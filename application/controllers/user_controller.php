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

    private function send_email($item_id = 0)
    {
        $item = Item::find_by_id($item_id);
        if (!$item) return FALSE;

        $email_template = '';
        if ($item->status == 'public')
            $email_template = Config::get('publish_mail');
        else if ($item->status == 'finished')
            $email_template = Config::get('endtime_mail');
        else if ($item->status == 'canceled')
            $email_template = Config::get('stoped_mail');

        if (!$email_template)
            return FALSE;

        $email_template = str_replace("\n", "<br/>", $email_template);

        $email_template = str_replace('{{$user}}', $item->user->fullname, $email_template);
        $email_template = str_replace('{{$site_name}}', Config::get('site_name'), $email_template);
        $email_template = str_replace('{{$item_link}}', '<a href="site.com/view/' . $item->id . '">перейти</a>', $email_template);
        $email_template = str_replace('{{$item_finish_date}}', $item->finish_time ? $item->finish_time->format('d.m.Y H:i') : '', $email_template);
        $email_template = str_replace('{{$item_animal}}', $item->animal_id == 1 ? 'щенка' : 'котёнка', $email_template);
        $email_template = str_replace('{{$item_animal}}', $item->animal_id == 1 ? 'щенка' : 'котёнка', $email_template);
        $email_template = str_replace('{{$item_editlink}}', '<a href="site.com/edit/' . $item->id . '">перейти</a>', $email_template);

        $site_email = Config::get('site_email');

        $this->email->initialize(array('mailtype' => 'html'));

        $this->email->from($site_email, 'Имя сайта');
        $this->email->to($item->user->email);

        $this->email->subject('Информация об объявлении');
        $this->email->message($email_template);

        $this->email->send();
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

        $params = array();
        if ($status == 'public')
            $params['publish_till'] = $this->input->post('publish_till');
        else if ($status == 'saled')
            $params['saled_by'] = $this->input->post('saled_by');

        $item->change_status($status, $params);
        $this->send_email($item->id);

        $item->display_mainpage = $this->input->post('mainpage_show');
        $item->save();

        echo $this->load->view('user/user_items.php', array('items' => $item->user->items), true);
        die;
    }
}

?>