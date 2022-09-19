<?php

class CProducts
{
    private $connection = "";

    public function __construct(string $mysql_host, string $mysql_login, string $mysql_password, string $mysql_db_name)
    {
        $this->connection = mysqli_connect($mysql_host, $mysql_login, $mysql_password, $mysql_db_name);
    }

    function GetProducts(Int $limit = 10)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `products` WHERE `IS_HIDDEN` = ? ORDER BY `DATE_CREATE` DESC LIMIT ?");
        $is_hidden = 0;
        $stmt->bind_param("ii", $is_hidden, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }
    
    function HideProduct(Int $product_id)
    {
        $stmt = $this->connection->prepare("UPDATE `products` SET `IS_HIDDEN` = ? WHERE `products`.`ID` = ?;");
        $is_hidden = 1;
        $stmt->bind_param("ii", $is_hidden, $product_id);
        $stmt->execute();
    }
    
    function ChangeQty(Int $product_id, Int $mutable_value)
    {
        // получаем значение из БД
        $stmt = $this->connection->prepare("SELECT `PRODUCT_QUANTITY` FROM `products` WHERE `ID` = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $new_qty = $row['PRODUCT_QUANTITY'] + $mutable_value;

        // записываем в бд новое значение
        $stmt = $this->connection->prepare("UPDATE `products` SET `PRODUCT_QUANTITY` = ? WHERE `products`.`ID` = ?;");
        $stmt->bind_param("ii", $new_qty, $product_id);
        $stmt->execute();

        echo $new_qty;
    }

}

?>