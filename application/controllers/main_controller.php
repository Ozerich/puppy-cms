<?php

class Main_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_list($city_alias = '', $kind_alias = '')
    {
        $city = City::find_by_alias($city_alias);
        if (!$city) show_404();

        $kind = $kind_alias ? Kind::find_by_alias($kind_alias) : null;

        $items = $kind ?
                Item::all(array('conditions' => array('city_id = ? AND kind_id = ? AND status = ?', $city->id, $kind->id, 'public'))) :
                Item::all(array('conditions' => array('city_id = ? AND status = ?', $city->id, 'public')));

        $this->view_data['filter_phone'] = $kind ? KindSetting::get($kind->id, $city->id)->phone : KindSetting::get(1, $city->id)->phone;

        $this->view_data['text_before'] = '';
        $this->view_data['text_after'] = '';

        $filter_data = array('filter_type' => '', 'cities' => array($city->id));

        $data = array('items' => $items, 'cities' => array($city->id));
        if ($kind)
            $filter_data['kinds'] = array($kind->id);


        $admin_filter = $this->load->view('item/admin_filter.php', $filter_data, true);

        $data['admin_filter'] = $admin_filter;
        $this->view_data['item_list'] = $this->load->view('item/item_list.php', $data, true);

        if($kind && $city)
        {
            $this->view_data['meta_keywords'] = KindSetting::get($kind->id, $city->id)->meta_keywords;
            $this->view_data['meta_description'] = KindSetting::get($kind->id, $city->id)->meta_description;
            $this->view_data['page_title'] = KindSetting::get($kind->id, $city->id)->title;
        }
        else if($city)
        {
            $this->view_data['meta_keywords'] = $city->meta_keywords;
            $this->view_data['meta_description'] = $city->meta_description;
            $this->view_data['page_title'] = $city->title;
        }

        $this->content_view = 'main/index';
    }

    public function filter()
    {

        $city = $this->input->post('city');
        $kind = $this->input->post('kind');

        $settings = KindSetting::get($kind, $city);

        $q = "city_id = " . $city . ' AND kind_id = ' . $kind;
        $q .= $this->input->post('sex') == '0' ? '' : ' AND sex = "' . $this->input->post('sex') . '"';

        $price = explode('_', $this->input->post('price'));
        $q .= ' AND price >= ' . $price[0] . ($price[1] != 'inf' ? ' AND price <= ' . $price[1] : '');

        if ($this->input->post('weight')) {
            $weight = explode('_', $this->input->post('weight'));
            $q .= ' AND weight >= ' . $weight[0] . ($weight[1] != 'inf' ? ' AND weight <= ' . $weight[1] : '');
        }

        if ($this->input->post('height')) {
            $height = explode('_', $this->input->post('height'));
            $q .= ' AND height >= ' . $height[0] . ($height[1] != 'inf' ? ' AND height <= ' . $height[1] : '');
        }

        $q .= ' AND status = "public"';

        $items = Item::all(array('conditions' => $q));

        $this->view_data['text_before'] = '';
        $this->view_data['text_after'] = '';

        $admin_filter = $this->load->view('item/admin_filter.php', array('filter_type' => '', 'cities' => array($city), 'kinds' => array($kind)), true);
        $this->view_data['item_list'] = $this->load->view('item/item_list.php', array('items' => $items, 'cities' => array($city), 'kinds' => array($kind), 'admin_filter' => $admin_filter), true);

        echo json_encode(
            array(
                'data' => $this->load->view('main/index.php', $this->view_data, true),
                'phone' => $settings->phone));
        die;
    }

    public function item_list()
    {
        $filter_type = $this->input->post('filter_type');

        $this->view_data['text_before'] = '';
        $this->view_data['text_after'] = '';

        if ($filter_type != 'users') {
            if ($filter_type == 'new_and_edit')
                $type_q = 'status = "edited" OR status = "created"';
            elseif ($filter_type == 'closed')
                $type_q = 'status = "closed"';
            elseif ($filter_type == 'sell_plant')
                $type_q = 'status = "saled" AND saled_by = "plant"';
            elseif ($filter_type == 'sell_site')
                $type_q = 'status = "saled" AND saled_by = "site"';
            elseif ($filter_type == 'sell_null')
                $type_q = 'status = "saled" AND NOT saled_by';
            elseif ($filter_type == 'near_finish')
                $type_q = 'status = "publish" AND 1';
            else
                $type_q = '1';
            $type_q = '(' . $type_q . ')';

            $cities = array();
            $city_q = '';
            $cities_post = isset($_POST['city']) ? $_POST['city'] : array();
            foreach ($cities_post as $city_id => $t)
            {
                $cities[] = $city_id;
                $city_q .= ($city_q == '' ? '' : ' OR ') . "city_id = " . $city_id;
            }
            $city_q = $city_q ? '(' . $city_q . ')' : '0';

            $kinds = array();
            $kind_q = '';
            $kinds_post = isset($_POST['kind']) ? $_POST['kind'] : array();
            foreach ($kinds_post as $kind_id => $t)
            {
                $kinds[] = $kind_id;
                $kind_q .= ($kind_q == '' ? '' : ' OR ') . "kind_id = " . $kind_id;
            }
            $kind_q = $kind_q ? '(' . $kind_q . ')' : '0';

            $items = Item::all(array('conditions' => array($city_q . ' AND ' . $kind_q . ' AND ' . $type_q)));

            $admin_filter = $this->load->view('item/admin_filter.php', array('filter_type' => $filter_type, 'cities' => $cities, 'kinds' => $kinds), true);
            $this->view_data['item_list'] = $this->load->view('item/item_list.php', array('admin_filter' => $admin_filter, 'items' => $items, 'filter_type' => $filter_type, 'cities' => $cities, 'kinds' => $kinds), true);
        }
        else {

            $user_filter = array(
                'public_exist' => isset($_POST['public_exist']) ? 1 : 0,
                'closed_exist' => isset($_POST['closed_exist']) ? 1 : 0,
                'best_users' => isset($_POST['best_users']) ? 1 : 0,
                'email' => isset($_POST['user_email']) ? $_POST['user_email'] : ''
            );

            $admin_filter = $this->load->view('item/admin_filter.php', array('filter_type' => $filter_type, 'user_filter' => $user_filter), true);

            $users = array();

            $conditions = $user_filter['email'] ? 'email LIKE "%' . $user_filter['email'] . '%"' : '';

            foreach (User::all(array('conditions' => $conditions)) as $user)
            {
                if ($user_filter['best_users'] && !$user->is_best)
                    continue;

                if ($user_filter['closed_exist'] && $user->closed_count == 0)
                    continue;

                if ($user_filter['public_exist'] && $user->public_count == 0)
                    continue;

                $users[] = $user;
            }


            $this->view_data['item_list'] = $this->load->view('item/user_list.php', array('admin_filter' => $admin_filter, 'users' => $users, 'filter_type' => $filter_type), true);
        }

        $this->content_view = 'main/index';
    }

    public function index()
    {
        $items = Item::all(array('conditions' => array('display_mainpage = 1 AND status="public"')));

        $this->set_page_title('Главная страница');

        $admin_filter = $this->load->view('item/admin_filter.php', array('filter_type' => '',), true);

        $this->view_data['item_list'] = $this->load->view('item/item_list.php', array('items' => $items, 'admin_filter' => $admin_filter), true);

        $this->view_data['text_before'] = '';
        $this->view_data['text_after'] = '';
    }

    public function view_item($item_id = 0)
    {
        $item = Item::find_by_id($item_id);
        if (!$item)
            show_404();

        $this->view_data['item'] = $item;
        $this->content_view = 'item/view';
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
        $email_template = str_replace('{{$item_link}}', '<a href="site.com/view/'.$item->id.'">перейти</a>', $email_template);
        $email_template = str_replace('{{$item_finish_date}}', $item->finish_time->format('d.m.Y H:i'), $email_template);
        $email_template = str_replace('{{$item_animal}}', $item->animal_id == 1 ? 'щенка' : 'котёнка', $email_template);
        $email_template = str_replace('{{$item_animal}}', $item->animal_id == 1 ? 'щенка' : 'котёнка', $email_template);
        $email_template = str_replace('{{$item_editlink}}', '<a href="site.com/edit/'.$item->id.'">перейти</a>', $email_template);

        $site_email = Config::get('site_email');

        $this->email->initialize(array('mailtype' => 'html'));

        $this->email->from($site_email, 'Имя сайта');
        $this->email->to($item->user->email);

        $this->email->subject('Информация об объявлении');
        $this->email->message($email_template);

        $this->email->send();
    }

    public function admin_item($item_id = 0)
    {
        $item = Item::find_by_id($item_id);

        if (!$item || !$this->user || $this->user->access_edit == FALSE)
            die;

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


        echo 'OK';
        die;
    }
}

?>