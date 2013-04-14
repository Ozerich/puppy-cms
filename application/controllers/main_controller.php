<?php

class Main_Controller extends MY_Controller
{

    public function _404()
    {
        print_r('404');
        exit;
    }

    public function sms_billing()
    {
        if (!isset($_GET['msg'])) {
            echo "ok\n неправильно введены данные";
            die;
        }
        $msg = substr($_GET['msg'], 3);
        $sekretKey = "Vital Ozierski";
        //$skey=isset($_GET['skey']) ? $_GET['skey'] : '';

        $item = Item::find_by_id($msg);
        if (!$item)
            echo "ok\n неправильно введены данные";
        else {
            echo("ok");
            echo("\n");
            echo($item->user->phone);
        }

        die;
    }

    public function show_other_list($type)
    {
        $items = Item::all(array('conditions' => array('city_id >= 6 and animal_id = ?  AND status = ?', $type == 'cats' ? 2 : 1, 'public'), 'order' => 'publish_time DESC'));

        $this->view_data['item_list'] = $this->load->view('item/item_list.php', array('items' => $items), true);


		if($type == 'cats'){
			$this->view_data['meta_keywords'] = 'британские котята купить вислоухие шотландские мэйн кун екатеринбург новгород';
			$this->view_data['meta_description'] = 'Ум и благородство чистокровных британских, шотландских и мейн-кун котят подарят вам бесконечную радость. Выбирайте котенка по объявлению и звоните заводчику.';
			$this->view_data['page_title'] = 'Котята мэй-кун и других пород от отборных заводчиков России';
		}
		
		if($type == 'dogs'){
			$this->view_data['meta_keywords'] = 'куплю чихуахуа щенки йоркширского терьера померанского шпица цена продажа';
			$this->view_data['meta_description'] = 'Продажа щенков от питомников Екатеринбурга, Нижнего Новгорода и других городов России. Бесплатные объявления и недорогая цена.';
			$this->view_data['page_title'] = 'Йоркширский терьер, чихуахуа, шпиц и хаски  от заводчиков';
		}
		

        $this->content_view = 'main/index';
    }

