<?php                      
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';


$sql="SELECT ID,Imie,Nazwisko,Numer_Telefonu,Adres_Email
    FROM czytelnik
    order by id desc;";
$czytelnicy = pdo($pdo,$sql)->fetchAll();


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
<br><br>
<div class="czytelnicy">

    <div class="ramka1">
    <h1>Czytelnicy: </h1>
    <br>
    <div class="szukaj">
    <form action="oferty.php" method="get" class="form-search">
                <label for="search"><span> </span></label>
                <input type="text" name="term" 
                    id="search" placeholder="Wyszukaj tutaj:"  
                /><input type="submit" value="Szukaj" class="btnszukajo" />
                
        </form>
    </div>
    <div class="dodajbutton">
        <a href="dodajczytelnika.php" class="btndodaj">DODAJ CZYTELNIKA</a>
    </div> <br>
   
        <?php foreach($czytelnicy as $pojedynczo) { ?> 
            <div class="ramkaczytelnicy">
           
                <div class="tekst">
                    <div class="id">  <?= $pojedynczo['ID']; ?></div>
                
                    <?= $pojedynczo['Imie']; ?>
                    <?= $pojedynczo['Nazwisko']; ?><br>
                    <?= "Nr telefonu: ".$pojedynczo['Numer_Telefonu']; ?> <br>
                    <?= "E-mail: ".$pojedynczo['Adres_Email']; ?>
                </div>
                <div class="przyciski">
                <a href="czytelnik.php" class="btnzobacz">ZOBACZ</a> 
                    <a href="edytujczytelnika.php" class="btnzobacz">EDYTUJ</a>
                    <a href="usunczytelnika.php" class="btnzobacz">USUŃ</a>
                </div>
            </div>
        <?php }?>
        
    </div>
 
</div>
      
<?php include 'includes/footer.php'; ?>
</body>
</html>