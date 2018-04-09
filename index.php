<?php
$appid = '933b7b9a84e3429a4660a9cb74e947d9';
$id_default = '524894';
if (isset($_REQUEST['city'])) {
    $city_id = $_REQUEST['city'];
};
if (empty($city_id)) {
    $city_id = $id_default;
};
$api = file_get_contents("http://api.openweathermap.org/data/2.5/weather?id=" . $city_id . "&appid=" . $appid);
$city_list_file = file_get_contents("city.list.json");
$decode_api = json_decode($api, true);
$decode_city = json_decode($city_list_file, true);

$city_name = $decode_api['name'];

$weather_desc = $decode_api['weather'][0]['description'];
$pressure = $decode_api['main']['pressure'];
$humidity = $decode_api['main']['humidity'];
$coord_lon = $decode_api['coord']['lon'];
$coord_lat = $decode_api['coord']['lat'];

$temp = $decode_api['main']['temp'];

$temp_celsius = $temp - 273;
$temp_celsius = round($temp_celsius, 1). ' C&deg';

if ($temp_celsius > 0) {
    $temp_celsius = str_pad($temp_celsius, strlen($temp_celsius)+1, "+", STR_PAD_LEFT);
}

$icon = $decode_api['weather'][0]['icon'];
$icon_url = 'http://openweathermap.org/img/w/' . $icon . '.png';
?>
