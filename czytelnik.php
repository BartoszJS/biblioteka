<?php
            
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}

$wypozyczenie = $cms->getWypozyczenie()->getWypozyczeniaCzytelnika($id);

$czytelnik =$cms->getCzytelnik()->getCzytelnik($id);
if (!$czytelnik) {   
    header("Location: nieznaleziono.php");  
    exit();                              // Page not found
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Strona główna</title>
    <?php include 'includes/header.php'; ?>    
    

</head>
<body>
<br><br><br><br><br><br><br><br><br><br>
<div class="oferta">
    <div class="ramka">
                    

            <?= $czytelnik['id']?>
            <?= $czytelnik['imie']?>
            <?= $czytelnik['nazwisko']?> 
            <?= $czytelnik['numer_telefonu']?>
            <?= $czytelnik['adres_email']?>
            <?php foreach($wypozyczenie as $pojedynczo) { ?> 
                <?= $pojedynczo['tytul'] ?> <br>

            <?php } ?>

                     
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>