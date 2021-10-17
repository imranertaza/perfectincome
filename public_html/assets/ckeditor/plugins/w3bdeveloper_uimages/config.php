<?php
ini_set('display_errors', '0');
$uploadDir = 'http://localhost/dnationsoft_cms/assets/ckeditor/plugins/w3bdeveloper_uimages/'; # the link for the plugin,add slash after
$dbHost = 'localhost';
$dbName = 'dnationsoft_cms';
$dbUser = 'root';
$dbPass = '';

$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.';charset=utf8',$dbUser, $dbPass);
$db->query("
			CREATE TABLE IF NOT EXISTS `w3bdeveloper_media` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `type` varchar(255) NOT NULL,
			  `path` text NOT NULL,
			  `thumbnailPath` text NOT NULL,
			  `fileName` text NOT NULL,
			  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

?>