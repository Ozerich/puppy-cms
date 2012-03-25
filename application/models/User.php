<?php

class User extends ActiveRecord\Model
{

    public static function generate_password($pass)
    {

        $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_RAND));
        $hash = hash("sha256", $salt . $pass);

        return $salt . $hash;

    }

    public function set_pass($plain_text)
    {
        $this->password = $this->hash_password($plain_text);
    }

    private function hash_password($password)
    {
        $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_RAND));
        $hash = hash("sha256", $salt . $password);

        return $salt . $hash;
    }

    private function validate_password($password)
    {
        $salt = substr($this->password, 0, 64);
        $hash = substr($this->password, 64, 64);

        $password_hash = hash("sha256", $salt . $password);

        return $password_hash == $hash;
    }

    public static function validate_login($email, $password, $is_admin = FALSE)
    {
        $user = User::find_by_email($email);

        if (!$user || ($is_admin && !$user->is_access_admin))
            return FALSE;

        if ($user->validate_password($password)) {
            User::login($user->id);
            return $user;
        }
        else
            return FALSE;
    }

    public static function login($user_id)
    {
        $CI =& get_instance();

        $CI->session->set_userdata("user_id", $user_id);
    }

    public static function logout()
    {
        $CI =& get_instance();
        $CI->session->sess_destroy();
    }

    public function get_is_access_admin()
    {
        return $this->type == "admin";
    }

    public function get_fullname()
    {
        return $this->name . " " . $this->surname;
    }

    public function get_plain_address()
    {
        return $this->country . ', ' . $this->city . ', ' . $this->address;
    }

    public function get_plain_type()
    {
        switch ($this->type) {
            case "admin":
                return "Администратор";
            case "manager":
                return "Менеджер";
            case "user":
                return "Пользователь";
            default:
                return "Неизвестно";
        }
    }

    public function get_city()
    {
        return City::find_by_id($this->city_id);
    }
}

?>