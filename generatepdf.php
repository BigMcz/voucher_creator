<?php


// Require composer autoload
require_once './vendor/autoload.php';
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
        margin-top:0;
        border: 1px solid #d6d6d6;
        box-shadow: 0px 10px 15px -3px rgba(0,0,0,0.2);
        padding: 0;
    }
    li {
        height: 160px;
        width: 100%;
        border: 1px solid #d6d6d6;
        list-style-type: none;
        list-style-position: inside;
        margin: 0;
    }
</style>
";




// Write some HTML code:



$mpdf->WriteHTML("$css
    
<div class='A4'>
<ul>
    <li>
        
    </li>
</ul>

</div>
");

// Output a PDF file directly to the browser
$mpdf->Output();



?>