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
        $stmt = $this->connection->prepare("UPDATE `products` SET `IS_HIDDEN` = '1' WHERE `products`.`ID` = ?;");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
    }

}

?>