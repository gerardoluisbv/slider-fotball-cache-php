<?php
// Load the cache process
include("cache.php");

// Connect to database
// include("config.php");

?>
<html>
<body>

<ul>

    <?php
    
    $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2Mzc5MGJhMWZkOWFhYzIyNjc1NjFmYzIiLCJpYXQiOjE2NjkwNDQwMzUsImV4cCI6MTY2OTEzMDQzNX0.4XvB3QD5Eu0y3-uaHMPHUaB21jJ3FsfHwPQXIC3pWKI";
    //  setup the request, you can also use CURLOPT_URL
    $ch = curl_init('http://api.cup2022.ir/api/v1/bydate');



// POST 
// -----------------------------------------------------------------------------------------

$data = array (
    'date' => '11/22/2022'
);

$payload = json_encode($data);

//echo $payload;

//Set your auth headers
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Authorization: Bearer ' . $token
));

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$response = curl_exec($ch);

if(curl_errno($ch)) echo curl_error($ch);
else $decoded = json_decode($response, true);

for($i=0; $i<count($decoded["data"]);$i++):
   
    echo $decoded["data"][$i]["group"]."\n";
    echo $decoded["data"][$i]["local_date"]."\n";
    echo $decoded["data"][$i]["home_team_en"]."\n";
    echo $decoded["data"][$i]["home_flag"]."\n";
    echo $decoded["data"][$i]["away_team_en"]."\n";
    echo $decoded["data"][$i]["away_flag"]."\n";
    echo "<br>";
    echo "<br>";
    echo "<br>";
endfor;
// var_dump($decoded["data"][2]);

// close curl resource to free up system resources
curl_close($ch);

// -----------------------------------------------------------------------------------------



// GET
// -----------------------------------------------------------------------------------------
// // Returns the data/output as a string instead of raw data
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// //Set your auth headers
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //    'Content-Type: application/json',
//    'Authorization: Bearer ' . $token
//    ));

// // get stringified data/output. See CURLOPT_RETURNTRANSFER
// $data = curl_exec($ch);

// // get info about the request
// $info = curl_getinfo($ch);

// var_dump($data);

// // close curl resource to free up system resources
// curl_close($ch);


// TEST WITH API FREE

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://reqres.in/api/users?page=2');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


// $response = curl_exec($ch);

// if(curl_error($ch)) echo curl_error($ch);
// else $decoded = json_decode($response, true);

// var_dump($decoded);

// curl_close($ch);



?>

</ul>
</body>
</html>
<?php
// Save the cache
include("cache_footer.php");
?>