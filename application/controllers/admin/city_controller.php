<?php

class City_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
    }

    public function index()
    {

        $this->view_data['cities'] = City::all();
        $this->set_page_title('Города');
    }

    public function create()
    {
        $name = $this->input->post('name');

        if ($name)
            City::create(array('name' => $name));

        redirect('admin/cities');
    }

    public function delete($city_id = 0)
    {
        $city = City::find_by_id($city_id);

        if (!$city) {
            show_404();
            exit();
        }

        $city->delete();

        redirect('admin/cities');
    }

    public function view($city_id = 0)
    {
        $city = City::find_by_id($city_id);

        if(!$city)
        {
            show_404();
            exit();
        }

        if($_POST){

            $city->name = $this->input->post('name');
            $city->alias = $this->input->post('alias');
            $city->valute = $this->input->post('valute');

            $city->save();

            redirect('admin/cities');
        }

        $this->view_data['city'] = $city;
    }

    public function delete_commission($com_id = 0)
    {

    }
}

?>