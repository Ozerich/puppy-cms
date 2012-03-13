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

    public function view($animal_id = 0)
    {
        $animal = Animal::find_by_id($animal_id);

        if (!$animal) {
            show_404();
            exit();
        }

        if ($_POST) {
            $animal->name = $this->input->post('name');
            $animal->alias = $this->input->post('alias');
            $animal->no_organization = $this->input->post('no_org');

            $animal->save();

            redirect('admin/animals');
        }

        $this->view_data['organization_list'] = $this->load->view('admin/animal/organization_list.php',
            array('organizations' => $animal->organizations), true);

        $this->view_data['animal'] = $animal;
    }

    public function new_organization($animal_id = 0)
    {
        $animal = Animal::find_by_id($animal_id);

        if (!$animal) {
            show_404();
            exit();
        }

        Organization::create(array(
            'animal_id' => $animal_id,
            'name' => $this->input->post('org_name'),
            'description' => $this->input->post('org_description')
        ));

        echo $this->load->view('admin/animal/organization_list.php',
            array('organizations' => $animal->organizations), true);
        exit();
    }

    public function delete_organization($org_id = 0)
    {
        $org = Organization::find_by_id($org_id);

        if (!$org) {
            show_404();
            exit();
        }

        $org->delete();
        exit();
    }

}

?>