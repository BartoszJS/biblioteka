<?php
            
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';

$errors['id']='';




if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $rent['IdPracownika']=$_POST['IdPracownika'];
    $rent['IdCzytelnika']=$_POST['IdCzytelnika'];
    $rent['IdKsiazki']=$_POST['IdKsiazki'];
    $rent['Data_wypozyczenia']=$_POST['Data_wypozyczenia'];
    $rent['Czas']=$_POST['Czas'];
    
    
}  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Strona główna</title>
    <?php include 'includes/header.php'; ?>    
    

</head>
<body>
<br><br><br><br><br><br><br>
<div class="wypozycz">
    <div class="ramka">
            
    <h1><?= $_POST['IdPracownika'] ?></h1>
    <h1><?= $rent['IdCzytelnika'] ?></h1>
    <h1><?= $rent['IdKsiazki'] ?></h1>
    <h1><?= $rent['Data_wypozyczenia'] ?></h1>
    <h1><?= $rent['Czas'] ?></h1>
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>