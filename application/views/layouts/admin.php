<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text-html; charset=utf-8">
    <title><?if (isset($page_title)) echo $page_title;?> | Puppy CMS Admin Panel</title>
    <base href="<?=base_url()?>"/>

    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title"/>
    <link rel="stylesheet/less" href="css/main.less" type="text/css"/>

    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/less-1.1.5.min.js"></script>

    <? if (isset($JS_files))
    foreach ($JS_files as $js): ?>
        <script src="<?=$js?>"></script>
        <? endforeach; ?>
</head>
<body>
<?=$page_content?>
</body>
</html>
