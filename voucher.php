<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test šablony</title>
    <link rel="stylesheet" href="./css/voucher.css">
</head>
<body>
    <?php

    // Require composer autoload
    require './vendor/autoload.php';

    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();

    $companyName = $_POST["companyName"];
    $addText = $_POST["addText"];
    $voucherInfo = $_POST["voucherInfo"];
    $voucher = explode(PHP_EOL, $voucherInfo);
    
    $myfile = $_POST["myfile"];
    $design = $_POST["design"];


  /*  
    foreach ($voucher as $value) {
        echo "<br>";
        $values = preg_split('/\s+/', $value);

        echo $values[0];
        echo "<br>";
        echo $values[1];
        echo "<br>";
        echo $values[2];
        echo "<br>";
        echo $values[3];
        echo "<br>";
        
    }
   

    echo '<pre>'; 
    print_r($voucherInfo); 
    echo '</pre>';
    */
    ?>



        <div class="A4">
            <ul>
            <?php
                foreach ($voucher as $value) {
                    echo '<li>';
                    
                    $values = preg_split('/\s+/', $value);   
                    $price = explode(',', $values[2]);
                    $price = $price[0];
                    $number = $values[0];
                    $code = $values[1];
                    $dateEnd = $values[3];
                    $barcode = str_pad( $number, 4, "0", STR_PAD_LEFT );

                    echo '<p class="companyName">'.$companyName.'</p>';
                    echo '<p class="price">'.$price.' Kč</p>';
                    echo '<p class="number">Číslo voucheru:  <strong>'.$number.'</strong></p>';
                    echo '<p class="code">Ověřovací kód:  <strong>'.$code.'</strong></p>';
                    echo '<img class="barcode" src="data:image/png;base64,' . base64_encode($generator->getBarcode( $barcode , $generator::TYPE_CODE_128)) . '">';
                    echo '<p class="dateEnd">Platnost do:  '.$dateEnd.'</p>';
                    echo '<p class="addText">'.$addText.'</p>';
                    echo '<img class="img" src="./img/'.$design.'.png" width="700" height="200">';

                    
                    echo "</li>";
                    }
            ?>
            </ul>

        </div>
</body>
</html>