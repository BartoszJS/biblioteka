<?php
            
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}

$sql="SELECT id,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
    FROM ksiazki
    where id=:id;";

$ksiazka = pdo($pdo, $sql, [$id])->fetch();    // Get article data
if (!$ksiazka) {   
    header("Location: nieznaleziono.php");  
    exit();                              // Page not found
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
<div class="ksiazka">
    <div class="ramka">
            <div class="okladka">
                <img class="image-resize" src="uploads/<?= html_escape($ksiazka['okladka'] ?? 'blank.png') ?>">
            </div>
            <div class="tekst">
                <?= "ID: ".$ksiazka['id']?> <br>
                <?= "Tytuł: ".$ksiazka['tytul']?><br>
                <?= "Autor: ".$ksiazka['autor']?> <br>
                <?= "Gatunek: ".$ksiazka['gatunek']?> <br>
                <?= "Liczba stron: ".$ksiazka['liczba_stron']?> <br>
            </div>
            <div class="buttons">
                        <a href="wypozycz.php?id=<?= $ksiazka['id'] ?>" class="btnbook">WYPOZYCZ</a> <br>
                        <a href="edytujksiazke.php?id=<?= $ksiazka['id'] ?>" class="btnbook">EDYTUJ</a> <br>
                        <a href="usunksiazke.php?id=<?= $ksiazka['id'] ?>" class="btnbook">USUŃ</a> <br>
                      
            </div>

                     
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>