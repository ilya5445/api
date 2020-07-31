<?

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/reviews.php';

$utilities = new Utilities();
$database = new Database();

$db = $database->getConnection();

$reviews = new Reviews($db);

if (isset($_GET['field'])) {
	if (in_array($_GET['field'], $sort_field))
		$reviews->field = $_GET['field'];
	else {

	    http_response_code(404);
	    echo json_encode(array("message" => "Не верный параметр сортировки. Только rating и create"), JSON_UNESCAPED_UNICODE);
	    die();

	}
}

if (isset($_GET['sort'])) {
	if (in_array($_GET['sort'], $sort))
		$reviews->sort = $_GET['sort'];
	else {

	    http_response_code(404);
	    echo json_encode(array("message" => "Не верный параметр сортировки. Только ASC и DESC"), JSON_UNESCAPED_UNICODE);
	    die();

	}
}

$stmt = $reviews->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if ($num > 0) {

    $reviews_arr = array();
    $reviews_arr["records"] = array();
    $reviews_arr["paging"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);

        $photo = $reviews->getPhoto($id, 1);

        $reviews_item = array(
            "id" => $id,
            "user" => $user,
            "rating" => $rating,
            "description" => html_entity_decode($description),
            "create" => $create,
            "photo" => $photo,
        );

        array_push($reviews_arr["records"], $reviews_item);
    }

    $total_rows = $reviews->count();
    $page_url = "{$home_url}reviews/review_list.php?";
    $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $reviews_arr["paging"] = $paging;

    http_response_code(200);
    echo json_encode($reviews_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Отзывы не найдены."), JSON_UNESCAPED_UNICODE);
}