<?
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/reviews.php';

$database = new Database();
$db = $database->getConnection();

$reviews = new Reviews($db);

$keywords = isset($_GET["s"]) ? $_GET["s"] : "";
$fields = isset($_GET["fields"]) ? $_GET["fields"] : "";

if ($keywords == "") {
    http_response_code(404);
    die(json_encode(array("message" => "Не указаны параметры поиска (s)."), JSON_UNESCAPED_UNICODE));
}

$arfields = array();

$photoCount = 1;

if (isset($fields)) {
    $expFields = explode(',', $fields);
    if (!empty($expFields) && $fields != '') {
        for ($i = 0; $i < count($expFields); $i++) {
            if (!in_array($expFields[$i], $search_fields)) {
                http_response_code(404);
                die(json_encode(array("message" => "Параметр " . $expFields[$i] . " не найден. Параметры: " . implode(', ', $search_fields)), JSON_UNESCAPED_UNICODE));
            } else if ($expFields[$i] == 'allphoto') {
                $photoCount = 3;
            }
        }
    }
}

$stmt = $reviews->search($keywords);
$num = $stmt->rowCount();

if ($num > 0) {

    $reviews_arr = array();
    $reviews_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $photo = $reviews->getPhoto($id, $photoCount);

        $reviews_item = array(
            "id" => $id,
            "user" => $user,
            "description" => in_array('description', $expFields) ? html_entity_decode($description) : null,
            "rating" => $rating,
            "photo" => $photo,
        );

        $reviews_item = array_filter($reviews_item, function($element) {
            return !empty($element);
        });

        array_push($reviews_arr["records"], $reviews_item);
    }

    http_response_code(200);
    echo json_encode($reviews_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Отзыв не найдены."), JSON_UNESCAPED_UNICODE);
}

?>