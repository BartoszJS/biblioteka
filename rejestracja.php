<?php
include 'src/bootstrap.php';    



$errors['imie']='';
$errors['nazwisko']='';
$errors['numer_telefonu']='';
$errors['login']='';
$errors['haslo']='';

$czytelnik['imie']='';
$czytelnik['nazwisko']='';
$czytelnik['numer_telefonu']='';
$czytelnik['login']='';
$czytelnik['haslo']='';


$last = $cms->getCzytelnik()->getLastId();
$last=$last+1;



if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $czytelnik['imie']=$_POST['imie'];
    $czytelnik['nazwisko']=$_POST['nazwisko'];
    $czytelnik['numer_telefonu']=$_POST['numer_telefonu'];
    $czytelnik['login']=$_POST['login'];
    $czytelnik['haslo']=$_POST['haslo'];

    $errors['imie']  = is_text($czytelnik['imie'], 1, 40)
    ? '' : 'Imie musi miec od 1-40 znaków';
$errors['nazwisko']  = is_text($czytelnik['nazwisko'], 1, 40)
    ? '' : 'Nazwisko musi miec od 1-40 znaków';
$errors['numer_telefonu']  = is_text($czytelnik['numer_telefonu'], 6, 15)
    ? '' : 'Telefon musi miec od 6-15 znaków';
$errors['login']  = is_text($czytelnik['login'], 6, 30)
    ? '' : 'Email moze miec od 6-30 znaków';
$errors['haslo']  = is_text($czytelnik['haslo'], 1, 20)
    ? '' : 'Hasło musi miec od 1-20 znaków';

    

$invalid = implode($errors);






   
    // $arguments=$czytelnik;   

    // $cms->getCzytelnik()->dodajCzytelnika($arguments,$last); 

       
if (!$invalid) {                                  
      $result = $cms->getMember()->create($czytelnik);                                            
      if ($result === false) {                             // If result is false
        $errors['login'] = 'Email jest zajety';
      } else {                                             // Otherwise send to login
          redirect('../logowanie.php'); 
      }
    } else {
      $errors['login'] = 'Email jest zajety';
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
    <title>Rejestracja</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>


</head>
<body>
<div class="bodylogowanie">
  <br><br><br><br>
  <form action="rejestracja.php" method="POST" enctype="multipart/form-data"> 
  <br><br>
      <section class="formularz">
      <div class="ramka">
        <br><br>
        <h1>Rejestracja</h1> <br> 
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
            <label for="title">  Adres e-mail: </label> <br>
            <input type="text" name="login" id="login" value="<?= html_escape($czytelnik['login']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['login'] ?></span>
          </div>
          
          
          <br>
          <div class="form-group">
            <label for="title">  Haslo: </label> <br>
            <input type="password" name="haslo" id="haslo" value="<?= html_escape($czytelnik['haslo']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['haslo'] ?></span>
          </div>
    <br>
          <div class="form-group">
            <label for="title">  Numer telefonu: </label> <br>
            <input type="text" name="numer_telefonu" id="numer_telefonu" value="<?= html_escape($czytelnik['numer_telefonu']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['numer_telefonu'] ?></span>
          </div><br>


      <p>Masz już konto? <a href="logowanie.php" >Zaloguj się </a></p>
         
<br>

          
          <div class="loginbutton">
          <input type="submit" name="update" class="btnzalogujsie" value="ZAJERESTRUJ" class="btn btn-primary">
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