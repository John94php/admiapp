<?php


class Menu
{
private $conn;
private $table = "menu";
public $menu_id;
public $menu_href;
public $menu_text;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readMenu() {
        $query = 'SELECT * FROM '.$this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
 }
}