    public function show_list($city_alias = '', $kind_alias = '')
    {
        if (($city_alias == 'novgorod' || $city_alias == 'ekaterinburg') && !empty($kind_alias)) show_404();
        if (in_array($kind_alias, array('vislouchie-kotijata', 'britanskie-kotijata', 'main-kun', 'shotlandskie-kotijata', 'toy-terryer'))) show_404();

        $city = City::find_by_alias($city_alias);
        if (!$city) {
            $kind = Kind::find_by_alias($city_alias);
            if (!$kind) {
                show_404();
            }
        } else {
            if (!empty($kind_alias)) {
                $kind = Kind::find_by_alias($kind_alias);
                if (!$kind && $kind_alias != 'kotijata') {
                    show_404();
                }
            } else {
                $kind = null;
            }
        }


        $kind_q = '';
        if ($kind) {
            $sub_kinds = Kind::find_all_by_parent_id($kind->id);
            $kind_q = 'kind_id = ' . $kind->id;
            if ($sub_kinds) {
                $kind_q_array = '';
                foreach ($sub_kinds as $kind_id)
                    $kind_q_array[] = 'kind_id = ' . $kind_id->id;
                $kind_q = implode(' OR ', $kind_q_array);
            }
        }


        if ($kind_alias == 'kotijata') {
            $kind_q = 'animal_id = 2';
        }

        if (!$city)
            $items = Item::all(array('conditions' => array($kind_q . ' AND status = ?', 'public'), 'order' => 'publish_time DESC'));
        else {
            $items_all = $kind_q ?
                Item::all(array('conditions' => array('city_id = ? AND ' . ($kind_q ? '('.$kind_q.')' : '') . ' AND status = ?', $city->id, 'public'), 'order' => 'publish_time DESC')) :
                Item::all(array('conditions' => array('city_id = ? AND status = ?', $city->id, 'public'), 'order' => 'publish_time DESC'));
			
			$items = array();			
			foreach($items_all as &$item){
				if($item->city_id == $city->id){
					$items[] = $item;
				}
			}
				
        }


        $settings = $kind && $city ? KindSetting::get($kind->id, $city->id) : ($city ? KindSetting::get(1, $city->id) : KindSetting::get(1, 1));
        $this->view_data['filter_phone'] = $settings->phone;

        $this->view_data['text_before'] = $settings->beforelist_text;
        $this->view_data['text_after'] = $settings->afterlist_text;

        $cities_filter = array();
        if ($city)
            $cities_filter = array($city->id);
        else
            foreach (City::all() as $city)
                $cities_filter[] = $city->id;

        $filter_data = array('filter_type' => '', 'cities' => $cities_filter);

        $data = array('items' => $items, 'cities' => $cities_filter, 'city_alias_zig' => $city_alias, 'kind_alias_zig' => $kind_alias);

        if ($kind)
            $filter_data['kinds'] = array($kind->id);


        $admin_filter = $this->load->view('item/admin_filter.php', $filter_data, true);

        $data['admin_filter'] = $admin_filter;
        $this->view_data['item_list'] = $this->load->view('item/item_list.php', $data, true);

		
        if ($kind && $city) {
            $this->view_data['meta_keywords'] = KindSetting::get($kind->id, $city->id)->meta_keywords;
            $this->view_data['meta_description'] = KindSetting::get($kind->id, $city->id)->meta_description;
            $this->view_data['page_title'] = KindSetting::get($kind->id, $city->id)->title;
        } else if ($city) {
            $this->view_data['meta_keywords'] = $city->meta_keywords;
            $this->view_data['meta_description'] = $city->meta_description;
            $this->view_data['page_title'] = $city->title;
        }
		if($kind_alias == 'kotijata'){
		
			if($city_alias == 'kiev'){
				$this->view_data['meta_keywords'] = 'британские котята купить вислоухие шотландские мэйн кун';
				$this->view_data['meta_description'] = 'Мэйн кун, британские и шотландские котята от лучших питомников Украины: купить котенка помогут фотографии, описание родословной и актуальная цена! ';
				$this->view_data['page_title'] = 'Лучшие котята Украины от питомников совсем недорого';
			}
			
			if($city_alias == 'minsk'){
				$this->view_data['meta_keywords'] = 'британские котята минск вислоухие продажа шотландские мэйн-кун';
				$this->view_data['meta_description'] = 'Вислоухие и британские котята от благородных питомников: выберите котенка по фото, родословной, описанию от заводчика и уже завтра котенок ваш. Цена указана.';
				$this->view_data['page_title'] = 'Элитные породистые котята из Минска в наших бесплатных объявлениях';
			}
			
			if($city_alias == 'moscow'){
				$this->view_data['meta_keywords'] = 'мэйн кун британские котята купить шотландские цена москва вислоухие';
				$this->view_data['meta_description'] = 'Купить котенка по специальным объявлениям просто, ведь они содержат фото, описание характера и родословной, указана цена. Самые умные и достойные котята ждут вас.';
				$this->view_data['page_title'] = 'Британские и шотландские котята из VIP питомников Москвы';
			}
			
			if($city_alias == 'ross'){
				$this->view_data['meta_keywords'] = 'британские котята купить вислоухие шотландские мэйн кун екатеринбург новгород';
				$this->view_data['meta_description'] = 'Ум и благородство чистокровных британских, шотландских и мейн-кун котят подарят вам бесконечную радость. Выбирайте котенка по объявлению и звоните заводчику.';
				$this->view_data['page_title'] = 'Котята мэй-кун и других пород от отборных заводчиков России';
			}
			
			if($city_alias == 'spb'){
				$this->view_data['meta_keywords'] = 'шотландские вислоухие котята санкт петербург, шотландские котята в СПб, шотландские вислоухие котята цена, купить шотландского котенка';
				$this->view_data['meta_description'] = 'Объявления СПб от питомников. Выберите котенка по описанию: цена, фото, родословная. Звоните, и мы договоримся о времени просмотра и покупки щенка у заводчика.';
				$this->view_data['page_title'] = 'Шотландские и британские котята от питомников  Санкт-Петербурга';
			}
			
			$this->view_data['text_before'] = '';
			$this->view_data['text_after'] = '';
		}
		
		else if($kind_alias == 'krupnye-porodi'){
		
			if($city_alias == 'kiev'){
				$this->view_data['meta_keywords'] = 'щенки лабрадора хаски продажа киев продать щенка украина';
				$this->view_data['meta_description'] = 'Сибирский хаски, маламут, лабрадор, немецкий дог и щенки других крупных пород от питомников Киева, с фото, описаниями и актуальной ценой в бесплатных объявлениях.';
				$this->view_data['page_title'] = 'Щенки крупных пород от украинских питомников и заводчиков';
			}		
		
			if($city_alias == 'minsk'){
				$this->view_data['meta_keywords'] = 'сибирский хаски купить немецкий дог щенки лабрадор сибирского хаски';
				$this->view_data['meta_description'] = 'Умный и преданный, настоящий лучший друг ждет вас у нас. Объявления с указанием цены щенка, родословной, фотографий щенка и родителей.';
				$this->view_data['page_title'] = 'Щенки сибирского хаски, дога, лабродора теперь в Минске';
			}
			
			if($city_alias == 'moscow'){
				$this->view_data['meta_keywords'] = 'сибирский хаски щенки купить лабрадор маламут';
				$this->view_data['meta_description'] = 'Предложения от питомников Москвы: щенки с элитными родословными по достойным ценам. У нас есть сибирский хаски, лабрадор, маламут и другие породы';
				$this->view_data['page_title'] = 'Цена, родословная и фото помогут купить щенка в Москве';
			}	

			if($city_alias == 'spb'){
				$this->view_data['meta_keywords'] = 'немецкий дог спб, овчарка спб, сибирский хаски спб, лабрадор спб, купить лабрадора  спб';
				$this->view_data['meta_description'] = 'Щенки сибирского хаски, маламутов и других пород от заводчиков СПб проверенных годами. Специалист поможет выбрать питомник и подходящего щенка бесплатно.';
				$this->view_data['page_title'] = 'Объявления от питомников собак крупных пород Санкт-Петербурга';
			}			
			
			$this->view_data['text_before'] = '';
			$this->view_data['text_after'] = '';
		}

		
		else if($kind_alias == ''){
		
			if($city_alias == 'ross'){
				$this->view_data['meta_keywords'] = 'продажа британских котят шотландских мэйн-кун щенки хаски чихуахуа йоркширского терьера шпица';
				$this->view_data['meta_description'] = 'Тверь, Новгород, Новосибирск, Екатеринбург и другие российские города - самые актуальные предложения от лучших местных питомников и проверенных заводчиков.';
				$this->view_data['page_title'] = 'Лучшие породистые щенки и котята в самых разных городах России';
			}
			
			if($city_alias == 'kiev'){
				$this->view_data['meta_keywords'] = 'британские шотландские мейн-кун котята продажа в киеве йоркширского терьар щенки чихуахуа';
				$this->view_data['meta_description'] = 'Ищете преданного друга и компаньона? На бесплатной доске объявлений вас уже ждут щенки и котята различных пород - йоркширского терьера, чихуахуа, хаски и т.д.';
				$this->view_data['page_title'] = 'Отличные щенки и котята самых популярных пород от заводчиков Украины';
			}
			
			if($city_alias == 'minsk'){
				$this->view_data['meta_keywords'] = 'щенки йоркширского терьера продать минск чихуахуа купить объявления';
				$this->view_data['meta_description'] = 'Частные питомники и заводчики Минска предлагают потенциальным хозяевам отличных породистых щенков и котят, выращенных в любви и теплой домашней обстановке.';
				$this->view_data['page_title'] = 'Лучшие питомники и заводчики собак и кошек белорусской столицы';
			}
		
			if($city_alias == 'moscow'){
				$this->view_data['meta_keywords'] = 'йоркширский терьер, чихуахуа, померанский шпиц, мэйн-кун, британские котята';
				$this->view_data['meta_description'] = 'Чистокровные щенки йоркширского терьера, чиахуахуа, шпица, хаски, с отличной родословной, в Москве. Котята британцы, шотландцы, мейн-кун. Фото и описания.';
				$this->view_data['page_title'] = 'Объявления о продаже щенков и котят московских питомников';
			}
			
			if($city_alias == 'spb'){
				$this->view_data['meta_keywords'] = 'продать щенка спб, продать котят спб, где продать щенков, продажа щенков, продажа чихуахуа, продажа йоркширского терьера';
				$this->view_data['meta_description'] = 'Подборка объявлений из Санкт-Петербурга о продаже породистых щенков и котят. Лучшие предложения авторитетных заводчиков и питомников с блестящей репутацией.';
				$this->view_data['page_title'] = 'Чистокровные щенки и котята из лучших питомников северной столицы';
			}
		
		}

        $this->content_view = 'main/index';


    }


