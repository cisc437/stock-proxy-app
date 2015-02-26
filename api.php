<?php
//This script demonstrates several things:
//1) an API need not be complicated, a one of file can do the job IF you have 
//   a very limited scope for the project.  Extending this would not be pleasant

//2) Proxy requests: unlike the BGG app, this script will hit the 3rd party in 
//   real time.  I'm using curl which is a standard way to make programmatic 
//   http requests.

//This is a faster way to get URL parameters, sorry I didn't think of it sooner
$ticker = $_GET["ticker"];

//If you don't use my API correctly you get this message
if (!isset($_GET["ticker"])){
    die("usage: ?ticker=XXXX");
}

//these lines took some time to make.  I went to the YQL console made a command
//that I liked and looked at the URL that was displayed in a box at the bottom 
//of the screen.  The part that was missing was env=blahblahblah.  That is 
//what told YQL where to find the yahoo.finance.quote table.

//YQL is mostly just SQL with extra url parameters.
$yql_base_url = "https://query.yahooapis.com/v1/public/yql";
$yql_query = "select * from yahoo.finance.quote where symbol=\"".$ticker."\"";
$the_url = $yql_base_url."?q=".urlencode($yql_query)."&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";

//Please NOTE that when running SQL commands the above lines would be open to 
//SQL injection.  We are sending our commands through a set of url paramters, 
//so the task of fighting the injection is on Yahoo in this one case only.

//These lines are not my own work, they are google searched using terms like 
// PHP Curl GET Example
$curl_handler = curl_init();

curl_setopt($curl_handler, CURLOPT_URL, $the_url);
curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($curl_handler);

//This is mine, I "decode" the JSON object into a PHP object and return to my
//clients the stock quote.  This is not checking even checking for error.
//This whole thing is quick and dirty to get the job done.
$robj = json_decode($output);
print_r(json_encode($robj->query->results->quote));

//close curl out.
curl_close($curl_handler);

?>
