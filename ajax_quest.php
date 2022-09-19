<?php

if ($_GET == []) exit();

require('config.php');
require('CProducts.php');
$cProducts = new CProducts($_ENV['db']['host'], $_ENV['db']['login'], $_ENV['db']['password'], $_ENV['db']['name']);

switch ($_GET['action']) {
    case 'hide_product':
        if (isset($_GET['product_id']))
            $cProducts->HideProduct($_GET['product_id']);
        break;
}

?>