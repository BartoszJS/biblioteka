<?php
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 

$upload_path = dirname(__FILE__).DIRECTORY_SEPARATOR. 'uploads'.DIRECTORY_SEPARATOR;

$errors['tytul']='';
$errors['autor']='';
$errors['okladka']='';
$errors['gatunek']='';
$errors['liczba_stron']='';
$id=[];



$ksiazka['tytul']='';
$ksiazka['autor']='';
$ksiazka['okladka']='';
$ksiazka['gatunek']='';
$ksiazka['liczba_stron']='';





$last = $cms->getKsiazka()->getLastId();
$last=$last+1;




if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $ksiazka['tytul']=$_POST['tytul'];
    $ksiazka['autor']=$_POST['autor'];
    $ksiazka['gatunek']=$_POST['gatunek'];
    $ksiazka['liczba_stron']=$_POST['liczba_stron'];

    $temp = $_FILES['okladka']['tmp_name'];
    $path = 'uploads/' . $_FILES['okladka']['name'];
    $moved = move_uploaded_file($temp, $path);
    $ksiazka['okladka']    =$_FILES['okladka']['name'];
  
    $arguments=$ksiazka;   

    $cms->getKsiazka()->dodajKsiazke($arguments,$last);  
  
    

  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dodaj ksiażkę</title>
    <?php include 'includes/header.php'; ?>
</head>
<body>
<div class="bodylogowanie">
  <br><br><br><br>
  <form action="dodajksiazke.php" method="POST" enctype="multipart/form-data"> 
  <br><br>
      <section class="formularz">
      <div class="ramka">
        <br>
        <h1>Dodawanie książki:</h1> <br>
        
        <p>Automatycznie przypisane id: <?=$last?></p> <br>
        
        <div class="form-group">
        <label for="okladka">Dodaj okładkę:</label>
            
              <input type="file" name="okladka" class="form-control-file" id="okladka"
              accept="okladka/jpeg,okladka/jpg,okladka/png"><br>
              <span class="errors"><?= $errors['okladka'] ?></span>
            </div><br>


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
          <input type="submit" name="update" class="btnwypozycz" value="DODAJ KSIĄŻKĘ" class="btn btn-primary">
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