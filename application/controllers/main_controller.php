<?php

class Main_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $items = Item::all();

        $this->set_page_title('Главная страница');
        $this->view_data['item_list'] = $this->load->view('item/item_list.php', array('items' => $items), true);

        $this->view_data['text_before'] = '';
        $this->view_data['text_after'] = '';
    }
}

?>