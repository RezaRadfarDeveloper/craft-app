<?php
$name = $_GET["searchtext"];
$url = "https://developers.zomato.com/api/v2.1/search?entity_id=259&entity_type=city&q=Melbourne&count=20";
// user-key is based on the key registered in zomato API page ...
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'user-key: 419a4c531b337d0e0d082a84065726e2'
  ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$output = curl_exec($ch);
$curl_error = curl_error($ch);
curl_close($ch);

//

$array = json_decode($output, true);
for ($i=0 ; $i<count($array['restaurants']) ; $i++) {
    $restaurantList .=  $array['restaurants'][$i]['restaurant']['name'];
}

foreach ($restaurantList as $restaurant) {
   if (strpos(strtolower($restaurant),strtolower($name))!== false && strpos(strtolower($restaurant),strtolower($name)) === 0) {
    $matchedList []= $restaurant;
   }
}
echo $name;
// echo $restaurantList;
print_r($curl_error);
