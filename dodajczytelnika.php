<?php
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 


$errors['imie']='';
$errors['nazwisko']='';
$errors['numer_telefonu']='';
$errors['adres_email']='';

$czytelnik['imie']='';
$czytelnik['nazwisko']='';
$czytelnik['numer_telefonu']='';
$czytelnik['adres_email']='';


$last = $cms->getCzytelnik()->getLastId();
$last=$last+1;



if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $czytelnik['imie']=$_POST['imie'];
    $czytelnik['nazwisko']=$_POST['nazwisko'];
    $czytelnik['numer_telefonu']=$_POST['numer_telefonu'];
    $czytelnik['adres_email']=$_POST['adres_email'];
   
    $arguments=$czytelnik;   

    $cms->getCzytelnik()->dodajCzytelnika($arguments,$last); 
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dodaj czytelnika</title>
    <?php include 'includes/header.php'; ?>
</head>
<body>
<div class="bodylogowanie">
  <br><br><br><br>
  <form action="dodajczytelnika.php" method="POST" enctype="multipart/form-data"> 
  <br><br>
      <section class="formularz">
      <div class="ramka">
        <br><br>
        <h1>Dodawanie czytelnika</h1> <br> 
        <p>Automatycznie przypisane id: <?=$last?></p> <br>


          <div class="form-group">
            <label for="title">  Imie: </label> <br>
            <input type="text" name="imie" id="imie" value="<?= html_escape($czytelnik['imie']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['imie'] ?></span>
          </div><br>

          <div class="form-group">
            <label for="title">  Nazwisko: </label> <br>
            <input type="text" name="nazwisko" id="nazwisko" value="<?= html_escape($czytelnik['nazwisko']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['nazwisko'] ?></span>
          </div><br>

          <div class="form-group">
            <label for="title">  Numer telefonu: </label> <br>
            <input type="text" name="numer_telefonu" id="numer_telefonu" value="<?= html_escape($czytelnik['numer_telefonu']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['numer_telefonu'] ?></span>
          </div><br>

          <div class="form-group">
            <label for="title">  Adres e-mail: </label> <br>
            <input type="text" name="adres_email" id="adres_email" value="<?= html_escape($czytelnik['adres_email']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['adres_email'] ?></span>
          </div><br>
<br>
          
          <div class="loginbutton">
          <input type="submit" name="update" class="btnloguj" value="DODAJ CZYTELNIKA" class="btn btn-primary">
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