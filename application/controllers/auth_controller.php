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
        $email_template = str_replace('{{$user}}', $user->fullname, $email_template);
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

            $user_found = User::find_by_email($this->input->post('email'));
            if($user_found)
                die("Пользователь с таким email уже существует");

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
            $this->load->helper('email');
            if(!valid_email($email))
            {
                $this->view_data['error'] = 'Некорректный формат e-mail';
            }
            else if (!$result) {
                $this->view_data['error'] = 'Неверный e-mail или пароль<br/><input type="hidden" id="email_remind" value="'.$email.'"/>
                <a id="remind_password" onclick="remind_password(); return false;" href="auth/remind">Напомнить пароль</a>
                <div id="remind_password_ok">Пароль отправлен на <b>'.$email.'</b></div>
                ';
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

    public function remind()
    {
        $email = $this->input->post('email');
        $user = User::find_by_email($email);

        if(!$user)
            show_404();

        $user->remind_password();
    }
}

?>