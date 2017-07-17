<?php
/**
 * Base application config, cat get param Application::getParam();
 */
return [
	'db' => require(__DIR__ . '/db.php'),
    'layoutPath' => $_SERVER['DOCUMENT_ROOT'] . '/views/layouts',
    'viewsPath' => $_SERVER['DOCUMENT_ROOT'] . '/views',
    'uploadPath' => $_SERVER['DOCUMENT_ROOT'] . '/uploads',
];