<?php
            
include 'src/bootstrap.php';    


is_admin($session->role); 
            

if($_SERVER['REQUEST_METHOD'] == 'POST') {

                
                $rent['IdPracownika']=$_POST['IdPracownika'];
                $rent['IdCzytelnika']=$_POST['IdCzytelnika'];
                $rent['IdKsiazki']=$_POST['IdKsiazki'];
                $rent['Data_wypozyczenia']=$_POST['Data_wypozyczenia'];
                $rent['Czas']=$_POST['Czas'];
                $rent['Do']=$_POST['Do'];
                $rent['zakonczona']=$_POST['zakonczona'];
                $id=$_POST['IdKsiazki'];
                $arguments=$rent;

                $cms->getKsiazka()->updateDostepnosc($id);
                $ksiazki = $cms->getWypozyczenie()->insertWypozyczenie($arguments);  
                
                
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
    <div class="ramku">
            
    <h2>Pomyślnie wypożyczono</h2> <br>

    <h3>Powrót do strony głownej <a href="index.php">strony głównej</a></h3>
        
    
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>