/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : mama

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2013-04-15 01:37:43
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `animals`
-- ----------------------------
DROP TABLE IF EXISTS `animals`;
CREATE TABLE `animals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `no_organization` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of animals
-- ----------------------------

-- ----------------------------
-- Table structure for `articles`
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `preview` text NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL DEFAULT '',
  `meta_description` varchar(255) NOT NULL DEFAULT '',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `changed_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles
-- ----------------------------

-- ----------------------------
-- Table structure for `article_categories`
-- ----------------------------
DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE `article_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `changed_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `cities`
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) DEFAULT NULL,
  `valute` varchar(10) NOT NULL DEFAULT '',
  `bank` varchar(255) NOT NULL DEFAULT '',
  `title` text,
  `meta_keywords` text,
  `meta_description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cities
-- ----------------------------

-- ----------------------------
-- Table structure for `city_organizations`
-- ----------------------------
DROP TABLE IF EXISTS `city_organizations`;
CREATE TABLE `city_organizations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) unsigned NOT NULL DEFAULT '0',
  `organization_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of city_organizations
-- ----------------------------

-- ----------------------------
-- Table structure for `commissions`
-- ----------------------------
DROP TABLE IF EXISTS `commissions`;
CREATE TABLE `commissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL DEFAULT '0',
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `value` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of commissions
-- ----------------------------

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `param` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`param`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('site_title', 'Породные щенки и котята от лучших питомников и заводчиков');
INSERT INTO `config` VALUES ('copyright', 'Copyright © 2013 by Куракина Ольга. Все права защищены. Запрещено любое копирование материалов сайта без письменного согласия владельца – Куракиной Ольги.');
INSERT INTO `config` VALUES ('meta_keywords', 'британские котята, вислоухие котята, шотландские котята, щенки хаски, щенки чихуахуа, щенки йоркширского терьера, мэйн кун, щенки той терьера, щенки померанского шпица, щенки дога  ');
INSERT INTO `config` VALUES ('meta_description', 'Объявления о продаже породистых щенков декоративных пород и котят от питомников и заводчиков: фото, цена, подробное описание. Желающие могут разместить частные предложения. Профессиональная помощь в выборе питомца. Бесплатные консультации.  ');
INSERT INTO `config` VALUES ('html_left', '<br>');
INSERT INTO `config` VALUES ('html_bottom_1', 'Copyright © 2013 by Куракина Ольга. Все права защищены. \nЗапрещено любое копирование материалов сайта без письменного согласия владельца – Куракиной Ольги.');
INSERT INTO `config` VALUES ('404', '<div style=\"text-align: center;\"><b><font color=\"#ff6600\">Упс! Вы пытались зайти на страницу которая не существует)</font></b></div><div style=\"text-align: center;\"><font color=\"#ff6600\"><b><br></b></font></div><div style=\"text-align: center;\"><font color=\"#ff6600\"><b>Чтобы найти информацию на нашем сайте (а она точно есть) воспользуйтесь поиском:</b></font></div>\n<div style=\"font-size: 10pt;\">\n<div class=\"ya-site-form ya-site-form_inited_no\" onclick=\"return {\'bg\': \'#ff8000\', \'target\': \'_self\', \'language\': \'ru\', \'suggest\': false, \'tld\': \'ru\', \'site_suggest\': false, \'action\': \'http://yandex.ru/sitesearch\', \'webopt\': false, \'fontsize\': 12, \'arrow\': false, \'fg\': \'#000000\', \'searchid\': \'2013543\', \'logo\': \'ww\', \'websearch\': false, \'type\': 2}\"><form action=\"http://yandex.ru/sitesearch\" method=\"get\" target=\"_self\"><input type=\"hidden\" name=\"searchid\" value=\"2013543\"><input type=\"hidden\" name=\"l10n\" value=\"ru\"><input type=\"hidden\" name=\"reqenc\" value=\"\"><input type=\"text\" name=\"text\" value=\"\"><input type=\"submit\" value=\"Найти\"></form></div><style type=\"text/css\">.ya-page_js_yes .ya-site-form_inited_no { display: none; }</style>&lt;script type=\"text/javascript\"&gt;(function(w,d,c){var s=d.createElement(\'script\'),h=d.getElementsByTagName(\'script\')[0],e=d.documentElement;(\' \'+e.className+\' \').indexOf(\' ya-page_js_yes \')===-1&amp;&amp;(e.className+=\' ya-page_js_yes\');s.type=\'text/javascript\';s.async=true;s.charset=\'utf-8\';s.src=(d.location.protocol===\'https:\'?\'https:\':\'http:\')+\'//site.yandex.net/v2.0/js/all.js\';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Form.init()})})(window,document,\'yandex_site_callbacks\');&lt;/script&gt;\n</div>\n<div style=\"font-size: 10pt; text-align: center;\"><br></div><div style=\"font-size: 10pt; text-align: center;\"><font size=\"5\" color=\"#ff6600\"><b>Если вы хотите купить щенка или котенка от питомника проверенного годами, то вы попали по адресу.&nbsp;</b></font></div><div style=\"font-size: 10pt; text-align: center;\"><font size=\"5\" color=\"#ff6600\"><b><br></b></font></div><div style=\"text-align: center;\"><font color=\"#ff6600\"><b>Для выбора щенка или котенка воспользуйтесь фильтром слева или перейдите <a href=\"http://dogscat.com/all-offers\">сюда</a>.</b></font></div>');
INSERT INTO `config` VALUES ('html_bottom_2', '<br>');
INSERT INTO `config` VALUES ('site_email', 'dogscatru@gmail.com');
INSERT INTO `config` VALUES ('publish_mail', 'Здравствуйте, {{$user}}!\n\nВаше объявление {{$item_link}} опубликовано до {{$item_finish_date}}.\n\nС уважением, сайт {{$site_name}}');
INSERT INTO `config` VALUES ('endtime_mail', 'Здравствуйте, {{$user}}!\n\nВаше объявление {{$item_link}} снято, так как истек срок его публикации, если хотите продлить публикацию, напишите об этом в ответ на\nэто письмо.\n\nС уважением, сайт {{$site_name}}');
INSERT INTO `config` VALUES ('stoped_mail', 'Здравствуйте, {{$user}}!\n\nВаше объявление {{$item_link}} снято, так как не пользуется спросом.\nДавайте сделаем ваше объявление более привлекательным для покупателей – это поможет скорее продать {{$item_animal}}:\n1) если фотографии неактуальны или не самые удачные – загрузите новые фотографии {{$item_animal}}\n2) если описание {{$item_animal}} в стиле «красивый, ласковый», то стоит добавить красок, например, «Малыш не только безумно красив, но и обладает редким обаянием…»\n3) уменьшите цену за {{$item_animal}}- на сегодня есть предложения более выгодные чем, ваше. Снизив цену вы скорее сможете найти хороших покупателей.\n\nЧтобы внести изменения в объявление пройдите по ссылке: {{$item_editlink}}\n\nМы можем вновь опубликовать объявление, без изменений, но это будет платный тип объявления.\nПодробнее здесь: http://dogscat.com/statji/zav/prodat\n\nС уважением, сайт {{$site_name}}');
INSERT INTO `config` VALUES ('medals_dir', 'img/medals/');
INSERT INTO `config` VALUES ('item_images_count', '3');
INSERT INTO `config` VALUES ('item_images_dir', 'img/items/');
INSERT INTO `config` VALUES ('article_images_dir', 'img/articles/');
INSERT INTO `config` VALUES ('site_name', 'dogscat.com');
INSERT INTO `config` VALUES ('register_email', 'Здравствуйте, {{$user}}!\n\nВы зарегистрировались на сайте!\n\nemail: {{email}}\nпароль: {{password}}\n\n\nС уважением, сайт {{$site_name}}');
INSERT INTO `config` VALUES ('agreement2_text', '<span style=\"font-family: Arial, \'Helvetica CY\', \'Nimbus Sans L\', sans-serif; line-height: 20px; text-align: left; background-color: rgb(255, 255, 223); \">Если&nbsp;</span><b style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; border-image: initial; outline-width: 0px; outline-style: initial; outline-color: initial; vertical-align: baseline; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 223); font-family: Arial, \'Helvetica CY\', \'Nimbus Sans L\', sans-serif; line-height: 20px; text-align: left; \">Вы самостоятельно</b><span style=\"font-family: Arial, \'Helvetica CY\', \'Nimbus Sans L\', sans-serif; line-height: 20px; text-align: left; background-color: rgb(255, 255, 223); \">&nbsp;найдете клиента на щенка и&nbsp;</span><b style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; border-image: initial; outline-width: 0px; outline-style: initial; outline-color: initial; vertical-align: baseline; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 223); font-family: Arial, \'Helvetica CY\', \'Nimbus Sans L\', sans-serif; line-height: 20px; text-align: left; \">щенок будет забронирован или продан</b><span style=\"font-family: Arial, \'Helvetica CY\', \'Nimbus Sans L\', sans-serif; line-height: 20px; text-align: left; background-color: rgb(255, 255, 223); \">, то сразу же, как только щенка забронируют, Вы оповестите нас об этом по&nbsp;</span><b style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; border-image: initial; outline-width: 0px; outline-style: initial; outline-color: initial; vertical-align: baseline; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 223); font-family: Arial, \'Helvetica CY\', \'Nimbus Sans L\', sans-serif; line-height: 20px; text-align: left; \">email или позвоните по телефону</b><span style=\"font-family: Arial, \'Helvetica CY\', \'Nimbus Sans L\', sans-serif; line-height: 20px; text-align: left; background-color: rgb(255, 255, 223); \">&nbsp;указанному на сайте. Это важно для того, чтобы мы не тратили напрасно средства и время на рекламу и продажу щенка, который уже продан.&nbsp;</span><span class=\"sure\" style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; border-image: initial; outline-width: 0px; outline-style: initial; outline-color: initial; vertical-align: baseline; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 223); font-family: Arial, \'Helvetica CY\', \'Nimbus Sans L\', sans-serif; line-height: 20px; text-align: left; \">Договорились?</span>');

