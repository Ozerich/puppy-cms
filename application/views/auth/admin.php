<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text-html; charset=utf-8">
    <title><?=$page_title ? $page_title : ''?> | Puppy CMS Admin Panel</title>
    <base href="<?=base_url()?>"/>
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title"/>
    <link rel="stylesheet/less" href="css/admin.less" type="text/css"/>
</head>
<body>
<?=form_open("admin/login"); ?>
<div class="admin-login">
    <span class="error"><?=isset($error) ? $error : ''?></span>
    <label for="uname">Login:</label>
    <input type="text" id="uname" name="uname"/>
    <label for="upass">Password:</label>
    <input type="password" id="upass" name="upass"/>
    <input type="submit" value="Войти"/>
</div>
</form>
</body>
</html>