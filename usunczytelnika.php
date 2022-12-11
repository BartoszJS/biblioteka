<?php
            
include 'src/bootstrap.php';    


is_admin($session->role); 
            
            
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}


$czytelnik =  $cms->getCzytelnik()->getCzytelnik($id);    // Get article data
if (!$czytelnik) {   
    header("Location: nieznaleziono.php");  
    exit();                              // Page not found
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {


$cms->getWypozyczenie()->usunWypozyczeniaCzytelnika($id);
$czytelnik =$cms->getCzytelnik()->usunCzytelnika($id);

if (!$czytelnik) {   
    header("Location: index.php");  
    exit();                              // Page not found
}



}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="photos/favicon.ico" type="image/x-icon"/>
    <title>Usuń czytelnika</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>


    </head>
<body>



    <form action="usunczytelnika.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data"> 
    <br><br><br><br><br><br>
      <section class="formularzusun">
      <div class="wypozycz">
      <div class="ramka">
        
        <h1>Usunąć czytelnika(niezalecane)?</h1> 
        <h1>Zostaną równiez usuniete wszystkie wypożyczenia czytelnika</h1> <br>
        <h1>
            <?= $czytelnik['id']?>
            <?= $czytelnik['imie']?>
            <?= $czytelnik['nazwisko']?> 
            <?= $czytelnik['numer_telefonu']?>
            <?= $czytelnik['login']?><br><br>
        </h1>
       <div class="formularz">
          
          </div><div class="loginbuttons">
          <input type="submit" name="update" class="btnprzywroc" value="TAK "> 
                    <a href="czytelnicy.php" class="btnprzywroc2">ANULUJ</a>   
          <br><br>
          </div>
        </div>
      </section>
      <br>
  </form>
    
    </head>
    <body>
    
