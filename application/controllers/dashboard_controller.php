<?php

class Dashboard_Controller extends MY_Controller
{
    public function __construct()
    {
        $this->layout_view = "admin";
        $this->view_data['page_title'] = "Dashboard";

        parent::__construct();
   }

   public function index()
   {

   }
}

?>