<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text-html; charset=utf-8">
    <title><?if (isset($page_title)) echo $page_title;?> | Puppy CMS Admin Panel</title>
    <base href="<?=base_url()?>"/>

    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title"/>
    <link rel="stylesheet/less" href="css/admin.less" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery.cleditor.css" />

    <script src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.cleditor.min.js"></script>
    <script src="js/less-1.1.5.min.js"></script>
    <script src="js/admin.js"></script>

    <? if (isset($JS_files))
    foreach ($JS_files as $js): ?>
        <script src="<?=$js?>"></script>
        <? endforeach; ?>
</head>
<body>
<div id="main-wrapper">
    <div id="header">
        <span class="version">Puppy CMS 1.0</span>

        <div class="user-block">
            Пользователь: <span class="name"><?=$user ? $user->login : 'Неизвестный'?></span>
            (<a href="admin/logout" class="logout">выход</a>)
        </div>
        <br class="clear"/>
    </div>
    <div id="nav">
        <ul>
            <li>
                <div class="menu-item">
                    <span>Настройки CMS</span>
                    <a href="#" class="toggle_submenu">—</a>
                </div>
                <ul class="submenu">
                    <li><a href="admin/cities">Города</a></li>
                    <li><a href="admin/animals">Виды животных</a></li>
                    <li><a href="admin/config/mails">Шаблоны писем</a></li>
                    <li><a href="admin/config/medals">Медали</a></li>
                </ul>
            </li>
            <li>
                <div class="menu-item">
                    <span>Пользователи</span>
                    <a href="#" class="toggle_submenu">—</a>
                </div>
                <ul class="submenu">
                    <li><a href="admin/users/admin">Администраторы</a></li>
                    <li><a href="admin/users/manager">Менеджеры</a></li>
                    <li><a href="admin/users/user">Пользователи</a></li>
                    <li><a href="admin/users">Все</a></li>
                </ul>
            </li>
            <li>
                <div class="menu-item">
                    <span>Каталог</span>
                    <a href="#" class="toggle_submenu">—</a>
                </div>
                <ul class="submenu">
                    <li><a href="admin/kinds">Породы</a></li>
                    <li><a href="admin/catalog">Щенки</a></li>
                </ul>
            </li>
            <li>
                <div class="menu-item">
                    <span>Сайт</span>
                    <a href="#" class="toggle_submenu">—</a>
                </div>
                <ul class="submenu">
                    <li><a href="admin/config/content">Контент</a></li>
                    <li><a href="admin/articles">Статьи</a></li>
                </ul>
            </li>

        </ul>
    </div>
    <div id="content">
        <?=$page_content?>
    </div>
    <div id="footer">
        <div class="license">Licensed to: <span class="name">Ольга Куракина</span></div>
        <div class="copyright">&copy; <a href="mailto:ozicoder@gmail.com">Vital Ozierski</a> | 2012</div>
        <br class="clear"/>
    </div>
</div>

</body>
</html>
