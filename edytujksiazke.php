<?php
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}

$errors['tytul']='';
$errors['autor']='';
$errors['gatunek']='';
$errors['liczba_stron']='';

$ksiazka['tytul']='';
$ksiazka['autor']='';
$ksiazka['gatunek']='';
$ksiazka['liczba_stron']='';


$ksiazka =  $cms->getKsiazka()->getKsiazka($id);    // Get article data
if (!$ksiazka) {   
    header("Location: nieznaleziono.php");  
    exit();                              // Page not found
}



if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $ksiazka['tytul']=$_POST['tytul'];
    $ksiazka['autor']=$_POST['autor'];
    $ksiazka['gatunek']=$_POST['gatunek'];
    $ksiazka['liczba_stron']=$_POST['liczba_stron'];

  
    $arguments=$ksiazka;   

    $ksiazka=$cms->getKsiazka()->edytujKsiazke($arguments,$id);  
  
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Rejestracja</title>
    <?php include 'includes/header.php'; ?>
</head>
<body>
<div class="bodylogowanie">
  <br><br><br><br>
  <form action="edytujksiazke.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data"> 
  <br><br>
  <section class="formularz">
      <div class="ramka">
        <br><br>
        <h1>Edytuj książkę:</h1> <br>
        <?php /*
        <input type="hidden" name="okladka" id="okladka" value="<?= html_escape($ksiazka['okladka']) ?>"
                  class="form-control">
            <input type="hidden" name="dostepnosc" id="dostepnosc" value="<?= html_escape($ksiazka['dostepnosc']) ?>"
                  class="form-control">
        */ ?>
        <div class="form-group">
            <label for="title">  Tytuł: </label> <br>
            <input type="text" name="tytul" id="tytul" value="<?= html_escape($ksiazka['tytul']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['tytul'] ?></span>
          </div><br>

          <div class="form-group">
            <label for="title">  Autor: </label> <br>
            <input type="text" name="autor" id="autor" value="<?= html_escape($ksiazka['autor']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['autor'] ?></span>
          </div><br>

          <div class="form-group">
            <label for="title">  Gatunek: </label> <br>
            <input type="text" name="gatunek" id="gatunek" value="<?= html_escape($ksiazka['gatunek']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['gatunek'] ?></span>
          </div><br>

          <div class="form-group">
            <label for="title">  Liczba stron: </label> <br>
            <input type="text" name="liczba_stron" id="liczba_stron" value="<?= html_escape($ksiazka['liczba_stron']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['liczba_stron'] ?></span>
          </div><br><br>
          
          <div class="loginbutton">
          <input type="submit" name="update" class="btnwypozycz" value="EDYTUJ KSIĄŻKĘ" class="btn btn-primary">
          <br><br>
          </div>
      
        </div>
      </section>
      <br>
  </form>
</div>  
<?php include 'includes/footer.php'; ?>    
</body>
</html>