<?php

class Article_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(true);
    }

    public function index()
    {
        $this->view_data['categories'] = ArticleCategory::all();
        $this->view_data['articles'] = Article::find_all_by_category_id(0);
        $this->set_page_title('Статьи');
    }

    public function delete($type = "article", $item_id = 0)
    {

        if ($type != "article" && $type != "category")
            show_404();

        $item = $type == "article" ? Article::find_by_id($item_id) : ArticleCategory::find_by_id($item_id);

        if (!$item) {
            show_404();
            exit();
        }

        $article_id = $type == "article" ? $item->category_id : 0;

        $item->delete();
        redirect($article_id == 0 ? 'admin/articles' : 'admin/articles/edit/category/' . $article_id);

    }

    public function create($type = 'article')
    {
        if ($_POST) {

            if ($type == 'category') {
                $name = $this->input->post('name');
                $alias = $this->input->post('alias');

                if (!$name || !$alias) {
                    show_404();
                    return false;
                }

                ArticleCategory::create(array('name' => $name, 'alias' => $alias,
                    'created_time' => time_to_mysqldatetime(time()), 'created_by' => $this->user->id,
                    'changed_time' => time_to_mysqldatetime(time()), 'changed_by' => $this->user->id,));

                redirect('admin/articles');
            }
            else if ($type == 'article') {
                $title = $this->input->post('title');
                $alias = $this->input->post('alias');
                $category = $this->input->post('category');

                if (!$title || !$alias || ($category != 0 && !ArticleCategory::find_by_id($category))) {
                    show_404();
                    return false;
                }

                $article = Article::create(array('title' => $title, 'alias' => $alias, 'category_id' => $category,
                    'created_time' => time_to_mysqldatetime(time()), 'created_by' => $this->user->id,
                    'changed_time' => time_to_mysqldatetime(time()), 'changed_by' => $this->user->id,
                ));

                redirect('admin/articles/edit/article/' . $article->id);
            }
        }
        else
            show_404();
    }

    public function edit($item_type = 'article', $item_id = 0)
    {
        if ($item_type != 'article' && $item_type != 'category') {
            show_404();
            return false;
        }

        $item = $item_type == 'category' ? ArticleCategory::find_by_id($item_id) : Article::find_by_id($item_id);
        $item->changed_time = time_to_mysqldatetime(time());
        $item->changed_by = $this->user->id;

        if ($_POST) {

            if ($item_type == 'category') {

                $name = $this->input->post('name');
                $alias = $this->input->post('alias');

                if (!$name || !$alias) {
                    show_404();
                    return false;
                }

                $item->name = $name;
                $item->alias = $alias;
                $item->save();

                redirect('admin/articles');
            }
            else {
                $title = $this->input->post('title');
                $alias = $this->input->post('alias');
                $category = $this->input->post('category');

                if (!$title || !$alias || ($category != 0 && !ArticleCategory::find_by_id($category))) {
                    show_404();
                    return false;
                }

                $item->title = $title;
                $item->alias = $alias;
                $item->category_id = $category;
                $item->meta_keywords = $this->input->post('meta_keywords');
                $item->meta_description = $this->input->post('meta_description');
                $item->preview = $this->input->post('preview');
                $item->text = $this->input->post('text');
                $item->save();

                redirect('admin/articles'.($item->category_id != 0 ? '/edit/category/'.$item->category_id : ''));
            }
        }


        $this->view_data['item'] = $item;
        $this->content_view = "admin/article/edit_" . $item_type;
    }
}

?>