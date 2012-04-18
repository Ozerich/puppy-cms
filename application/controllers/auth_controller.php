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
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = User::validate_login($email, $password, TRUE);
            if (!$result) {
                $this->view_data['error'] = 'Неверный email или пароль';
                $this->view_data['email'] = $email;
            }
            else
                redirect('admin/');
        }
    }

    public function send_mail($user, $password)
    {
        $site_email = Config::get('site_email');
        $email_template = Config::get('register_email');

        $email_template = str_replace('{{email}}', $user->email, $email_template);
        $email_template = str_replace('{{password}}', $password, $email_template);
        $email_template = str_replace('{{$user}}', $user->user->fullname, $email_template);
        $email_template = str_replace('{{$site_name}}', Config::get('site_name'), $email_template);

        $email_template = str_replace("\n", '<br/>', $email_template);

        $this->email->initialize(array('mailtype' => 'html'));

        $this->email->from($site_email, 'dogscat.com');
        $this->email->to($user->email);

        $this->email->subject('Регистрация на сайте');
        $this->email->message($email_template);

        $this->email->send();
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
            $this->send_mail($user, $this->input->post('password'));
            User::login($user->id);
            redirect('profile');
        }
        else show_404();
    }

    public function user()
    {
        if ($this->user)
            redirect('profile');

        if ($_POST) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = User::validate_login($email, $password);
            if (!$result) {
                $this->view_data['error'] = 'Неверный e-mail или пароль';
                $this->view_data['email'] = $email;
            }
            else
                redirect('profile');
        }


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