<?php


// Require composer autoload
require_once  './vendor/autoload.php';


$companyName = $_POST["companyName"];
$addText = $_POST["addText"];
$voucherInfo = $_POST["voucherInfo"];
$voucher = explode(PHP_EOL, $voucherInfo);

$myfile = $_POST["myfile"];
$design = $_POST["design"];

$generator = new Picqer\Barcode\BarcodeGeneratorHTML();


// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['allow_html_optional_endtags' => false]);
$css=
"<style>
*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.odst {
    height: 200px;
    width: 100%;
    list-style-type: none;
    margin: 1px 0;
    border: 1px solid #00000;
    display: flex;
}
.img{
    width: 700px;
    height: 200px;
    background-image: url(./img/$design.png);
}
p {
    margin: 0;
    position: absolute;
}
.companyName {
    width: 230px;
    text-align: left;
    margin: 10px 0 0 55px;
    font-size: 1.6rem;
    line-height: 1.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-weight: 900;
    text-shadow: 2px 2px 3px #c0c0c0;
}
.price {
    width: 230px;
    text-align: left;
    margin-top: 5px;
    margin-left: 55px;
    font-size: 2.3rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-weight: bold;
    text-shadow: 2px 2px 3px #c0c0c0;
}
.number {
    width: 230px;
    text-align: left;
    margin-top: 5px;
    margin-left: 55px;
    font-size: 0.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
}
.code {
    width: 230px;
    text-align: left;
    margin-top: 5px;
    margin-left: 55px;
    font-size: 0.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
}
.barcode {
    height: 30px;
    width: 150px;
    margin-top: 5px;
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
    margin-top: 5px;
    margin-left: 55px;
    font-size: 0.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
}
.addText {
    width: 230px;
    text-align: left;
    margin-top: 5px;
    margin-left: 5px;
    font-size: 0.7rem;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-style: italic;
}
</style>
";





// Write some HTML code:

$mpdf->WriteHTML("$css");
    $mpdf->WriteHTML("<ul>");  
                     
                    
                foreach ($voucher as $value) {
                                        
                    $values = preg_split('/\s+/', $value);   
                    $price = explode(',', $values[2]);
                    $price = $price[0];
                    $number = $values[0];
                    $code = $values[1];
                    $dateEnd = $values[3];
                    $barcode = str_pad( $number, 4, "0", STR_PAD_LEFT );
                    $barcode = $generator->getBarcode($barcode, $generator::TYPE_CODE_128, 3, 50);

                    $mpdf->WriteHTML("
                    <li class='odst'>
                    <div class='img'>
                    <p class='companyName'>$companyName</p>
                    <p class='price'>$price Kč</p>
                    <p class='number'>Číslo voucheru:  <strong>$number</strong></p>
                    <p class='code'>Ověřovací kód:  <strong>$code</strong></p>
                    <p class='dateEnd'>Platnost do:  $dateEnd</p>
                    <p class='addText'>$addText</p>
                    <p class='barcode'>$barcode</p>
                    </div>
                    </li>
                    ");
                    }

                    
    $mpdf->WriteHTML("</ul>");

 
 
// Output a PDF file directly to the browser
$mpdf->Output();



?>