    public function filter()
    {

        $city = $this->input->post('city');
        $kind = $this->input->post('kind');

        $DB1 = $this->load->database("", TRUE);
        $qq = $DB1->query("SELECT alias FROM cities WHERE id='$city'");
        $rez_array = $qq->result_array();
        $city_alias = isset($rez_array[0]['alias']) ? $rez_array[0]['alias'] : '';

        $qq = $DB1->query("SELECT alias FROM kinds WHERE id='$kind'");
        $rez_array = $qq->result_array();
        $kind_alias = isset($rez_array[0]['alias']) ? $rez_array[0]['alias'] : '';


        $settings = KindSetting::get($kind, $city);
        $text_before = $settings ? $settings->beforelist_text : '';
        $text_after = $settings ? $settings->afterlist_text : '';
        $phone = $settings ? $settings->phone : '';

        $sub_kinds = Kind::find_all_by_parent_id($kind);

        $kind_q = 'kind_id = ' . $kind;
        if ($sub_kinds) {
            $kind_q_array = '';
            foreach ($sub_kinds as $kind_id)
                $kind_q_array[] = 'kind_id = ' . $kind_id->id;
            $kind_q = implode(' OR ', $kind_q_array);
        }

        if($kind == 'kotijata'){
            $kind_q = 'animal_id = 2';
        }

        $q = "city_id = " . $city . ' AND (' . $kind_q . ')';
        $q .= $this->input->post('sex') == '0' ? '' : ' AND sex = "' . $this->input->post('sex') . '"';

        $price = explode('_', $this->input->post('price'));
        $q .= ' AND price >= ' . $price[0] . ($price[1] != 'inf' ? ' AND price <= ' . $price[1] : '');

        if ($this->input->post('weight')) {
            $weight = explode('_', $this->input->post('weight'));
            $q .= ' AND weight >= ' . $weight[0] . ($weight[1] != 'inf' ? ' AND weight <= ' . $weight[1] : '');
        }

        if ($this->input->post('height')) {
            $height = explode('_', $this->input->post('height'));
            $q .= ' AND height >= ' . $height[0] . ($height[1] != 'inf' ? ' AND height <= ' . $height[1] : '');
        }

        $q .= ' AND status = "public"';


        $items = Item::all(array('conditions' => $q, 'order' => 'publish_time DESC'));


        $this->view_data['text_before'] = $text_before;
        $this->view_data['text_after'] = $text_after;

        $admin_filter = $this->load->view('item/admin_filter.php', array('city_alias_zig' => $city_alias, 'kind_alias_zig' => $kind_alias, 'filter_type' => '', 'cities' => array($city), 'kinds' => array($kind)), true);
        $this->view_data['item_list'] = $this->load->view('item/item_list.php', array('items' => $items, 'cities' => array($city), 'kinds' => array($kind), 'admin_filter' => $admin_filter), true);

        echo json_encode(
            array(
                'data' => $this->load->view('main/index.php', $this->view_data, true),
                'phone' => $phone));
        die;
    }

