<?$this->ci =& get_instance()?>
<?		$reviews = array();
foreach(Article::find('all', array('conditions' => array('category_id = ?', 7), 'order' => 'created_time DESC','limit' => '3')) as $review)
    $reviews[] = array(
        'id' => $review->id,
        'image' => site_url('img/articles/'.$review->image),
        'preview' => $review->preview,
    );
?>
<?=$this->ci->load->view('layouts/application', array('page_content' => Config::get('404'), 'all_reviews' => $reviews, '_404' => true), TRUE);?>