<?php

class Item extends ActiveRecord\Model
{
    static $table_name = "items";

    static $STATUSES = array('created', 'edited', 'public', 'saled', 'finished', 'canceled');

    public function get_city()
    {
        return City::find_by_id($this->city_id);
    }

    public function get_user()
    {
        return User::find_by_id($this->user_id);
    }

    public function get_images()
    {
        return ItemImage::find_all_by_item_id($this->id);
    }

    public function get_documents()
    {
        $result = array();
        $this_docs = ItemDocument::find_all_by_item_id($this->id);

        foreach ($this_docs as $doc)
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

    public function get_field_weight()
    {
        $field = Field::weight_field();
        return ItemField::get($this->id, $field->id);
    }

    public function get_field_height()
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
                return "Опубликовано до " . $this->finish_time->format('d.m.y');
            case 'saled':
                return "Щенок продан. Редактирование не возможно";
            case 'finished':
                return "Снято " . ($this->closed_by == 0 ? $this->closed_time->format('d.m.y') . ". Окончен срок публикации" : '');
            case 'canceled':
                return "Временно снято";
            default:
                return "Неизвестный тип";
        }
    }

    public function get_organization()
    {
        return Organization::find_by_id($this->organization_id);
    }

    public function get_animal()
    {
        return Animal::find_by_id($this->animal_id);
    }

    public function get_preview_header()
    {
        $template = $this->main_kind->header_template;

        $template = str_replace('{{id}}', $this->id, $template);
        $template = str_replace('{{sex}}', $this->sex == 'man' ? 'мальчик' : 'девочка', $template);
        $template = str_replace('{{weight}}', $this->weight . ' кг.', $template);
        $template = str_replace('{{rost}}', $this->height . ' см.', $template);
        $template = str_replace('{{city}}', $this->city->name, $template);
        $template = str_replace('{{kind_name}}', $this->kind->name, $template);

        $template = str_replace('{{metro}}', $this->user->metro, $template);
        $wool_length = ItemField::get($this->id, Field::wool_field_id());
        $template = str_replace('{{dlina_sher}}', $wool_length, $template);

        $template = str_replace("\n", "<br/>", $template);
        return $template;
    }

    public function get_preview_text()
    {
        $template = $this->main_kind->preview_template;

        $template = str_replace('{{date_birth}}', $this->birthday->format('d.m.Y;'), $template);
        $organization = $this->organization;
        $organization_text = $organization ? $organization->site_text : $this->animal->no_organization;
        $template = str_replace('{{pitomnik}}', $organization_text, $template);
        $template = str_replace('{{metro}}', $this->user->metro, $template);
        $template = str_replace('{{opis}}', $this->description, $template);
        $template = str_replace('{{weight}}', $this->weight . ' кг.', $template);
        $template = str_replace('{{rost}}', $this->height . ' см.', $template);
        $template = str_replace('{{opis_drugich}}', $this->another, $template);

        $wool_length = ItemField::get($this->id, Field::wool_field_id());
        $template = str_replace('{{dlina_sher}}', $wool_length, $template);

        $template = str_replace("\n", "<br/>", $template);
        return $template;
    }

    public function get_full_text()
    {
        $template = $this->main_kind->text_template;


        $template = str_replace('{{ears}}', ItemField::get($this->id, Field::ears_field_id()), $template);
        $template = str_replace('{{tail}}', ItemField::get($this->id, Field::tail_field_id()), $template);
        $template = str_replace('{{wool_length}}', ItemField::get($this->id, Field::wool_field_id()), $template);
        $template = str_replace('{{bite}}', ItemField::get($this->id, Field::bite_field_id()), $template);
        $template = str_replace('{{okras}}', ItemField::get($this->id, Field::okras_field_id()), $template);
        $template = str_replace('{{kontakt}}', $this->type != 'free' ? '<span style="color: #F26521;font-weight: bold;font-size: 16px;">Звоните: ' . $this->user->phone . " " . $this->user->name . '</span>' :
                    '<span style="color: #F26521;font-weight: bold;font-size: 16px;">' . KindSetting::get($this->main_kind_id, $this->city_id)->phone . '</span>   Консультант по породе бесплатно поможет вам выбрать ' . ($this->animal_id == 1 ? 'щенка' : 'котёнка') . ', посоветует питомник и даст номер телефона заводчика у которого вы сможете посмотреть и купить ' . ($this->animal_id == 1 ? 'щенка' : 'котёнка')
            , $template);

        $template = str_replace('{{metro}}', $this->user->metro, $template);

        $documents = $this->documents;
        $document_text = '';
        foreach ($documents as $doc)
            $document_text .= $doc->name . ', ';
        $document_text = $document_text ? substr($document_text, 0, -2) : '';
        $template = str_replace('{{documents}}', $document_text, $template);

        $complicate_params = array(
            'mother_tituls' => $this->mother_prizes,
            'mother_weight' => $this->mother_weight,
            'mother_height' => $this->mother_height,
            'mother_age' => $this->mother_age,
            'father_tituls' => $this->father_prizes,
            'father_weight' => $this->father_weight,
            'father_height' => $this->father_height,
            'father_age' => $this->father_age,
        );
        foreach ($complicate_params as $param => $val)
            if (preg_match_all('#{([^{]*?){' . $param . '}(.*?)}#sui', $template, $param_texts, PREG_SET_ORDER))
                foreach ($param_texts as $param_text)
                    $template = str_replace($param_text[0], ($val && $val != '0' ? $param_text[1] . $val . $param_text[2] : ''), $template);


        $template = str_replace('{{description}}', $this->description, $template);
        $template = str_replace('{{another}}', $this->another, $template);

        $template = str_replace('{{paid_phone_text}}', $this->type == "free" ? '' : 'Звоните: '.$this->user->phone.' '.$this->user->name, $template);
        $template = str_replace('{{site_phone}}',KindSetting::get($this->main_kind_id, $this->city_id)->phone, $template);

        $template = str_replace("\n", "<br/>", $template);

        return $template;
    }


    public function get_preview_image()
    {
        return Config::get('item_images_dir') . $this->image;
    }

    public function change_status($status, $params = array())
    {

        $this->status = $status;

        if ($status == 'created') {
            $this->closed_time = $this->changed_time = $this->publish_time = $this->finish_time = null;
            $this->closed_by = $this->publish_by = $this->changed_by = 0;
            $this->created_by = $this->user->id;
            $this->created_time = time_to_mysqldatetime(time());
        }
        else if ($status == 'edited') {
            $this->closed_time = $this->publish_time = $this->finish_time = null;
            $this->closed_by = $this->publish_by = 0;
            $this->changed_by = $this->user->id;
            $this->changed_time = time_to_mysqldatetime(time());
        }
        else if ($status == 'public') {
            $now = time_to_mysqldatetime(time());
            $this->publish_time = $now;
            $this->publish_by = $this->user->id;
            if (!isset($params['publish_till'])) {
                $this->finish_time = new DateTime();
                $this->finish_time = $this->finish_time->add(new DateInterval('P30D'));
            }
            else
                $this->finish_time = inputdate_to_mysqldate($params['publish_till']) . substr($now, 10);
            $this->closed_time = null;
            $this->closed_by = 0;
        }
        else if ($status == 'saled') {
            $saled_by = $params['saled_by'];
            if ($saled_by && $saled_by != 'site' && $saled_by != 'plant') die;
            $old_saled = $this->saled_by;
            $this->saled_by = $saled_by ? $saled_by : NULL;

            $user = $this->user;

            if ($old_saled == "site")
                $user->sell_site--;
            else if ($old_saled == 'plant')
                $user->sell_plant--;

            if ($saled_by == "site")
                $user->sell_site++;
            else if ($saled_by == "plant")
                $user->sell_plant++;

            $user->save();

        }

        if ($status == 'finished' || $status == 'canceled' || $status == 'saled') {
            $this->closed_time = time_to_mysqldatetime(time());
            $this->closed_by = $this->user->id;
            $this->finish_time = null;
        }

        $this->save();
    }

    public function get_main_kind(){
        return $this->kind->parent_id == 0 ? $this->kind : Kind::find_by_id($this->kind->parent_id);
    }

    public function get_main_kind_id(){
        $kind = Kind::find_by_id($this->kind_id);
        return $this->kind->parent_id == 0 ? $this->kind->id : $this->kind->parent_id;
    }

}

?>