    public function item_list()
    {
        $filter_type = $this->input->post('filter_type');

        $this->view_data['text_before'] = '';
        $this->view_data['text_after'] = '';

        if ($filter_type != 'users') {
            if ($filter_type == 'new_and_edit')
                $type_q = 'status = "edited" OR status = "created"';
            elseif ($filter_type == 'closed')
                $type_q = 'status = "canceled"'; elseif ($filter_type == 'sell_plant')
                $type_q = 'status = "saled" AND saled_by = "plant"'; elseif ($filter_type == 'sell_site')
                $type_q = 'status = "saled" AND saled_by = "site"'; elseif ($filter_type == 'sell_null')
                $type_q = 'status = "saled" AND NOT saled_by'; elseif ($filter_type == 'near_finish')
                $type_q = 'status = "publish" AND 1'; elseif ($filter_type == 'finished')
                $type_q = 'status = "finished"'; else
                $type_q = '1';
            $type_q = '(' . $type_q . ')';

            $cities = array();
            $city_q = '';
            $cities_post = isset($_POST['city']) ? $_POST['city'] : array();
            foreach ($cities_post as $city_id => $t) {
                $cities[] = $city_id;
                $city_q .= ($city_q == '' ? '' : ' OR ') . "city_id = " . $city_id;
            }
            $city_q = $city_q ? '(' . $city_q . ')' : '0';

            $kinds = array();
            $kind_q = '';
            $kinds_post = isset($_POST['kind']) ? $_POST['kind'] : array();

            foreach ($kinds_post as $kind_id => $t) {
                $kinds[] = $kind_id;
                $kind = Kind::find_by_id($kind_id);
                $cur_q = "kind_id = " . $kind_id;

                if ($kind->subkinds) {
                    $cur_q = "";
                    foreach ($kind->subkinds as $subkind)
                        $cur_q .= ($cur_q == '' ? '' : ' OR ') . 'kind_id=' . $subkind->id;
                }

                $kind_q .= ($kind_q == '' ? '' : ' OR ') . $cur_q;
            }
            $kind_q = $kind_q ? '(' . $kind_q . ')' : '0';

            $items = Item::all(array('conditions' => array($city_q . ' AND ' . $kind_q . ' AND ' . $type_q), 'order' => 'publish_time DESC'));

            $admin_filter = $this->load->view('item/admin_filter.php', array('filter_type' => $filter_type, 'cities' => $cities, 'kinds' => $kinds), true);
            $this->view_data['item_list'] = $this->load->view('item/item_list.php', array('admin_filter' => $admin_filter, 'items' => $items, 'filter_type' => $filter_type, 'cities' => $cities, 'kinds' => $kinds), true);
        } else {

            $user_filter = array(
                'public_exist' => isset($_POST['public_exist']) ? 1 : 0,
                'closed_exist' => isset($_POST['closed_exist']) ? 1 : 0,
                'best_users' => isset($_POST['best_users']) ? 1 : 0,
                'email' => isset($_POST['user_email']) ? $_POST['user_email'] : ''
            );

            $admin_filter = $this->load->view('item/admin_filter.php', array('filter_type' => $filter_type, 'user_filter' => $user_filter), true);

            $users = array();

            $conditions = $user_filter['email'] ? 'email LIKE "%' . $user_filter['email'] . '%"' : '';

            foreach (User::all(array('conditions' => $conditions)) as $user) {
                if ($user_filter['best_users'] && !$user->is_best)
                    continue;

                if ($user_filter['closed_exist'] && $user->closed_count == 0)
                    continue;

                if ($user_filter['public_exist'] && $user->public_count == 0)
                    continue;

                $users[] = $user;
            }


            $this->view_data['item_list'] = $this->load->view('item/user_list.php', array('admin_filter' => $admin_filter, 'users' => $users, 'filter_type' => $filter_type), true);
        }

        $this->content_view = 'main/index';
    }

