<?php

class Animal_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
    }

    public function index()
    {

        $this->view_data['animals'] = Animal::all();
        $this->set_page_title('Животные');
    }

    public function create()
    {
        $name = $this->input->post('name');

        if ($name)
            Animal::create(array('name' => $name));

        redirect('admin/animals');
    }

    public function delete($animal_id = 0)
    {
        $animal = Animal::find_by_id($animal_id);

        if (!$animal) {
            show_404();
            exit();
        }

        $animal->delete();

        redirect('admin/animals');
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