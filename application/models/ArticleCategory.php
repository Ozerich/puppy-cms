<?php

class ArticleCategory extends ActiveRecord\Model
{
    static $table_name = "article_categories";

    public function get_articles()
    {
        return Article::find_all_by_category_id($this->id);
    }
}

?>