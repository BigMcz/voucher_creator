<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABX Harsys voucher generator</title>

    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<header>
    <h1 class="nadpis">Voucher generátor PDF</h1>
</header>
<article class="formular">
    <p class="formTitle">Vyplňte všechny údaje</p>
    
    <form action="pdf.php" method="POST"> 
        <label for="companyName">Název podniku</label>
        <input type="text" id="companyName" name="companyName" placeholder="Název podniku..">

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name..">

        <label for="voucherInfo">Vyplňte vouchery ve formátu:  číslo;kod;hodnota;platnost</label>
        <textarea id="voucherInfo" name="voucherInfo" rows="4" cols="1"></textarea>

        <label for="design">Country</label>
        <select id="design" name="design">
            <option value="Design1">Design1</option>
            <option value="Design2">Design2</option>
            <option value="Design3">Design3</option>
    </select>
  
    <input type="submit" value="Submit">
  </form>

</article>

</body>
</html>