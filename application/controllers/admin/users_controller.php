<?php

class Users_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
				if(!$this->session->userdata('access_admin'))
			show_404();
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

    public function edit($user_id = 0)
    {
        $user = User::find_by_id($user_id);

        if (!$user) {
            show_404();
            exit();
        }

        if ($_POST) {
            $user->email = $this->input->post('email');
            $user->pass = $this->input->post('password');
            $user->type = $this->input->post('type');
            $user->name = $this->input->post('name');
            $user->surname = $this->input->post('surname');
            $user->address = $this->input->post('address');
            $user->city_id = $this->input->post('city');
            $user->phone = $this->input->post('phone');
            $user->metro = $this->input->post('metro');
            $user->information = $this->input->post('information');
            $user->is_checked = $this->input->post('is_checked') == "on" ? 1 : 0;
            $user->is_best = $this->input->post('is_best') == "on" ? 1 : 0;
            $user->is_agreed = $this->input->post('is_agreed') == "on" ? 1 : 0;

            if ($this->input->post('password'))
                $user->pass = $this->input->post('password');

            $user->save();

            redirect('admin/users/' . $this->input->post('type'));
        }

        $this->view_data['user'] = $user;
    }

    public function create($type = "")
    {
        if ($_POST) {
            User::create(array(
                'email' => $this->input->post('email'),
                'pass' => $this->input->post('password'),
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'surname' => $this->input->post('surname'),
                'city_id' => $this->input->post('city'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'metro' => $this->input->post('metro'),
                'information' => $this->input->post('information'),
                'is_checked' => $this->input->post('is_checked') == "on" ? 1 : 0,
                'is_best' => $this->input->post('is_best') == "on" ? 1 : 0,
                'is_agreed' => $this->input->post('is_agreed') == "on" ? 1 : 0,
                'is_ban' => 0,
                'register_time' => time_to_mysqldatetime(time())
            ));

            redirect('admin/users/' . $this->input->post('type'));
        }
        $this->view_data['type'] = $type;
    }

    public function delete($user_id = 0)
    {
        $user = User::find_by_id($user_id);

        if (!$user) {
            show_404();
            exit();
        }

        $user->delete();

        redirect('admin/users');
    }
}

?>