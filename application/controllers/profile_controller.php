<?php

class Profile_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user)
            redirect('login');
    }

    private function proc_image($item_id = 0, $type = 'main', $image = '')
    {
        $file_ext = substr($image, strrpos($image, '.') + 1);
        if ($file_ext === false)
            return '';

        $file_name = $item_id . '-' . $type . '.' . $file_ext;
        @rename('img/tmp/' . $image, Config::get('item_images_dir') . $file_name);
        return $file_name;
    }

    public function index()
    {
        $this->view_data['item_list'] = $this->load->view('profile/item_list.php', array('items' => $this->user->items), true);
        $this->set_page_title('Личный кабинет');
    }

    private function fill_item_data()
    {
        $this->view_data['settings'] = $this->view_data['organizations'] = array();
        foreach (Kind::all() as $kind)
            $this->view_data['settings'][$kind->id] = $this->user->city ? KindSetting::get($kind->id, $this->user->city->id) : null;

        foreach (Animal::all() as $animal) {
            $this->view_data['organizations'][$animal->id] = array();
            foreach ($animal->organizations as $org)
                if ($this->user->city->id && CityOrganization::check($this->user->city->id, $org->id))
                    $this->view_data['organizations'][$animal->id][] = $org;
        }
    }

    public function new_item()
    {
        $this->fill_item_data();
        $this->set_page_title('Новое объявление');
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

    public function calc_price()
    {
        $price = $this->input->post('price');

        if (!is_numeric($price))
            echo '0';
        else
            echo Commission::get_commission($this->user->city->id, $price) + $price;

        exit();
    }

    public function upload_image($elem_id)
    {
        $this->load->library('upload');

        $this->upload->initialize(array(
            'upload_path' => 'img/tmp',
            'allowed_types' => 'gif|jpg|png',
            'encrypt_name' => TRUE
        ));

        $data = array();

        if (!$this->upload->do_upload(key($_FILES)))
            $data = 'error';
        else
        {
            $file_data = $this->upload->data();
            $data = json_encode(array('id' => $elem_id, 'filename' => $file_data['file_name']));
        }

        echo $data;
        exit();
    }

    public function edit_item($item_id = 0)
    {
        $item = Item::find_by_id($item_id);

        if (!$item)
            show_404();

        if ($_POST) {
            $kind = Kind::find_by_id($this->input->post('kind'));
            $animal_id = $kind->animal_id;

            $price = $this->input->post('price');

            if (!is_numeric($price))
                show_404();

            $type = $this->input->post('pay_type');
            $site_price = ($type == "free" ? Commission::get_commission($this->user->city_id, $price) : 0) + $price;

            $item->kind_id = $kind->id;
            $item->plant_count = $this->input->post('plant_count');
            $item->plant_name = $this->input->post('plant_name');
            $item->birthday = inputdate_to_mysqldate($this->input->post('birthday'));
            $item->organization_id = $this->input->post('organization');
            $item->mother_name = $this->input->post('mother_name');
            $item->mother_age = $this->input->post('mother_age');
            $item->mother_weight = $this->input->post('mother_weight');
            $item->mother_height = $this->input->post('mother_height');
            $item->mother_prizes = $this->input->post('mother_prizes');
            $item->father_name = $this->input->post('father_name');
            $item->father_age = $this->input->post('father_age');
            $item->father_weight = $this->input->post('father_weight');
            $item->father_height = $this->input->post('father_height');
            $item->father_prizes = $this->input->post('father_prizes');
            $item->sex = $this->input->post('sex');
            $item->video = $this->input->post('video');
            $item->description = $this->input->post('description');
            $item->another = $this->input->post('another');
            $item->price = $price;
            $item->site_price = $site_price;
            $item->type = $type;
            $item->change_status('edited');

            if ($this->input->post('main_image_filename'))
                $item->image = $this->proc_image($item->id, 'main', $this->input->post('main_image_filename'));

            if ($this->input->post('mother_image_filename'))
                $item->mother_image = $this->proc_image($item->id, 'mother', $this->input->post('mother_image_filename'));

            if ($this->input->post('father_image_filename'))
                $item->father_image = $this->proc_image($item->id, 'father', $this->input->post('father_image_filename'));

            ItemDocument::reset($item->id);
            ItemImage::reset($item->id);
            ItemField::reset($item->id);

            $documents = explode(',', $this->input->post('documents'));

            foreach ($documents as $doc)
                if ($doc)
                    ItemDocument::create(array('item_id' => $item->id, 'document_id' => $doc));

            for ($i = 1; $i <= Config::get('item_images_count'); $i++)
                if ($this->input->post('image' . $i . '_filename'))
                    ItemImage::create(array('item_id' => $item->id, 'pos' => $i, 'image' => $this->proc_image($item->id, 'photo_' . $i,
                        $this->input->post('image' . $i . '_filename'))));

            foreach ($kind->fields as $field)
                ItemField::create(array('item_id' => $item->id, 'field_id' => $field->id, 'value' => $this->input->post('param_' . $field->id)));

            $item->weight = $item->field_weight;
            $item->height = $item->field_height;
            $item->save();

            exit();
        }

        $this->fill_item_data();
        $this->view_data['item'] = $item;
    }

    public function add_item()
    {
        $kind = Kind::find_by_id($this->input->post('kind'));
        $animal_id = $kind->animal_id;

        $price = $this->input->post('price');

        if (!is_numeric($price))
            show_404();

        $type = $this->input->post('pay_type');
        $site_price = ($type == "free" ? Commission::get_commission($this->user->city_id, $price) : 0) + $price;

        $item = Item::create(array(
            'user_id' => $this->user->id,
            'city_id' => $this->user->city_id,
            'kind_id' => $kind->id,
            'animal_id' => $animal_id,
            'plant_count' => $this->input->post('plant_count'),
            'plant_name' => $this->input->post('plant_name'),
            'birthday' => inputdate_to_mysqldate($this->input->post('birthday')),
            'organization_id' => $this->input->post('organization'),
            'mother_name' => $this->input->post('mother_name'),
            'mother_age' => $this->input->post('mother_age'),
            'mother_weight' => $this->input->post('mother_weight'),
            'mother_height' => $this->input->post('mother_height'),
            'mother_prizes' => $this->input->post('mother_prizes'),
            'father_name' => $this->input->post('father_name'),
            'father_age' => $this->input->post('father_age'),
            'father_weight' => $this->input->post('father_weight'),
            'father_height' => $this->input->post('father_height'),
            'father_prizes' => $this->input->post('father_prizes'),
            'sex' => $this->input->post('sex'),
            'video' => $this->input->post('video'),
            'description' => $this->input->post('description'),
            'another' => $this->input->post('another'),
            'price' => $price,
            'site_price' => $site_price,
            'type' => $type,
            'image' => $this->proc_image('main', $this->input->post('main_image_filename')),
        ));

        $item->change_status('created');

        $item->mother_image = $this->proc_image($item->id, 'mother', $this->input->post('mother_image_filename'));
        $item->father_image = $this->proc_image($item->id, 'father', $this->input->post('father_image_filename'));
        $item->image = $this->proc_image($item->id, 'mainphoto', $this->input->post('main_image_filename'));


        ItemDocument::reset($item->id);
        ItemImage::reset($item->id);
        ItemField::reset($item->id);

        $documents = explode(',', $this->input->post('documents'));

        foreach ($documents as $doc)
            if ($doc)
                ItemDocument::create(array('item_id' => $item->id, 'document_id' => $doc));

        for ($i = 1; $i <= Config::get('item_images_count'); $i++)
            ItemImage::create(array('item_id' => $item->id, 'pos' => $i, 'image' => $this->proc_image($item->id, 'photo_' . $i,
                $this->input->post('image' . $i . '_filename'))));

        foreach ($kind->fields as $field)
            ItemField::create(array('item_id' => $item->id, 'field_id' => $field->id, 'value' => $this->input->post('param_' . $field->id)));

        $item->weight = $item->field_weight;
        $item->height = $item->field_height;
        $item->save();

        exit();
    }

    public function admin_item($item_id = 0)
    {
        $item = Item::find_by_id($item_id);
        if (!$item)
            show_404();
    }

    public function update_item($item_id = 0)
    {
        $status = $this->input->post('status');
        $item = Item::find_by_id($item_id);

        if(!$item || !$this->user || $item->user_id != $this->user->id)
            die;

        if($status == 'canceled')
            $item->change_status('canceled');
        if($status == 'public')
            $item->change_status('edited');

        die;
    }
}

?>