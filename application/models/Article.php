<?php

class Article extends ActiveRecord\Model
{
    static $table_name = "articles";

    public function get_category()
    {
        return ArticleCategory::find_by_id($this->category_id);
    }
}

?>