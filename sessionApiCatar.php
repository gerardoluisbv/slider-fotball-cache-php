

    <?php

// LOGIN API /////////////////////////////////////////////////////

$sh = curl_init('http://api.cup2022.ir/api/v1/user/login');

$datalog = array(
    "email" => "pibliartpa@gmail.com",
    "password" =>  "pibliartpa"
);

$login = json_encode($datalog);

//echo $payload;

//Set your auth headers
curl_setopt($sh, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));



curl_setopt($sh, CURLOPT_POST, true);
curl_setopt($sh, CURLOPT_POSTFIELDS, $login);
curl_setopt($sh, CURLOPT_RETURNTRANSFER, true);


$resp = curl_exec($sh);

if (curl_errno($sh)) echo curl_error($sh);
else $respdec = json_decode($resp, true);


echo "<br>";
var_dump("respdec[data][token]");
echo "<br>";
var_dump($respdec["data"]["token"]);
echo "<br>";
// var_dump($respdec["data"]["token"]);

    $nombreArchivo = "token.txt";
    $archivo = fopen($nombreArchivo, "w");
    fwrite($archivo, $respdec["data"]["token"]);
    fclose($archivo);
?>