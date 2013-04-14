<?php

require_once APPPATH . "libraries/SimpleImage.php";

class MY_Controller extends CI_Controller
{
    var $user = FALSE;

    protected $layout_view = "application";
    protected $content_view = "";
    protected $view_data = array();
    protected $view_folder = "";

    private $template_path;


    public function __construct($is_admin = false)
    {
        parent::__construct();

        $this->user = $this->session->userdata('user_id') ? User::find($this->session->userdata('user_id')) : FALSE;
        $this->view_data['user'] = $this->user;

        if (!$this->user && $is_admin)
            redirect('admin/auth');

        if ($is_admin) {
            $this->view_folder = 'admin';
            $this->layout_view = 'admin';
        }
		
		$reviews = array();
		foreach(Article::find('all', array('conditions' => array('category_id = ?', 7), 'order' => 'created_time DESC','limit' => '3')) as $review)
			$reviews[] = array(
				'id' => $review->id,
				'image' => site_url('img/articles/'.$review->image),
				'preview' => $review->preview,
			);
		$this->view_data['all_reviews'] = $reviews;
    }

    public function _output($output)
    {
        $controller_class = strpos(strtolower($this->router->class), '_controller') !== FALSE ? substr($this->router->class, 0, -11) : $this->router->class;

        if ($this->content_view !== FALSE && empty($this->content_view))
            $this->content_view = $this->view_folder . "/" . $controller_class . "/" . $this->router->method . (($this->template_path) ? '/' . $this->template_path : '');

        $content = file_exists(APPPATH . "views/" . $this->content_view . EXT)
                ? $this->load->view($this->content_view, $this->view_data, TRUE) : FALSE;

        $this->view_data['page_content'] = $content;
        if ($this->layout_view)
            echo $this->load->view('layouts/' . $this->layout_view, $this->view_data, TRUE);
        else
            echo $content;
    }

    protected function set_page_title($title)
    {
        $this->view_data['page_title'] = $title;
    }

    protected function set_page_tpl($path)
    {
        $this->template_path = $path;
    }
}

?>