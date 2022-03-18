<?php


// Require composer autoload
require_once  './vendor/autoload.php';

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();

$companyName = $_POST["companyName"];
$addText = $_POST["addText"];
$voucherInfo = $_POST["voucherInfo"];
$voucher = explode(PHP_EOL, $voucherInfo);

$myfile = $_POST["myfile"];
$design = $_POST["design"];


// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$css=
"<style>
*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.A4 {
    width: 700px;
    margin: auto;
    margin-top: 2.5rem; 
    padding: 0;
}
li {
    height: 200px;
    width: 100%;
    list-style-type: none;
    margin: 1px 0;
    display: flex;
}
.img{
    z-index: -5000;
    position: relative;
    width: 100%;
    height: 100%;
}
p {
    position: absolute;
    margin: 0;
}
.companyName {
    width: 230px;
    text-align: left;
    margin-top: 10px;
    margin-left: 55px;
    font-size: 1.6rem;
    line-height: 1.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-weight: 900;
    text-shadow: 2px 2px 3px #c0c0c0;
}
.price {
    width: 230px;
    text-align: left;
    margin-top: 85px;
    margin-left: 55px;
    font-size: 2.3rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-weight: 700;
    text-shadow: 2px 2px 3px #c0c0c0;
}
.number {
    width: 230px;
    text-align: left;
    margin-top: 150px;
    margin-left: 55px;
    font-size: 0.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
}
.code {
    width: 230px;
    text-align: left;
    margin-top: 160px;
    margin-left: 55px;
    font-size: 0.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
}
.barcode {
    position: absolute;
    height: 30px;
    width: 150px;
    margin-top: 85px;
    margin-left: -58px;
    font-size: 1rem;
    background: white;
    padding: 5px 5px 0 5px;
    border-radius: 3px;
    transform: rotate(90deg);
}
.dateEnd {
    width: 230px;
    text-align: left;
    margin-top: 170px;
    margin-left: 55px;
    font-size: 0.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
}
.addText {
    width: 230px;
    text-align: left;
    margin-top: 186px;
    margin-left: 5px;
    font-size: 0.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-style: italic;
}
</style>
";




// Write some HTML code:



$mpdf->WriteHTML("$css");   
$mpdf->WriteHTML("<div class='A4'>");
    $mpdf->WriteHTML("<ul>");       

                foreach ($voucher as $value) {
                                        
                    $values = preg_split('/\s+/', $value);   
                    $price = explode(',', $values[2]);
                    $price = $price[0];
                    $number = $values[0];
                    $code = $values[1];
                    $dateEnd = $values[3];
                    $barcode = str_pad( $number, 4, "0", STR_PAD_LEFT );

                    $mpdf->WriteHTML("<li>");
                    $mpdf->WriteHTML("<p class='companyName'>$companyName</p>");
                    $mpdf->WriteHTML("<p class='price'>$price Kč</p>");
                    $mpdf->WriteHTML("<p class='number'>Číslo voucheru:  <strong>$number</strong></p>");
                    $mpdf->WriteHTML("<p class='code'>Ověřovací kód:  <strong>$code</strong></p>");
                   /*$mpdf->WriteHTML("<img class='barcode' src='data:image/png;base64,' . base64_encode($generator->getBarcode( $barcode , $generator::TYPE_CODE_128)) . ''>");*/
                    $mpdf->WriteHTML("<p class='dateEnd'>Platnost do:  $dateEnd</p>");
                    $mpdf->WriteHTML("<p class='addText'>$addText</p>");
                    $mpdf->WriteHTML("<img class='img' src='./img/$design .png' width='700' height='200'>");

                    
                    $mpdf->WriteHTML("</li>");
                    }

    $mpdf->WriteHTML("</ul>");
$mpdf->WriteHTML("</div>");

// Output a PDF file directly to the browser
$mpdf->Output();



?>