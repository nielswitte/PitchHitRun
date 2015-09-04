<?php
error_reporting(E_ALL);

require_once 'config.php';

require_once 'autoloader.php';

// Connect to database
Api\Helpers\Db::Connect($settings['db_host'], $settings['db_database'], $settings['db_user'], $settings['db_password'], $settings['db_port']);

// Api and Controllers
require_once __DIR__ . '/Controllers/CategoriesController.php';
require_once __DIR__ . '/Controllers/ResultsController.php';
require_once __DIR__ . '/Controllers/ScoresController.php';
require_once __DIR__ . '/Controllers/SectionsController.php';
require_once __DIR__ . '/Controllers/UserController.php';

$server = new \Api\Libs\RestServer\RestServer('debug');
$server->addClass('CategoriesController', 'Categories');
$server->addClass('ResultsController', 'Results');
$server->addClass('ScoresController', 'Scores');
$server->addClass('SectionsController', 'Sections');
$server->addClass('UserController', 'Users');
$server->handle();