-- ----------------------------
-- Table structure for `documents`
-- ----------------------------
DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `animal_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of documents
-- ----------------------------

-- ----------------------------
-- Table structure for `fields`
-- ----------------------------
DROP TABLE IF EXISTS `fields`;
CREATE TABLE `fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('text','int','select') NOT NULL DEFAULT 'text',
  `name` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fields
-- ----------------------------
INSERT INTO `fields` VALUES ('1', 'int', 'Ожидаемый вес, кг', 'weight');
INSERT INTO `fields` VALUES ('2', 'int', 'Рост, см', 'height');
INSERT INTO `fields` VALUES ('3', 'text', 'Окрас', 'okras');
INSERT INTO `fields` VALUES ('4', 'select', 'Уши', 'ears');
INSERT INTO `fields` VALUES ('5', 'select', 'Хвост', 'tail');
INSERT INTO `fields` VALUES ('6', 'select', 'Прикус', 'bite');
INSERT INTO `fields` VALUES ('7', 'select', 'Длина шерсти', 'wool_length');

-- ----------------------------
-- Table structure for `field_variants`
-- ----------------------------
DROP TABLE IF EXISTS `field_variants`;
CREATE TABLE `field_variants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of field_variants
-- ----------------------------
INSERT INTO `field_variants` VALUES ('1', '4', 'стоят');
INSERT INTO `field_variants` VALUES ('2', '4', 'пока не встали');
INSERT INTO `field_variants` VALUES ('3', '4', 'висят');
INSERT INTO `field_variants` VALUES ('4', '4', 'купированы');
INSERT INTO `field_variants` VALUES ('5', '5', 'не купирован');
INSERT INTO `field_variants` VALUES ('6', '5', 'купирован');
INSERT INTO `field_variants` VALUES ('7', '6', 'ножницеобразный');
INSERT INTO `field_variants` VALUES ('8', '6', 'прямой');
INSERT INTO `field_variants` VALUES ('9', '6', 'перекус');
INSERT INTO `field_variants` VALUES ('10', '6', 'недокус');
INSERT INTO `field_variants` VALUES ('11', '6', 'по стандарту');
INSERT INTO `field_variants` VALUES ('12', '7', 'короткошерстный');
INSERT INTO `field_variants` VALUES ('13', '7', 'длинношерстный');

-- ----------------------------
-- Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT '0',
  `animal_id` int(11) NOT NULL DEFAULT '0',
  `kind_id` int(11) NOT NULL DEFAULT '0',
  `plant_count` int(11) NOT NULL DEFAULT '0',
  `plant_name` varchar(255) DEFAULT '0',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `sex` enum('man','girl') NOT NULL DEFAULT 'man',
  `weight` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `organization_id` int(11) NOT NULL DEFAULT '0',
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_age` varchar(255) DEFAULT NULL,
  `mother_weight` double DEFAULT NULL,
  `mother_height` double DEFAULT NULL,
  `mother_prizes` varchar(255) DEFAULT NULL,
  `mother_image` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `father_age` varchar(255) DEFAULT NULL,
  `father_weight` double DEFAULT NULL,
  `father_height` double DEFAULT NULL,
  `father_prizes` varchar(255) DEFAULT NULL,
  `father_image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `description` text,
  `another` text,
  `price` int(11) NOT NULL DEFAULT '0',
  `site_price` int(11) NOT NULL DEFAULT '0',
  `type` enum('free','paid_1','paid_2') NOT NULL DEFAULT 'free',
  `image` varchar(255) NOT NULL DEFAULT '',
  `status` enum('created','edited','public','saled','finished','canceled') DEFAULT NULL,
  `saled_by` enum('site','plant') DEFAULT NULL,
  `created_time` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `changed_time` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `publish_time` datetime DEFAULT NULL,
  `publish_by` int(11) DEFAULT NULL,
  `finish_time` datetime DEFAULT NULL,
  `closed_time` datetime DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL,
  `display_mainpage` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of items
-- ----------------------------

-- ----------------------------
-- Table structure for `item_documents`
-- ----------------------------
DROP TABLE IF EXISTS `item_documents`;
CREATE TABLE `item_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `document_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_documents
-- ----------------------------

-- ----------------------------
-- Table structure for `item_fields`
-- ----------------------------
DROP TABLE IF EXISTS `item_fields`;
CREATE TABLE `item_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `field_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_fields
-- ----------------------------

-- ----------------------------
-- Table structure for `item_images`
-- ----------------------------
DROP TABLE IF EXISTS `item_images`;
CREATE TABLE `item_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `pos` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_images
-- ----------------------------

