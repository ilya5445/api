<?

/* ТЕСТОВАЯ ОТПРАВКА */
die();

$url = "http://testapi/api/reviews/create.php";

$fields = array (
    "user" => "kolya",
    "rating" => "5",
    "description" => "Описание отзыва",
    "photo" => array(
    	'testPhoto1',
    	'testPhoto2',
    	'testPhoto3',
    )
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$output = curl_exec($ch);
curl_close($ch);
echo "<pre>";print_r($output);echo "</pre>";