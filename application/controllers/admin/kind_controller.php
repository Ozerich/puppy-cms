<?php

class Kind_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
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
            $kind->save();

            KindField::table()->delete(array('kind_id' => $kind_id));
            if (isset($_POST['fields']))
                foreach ($_POST['fields'] as $field_id => $val)
                    KindField::create(array('field_id' => $field_id, 'kind_id' => $kind_id));

            KindText::table()->delete(array('kind_id' => $kind->id));
            foreach ($_POST['before'] as $city_id => $text)
                KindText::create(array('city_id' => $city_id, 'kind_id' => $kind_id, 'text' => $text, 'type' => 'before'));
            foreach ($_POST['after'] as $city_id => $text)
                KindText::create(array('city_id' => $city_id, 'kind_id' => $kind_id, 'text' => $text, 'type' => 'after'));

            redirect('admin/kinds');
        }

        $this->view_data['kind'] = $kind;

        $this->view_data['fields'] = array();
        foreach (ItemField::all() as $if)
            $this->view_data['fields'][$if->id] = 0;

        $data = KindField::find_all_by_kind_id($kind_id);
        foreach ($data as $kf)
            $this->view_data['fields'][$kf->field_id] = 1;

        $this->view_data['before'] = $this->view_data['after'] = array();
        foreach (City::all() as $city_id => $city) {
            $text = KindText::find(array('conditions' => array('city_id = ? AND kind_id = ? AND type = "before"', $city->id, $kind_id)));
            $this->view_data['before'][$city->id] = $text ? $text->text : '';

            $text = KindText::find(array('conditions' => array('city_id = ? AND kind_id = ? AND type = "after"', $city->id, $kind_id)));
            $this->view_data['after'][$city->id] = $text ? $text->text : '';
        }

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