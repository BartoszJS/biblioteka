<?php
            
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}

$sql="SELECT id,imie,nazwisko,numer_telefonu,adres_email
    FROM czytelnik
    where id=:id;";

$czytelnik = pdo($pdo, $sql, [$id])->fetch();    // Get article data
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

                     
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>