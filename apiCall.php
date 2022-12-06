<?php
function initCurl(string $apiUrl, string $token)
{
  $header = [
    "cache-control: no-cache",
    "Content-Type: application/json"
  ];

  if ($token != "") {
    array_push($header, "Authorization: Bearer {$token}");
  }

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_SSL_VERIFYPEER => false, //test developmen kalo production hapus
    CURLOPT_SSL_VERIFYHOST => false, //test developmen kalo production hapus
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2TLS,
    CURLOPT_HTTPHEADER => $header
  ));

  return $curl;
}

function execCurl($curl)
{
  if ($curl === false) {
    return false;
  }

  $response = curl_exec($curl);
  $responseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
  curl_close($curl);

  if ($responseCode != 200 && $responseCode != 201 && $responseCode != 204) {
    return json_decode('{"success": false, "result": ' . $responseCode . '}');
  }

  return json_decode('{"success": true, "result": ' . $response . '}');
}

function callGetApi(string $apiUrl, string $token)
{
  $curl = initCurl($apiUrl, $token);
  return execCurl($curl);
}

function callPostApi(string $apiUrl, string $token, $postData)
{
  $curl = initCurl($apiUrl, $token);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
  return execCurl($curl);
}
