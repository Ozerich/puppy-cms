<?php

class User extends ActiveRecord\Model
{

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

    public static function validate_login($login, $password, $is_admin = FALSE)
    {
        $user = User::find_by_login($login);

        if(!$user || !$user->access_admin)
            return FALSE;

        if($user->validate_password($password))
        {
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
}

?>