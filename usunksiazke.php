<?php
            
include 'src/bootstrap.php';    


is_admin($session->role); 

$errors['id']='';


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}

$book =    $cms->getKsiazka()->getKsiazka($id); 



if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idKsiazki=$_POST['IdKsiazki'];
   

   $cms->getKsiazka()->updateDostepnosc($idKsiazki);
   header("Location: ksiazki.php"); 
    exit();

    
 
   
}  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Usuń ksiażkę</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>



</head>
<body>
<br><br><br><br><br><br><br>
<div class="wypozycz">
    <div class="ramka">
            
    <div class="okladka">
                <img class="image-resize" src="uploads/<?= html_escape($book['okladka'] ?? 'blank.png') ?>">
            </div>
            <div class="tekst"><br><br>
                <h2>Podsumowanie usuwania:</h2><br>
                <h3>Książka:</h3>
                <?= "ID: ".$book['id']?> <br>
                <?= "Tytuł: ".$book['tytul']?><br>
                <?= "Autor: ".$book['autor']?> <br>
                <?= "Gatunek: ".$book['gatunek']?> <br>
                <?= "Liczba stron: ".$book['liczba_stron']?> <br>
            </div>
           

            <form action="usunksiazke.php?id=<?= $book['id'] ?>" method="POST" enctype="multipart/form-data"> 
            <div class="tekst">
                <h3>Czy na pewno chcesz usunac książkę?</h3>
                <input type="hidden" name="IdKsiazki" id="IdKsiazki" value= "<?=$book['id'] ?>">
               


                    <input type="submit" name="update" class="btnprzywroc" value="TAK "> 
                    <a href="wypozyczone.php" class="btnprzywroc2">ANULUJ</a>   
            
            </form>  
        
    
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>