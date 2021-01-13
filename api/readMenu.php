<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once('../core/initialize.php');

$menu = new Menu($db);
$result = $menu->readMenu();
$num = $result->rowCount();
if($num > 0) {
    $menu_array = array();
    $menu_array["data"] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $menu_item = array(
          'id' =>$menu_id,
          'href'=>$menu_href,
          'text' =>html_entity_decode($menu_text)
        );
        array_push($menu_array['data'],$menu_item);

    }
    echo json_encode($menu_array);
} else {
    echo json_encode(array('message' =>'No menu found'));

}
