<?php
include 'src/bootstrap.php';    


is_admin($session->role); 


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}

$errors['imie']='';
$errors['nazwisko']='';
$errors['numer_telefonu']='';
$errors['login']='';

$czytelnik['imie']='';
$czytelnik['nazwisko']='';
$czytelnik['numer_telefonu']='';
$czytelnik['login']='';


$czytelnik =  $cms->getCzytelnik()->getCzytelnik($id);   
if (!$czytelnik) {   
    header("Location: nieznaleziono.php");  
    exit();                              // Page not found
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $czytelnik['imie']=$_POST['imie'];
    $czytelnik['nazwisko']=$_POST['nazwisko'];
    $czytelnik['numer_telefonu']=$_POST['numer_telefonu'];
    $czytelnik['login']=$_POST['login'];

    $arguments=$czytelnik;    

    $czytelnik =  $cms->getCzytelnik()->edytujCzytelnika($arguments,$id);
  
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edytuj czytelnika</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>


</head>
<body>
<div class="bodylogowanie">
  <br><br><br><br>
  <form action="edytujczytelnika.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data"> 
  <br><br>
  <section class="formularz">
      <div class="ramka">
        <br><br>
        <h1>Dodawanie czytelnika</h1> <br>



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
            <input type="text" name="login" id="login" value="<?= html_escape($czytelnik['login']) ?>"
                  class="form-control">
                  <span class="errors"><?= $errors['login'] ?></span>
          </div><br>
<br>
          
          <div class="loginbutton">
          <input type="submit" name="update" class="btnloguj" value="EDYTUJ CZYTELNIKA" class="btn btn-primary">
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