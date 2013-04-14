<?php

class Article_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($cat_id = '', $item_id = '')
    {
        if (!$cat_id && !$item_id) {
            $articles = Article::all();
            $this->view_data['articles'] = $articles;
            $this->content_view = 'article/article_list';
        } else if ($cat_id && !$item_id) {

            $category = ArticleCategory::find_by_alias($cat_id);
            if ($category) {
                $articles = Article::find_all_by_category_id($category->id);
                $this->view_data['articles'] = $articles;
				
				$this->view_data['page_title'] = $category->name;
				
                $this->content_view = 'article/article_list';
            } else {
                $article = Article::find_by_alias($cat_id);
                if (!$article) show_404();
                $this->view_data['article'] = $article;
                $this->view_data['page_title'] = $article->title;
                $this->view_data['meta_keywords'] = $article->meta_keywords;
                $this->view_data['meta_description'] = $article->meta_description;
                $this->content_view = 'article/article_view';
            }
        } else {
            $category = ArticleCategory::find_by_alias($cat_id);
			
            if (!$category)
                show_404();

            $article = Article::find(array('conditions' => array('alias = ? AND category_id = ?', $item_id, $category->id)));
            if (!$article)
                show_404();

            $this->view_data['article'] = $article;
            $this->view_data['page_title'] = $article->title;
            $this->view_data['meta_description'] = $article->meta_description;
            $this->view_data['meta_keywords'] = $article->meta_keywords;
            $this->content_view = 'article/article_view';
        }
		
    }

    public function otzyvy()
    {
        $category = ArticleCategory::find_by_alias('otzyvy');
		
				$this->view_data['page_title'] = $category->name;
        if ($category) {
            $articles = Article::find_all_by_category_id($category->id);
            $this->view_data['articles'] = $articles;
            $this->content_view = 'article/article_list_otzivy';
        } else {
            $article = Article::find_by_alias('otzyvy');
            if (!$article) show_404();
            $this->view_data['article'] = $article;
            $this->content_view = 'article/article_view';
        }
		


    }

    public function show_static_page($page_name = '')
    {
        switch ($page_name) {

            case('kontakt'):
                $category = ArticleCategory::find_by_alias('kontakt');
                if ($category) {
                    $articles = Article::find_all_by_category_id($category->id);
                    $this->view_data['articles'] = $articles;
                    $this->content_view = 'article/article_list';
                } else {
                    $article = Article::find_by_alias('kontakt');
                    if (!$article) show_404();
                    $this->view_data['article'] = $article;
                    $this->content_view = 'article/article_view';
                }


                break;

            case('about'):
                $category = ArticleCategory::find_by_alias('about');
                if ($category) {
                    $articles = Article::find_all_by_category_id($category->id);
                    $this->view_data['articles'] = $articles;
                    $this->content_view = 'article/article_list';
                } else {
                    $article = Article::find_by_alias('about');
                    if (!$article) show_404();
                    $this->view_data['article'] = $article;
                    $this->content_view = 'article/article_view';
                }


                break;

            case('all-offers'):
                $category = ArticleCategory::find_by_alias('all-offers');
                if ($category) {
                    $articles = Article::find_all_by_category_id($category->id);
                    $this->view_data['articles'] = $articles;
                    $this->content_view = 'article/article_list';
                } else {
                    $article = Article::find_by_alias('all-offers');
                    if (!$article) show_404();
                    $this->view_data['article'] = $article;
                    $this->content_view = 'article/article_view';
                }

                break;

            default:
                show_404();
        }
		
		$this->view_data['meta_description'] = $article->meta_description;
		$this->view_data['meta_keywords'] = $article->meta_keywords;
		$this->view_data['page_title'] = $article->title;


    }

}

?>