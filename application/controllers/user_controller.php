<?php

class User_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($user_id = 0)
    {
        if (!$this->user || !$this->user->access_edit)
            redirect('login');

        $user = User::find_by_id($user_id);
        if (!$user) show_404();

        if ($_POST) {
            $user->name = $this->input->post('name');
            $user->surname = $this->input->post('surname');
            $user->phone = $this->input->post('phone');
            $user->email = $this->input->post('email');

            $user->is_best = isset($_POST['best']) ? 1 : 0;
            $user->is_agreed = isset($_POST['checked']) ? 1 : 0;
            $user->is_checked = isset($_POST['accept']) ? 1 : 0;

            $user->information = $this->input->post('information');

            $user->save();
        }

        $this->view_data['user_items'] = $this->load->view('user/user_items.php', array('items' => $user->items), true);
        $this->view_data['user'] = $user;
    }

    public function update_item($item_id = 0)
    {
        if (!$this->user || !$this->user->access_edit)
            redirect('login');

        $item = Item::find_by_id($item_id);
        if (!$item) show_404();
        if (!$_POST) show_404();

        $status = $this->input->post('status');
        if (!in_array($status, Item::$STATUSES))
            die;


        ItemMedal::reset($item_id);
        $medals = isset($_POST['medals']) ? $_POST['medals'] : array();
        foreach ($medals as $medal)
            ItemMedal::create(array('item_id' => $item_id, 'medal_id' => $medal));

        $item->status = $status;

        if($status == 'created')
        {
            $item->closed_time = $item->changed_time = $item->publish_time = $item->finish_time = null;
            $item->closed_by = $item->publish_by = $item->changed_by = 0;
        }
        else if($status == 'edited')
        {
            $item->closed_time = $item->publish_time = $item->finish_time = null;
            $item->closed_by = $item->publish_by = 0;
        }
        else if ($status == 'public') {
            $now = time_to_mysqldatetime(time());
            $item->publish_time = $now;
            $item->publish_by = $this->user->id;
            $item->finish_time = inputdate_to_mysqldate($this->input->post('publish_till')) . substr($now, 10);
            $item->closed_time = null;
            $item->closed_by = 0;
        }
        else if ($status == 'saled') {
            $saled_by = $this->input->post('saled_by');
            if ($saled_by && $saled_by != 'site' && $saled_by != 'plant') die;
            $old_saled = $item->saled_by;
            $item->saled_by = $saled_by ? $saled_by : NULL;

            $user = $item->user;

            if ($old_saled == "site")
                $user->sell_site--;
            else if ($old_saled == 'plant')
                $user->sell_plant--;

            if ($saled_by == "site")
                $user->sell_site++;
            else if ($saled_by == "plant")
                $user->sell_plant++;

            $user->save();

        }

        if ($status == 'finished' || $status == 'canceled' || $status == 'saled') {
            $item->closed_time = time_to_mysqldatetime(time());
            $item->closed_by = $this->user->id;
        }

        $item->display_mainpage = $this->input->post('mainpage_show');
        $item->save();


        echo $this->load->view('user/user_items.php', array('items' => $item->user->items), true);
        die;
    }
}

?>