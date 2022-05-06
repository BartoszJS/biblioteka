<?php
                         // Import Validate class
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 

$errors['login']    ='';
$errors['haslo']    ='';
$errors['warning'] ='';

$login='';


$member['login']    ='';
$member['haslo']    ='';


$success = $_GET['success'] ?? null;

if($_SERVER['REQUEST_METHOD']=='POST'){
  
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];


    // $errors['haslo']  = is_text($member['haslo'], 1, 20)
    //       ? '' : 'Hasło musi miec od 1-20 znaków';
       
    // $errors['login']  = is_text($member['login'], 1, 40)
    //       ? '' : 'Email musi miec od 1-40 znaków';

          $invalid = implode($errors);
          

    if($invalid){
      $errors['warning']='Sprobuj ponownie';
    }else{
      $member = $cms->getMember()->login($login, $haslo); // Get member details
      if ($member) {                                   // Otherwise for members
          $cms->getSession()->create($member);               // Create session
          //redirect('member.php', ['id' => $member['id'],]);
          redirect('../index.php');  // Redirect to their page
      } else {                                               // Otherwise
          $errors['warning'] = 'Nieprawidłowe dane';      // Store error message
      }
    }
}

$data['success']    = $success;                              // Success message
$data['login']      = $login;                                // Email address if login failed
$data['errors']     = $errors;  

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