<?php
define('ROOT', dirname(__DIR__));
require ROOT.'/app/App.php';

// result search are dynamically included in a page
if(isset($_GET['p']) && ($_GET['p'] !== 'dreams.search')) {
    include_once(ROOT. '/app/Views/templates/headHtml.php');
}

App::getInstance();
