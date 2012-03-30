<?php

class Item extends ActiveRecord\Model
{
    static $table_name = "items";

    public function get_city(){
        return City::find_by_id($this->city_id);
    }

    public function get_images(){
        return ItemImage::find_all_by_item_id($this->id);
    }

    public function get_documents()
    {
        return ItemDocument::find_all_by_item_id($this->id);
    }

    public function check_document($document_id = 0){
        return ItemDocument::find(array('conditions' => array('document_id = ? AND item_id = ?', $document_id, $this->id))) ? 1 : 0;
    }

    public function get_kind(){
        return Kind::find_by_id($this->kind_id);
    }

    public function get_weight(){
        $field = Field::weight_field();
        return ItemField::get($this->id, $field->id);
    }

    public function get_height(){
        $field = Field::height_field();
        return ItemField::get($this->id, $field->id);
    }

    public function get_plain_paidtype(){
        if($this->type == 'free')
            return 'Бесплатное (сверх цены добавлена комиссия)';
        elseif($this->type == 'paid_1')
            return 'Платное "Недорого"';
        elseif($this->type == 'paid_2')
            return 'Платное "Без проблем"';

        return 'Не опознаный тип';
    }

    public function get_parent_kind(){
        $kind = $this->kind;
        return $kind->parent_id == 0 ? $kind : Kind::find_by_id($kind->parent_id);
    }
}

?>