<?php
                         // Import Validate class
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';

$errors['login']    ='';
$errors['haslo']    ='';
$errors['warning'] ='';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Logowanie</title>
 
</head>
<body >
<div class="body">


<form action="logowanie.php" method="POST" enctype="multipart/form-data"> 
<br><br>
    <section class="formularz">
    <div class="ramka">
      <br>
      <h1>Logowanie</h1> 
<br>

<?php if ($errors['warning']) { ?>
        <div class="error"><?= $errors['warning'] ?></div>
      <?php } ?>

        <div class="form-group">
          <label for="title">  Login: </label> <br>
          <input type="text" name="login" id="login" value=""
                 class="form-control">
                 <span class="errors"><?= $errors['login'] ?></span>
        </div><br>

        <div class="form-group">
          <label for="title">  Haslo: </label> <br>
          <input type="password" name="haslo" id="haslo" value=""
                 class="form-control">
                 <span class="errors"><?= $errors['haslo'] ?></span>
        </div><br><br>

        <div class="loginbutton">
        <input type="submit" name="update" class="btndodaj" value="ZALOGUJ SIĘ" class="btn btn-primary">
        <br><br>
        </div>
        <br>

        

        <br>
     
      </div>
    </section>
    <br>
</form>
<br><br><br><br> <br>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>