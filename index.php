<?php
// Load the cache process
include("cache.php");

// Connect to database
// include("config.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="style.css">
    <!-- LINK CAROUSEL -->
    <link rel="stylesheet" href="glide/glide.core.min.css">
    <link rel="stylesheet" href="glide/glide.theme.min.css">
</head>

<body>
 
<?php
        /*
        Leer archivo de texto con PHP
        usando búfer */
      
        $nombreArchivo = "token.txt";
        
        $gestor = fopen($nombreArchivo, "r"); # Modo r, read
        if (!$gestor) {
            exit("Error abriendo archivo");
        }

        $lectura2 ="";
        $tamanio_bufer = 10; # bytes
        while (($lectura = fgets($gestor, $tamanio_bufer)) != false) {
            // Nota: aquí podrías concatenar en una cadena, guardarlo por ahí, etcétera
            $lectura2 = $lectura2.$lectura;
        }


        // Si el ciclo no terminó debido a un EOF (End of file) entonces
        // algo malo ocurrió
        if (!feof($gestor)) {
            exit("Error al leer");
        }
        // No olvides cerrar el gestor
        fclose($gestor);




    //  setup the request, you can also use CURLOPT_URL
    $ch = curl_init('http://api.cup2022.ir/api/v1/bydate');
    
    
    
    // POST 
    // -----------------------------------------------------------------------------------------
    $token = $lectura2;

    $data = array(
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

    if (curl_errno($ch)) echo curl_error($ch);
    else $decoded = json_decode($response, true);



    

    function getLocalTime($date)
{
    
    $timestamp = strtotime($date);
    $time = $timestamp - (8 * 60 * 60);
    $datetime = date("Y-m-d H:i", $time);
    return $datetime;
}

    // $datestr = $decoded["data"][1]["local_date"];    
   
    // echo "Hora Catar";
    // echo $datestr;

    
    // $localTime = getLocalTime( $datestr);
    // echo "Hora Panama";
    // echo $localTime;

    // // string(212) "{"status":"success","data":{"token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2Mzc5MGJhMWZkOWFhYzIyNjc1NjFmYzIiLCJpYXQiOjE2NjkwNDUyNjMsImV4cCI6MTY2OTEzMTY2M30.LlWNdZOBF91-yyN9HfjeV9ICXZZnpZCKxDXgovvhBKc"}}"

    // for ($i = 0; $i < count($decoded["data"]); $i++) :

    //     echo $decoded["data"][$i]["group"] . "\n";
    //     echo $decoded["data"][$i]["local_date"] . "\n";
    //     echo $decoded["data"][$i]["home_team_en"] . "\n";
    //     echo $decoded["data"][$i]["home_flag"] . "\n";
    //     echo $decoded["data"][$i]["away_team_en"] . "\n";
    //     echo $decoded["data"][$i]["away_flag"] . "\n";
    //     echo "<br>";
    //     echo "<br>";
    //     echo "<br>";

    // endfor;
    // var_dump($decoded["data"][2]);

    // close curl resource to free up system resources
    // curl_close($ch);



    ?>

    <div class='carousel content'>

        <div class='container__carousel'>

            <div class='glide'>

                <div class='glide__track' data-glide-el='track'>

                    <div class='glide__slides'>



                        <?php for ($i = 0; $i < count($decoded["data"]); $i++) : ?>

                            <div class='glide__slide'>
                                <div class='card__catar'>

                                    <p class='margin_catar padding_header-card header_card-catar'>
                                        FIFA - Mundial Catar 2022 - Grupo <?php echo $decoded["data"][$i]["group"] ?>
                                    </p>
                                    <p class='margin_catar border__bottom padding_header-card' style='font-size:12px;'>
                                        <?php 
                                        echo  getLocalTime($decoded["data"][$i]["local_date"]);
                                        ?>
                                    </p>

                                    <section class='padding_card-catar'>

                                        <div class='flex_card-catar padding-bottom-card' style='font-size:14px;'>
                                            <p class='item-flex_card'><?php echo $decoded['data'][$i]['home_team_en'] ?></p>
                                            <p class='item-flex_card'><?php echo $decoded['data'][$i]['away_team_en'] ?></p>
                                        </div>

                                        <div class='flex_card-catar'>

                                            <figure class='image item-flex_card'>
                                                <img class='avatar_flag' src='<?php echo $decoded['data'][$i]['home_flag'] ?>' alt=''>
                                            </figure>
                                            <p>vs</p>
                                            <figure class='image avatar_flag item-flex_card'>
                                                <img class='avatar_flag' src='<?php echo $decoded['data'][$i]['away_flag'] ?>' alt=''>
                                            </figure>
                                        </div>
                                       
                                    </section>
                                </div>
                            </div>
                        <?php endfor;
                        curl_close($ch);
                        ?>

                    </div> <!-- end glide__slides -->


                </div> <!-- end glide_tracks -->



                <!-- BOTONES DEL CAROUSEL  -->
                <div class='glide__arrows' data-glide-el='controls'>
                    <button class='carousel__anterior' data-glide-dir='<'>
                        <span class='material-symbols-outlined'>
                            navigate_before
                        </span>
                    </button>
                    <button class='carousel__siguiente' data-glide-dir='>'>
                        <span class='material-symbols-outlined'>
                            navigate_next
                        </span>
                    </button>
                </div>


            </div>

        </div>
    </div>

    </div>





    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script>
        const config = {
            type: "carousel",
            perView: 4,
            // autoplay: 10000,
            hoverpause: true,
            breakpoints: {
                1200: {
                    perView: 4
                },
                900: {
                    perView: 2
                },
                500: {
                    perView: 1
                }
            }
        };

        new Glide('.glide', config).mount();
    </script>




</body>

</html>
<?php
// Save the cache
include("cache_footer.php");
?>