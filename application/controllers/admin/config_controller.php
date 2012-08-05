<?php

class Config_Controller extends MY_Controller
{
    private $medal_config;

    public function __construct()
    {
        parent::__construct(true);
				if(!$this->session->userdata('access_admin'))
			show_404();

        $this->medal_config = array('upload_path' => Config::get('medals_dir'), 'allowed_types' => 'gif|jpg|png', 'max_size' => '100', 'max_width' => '120', 'max_height' => '120');
    }

    public function index()
    {
    }

    public function mails()
    {
        if ($_POST) {
            $mask = array('site_email', 'publish_mail', 'endtime_mail', 'stoped_mail', 'site_name', 'register_email');
            foreach ($mask as $ind)
                Config::set($ind, $this->input->post($ind));

            redirect('admin/config/mails');
        }

        $this->set_page_title('Настройки электронной почты');
    }

    public function content()
    {
        if ($_POST) {
            $mask = array('site_title', 'copyright', 'meta_keywords', 'meta_description', 'html_left', 'html_bottom_1', 'html_bottom_2', 'agreement2_text');
            foreach ($mask as $ind)
                Config::set($ind, $this->input->post($ind));

            redirect('admin/config/content');
        }
        $this->set_page_title('Управление контентом');
    }

    public function medals()
    {
        $this->view_data['medals'] = Medal::all();
        $this->set_page_title('Медали');
    }

    public function delete_medal($medal_id = 0)
    {
        $medal = Medal::find_by_id($medal_id);

        if (!$medal) {
            show_404();
            exit();
        }

        $medal->delete();
        redirect('admin/config/medals');
    }

    public function create_medal()
    {
        if ($_POST) {
            $name = $this->input->post('name');
            if (!$name)
                return false;

            $this->upload->initialize($this->medal_config);
            if (!$this->upload->do_upload('image')) {
                show_404();
                return false;
            }

            $file_data = $this->upload->data();
            Medal::create(array(
                'alt' => $this->input->post('alt'),
                'title' => $this->input->post('title'),
                'name' => $name, 'filename' => $file_data['file_name']));

            redirect('admin/config/medals');
        }
        else show_404();
    }

    public function view_medal($medal_id)
    {
        $medal = Medal::find_by_id($medal_id);
        ;
        if (!$medal) {
            show_404();
            exit();
        }

        if ($_POST) {

            $medal->name = $this->input->post('name');
            $medal->alt = $this->input->post('alt');
            $medal->title = $this->input->post('title');

            $this->upload->initialize($this->medal_config);
            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $medal->filename = $file_data['file_name'];
            }

            $medal->save();

            redirect('admin/config/medals');
        }

        $this->view_data['medal'] = $medal;
    }

}

?>