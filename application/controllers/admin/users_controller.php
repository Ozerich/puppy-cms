<?php

class Users_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
    }

    public function index()
    {
        $users = User::all();
        $this->view_data['user_list'] = $this->load->view('admin/users/user_list.php', array('users' => $users), true);
        $this->set_page_title('Все пользователи');
    }

    public function admin()
    {

        $users = User::find_all_by_type('admin');

        $this->view_data['user_list'] = $this->load->view('admin/users/user_list.php', array('users' => $users), true);
        $this->set_page_title('Администраторы');
    }

    public function user()
    {
        $users = User::find_all_by_type('user');

        $this->view_data['user_list'] = $this->load->view('admin/users/user_list.php', array('users' => $users), true);
        $this->set_page_title('Зарегистированные пользователи');
    }

    public function manager()
    {
        $users = User::find_all_by_type('manager');

        $this->view_data['user_list'] = $this->load->view('admin/users/user_list.php', array('users' => $users), true);
        $this->set_page_title('Менеджеры');
    }

    public function create($type = "")
    {

        $this->view_data['type'] = $type;
    }
}

?>