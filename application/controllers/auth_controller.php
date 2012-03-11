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

    public function logout()
    {
        User::logout();

        redirect('');
    }
}

?>