<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');
$category = new Category($db);

$result = $category->read();

$num = $result->rowCount();
if($num > 0) {
    $post_array = array();
    $post_array['data'] =array() ;
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'id' =>$id,
            'name' =>$title,
            'created_at' =>$created_at
        );
        array_push($post_array['data'],$post_item);
    }
    echo json_encode($post_array );
} else {
    echo json_encode(array('message' =>'No categories found'));
}