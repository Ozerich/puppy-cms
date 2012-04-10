function myplugin_options_page() {      //Функция создания и обработки страницы настроек плагина
    global $wpdb, $myplugin_prefs_table;
    $myplugin_options = array(          //Создаём массив с настройками плагина
        'myplug_modify_title',
        'myplug_modify_content',
    );
    $cmd = $_POST['cmd'];               //Обработка пользовательского ввода
    foreach ($myplugin_options as $myplugin_opt) {
        $$myplugin_opt = get_option($myplugin_opt);
    }
    if ($cmd == "del_prefs") {          //Если нажато "удалить фразы" - очищаем таблицу настроек плагина
        $sql = "TRUNCATE TABLE $myplugin_prefs_table";
        $wpdb->query( $sql );
    ?>
        <div class="updated"><p><strong> <?php echo __('All phrases are removed from the database','example_plugin'); ?></strong></p></div> /* Сообщаем пользвателю об успешной очистке. */
    <?php
    }
    if ($cmd == "add_prefs" && $_POST['prefs_base']) { //Если введены новые фразы в соотв. поле - обработаем их
        $lines = explode("\n", $_POST['prefs_base']); //Ввод разбивается на строки и кладётся в массив, разделитель - перевод строки
        foreach($lines as $line){   //Перебираем массив со строками
            $line = trim($line);    //Обрезка каждой строки от переводов
            if (!$line) continue;   //Если строка отстутствует - переходим к следующей итерации
            list($title, $body) = explode("|", $line);  //Разделение строки на две подстроки
            //Кладём подстроки в таблицу плагина.
            $sql = "INSERT INTO $myplugin_prefs_table (title, body) VALUES('$title','$body')";
            $wpdb->query($sql);
        }
    ?>
        <div class="updated"><p><strong> <?php echo __('Phrases added to the database','example_plugin'); ?></strong></p></div> /*Сообщаем пользователю об успешной обработке*/
    <?php
    }
    if ($cmd == "myplugin_save_opt") { //Обработка нажатия "Сохранить настройки"
        foreach ($myplugin_options as $myplugin_opt) {  //Перебор массива с настройками
            $$myplugin_opt = $_POST[$myplugin_opt]; //Каждому элементу массива присваиваем введённое пользователем занчение
        }

        foreach ($myplugin_options as $myplugin_opt) { //Обновляем настройки плагина в таблице настроек wordpress
            update_option($myplugin_opt, $$myplugin_opt);
        }
    ?>
        <div class="updated"><p><strong> <?php echo __('Settings saved','example_plugin'); ?></strong></p></div>
    <?php
    }
?>
    <div class="wrap">
    <h2>My Plugin</h2> /*Заголовок страницы настроек плагина*/

    <h3><?php echo __('Settings','example_plugin'); ?></h3> /*Название раздела настроек*/
    /*Начало формы для обработки настроек. Форма содержит 2 чекбокса, включающих или отключающих соответствующие функции плагина*/
    <form method="post" action="<? echo $_SERVER['REQUEST_URI'];?>">
    <table class="form-table">
    <tr>
    <th colspan=2 scope="row"> /*Первый чекбокс - будет ли плагин обрабатывать заголовки записей*/
        <input name="myplug_modify_title" type="checkbox" <?if($myplug_modify_title)echo "checked";?>> <?php echo __('Add random phrase to post title','example_plugin'); ?>
    </th>
    </tr>
    <tr>
    <th colspan=2 scope="row"> /*Второй чекбокс - будет ли плагин обрабатывать тело записей*/
        <input name="myplug_modify_content" type="checkbox" <?if($myplug_modify_content)echo "checked";?>> <?php echo __('Add random phrase to post content','example_plugin'); ?>
    </th>
    </tr>
    </table>
    <input type="hidden" name="cmd" value="myplugin_save_opt"> /*"Функциональная" часть кнопки сохранения настроек*/
    <p class="submit">
    <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" /> /*Вывод кнопки сохранения настроек в браузер. Стандартная функция Wordpress*/
    </p>
    </form> /*Конец формы обработки настроек*/

    /*Вывод информации о плагине. Например - кем разработан*/
    <h3><?php echo __('Plugin developed','example_plugin'); ?></h3>
    <table class="form-table">
    <tr><th>
    <ul>
    <li><?php echo __('By: <a href="http://dimio.org/" target="_blank">dimio</a>','example_plugin'); ?></li>
    </ul>
    </th></tr></table>

    /*Блок ввода новых фраз в таблицу настроек плагина. Сначала идёт справка для пользователя*/
    <h3><?php echo __('Adding phrases','example_plugin'); ?></h3>
    /*Начало формы ввода. Форма содержит текстовое поле для ввода шириной 80 символов и высотой 12 строк*/
    <table class="form-table" width="300px">
    <tr>
    <td>
        <?php echo __('Format phrases: Title|Body','example_plugin'); ?><br />
    <form method="post" action="<? echo $_SERVER['REQUEST_URI'];?>">
    <textarea cols=80 rows=12 name="prefs_base"></textarea> /*Поле для ввода новых фраз*/
    </td>
    </tr>
    </table>
    /*Кнопка для сохранения фраз. По аналогии с кнопкой сохранения настроек, но без применения стандартной ф-и Wordpress*/
    <input type="hidden" name="cmd" value="add_prefs">
    <p class="submit">
    <input type="submit" name="Submit" value="<?php echo __('Add phrases','example_plugin'); ?>" />
    </p>
    </form>
    /*Форма, содержащая единственную кнопку - очистки таблицы настроек плагина*/
    <form method="post" action="<? echo $_SERVER['REQUEST_URI'];?>">
    <input type="hidden" name="cmd" value="del_prefs">
    <input type="submit" name="Submit" value="<?php echo __('Remove all phrases from the database','example_plugin'); ?>" />
    </form>
    </div>

<?php
//Конец функции создания и обработки страницы настроек.
}
?>