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
        if($_POST)
        {
            $login = $_POST['uname'];
            $password = $_POST['upass'];

            $result = User::validate_login($login, $password, TRUE);
            if(!$result)
            {
                $this->view_data['error'] = 'Неверный логин или пароль';
            }
            else
                redirect('admin/');
        }

        $this->view_data['page_title'] = 'Login';
    }

    public function login()
    {
        if($_POST)
        {
            $login = $_POST['uname'];
            $password = $_POST['upass'];

            $result = User::validate_login($login, $password);
            if(!$result)
            {
                $this->view_data['error'] = 'Неверный логин или пароль';
            }
            else
                redirect('/');
        }
    }


    public function logout()
    {
        User::logout();

        redirect('');
    }
}

?>