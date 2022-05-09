<?php
            
include 'src/bootstrap.php';    


is_admin($session->role); 



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Kontakt</title>
    <?php include 'includes/header.php'; ?>    
    

</head>
<body>
<br><br><br><br><br><br><br>
<div class="wypozycz">
    <div class="ramka">
            
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