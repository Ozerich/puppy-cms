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
        }
        else if ($cat_id && !$item_id) {

            $category = ArticleCategory::find_by_alias($cat_id);
            if ($category) {
                $articles = Article::find_all_by_category_id($category->id);
                $this->view_data['articles'] = $articles;
                $this->content_view = 'article/article_list';
            }
            else
            {
                $article = Article::find_by_alias($cat_id);
                if (!$article) show_404();
                $this->view_data['article'] = $article;
                $this->content_view = 'article/article_view';
            }
        }
        else {
            $category = ArticleCategory::find_by_alias($cat_id);
            if(!$category)
                show_404();

            $article = Article::find(array('conditions' => array('alias = ? AND category_id = ?', $item_id, $category->id)));
            if(!$article)
                show_404();

            $this->view_data['article'] = $article;
            $this->content_view = 'article/article_view';
        }
    }
}

?>