    public function index()
    {

        $items = Item::all(array('conditions' => array('display_mainpage = 1 AND status="public"'), 'order' => 'publish_time DESC'));

        $this->set_page_title('Главная страница');

        $admin_filter = $this->load->view('item/admin_filter.php', array('filter_type' => '',), true);

        $alias_city_zig_arr = array();
        $alias_kind_zig_arr = array();
        $DB1 = $this->load->database("", TRUE);

        $cities = array();
        foreach (City::all() as $city)
            $cities[$city->id] = $city->alias;

        $kinds = array();
        foreach (Kind::all() as $kind)
            $kinds[$kind->id] = $kind->alias;

        foreach ($items as $item) {
            $elem = $item->id;

            $city_id = $item->city_id;
            $kind_id = $item->kind_id;

            $alias_city_zig_arr[] = $cities[$city_id];
            $alias_kind_zig_arr[] = $kinds[$kind_id];
        }
        //$this->view_data['item_list'] = $this->load->view('item/item_list.php', array('city_alias_zig' => $city_alias,'kind_alias_zig' => $kind_alias,'items' => $items, 'admin_filter' => $admin_filter), true);


        $this->view_data['item_list'] = $this->load->view('item/item_list.php', array('alias_kind_zig_arr' => $alias_kind_zig_arr, 'alias_city_zig_arr' => $alias_city_zig_arr, 'items' => $items, 'admin_filter' => $admin_filter), true);

        $this->view_data['text_before'] = '';
        $this->view_data['text_after'] = '';

		
		$this->view_data['meta_keywords'] = 'британские котята купить вислоухие шотландские мэйн кун щенки йоркширского терьера чихуахуа шпица';
		$this->view_data['meta_description'] = 'Продажа чистокровных щенков и котят декоративных пород - цена, подробные описания, фото. Бесплатные объявления и консультации специалистов.';
		$this->view_data['page_title'] = 'Породные щенки и котята от лучших питомников и заводчиков';

    }

