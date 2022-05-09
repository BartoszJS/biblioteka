<?php
            
include 'src/bootstrap.php';    


is_admin($session->role); 
$i=0;
$nieoddane=0;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}

$wypozyczenie = $cms->getWypozyczenie()->getWypozyczeniaCzytelnika($id);

$czytelnik =$cms->getCzytelnik()->getCzytelnik($id);
if (!$czytelnik) {   
    header("Location: nieznaleziono.php");  
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
    <title>Czytelnik</title>
    <?php include 'includes/header.php'; ?>    
    

</head>
<body>
<br><br><br><br><br>
<div class="czytelnik">
    <?php
foreach($wypozyczenie as $pojedynczo) { 
        $i++;
        if ($pojedynczo['zakonczona']==0){ 
            $nieoddane++;
        }

    }
   
    ?>

    <div class="ramka">
                    <div class="tresc">
                        
                        <div class="rameczka1">
                            
                            <?= "ID: ".$czytelnik['id']?><br>
                            <?= $czytelnik['imie']?>
                            <?= $czytelnik['nazwisko']?> <br>
                            <?= "Nr telefonu: ".$czytelnik['numer_telefonu']?><br>
                            <?= "Adres email: ".$czytelnik['adres_email']?><br>
                           
                            
                        </div>
                        <div class="rameczka2">
                        <?= "Suma wypozyczeń: ".$i ?> <br>
                        <?= "Liczba nieoddanych: ".$nieoddane ?> <br>
                            
                            </div>
                        
                    </div>
                    <?php foreach($wypozyczenie as $pojedynczo) { ?> 
                        <?php if ($pojedynczo['zakonczona']==0){ ?>
                        <div class="tresc">
                            <div class="tekst">
                            <?= "ID: ".$pojedynczo['id'] ?> <br>
                            <?= "Tytuł: ".$pojedynczo['tytul'] ?> <br>
                            <?= "Autor: ".$pojedynczo['autor'] ?> <br>
                           
                            
                           
                            <?= "Czas wypożyczenia:" ?> 
                            <?= date("Y-m-d", strtotime($pojedynczo['Data_wypozyczenia'])); ?>  <?= " - ".$pojedynczo['Do'] ?> <br>
                            </div>
                            <div class="button">
                                <a href="oddajksiazke.php?id=<?= $pojedynczo['id'] ?>" class="btnzobacz" >ODDAJ</a><br> 
                            </div>
                            
                        </div>
                        <?php }else{ ?>
                            <div class="tresc">
                            <div class="tekst">
                            <?= "ID: ".$pojedynczo['id'] ?> <br>
                            <?= "Tytuł: ".$pojedynczo['tytul'] ?> <br>
                            <?= "Autor: ".$pojedynczo['autor'] ?> <br>
                            
                            
                           
                            <?= "Czas wypożyczenia:" ?> 
                            <?= date("Y-m-d", strtotime($pojedynczo['Data_wypozyczenia'])); ?>  <?= " - ".$pojedynczo['Do'] ?> <br>
                            </div>
                           
                            
                        </div>

                        <?php }?>

                    <?php } ?>
               
    </div >  
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>