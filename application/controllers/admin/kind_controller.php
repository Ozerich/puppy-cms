<?php

class Kind_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
				if(!$this->session->userdata('access_admin'))
			show_404();
    }

    public function index()
    {
        $this->view_data['kinds'] = Kind::find_all_by_parent_id(0);
        $this->set_page_title('Породы');
    }

    public function create()
    {
        $name = $this->input->post('name');

        if ($name && $this->input->post('animal'))
            Kind::create(
                array('name' => $name, 'animal_id' => $this->input->post('animal'), 'alias' => $this->input->post('alias'))
            );

        redirect('admin/kinds');
    }

    public function delete($kind_id = 0)
    {
        $kind = Kind::find_by_id($kind_id);

        if (!$kind) {
            show_404();
            exit();
        }

        $kind->delete();

        redirect('admin/kinds');
    }

    public function view($kind_id = 0)
    {
        $kind = Kind::find_by_id($kind_id);
        if (!$kind) {
            show_404();
            exit();
        }

        if ($_POST) {

            $kind->animal_id = $this->input->post('animal');
            $kind->name = $this->input->post('name');
            $kind->alias = $this->input->post('alias');
            $kind->preview_template = str_replace("\r\n", '<br/>', $this->input->post('preview_template'));
            $kind->header_template = str_replace("\r\n", '<br/>', $this->input->post('header_template'));
            $kind->text_template = str_replace("\r\n", '<br/>', $this->input->post('text_template'));

            $kind->save();

            KindField::table()->delete(array('kind_id' => $kind_id));
            if (isset($_POST['fields']))
                foreach ($_POST['fields'] as $field_id => $val)
                    KindField::create(array('field_id' => $field_id, 'kind_id' => $kind_id));
            KindSetting::table()->delete(array('kind_id' => $kind->id));

            foreach ($_POST['title'] as $city_id => $t) {
                KindSetting::create(array(
                    'kind_id' => $kind_id,
                    'city_id' => $city_id,
                    'title' => $_POST['title'][$city_id],
                    'beforelist_text' => $_POST['before'][$city_id],
                    'afterlist_text' => $_POST['after'][$city_id],
                    'phone' => $_POST['phone'][$city_id],
                    'meta_keywords' => $_POST['meta_keywords'][$city_id],
                    'meta_description' => $_POST['meta_description'][$city_id],
                    'free_agreement' => $_POST['free_agreement'][$city_id],
                    'paid1_agreement' => $_POST['paid1_agreement'][$city_id],
                    'paid2_agreement' => $_POST['paid2_agreement'][$city_id],
                    'manager_contact' => $_POST['manager_contact'][$city_id],
                ));
            }

            redirect('admin/kinds');
        }

        $this->view_data['kind'] = $kind;

        $this->view_data['fields'] = array();
        foreach (Field::all() as $if)
            $this->view_data['fields'][$if->id] = 0;

        $data = KindField::find_all_by_kind_id($kind_id);
        foreach ($data as $kf)
            $this->view_data['fields'][$kf->field_id] = 1;

        $this->view_data['kind_settings'] = array();
        foreach (City::all() as $city_id => $city)
            $this->view_data['kind_settings'][$city->id] = KindSetting::find(array('conditions' => array('city_id = ? AND kind_id = ?', $city->id, $kind_id)));

        $this->view_data['subkind_list'] = $this->load->view('admin/kind/subkind_list.php', array('subkinds' => $kind->subkinds), true);
    }

    public function delete_subkind($kind_id = 0)
    {
        $kind = Kind::find_by_id($kind_id);

        if (!$kind) {
            show_404();
            exit();
        }

        $kind->delete();
        exit();
    }

    public function new_subkind($kind_id = 0)
    {
        $kind = Kind::find_by_id($kind_id);

        if (!$kind) {
            show_404();
            exit();
        }

        Kind::create(array(
            'parent_id' => $kind_id,
            'name' => $this->input->post('subkind_name')
        ));

        echo $this->load->view('admin/kind/subkind_list.php', array('subkinds' => $kind->subkinds), true);
        exit();
    }

}

?>