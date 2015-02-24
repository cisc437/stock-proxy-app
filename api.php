<?php

$sample_ticker = $_GET["ticker"];

if (!isset($_GET["ticker"])){
    die("usage: ?ticker=XXXX");
}

$yql_base_url = "https://query.yahooapis.com/v1/public/yql";
$yql_query = "select * from yahoo.finance.quote where symbol=\"".$sample_ticker."\"";
$the_url = $yql_base_url."?q=".urlencode($yql_query)."&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";

$curl_handler = curl_init();

curl_setopt($curl_handler, CURLOPT_URL, $the_url);
curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($curl_handler);
$robj = json_decode($output);

print_r(json_encode($robj->query->results->quote));

curl_close($curl_handler);

?>
