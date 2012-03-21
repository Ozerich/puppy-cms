<?php

class Auth_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layout_view = "";

    }

    public function admin()
    {
        if ($_POST) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $result = User::validate_login($login, $password, TRUE);
            if (!$result) {
                $this->view_data['error'] = 'Неверный логин или пароль';
                $this->view_data['login'] = $login;
            }
            else
                redirect('admin/');
        }
    }

    public function register()
    {
        if ($_POST) {
            $user = User::create(array(
                'type' => 'user',
                'email' => $this->input->post('email'),
                'pass' => $this->input->post('password'),
                'name' => $this->input->post('name'),
                'surname' => $this->input->post('surname'),
                'city_id' => $this->input->post('city'),
                'metro' => $this->input->post('metro'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'register_time' => time_to_mysqldatetime(time()),
                'is_ban' => 0,
            ));
            User::login($user->id);
            redirect('profile');
        }
        else show_404();
    }

    public function user()
    {
        if ($this->user)
            redirect('profile');

        $this->layout_view = 'application';
        $this->set_page_title('Вход в систему');
    }

    public function logout()
    {
        User::logout();

        redirect('');
    }
}

?>