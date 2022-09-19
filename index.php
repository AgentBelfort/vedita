<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список товаров</title>
    <script src="script.js"></script>
</head>
<body>
    <table border='1'>
        <tr>
            <td>ID</td>
            <td>PRODUCT_ID</td>
            <td>Название продукта</td>
            <td>Цена</td>
            <td>Артикул</td>
            <td>Кол-во</td>
            <td>Дата создания</td>
            <td></td>
        </tr>
        <?php
        require('config.php');
        require('CProducts.php');
        $cProducts = new CProducts($_ENV['db']['host'], $_ENV['db']['login'], $_ENV['db']['password'], $_ENV['db']['name']);
        $rows = $cProducts->GetProducts();

        usort($rows, function($a,$b){ // сортировка товаров
            return strtotime($a['DATE_CREATE'])<strtotime($b['DATE_CREATE']) ? 1 : -1;
        });

        foreach($rows as $key=>$value): ?>
        <tr id="tr_<?=$value['ID'];?>">
            <td><?=$value['ID'];?></td>
            <td><?=$value['PRODUCT_ID'];?></td>
            <td><?=$value['PRODUCT_NAME'];?></td>
            <td><?=$value['PRODUCT_PRICE'];?> руб.</td>
            <td><?=$value['PRODUCT_ARTICLE'];?></td>
            <td><?=$value['PRODUCT_QUANTITY'];?></td>
            <td><?=$value['DATE_CREATE'];?></td>
            <td><button onclick='hide_td(<?=$value['ID'];?>)'>Скрыть</button></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>