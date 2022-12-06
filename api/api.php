<?php
require_once("apiCall.php");

global $settingData;

$fpage = isset($_POST['fpage']) ? intval($_POST['fpage']) : 1;
$frows = isset($_POST['frows']) ? intval($_POST['frows']) : 10;
$fsearch = isset($_POST['fsearch']) ? strval($_POST['fsearch']) : '';
$forder = isset($_POST['forder']) ? strval($_POST['forder']) : 'id';
$fsort = isset($_POST['fsort']) ? strval($_POST['fsort']) : 'asc';
$fmodul = isset($_POST['fmodul']) ? strval($_POST['fmodul']) : '';
$ftots = isset($_POST['ftots']) ? strval($_POST['ftots']) : '';
$token = $_COOKIE['accesstoken'];
$foffset = ($fpage - 1) * $frows;
$flsearch = isset($_POST['flsearch']) ? strval($_POST['flsearch']) : '';
$split_flsearch = explode(",", $flsearch);

if ($fsearch) {
  $fsearch = rawurlencode($fsearch);
  $all_search = '%24filter=contains%28';

  for ($x = 1; $x <= $ftots; $x++) {
    if ($x != $ftots) {
      $all_search .= $split_flsearch[$x - 1] . '%2C%27' . $fsearch . '%27%29%20or%20contains%28';
    }
    else {
      $all_search .= $split_flsearch[$x - 1] . '%2C%27' . $fsearch . '%27%29&';
    }
  }


}
else {
  $all_search = '';
}

$url_get_data = "{$settingData->apiServerUrl}/api/v0.1/$fmodul?$all_search%24orderby=$forder%20$fsort&%24top=$frows&%24skip=$foffset&%24count=true";

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url_get_data,
  CURLOPT_SSL_VERIFYPEER => false, //test developmen kalo production hapus
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$response = json_decode($response, true);

$result["rows"] = $response['value'];
$result["total"] = $response['@odata.count'];
$result["foffset"] = $foffset;
echo json_encode($result);
?>