<?php

require('config.php');

$mysqli = mysqli_connect($_ENV['db']['host'], $_ENV['db']['login'], $_ENV['db']['password'], $_ENV['db']['name']);

function GetProducts(mysqli $mysqli, Int $limit = 10)
{
    $stmt = $mysqli->prepare("SELECT * FROM `products` LIMIT ?");
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}

var_dump(GetProducts($mysqli, 1));

?>