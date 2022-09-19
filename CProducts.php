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
        $stmt = $this->connection->prepare("SELECT * FROM `products` LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

}

?>