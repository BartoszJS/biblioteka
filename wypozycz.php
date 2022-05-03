<?php
            
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';

$errors['id']='';


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                          // If no valid id
}

$sql="SELECT id,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
    FROM ksiazki
    where id=:id;";

$ksiazka = pdo($pdo, $sql, [$id])->fetch();    // Get article data
if (!$ksiazka) {   
    header("Location: nieznaleziono.php");  
    exit();                                 // Page not found
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
            <div class="okladka">
                <img class="image-resize" src="uploads/<?= html_escape($ksiazka['okladka'] ?? 'blank.png') ?>">
            </div>
            <div class="tekst">
            <h2>Wypożycz:</h2><br>
                <h3>Książka:</h3>
                <?= "ID: ".$ksiazka['id']?> <br>
                <?= "Tytuł: ".$ksiazka['tytul']?><br>
                <?= "Autor: ".$ksiazka['autor']?> <br>
                <?= "Gatunek: ".$ksiazka['gatunek']?> <br>
                <?= "Liczba stron: ".$ksiazka['liczba_stron']?> <br>
            </div>
            <div class="tekst">
             <h3>Dane pracownika:</h3>
                <?= "ID: ".$_SESSION['id'] ?><br>
                <?= $_SESSION['imie'] ?>
                <?= $_SESSION['nazwisko'] ?>


               
            </div>
        <form action="potwierdzwypozyczenie.php" method="POST" enctype="multipart/form-data"> 
            <input type="hidden" name="IdPracownika" id="IdPracownika" value= "<?=$_SESSION['id'] ?>">
            <input type="hidden" name="IdKsiazki" id="IdKsiazki" value= "<?= $ksiazka['id'] ?> ">
            <div class="tekst">
                <div class="form-group">
                <label for="title">  <h3>Id klienta:</h3> </label>
                <input type="text" name="IdCzytelnika" id="IdCzytelnika" placeholder="Wpisz id klienta:"
                    class="form-control1">
                    <span class="errors"><?= $errors['id'] ?></span>
                </div><br>
                <h3> Data wypożyczenia(R-M-D): </h3>
                <input type="text" name="Data_wypozyczenia" id="Data_wypozyczenia" placeholder="Podaj datę wypożyczenia:"  class="form-control1" value="<?= date("Y-m-d") ?>">
                <br> 
                <label for="dni"> <h3> Czas wypożyczenia: </h3></label> 
                <div class="czas">
                    <input type="text" name="Czas" id="Czas" placeholder="Podaj liczbe dni:"  class="form-control2" value="30">
                </div>
                <div class="dni">
                    <span>dni</span><br><br>
                </div>
               
            </div>
          
                <div class="buttons">
                    <input type="submit" name="update" class="btnbook" value="WYPOŻYCZ"> 
                        
                </div>
        </form>  
                     
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>