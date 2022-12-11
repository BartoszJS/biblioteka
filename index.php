<?php                      
include 'src/bootstrap.php';    


$ksiazka = $cms->getKsiazka()->indexKsiazki();
$today=date("Y-m-d");
$polecane = $cms->getWypozyczenie()->indexWypozyczenia();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="photos/favicon.ico" type="image/x-icon"/>
    <title>Strona główna</title>
    

    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>




 
    

</head>
<body>

<div class="back">
    <div class="content_back">
        <h1>Biblioteka nr 1 w Radomiu</h1>
        <a href="ksiazki.php">
            <button class="button_back">Zobacz książki</button>
        </a>
    </div>
</div>
<div class="cont-width">
<div class="index_container">
    <div class="wrapper">
    <h2 class='newest_title'>Najnowsze ksiązki:</h2><br>
    <div class="recomended_container">
        
        
        <?php foreach($ksiazka as $pojedynczo) { ?> 
            <div class="recomended-book">
            <div class="recomended-img">
                    <img class="recomended-img-img" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
                    </div>
                    <div class="recomended-text">
                    <?= "Tytuł: ".$pojedynczo['tytul'] ?><br>
                    <?= "Autor: ". $pojedynczo['autor'] ?><br>
                    <?= "Gatunek: ".$pojedynczo['gatunek'] ?><br>
                    </div>
                    <div class="recomended-button">
                    <a href="ksiazka.php?id=<?= $pojedynczo['id'] ?>" class="btnzobaczindex" >ZOBACZ</a><br> 
        </div>
        </div>
                
            
        <?php }?>
    </div>
    </div>

    <div class="wrapper">
        
    <h2 class='newest_title'>Polecane ksiązki:</h2><br>
    <div class="recomended_container">
   
        <?php foreach($polecane as $pojedynczo) { ?> 
            <div class="recomended-book">
                <div class="recomended-img">
                    <img class="recomended-img-img" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
                </div>
                <div class="recomended-text">    
                    <?= "Tytuł: ".$pojedynczo['tytul'] ?><br>
                    <?= "Autor: ". $pojedynczo['autor'] ?><br>
                    <?= "Gatunek: ".$pojedynczo['gatunek'] ?><br>
                </div>
                <div class="recomended-button">
                    <a href="ksiazka.php?id=<?= $pojedynczo['id'] ?>" class="btnzobaczindex" >ZOBACZ</a><br> 
                </div>
            </div>
            
        <?php }?>
    </div>
    </div>

</div>
</div>
  
<?php include 'includes/footer.php'; ?>
</body>
</html>