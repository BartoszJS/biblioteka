<?php
            
include 'src/bootstrap.php';    



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="photos/favicon.ico" type="image/x-icon"/>
    <title>Kontakt</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>


</head>
<body>
<br><br><br><br><br><br><br>
<div class="wypozycz">
    <div class="ramkaaa">
            
    <h1>Kontakt</h1>
            <p>Dane firmy: </p>
            <p>BIBRARY</p>
            <p>99-999 Warszawa</p>
            <p>ul. Porcelanowa 39a</p>
            <br>
            <h1>Dział obsługi klienta:</h1>
            <p>e-mail: eloelo@car.pl</p>
            <p>telefon: 677-777-777</p>
    
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>