<?php

$address="Carrera 49 N 7 Sur – 50";
getCoordinates($address);

function getCoordinates($address){
    $address = urlencode($address);
    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
    $response = file_get_contents($url);
    $json = json_decode($response,true);
 
    $lat = $json['results'][0]['geometry']['location']['lat'];
    $lng = $json['results'][0]['geometry']['location']['lng'];
 
    return array($lat, $lng);
}
 
 
$coords = getCoordinates("Passeig de Gracia, Barcelona, Barcelona");
print_r($coords);
?>