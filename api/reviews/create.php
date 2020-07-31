<?
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/reviews.php';

$database = new Database();
$db = $database->getConnection();

$reviews = new Reviews($db);
 
$data = json_decode(file_get_contents("php://input"));
 
if (
    !empty($data->user) &&
    !empty($data->rating) &&
    !empty($data->description) &&
    !empty($data->photo)
) {

    if ( strlen($data->user) > 50 ) {
        http_response_code(400);
        die(json_encode(array("message" => "Невозможно создать отзыв. Длина имени (user) превышает 50 символов"), JSON_UNESCAPED_UNICODE));
    }

    if ( $data->rating <= 0 || $data->rating > 5 ) {
        http_response_code(400);
        die(json_encode(array("message" => "Невозможно создать отзыв. Рейтинг не может быть меньше 0 или больше 5"), JSON_UNESCAPED_UNICODE));
    }

    if ( strlen($data->description) > 1000 ) {
        http_response_code(400);
        die(json_encode(array("message" => "Невозможно создать отзыв. Описание превышает 1000 символов"), JSON_UNESCAPED_UNICODE));
    }

    if ( count($data->photo) > 3 ) {
        http_response_code(400);
        die(json_encode(array("message" => "Невозможно создать отзыв. Количество фото более 3"), JSON_UNESCAPED_UNICODE));
    }

    $reviews->user = $data->user;
    $reviews->rating = $data->rating;
    $reviews->description = $data->description;
    $reviews->photo = $data->photo;

    if($id = $reviews->create()){
        http_response_code(201);
        echo json_encode(array("id" => $id, "message" => "Отзыв был создан."), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно создать отзыв."), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать отзыв. Данные неполные."), JSON_UNESCAPED_UNICODE);
}

?>