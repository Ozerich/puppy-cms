<?php

class Api_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    private function response($message = "")
    {
        echo json_encode(array(
            'error' => 0,
            'message' => $message,
        ));
        die;
    }

    private function error($error = "")
    {
        echo json_encode(array(
            'error' => 1,
            'message' => $error
        ));
        die;
    }

    public function index()
    {
        $message = json_decode(file_get_contents('http://dogscat/api/get/2'));
        print_r($message->message);exit();
        die;
    }

    public function get($city_id = 0, $kind_id = 0)
    {
        $city = City::find_by_id($city_id);
        if(!$city)
            $this->error('City is no found');

        $conditions = array(
            'city_id' => $city_id,
            'animal_id' => 1,
            'status' => 'public',
        );

        if($kind_id)
            $conditions['kind_id'] = $kind_id;

        $items = Item::find('all', array('conditions' => $conditions));

		$data = array();
		
        foreach($items as $item){
		
			$wool_length = $item->wool_length;
			if($wool_length)
				$wool_length = $wool_length == 'короткошерстный' ? 'short' : 'long';
				
            $data[$item->id] = array(
                'id' => $item->id,
				'sex' => $item->sex,
				'weight' => floatval($item->weight),
                'link' => site_url('view/'.$item->id),
                'preview_header' => $item->preview_header,
                'preview_text' => $item->preview_text,
                'preview_image' => site_url($item->preview_image),
                'price' => $item->site_price,
				'wool_length' => $wool_length,
			);
		}
		
       $this->response($data);
    }
}

?>