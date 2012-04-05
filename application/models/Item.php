<?php

class Item extends ActiveRecord\Model
{
    static $table_name = "items";

    public function get_city()
    {
        return City::find_by_id($this->city_id);
    }

    public function get_images()
    {
        return ItemImage::find_all_by_item_id($this->id);
    }

    public function get_documents()
    {
        $result = array();
        $item_docs = ItemDocument::find_all_by_item_id($this->id);

        foreach ($item_docs as $doc)
            $result[] = Document::find_by_id($doc->document_id);

        return $result;
    }

    public function get_kind()
    {
        return Kind::find_by_id($this->kind_id);
    }

    public function check_document($document_id = 0)
    {
        return ItemDocument::find(array('conditions' => array('document_id = ? AND item_id = ?', $document_id, $this->id))) ? 1 : 0;
    }

    public function get_kind()
    {
        return Kind::find_by_id($this->kind_id);
    }

    public function get_weight()
    {
        $field = Field::weight_field();
        return ItemField::get($this->id, $field->id);
    }

    public function get_height()
    {
        $field = Field::height_field();
        return ItemField::get($this->id, $field->id);
    }

    public function get_plain_paidtype()
    {
        if ($this->type == 'free')
            return 'Бесплатное (сверх цены добавлена комиссия)';
        elseif ($this->type == 'paid_1')
            return 'Платное "Недорого"';
        elseif ($this->type == 'paid_2')
            return 'Платное "Без проблем"';

        return 'Не опознаный тип';
    }

    public function get_parent_kind()
    {
        $kind = $this->kind;
        return $kind->parent_id == 0 ? $kind : Kind::find_by_id($kind->parent_id);
    }

    public function get_plain_status()
    {
        switch ($this->status)
        {
            case 'created':
                return "Новое. Ждет модерации";
            case 'edited':
                return "Отредактировано. Ждет модерации";
            case 'public':
                return "Опубликовано до " . $this->finish_date->format('d.m.y');
            case 'saled':
                return "Щенок продан. Редактирование не возможно";
            case 'finished':
                return "Снято " . $this->finish_date->format('d.m.y') . ". Окончен срок публикации";
            case 'canceled':
                return "Временно снято";
            default:
                return "Неизвестный тип";
        }
    }

    public function get_preview_header(){
        return "273. Девочка, будет весить 1,2 кг.";
    }

    public function get_preview_text(){
        return "Документы: ветпаспорт, щенячья карточка (позже Клуб обменивает ее на родословную), отмечено клеймо/вживлен микрочип
        Щенки йоркширского терьера этого помета рождены: 24.03.2011. Питомник (заводчик) ждет Вас в г.Москва,        Васильковская

        В меру игривая, ласковая, обаятельная. Девочка отлично социализирована, растёт в контакте с детьми. Очень забавная, умилительная крошка!";
    }


    public function get_preview_image(){
        return Config::get('item_images_dir').$this->image;
    }
}

?>