-- ----------------------------
-- Table structure for `item_medals`
-- ----------------------------
DROP TABLE IF EXISTS `item_medals`;
CREATE TABLE `item_medals` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned NOT NULL,
  `medal_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_medals
-- ----------------------------

-- ----------------------------
-- Table structure for `kinds`
-- ----------------------------
DROP TABLE IF EXISTS `kinds`;
CREATE TABLE `kinds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `animal_id` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `header_template` text,
  `preview_template` text,
  `text_template` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kinds
-- ----------------------------

-- ----------------------------
-- Table structure for `kind_fields`
-- ----------------------------
DROP TABLE IF EXISTS `kind_fields`;
CREATE TABLE `kind_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kind_id` int(11) NOT NULL DEFAULT '0',
  `field_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kind_fields
-- ----------------------------

-- ----------------------------
-- Table structure for `kind_settings`
-- ----------------------------
DROP TABLE IF EXISTS `kind_settings`;
CREATE TABLE `kind_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kind_id` int(11) NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL DEFAULT '0',
  `beforelist_text` text,
  `afterlist_text` text,
  `phone` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `free_agreement` text,
  `paid1_agreement` text,
  `paid2_agreement` text,
  `manager_contact` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kind_settings
-- ----------------------------

-- ----------------------------
-- Table structure for `kind_texts`
-- ----------------------------
DROP TABLE IF EXISTS `kind_texts`;
CREATE TABLE `kind_texts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kind_id` int(11) NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL DEFAULT '0',
  `type` enum('before','after') NOT NULL DEFAULT 'before',
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kind_texts
-- ----------------------------

-- ----------------------------
-- Table structure for `medals`
-- ----------------------------
DROP TABLE IF EXISTS `medals`;
CREATE TABLE `medals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alt` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of medals
-- ----------------------------

-- ----------------------------
-- Table structure for `organizations`
-- ----------------------------
DROP TABLE IF EXISTS `organizations`;
CREATE TABLE `organizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `animal_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `site_text` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of organizations
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('admin','manager','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `metro` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `information` text,
  `is_checked` tinyint(1) NOT NULL DEFAULT '0',
  `is_best` tinyint(1) NOT NULL DEFAULT '0',
  `is_agreed` tinyint(1) NOT NULL DEFAULT '0',
  `is_ban` tinyint(1) DEFAULT NULL,
  `register_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastlogin_time` datetime DEFAULT NULL,
  `sell_site` int(11) NOT NULL,
  `sell_plant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
