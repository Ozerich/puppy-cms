<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text-html; charset=utf-8">
    <meta name="keywords" content="<?=isset($meta_keywords) ? $meta_keywords : Config::get('meta_keywords')?>">
    <meta name="description" content="<?=isset($meta_description) ? $meta_description : Config::get('meta_description')?>">

    <title><?=isset($page_title) ? $page_title.' - ' : ''?><?=Config::get('site_title');?></title>
    <base href="<?=base_url()?>"/>

    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title"/>
    <link rel="stylesheet/less" href="css/main.less" type="text/css"/>
    <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css"/>
    <link rel="stylesheet" href="css/colorbox.css" type="text/css"/>

    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <script src="js/ajaxfileupload.js"></script>
    <script src="js/less-1.1.5.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/jquery.colorbox.js"></script>

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-31146458-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter14079358 = new Ya.Metrika({id:14079358, enableAll: true, webvisor:true});
            } catch(e) {}
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/14079358" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <? if (isset($JS_files))
    foreach ($JS_files as $js): ?>
        <script src="<?=$js?>"></script>
        <? endforeach; ?>
</head>
<body>


<div id="main-wrapper">
    <div id="left-wrapper">
        <div id="filter">        <?=form_open('filter');?>
            <h2 id="filter_phone" class="phone"><?=isset($filter_phone) ? $filter_phone : ''?></h2>
            <h3>щенки и котята<br/>от проверенных временем<br/>питомников</h3>

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
                        <? foreach (Kind::all() as $kind): ?>
                        <option has_height="<?=$kind->is_height?>" has_weight="<?=$kind->is_weight?>"
                                animal="<?=$kind->animal_id?>" value="<?=$kind->id?>"><?=$kind->name?></option>
                        <? endforeach; ?>
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
                    <select disabled id="price" name="price">

                    </select>
                </div>

                <div class="filter-param" id="weight-filter">
                    <label for="weight">Вес:</label>
                    <select disabled id="weight" name="weight">

                    </select>
                </div>

                <div class="filter-param" id="height-filter">
                    <label for="height">Рост:</label>
                    <select disabled id="height" name="height">

                    </select>
                </div>
            </div>

            <img id="filter_loading" src="img/item-loader.gif"/>
            <input type="submit" value="Показать" id="filter_submit"/>
            </form></div>


        <a href="create" id="new-item">Дать объявление</a>

        <div id="left-content">
            <?=Config::get('html_left');?>
        </div>
    </div>
    <div id="right-wrapper">
        <div id="header">

            <a href="/">
                <div id="header-content">
                    <h2>
                        Щенки и котята от<br/>
                        проверенных питомников
                    </h2>
                </div>
                <div id="header-left"></div>
                <div id="header-right"></div>
            </a>
        </div>

        <? if ($this->user): ?>
        <div id="top_menu">
            <a href="profile">Личный кабинет (объявления)</a>
            <a href="logout">Выйти</a>
            <a href="statji">Новости сайта</a>
        </div>
        <? endif; ?>

        <div id="content">
            <?=$page_content?>
        </div>
    </div>
    <br class="clear">
</div>


<div id="footer_1">
    <?=Config::get('html_bottom_1');?>
</div>

<div id="footer_2">
    <?=Config::get('html_bottom_2');?>
</div>

</body>
</html>
