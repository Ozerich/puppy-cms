<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text-html; charset=utf-8">
    <title><?=isset($page_title) ? $page_title : ''?> | Заголовок сайта</title>
    <base href="<?=base_url()?>"/>

    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title"/>
    <link rel="stylesheet/less" href="css/main.less" type="text/css"/>
    <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css"/>

    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <script src="js/ajaxfileupload.js"></script>
    <script src="js/less-1.1.5.min.js"></script>
    <script src="js/main.js"></script>

    <? if (isset($JS_files))
    foreach ($JS_files as $js): ?>
        <script src="<?=$js?>"></script>
        <? endforeach; ?>
</head>
<body>


<div id="main-wrapper">
    <div id="left-wrapper">

        <div id="filter">
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
                        <option value="<?=$kind->id?>"><?=$kind->name?></option>
                        <? endforeach; ?>
                    </select>
                </div>
                <div class="filter-param">
                    <label for="price">Цена:</label>
                    <select id="price" name="price">

                    </select>
                </div>

                <div class="filter-param">
                    <label for="sex">Пол:</label>
                    <select id="sex" name="sex">
                        <option value="0">любой</option>
                        <option value="man">мальчик</option>
                        <option value="girl">девочка</option>
                    </select>
                </div>

                <div class="filter-param">
                    <label for="weight">Вес:</label>
                    <select id="weight" name="weight">

                    </select>
                </div>

                <div class="filter-param">
                    <label for="height">Рост:</label>
                    <select id="height" name="height">

                    </select>
                </div>
            </div>

            <button id="submit-filter">Показать</button>
        </div>

        <a href="create" id="new-item">Дать объявление</a>

        <div id="left-content">
            <?=Config::get('html_left');?>
        </div>
    </div>
    <div id="right-wrapper">
        <div id="header">

            <div id="header-content">
                <h2>
                    От Святого Валентина<br/>
                    щенки и котята для любимых!
                </h2>
            </div>
            <div id="header-left"></div>
            <div id="header-right"></div>
        </div>

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
