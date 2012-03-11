<?php

class Dashboard_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
    }

    public function index()
    {

        $this->view_data['page_title'] = 'Dashboard';
    }
}

?>