    public function view_item($item_id = 0, $kind_id)
    {

        $kind = Kind::find_by_alias($kind_id);
        if (!$kind) {
            show_404();
        }

        $item = Item::find_by_id($item_id);
        if (!$item)
            redirect('/');

        $this->set_page_title($item->title);
		
				$this->view_data['meta_keywords'] = '';
		$this->view_data['meta_description'] = '';

        $this->view_data['item'] = $item;
        $this->content_view = 'item/view';
    }

    private function send_email($item_id = 0)
    {
        $item = Item::find_by_id($item_id);
        if (!$item) return FALSE;

        $email_template = '';
        if ($item->status == 'public')
            $email_template = Config::get('publish_mail');
        else if ($item->status == 'finished')
            $email_template = Config::get('endtime_mail');
        else if ($item->status == 'canceled')
            $email_template = Config::get('stoped_mail');

        if (!$email_template)
            return FALSE;

        $email_template = str_replace("\n", "<br/>", $email_template);

        $email_template = str_replace('{{$user}}', $item->user->fullname, $email_template);
        $email_template = str_replace('{{$site_name}}', Config::get('site_name'), $email_template);
        $email_template = str_replace('{{$item_link}}', '<a href="dogscat.com/view/' . $item->id . '">перейти</a>', $email_template);
        $email_template = str_replace('{{$item_finish_date}}', $item->finish_time ? $item->finish_time->format('d.m.Y H:i') : '-', $email_template);
        $email_template = str_replace('{{$item_animal}}', $item->animal_id == 1 ? 'щенка' : 'котёнка', $email_template);
        $email_template = str_replace('{{$item_animal}}', $item->animal_id == 1 ? 'щенка' : 'котёнка', $email_template);
        $email_template = str_replace('{{$item_editlink}}', '<a href="dogscat.com/edit/' . $item->id . '">перейти</a>', $email_template);

        $site_email = Config::get('site_email');

        $this->email->initialize(array('mailtype' => 'html'));

        $this->email->from($site_email, 'dogscat.com');
        $this->email->to($item->user->email);
        $this->email->subject('Информация об объявлении #' . $item->id);
        $this->email->message($email_template);

        $this->email->send();
    }

    public function admin_item($item_id = 0)
    {
        $item = Item::find_by_id($item_id);

        if (!$item || !$this->user || $this->user->access_edit == FALSE)
            die;

        $status = $this->input->post('status');
        if (!in_array($status, Item::$STATUSES))
            die;


        ItemMedal::reset($item_id);
        $medals = isset($_POST['medals']) ? $_POST['medals'] : array();
        foreach ($medals as $medal)
            ItemMedal::create(array('item_id' => $item_id, 'medal_id' => $medal));

        $params = array();

        if ($status == 'public')
            $params['publish_till'] = $this->input->post('publish_till');
        else if ($status == 'saled')
            $params['saled_by'] = $this->input->post('saled_by');

        $item->change_status($status, $params);
        $this->send_email($item->id);

        $item->display_mainpage = $this->input->post('mainpage_show');
        $item->save();


        echo 'OK';
        die;
    }

    public function update_finish_time()
    {
        foreach (Item::all() as $item) {
            if (!$item->user)
                $item->delete();

            if ($item->user)
                $item->site_price = ($item->type == "free" ? Commission::get_commission($item->user->city_id, $item->price) : 0) + $item->price;

            $item->save();
        }

        foreach (Item::all(array('conditions' => array('status' => 'public'))) as $item) {

            if ($item->finish_time->getTimestamp() - 3600 <= time()) {
                $item->status = 'finished';
                $item->closed_time = time_to_mysqldatetime(time());
                $item->closed_by = 0;
                $item->save();
                $this->send_email($item->id);
            }
        }
        die;
    }
}

?>