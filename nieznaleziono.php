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
    <title>Nieznaleziono</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>



</head>
<body>
<br><br><br><br><br><br><br>
<div class="ksiazka">
    <div class="ramka">
            <h1>Nieznaleziono strony</h1>
            <h3>Powrót do strony głownej: <a href="index.php">strony głównej</a></h3>

                     
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>