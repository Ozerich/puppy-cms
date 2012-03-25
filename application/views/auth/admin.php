<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text-html; charset=utf-8">
    <title>Login | Puppy CMS Admin Panel</title>
    <base href="<?=base_url()?>"/>

    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title"/>
    <link rel="stylesheet/less" href="css/admin.less" type="text/css"/>

    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/less-1.1.5.min.js"></script>
</head>
<body class="adminauth">
<?=form_open("admin/auth"); ?>
    <div id="adminauth-block">
        <div class="header">
            <p>Введите имя пользователя и пароль</p>
            <a href="arrow-down"></a>
        </div>
        <div class="copyright">Сайт работает на системе <a href="mailto:ozicoder@gmail.com?subject=Puppy%20CMS">Puppy CMS</a></div>
        <? if(isset($error)): ?>
        <div class="error-block">
            <?=$error?>
        </div>
        <? endif; ?>
        <div class="inputs">
            <label for="email">e-mail:</label>
            <input type="text" name="email" id="email" value="<?=isset($email) ? $email : ''?>"/>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password"/>
        </div>
        <input type="submit" value="Войти"/>
    </div>
</form>
</body>
</html>