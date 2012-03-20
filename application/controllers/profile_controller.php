<?php

class Profile_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user)
            redirect('login');
    }

    public function index()
    {

        $this->set_page_title('Личный кабинет');
    }


    public function ajax_save()
    {
        $this->load->helper('email');

        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');

        if (!$name || !$surname || !$phone || !$address || !valid_email($email))
            show_404();

        $this->user->email = $email;
        $this->user->name = $name;
        $this->user->surname = $surname;
        $this->user->phone = $phone;
        $this->user->address = $address;
        $this->user->city_id = $this->input->post('city');
        $this->user->metro = $this->input->post('metro');
        $this->user->save();

        exit();
    }
}

?>