<?php
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 


is_admin($session->role); 
            

if($_SERVER['REQUEST_METHOD'] == 'POST') {
               
        $idKsiazki=$_POST['IdKsiazki'];
        $id=$_POST['ID'];
        $cms->getKsiazka()->updateNiedostepnosc($idKsiazki);    
        $cms->getWypozyczenie()->updateZakonczona($id);    

                
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Wypożycz</title>
    <?php include 'includes/header.php'; ?>
</head>
<body>
<br><br><br><br><br><br><br>
<div class="wypozycz">
    <div class="ramka">
            
    <h2>Pomyślnie przywrócono</h2> <br>

    <h3>Powrót do strony głownej <a href="index.php">strony głównej</a></h3>
        
    
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>