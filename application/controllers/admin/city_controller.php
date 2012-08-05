<?php

class City_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
				if(!$this->session->userdata('access_admin'))
			show_404();
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

        if (!$city) {
            show_404();
            exit();
        }

        if ($_POST) {

            $city->name = $this->input->post('name');
            $city->alias = $this->input->post('alias');
            $city->valute = $this->input->post('valute');
            $city->bank = $this->input->post('bank');
            $city->title = $this->input->post('title');
            $city->meta_keywords = $this->input->post('meta_keywords');
            $city->meta_description = $this->input->post('meta_description');

            $city->save();

            CityOrganization::table()->delete(array('city_id' => $city->id));
            $organizations = isset($_POST['organization_enable']) ? $_POST['organization_enable'] : array();

            foreach ($organizations as $org_id => $t)
                CityOrganization::create(array('organization_id' => $org_id, 'city_id' => $city_id));

            redirect('admin/cities');
        }

        $this->view_data['city'] = $city;

        $this->view_data['organization_enable'] = array();
        foreach (Organization::all() as $organization)
            $this->view_data['organization_enable'][$organization->id] = CityOrganization::find(
                array('conditions' => array('organization_id = ? AND city_id = ?', $organization->id, $city->id))) ? 1 : 0;

        $this->view_data['commission_list'] = $this->load->view('admin/city/commission_list.php', array('commissions' => $city->commissions), true);
    }

    public function delete_commission($com_id = 0)
    {
        $commission = Commission::find_by_id($com_id);

        if (!$commission) {
            show_404();
            exit();
        }

        $commission->delete();
        exit();
    }

    public function new_commission($city_id)
    {
        $city = City::find_by_id($city_id);

        if (!$city) {
            show_404();
            exit();
        }

        Commission::create(array(
            'city_id' => $city_id,
            'from' => $this->input->post('from'),
            'to' => $this->input->post('to'),
            'value' => $this->input->post('value')
        ));

        echo $this->load->view('admin/city/commission_list.php', array('commissions' => $city->commissions), true);
        exit();
    }
}

?>