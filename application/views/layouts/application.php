<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text-html; charset=utf-8">
    <? if(isset($meta_keywords) && !empty($meta_keywords)): ?>
	<meta name="keywords" content="<?=isset($meta_keywords) ? $meta_keywords : Config::get('meta_keywords')?>">
	<? endif; ?>
	
	    <? if(isset($meta_description) && !empty($meta_description)): ?>
    <meta name="description" content="<?=isset($meta_description) ? $meta_description : Config::get('meta_description')?>">
	<? endif; ?>
	
    <title><?=isset($page_title) ? $page_title : Config::get('site_title');?></title>
    <base href="<?=base_url()?>"/>
	

    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title"/>
    <link rel="stylesheet/less" href="css/main.less" type="text/css"/>
    <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css"/>
    <link rel="stylesheet" href="css/colorbox.css" type="text/css"/>

    <script src="js/less-1.1.5.min.js"></script>
    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/jquery-ui-1.8.18.custom.min.js"></script>
	
    <script src="js/ajaxfileupload.js"></script>
    <script src="js/main.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/jquery.colorbox.js"></script>



    <script type="text/javascript">
var _gaq=_gaq||[];_gaq.push(["_setAccount","UA-31146458-1"]);_gaq.push(["_trackPageview"]);(function(){var e=document.createElement("script");e.type="text/javascript";e.async=true;e.src=("https:"==document.location.protocol?"https://ssl":"http://www")+".google-analytics.com/ga.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();(function(e,t,n){(t[n]=t[n]||[]).push(function(){try{t.yaCounter14079358=new Ya.Metrika({id:14079358,enableAll:true,webvisor:true})}catch(e){}});var r=e.getElementsByTagName("script")[0],i=e.createElement("script"),s=function(){r.parentNode.insertBefore(i,r)};i.type="text/javascript";i.async=true;i.src=(e.location.protocol=="https:"?"https:":"http:")+"//mc.yandex.ru/metrika/watch.js";if(t.opera=="[object Opera]"){e.addEventListener("DOMContentLoaded",s)}else{s()}})(document,window,"yandex_metrika_callbacks")
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/14079358" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <? if (isset($JS_files))
    foreach ($JS_files as $js): ?>
        <script src="<?=$js?>"></script>
        <? endforeach; ?>
</head>
<body>


<div id="container-main">
<div id="main-wrapper">
    <div id="left-wrapper">
        <div id="filter">        <?=form_open('filter');?>
            <h2 id="filter_phone" class="phone"><?=isset($filter_phone) ? $filter_phone : ''?></h2>
            <a href="/"><h3>Щенки и котята<br/>от проверенных временем<br/>питомников</h3></a>
            <div id="filter-form">
                <div class="filter-param">
                    <label for="city">Город:</label>
                    <select id="city" name="city">
                        <? foreach (City::all() as $city): ?>
                        <option value="<?=$city->id?>"><?=$city->name?></option>
                        <? endforeach; ?>
                    </select>
                </div>
                <div class="filter-param">
                    <label for="kind">Порода:</label>
                    <select id="kind" name="kind">
                        <? foreach (Kind::all() as $kind): if($kind->animal_id == 2)continue; ?>
                        <option has_height="<?=$kind->is_height?>" has_weight="<?=$kind->is_weight?>"
                                animal="<?=$kind->animal_id?>" value="<?=$kind->id?>"><?=$kind->name?></option>
                        <? endforeach; ?>
                        <option has_height="false" has_weight="false" animal="2" value="kotijata">Котята</option>
                    </select>
                </div>

                <div class="filter-param" id="sex-filter">
                    <label for="sex">Пол:</label>
                    <select id="sex" name="sex">
                        <option value="0">любой</option>
                        <option value="man">мальчик</option>
                        <option value="girl">девочка</option>
                    </select>
                </div>

                <div class="filter-param" id="price-filter">
                    <label for="price">Цена:</label>
                    <select id="price" name="price">

                    </select>
                </div>

                <div class="filter-param" id="weight-filter">
                    <label for="weight">Вес:</label>
                    <select id="weight" name="weight">

                    </select>
                </div>

                <div class="filter-param" id="height-filter">
                    <label for="height">Рост:</label>
                    <select id="height" name="height">

                    </select>
                </div>
            </div>

            <img id="filter_loading" src="img/item-loader.gif"/>
            <input type="submit" value="Показать" id="filter_submit"/>
            </form>
		</div>
		<div id="left-content">
			<a href="create" id="new-item">Дать объявление</a>
            <?=Config::get('html_left');?>
        </div>
    </div>
    <div id="right-wrapper">
        <div id="header">

				<div class="header-phones">
					<table id="contacts">
						<tbody>
							<tr>
								<td>Москва</td>
								<td>+7 925 282-62-14</td>
							</tr>
							<tr>
								<td>Санкт-Петербург</td>
								<td>+7 931 288-72-23</td>
							</tr>
							<tr>
								<td>Киев</td>
								<td>+38 097 289-42-10</td>
							</tr>
							<tr>
								<td>Минск</td>
								<td>+375 29 860-27-86</td>
							</tr>
							<tr>
								<td colspan="2"><b><a href="mailto:dogscatru@gmail.com">dogscatru@gmail.com</a></b></td>
							</tr>
						</tbody>
					</table>
					<div class="clear-right"></div>
					<!--<p>Москва <b>+7 925 282-62-14</b></p>
					<p>Санкт-Петербург <b>+7 931 288-72-23</b></p>
					<p>Киев <b>097 289-42-10</b></p>
					<p>Минск <b>+375 29 860-27-86</b></p>
					<p><b>dogscatru@gmail.com</b></p>-->
				</div>

			<div id="top_menu">	
				<a href="/about">О нас</a><span class="sep">|</span>
				<a href="/statji/otzyvy">Отзывы</a><span class="sep">|</span>
				<a href="statji">Статьи</a><span class="sep">|</span>
				<a href="/kontakt">Контакты</a><span class="sep">|</span>
			<? if ($this->user): ?>
				<a href="/all-offers">Все предложения</a><span class="sep">|</span>
				<a href="profile">Личный кабинет</a><span class="sep">|</span>
				<a href="logout">Выйти</a>
			<? else: ?>
				<a href="/all-offers">Все предложения</a><span class="sep">|</span>
				<a href="/create" id="new-item">Добавить объявление</a><span class="sep">|</span>
				<a href="create" id="new-item">Вход</a>
			<? endif; ?>
			</div>

            <? if(isset($_404) == false): ?>
			<div id="breadcrums">
				<?php
				$current_uri	= $_SERVER['REQUEST_URI'];
				$out_item		= '';
				$wrap_1			= '<span class="current_page">';
				$wrap_2			= '</span>';
				$arr			= array();
				switch($current_uri) {
					case("/profile"):  $out_item=' -> Личный кабинет'; break;
					
				}
			
				$pattt =	'"^\/view\/([0-9]+)$"iS'; 
				if(preg_match($pattt, $current_uri, $arr)) {
					$DB1 = $this->load->database("",TRUE);
					$elem = $arr[1];
					$qq = $DB1->query("SELECT city_id,kind_id FROM items WHERE id='$elem'");
					$rez_array = $qq->result_array();
					$city_id = $rez_array[0]['city_id'];
					$kind_id = $rez_array[0]['kind_id'];
					
					$qq = $DB1->query("SELECT alias FROM cities WHERE id='$city_id'");
					$rez_array = $qq->result_array();
					$alias_city = $rez_array[0]['alias'];
					
					$qq = $DB1->query("SELECT alias FROM kinds WHERE id='$kind_id'");
					$rez_array = $qq->result_array();
					$alias_kind = $rez_array[0]['alias'];
					
					header("HTTP/1.1 301 Moved Permanently");
					header("Location: /".$alias_city."/".$alias_kind."_".$elem);
					exit();
					
				}
				/*if($_SERVER['HTTP_HOST']=='dogscat.com') {
					header("HTTP/1.1 301 Moved Permanently");
					header("Location: http://www.".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
					echo "<script>console.log('www.".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."')</script>";
					exit();
				}*/
				
				
				$pat0 =	'"^\/statji\/([^\/]+)\/([^\/]+)$"iS'; 				
				$pat = '"^\/statji\/([^\/]+)$"iS'; 
				$pat2 = '"^\/statji$"iS';
				$pat00 = '"^\/([^\/]+)\/([^\/]+)$"iS';
				$pat01 = '"^\/([^\/]+)$"iS';
				$pat_view = '"^\/view\/([0-9]+)$"iS';
				// http://dogscat.com/statji/zav/prodat
				if(preg_match($pat0, $current_uri, $arr)) {
					$DB1 = $this->load->database("",TRUE);
					$elem = $arr[1];
					$elem2 = $arr[2];
					$qq = $DB1->query("Select name from article_categories WHERE alias='$elem'");
					$rez_array = $qq->result_array();
					if(isset($rez_array[0]['name'])) $out_item = ' -> <a href="/statji">Статьи</a> -> <a href="/statji/'.$elem.'">'.$rez_array[0]['name'].'</a>';
					else {
						$out_item = ' -> <a href="/statji">Статьи</a>';
					}
				}else if(preg_match($pat, $current_uri, $arr)) {
					$DB1 = $this->load->database("",TRUE);
					$elem = $arr[1];
					$qq = $DB1->query("Select name from article_categories WHERE alias='$elem'");
					$rez_array = $qq->result_array();
					if(isset($rez_array[0]['name'])) $out_item = ' -> <a href="/statji">Статьи</a> -> '.$rez_array[0]['name'];
					else {
						$out_item = ' -> <a href="/statji">Статьи</a>';
					}
				} else if(preg_match($pat2, $current_uri)) {
					$out_item = ' -> Статьи';
				}else if(preg_match($pat00, $current_uri, $arr)) {
					$DB1 = $this->load->database("",TRUE);
					$elem = $arr[1];
					$elem2 = $arr[2];
					$qq = $DB1->query("Select name from cities WHERE alias='$elem'");
					$rez_array = $qq->result_array();
					$qq = $DB1->query("Select name from kinds WHERE alias='$elem2'");
					$rez_array2 = $qq->result_array();
					if(isset($rez_array[0]['name'])) $out_item = ' -> <a href="/'.$elem.'">'.$rez_array[0]['name'].'</a>';
					if(isset($rez_array2[0]['name']) && isset($elem)) $out_item .= ' -> '.$rez_array2[0]['name'];
					if(!isset($rez_array[0]['name']) && !isset($rez_array2[0]['name'])) {
						if(preg_match($pat_view, $current_uri, $arr)) {
							$elem = $arr[1];
							$out_item = ' -> Объявление № '.$elem;
						}
					}
				} else if(preg_match($pat01, $current_uri, $arr)) {
					$DB1 = $this->load->database("",TRUE);
					$elem = $arr[1];
					$qq = $DB1->query("Select name from cities WHERE alias='$elem'");
					$rez_array = $qq->result_array();
					if(isset($rez_array[0]['name'])) $out_item = ' -> '.$rez_array[0]['name'];
				}			
				
				
				
				
			/*	
				rkf-ksu-fci-vystavki РКФ, КСУ, FCI и Выставки
				vijazka Вязка(статьи по теме)
				veterinar-pitanie Ветеринария и питание
						uchod-gruming-spa Уход и гроуминг SPARKPATH
						zav Заводчикам
						tecnic  Тех.моменты
						otzyvy Отзывы */
				
				/*$pat_c_norka='"^\/catalog\/norka.*?$"iS';
				if(preg_match($pat_c_norka,$current_uri) {
					echo "111";
				}*/
				
				?>
				<a href="/">Главная</a>
				<?php if(trim($out_item)!='') echo $out_item; ?>
				<?php if(isset($article->title)) echo ' -> '.$wrap_1.$article->title.$wrap_2; ?>
			</div>
			<p class="header-text">
				<div class="ya-site-form ya-site-form_inited_no" onclick="return {'bg': '#ff8000', 'target': '_self', 'language': 'ru', 'suggest': true, 'tld': 'ru', 'site_suggest': true, 'action': 'http://yandex.ru/sitesearch', 'webopt': false, 'fontsize': 12, 'arrow': false, 'fg': '#000000', 'searchid': '2013543', 'logo': 'ww', 'websearch': false, 'type': 2}"><form action="http://yandex.ru/sitesearch" method="get" target="_self"><input type="hidden" name="searchid" value="2013543" /><input type="hidden" name="l10n" value="ru" /><input type="hidden" name="reqenc" value="" /><input type="text" name="text" value="" /><input type="submit" value="Найти" /></form></div><style type="text/css">.ya-page_js_yes .ya-site-form_inited_no { display: none; }</style><script type="text/javascript">(function(w,d,c){var s=d.createElement('script'),h=d.getElementsByTagName('script')[0],e=d.documentElement;(' '+e.className+' ').indexOf(' ya-page_js_yes ')===-1&&(e.className+=' ya-page_js_yes');s.type='text/javascript';s.async=true;s.charset='utf-8';s.src=(d.location.protocol==='https:'?'https:':'http:')+'//site.yandex.net/v2.0/js/all.js';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Form.init()})})(window,document,'yandex_site_callbacks');</script>
			</p>

            <? endif; ?>
        
		</div>
		
		<div class="content-wr">
	
		
			<div id="content"><?=$page_content?></div>
			<br clear="all"/>
		</div>
    </div>
    <br class="clear">
</div>

<div id="top_menu_bottom">	
			<a href="/about">О нас</a><span class="sep">|</span>
				<a href="statji">Статьи</a><span class="sep">|</span>
				<a href="/kontakt">Контакты</a><span class="sep">|</span>
			<? if ($this->user): ?>
				<a href="/all-offers">Все предложения</a><span class="sep">|</span>
				<a href="profile">Личный кабинет</a><span class="sep">|</span>
				<a href="logout">Выйти</a>
			<? else: ?>
				<a href="/all-offers">Все предложения</a><span class="sep">|</span>
				<a href="/create" id="new-item">Добавить объявление</a><span class="sep">|</span>
				<a href="create" id="new-item">Вход</a>
			<? endif; ?>
	</div>
<div id="footer_1">
	<?=Config::get('html_bottom_1');?>
</div>

<div id="footer_2">
	<?=Config::get('html_bottom_2');?>
</div>
</div>
</body>
</html>
