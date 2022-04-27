<?php                      
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';

$term  = filter_input(INPUT_GET, 'term');                 // Get search term
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 10; // Limit
$from  = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset
$count = 0;
$czytelnicy=[];


if(!$term){
    $count = 0;
    $sqlicz="SELECT COUNT(id) from czytelnik ;";
    $count = pdo($pdo, $sqlicz)->fetchColumn();
    if($count>0){
        $arguments['show'] = $show;                     
        $arguments['from'] = $from;

        $sql="SELECT ID,imie,nazwisko,numer_telefonu,adres_email
        FROM czytelnik  
        order by id desc
        limit :show
        OFFSET :from;";
        $czytelnicy = pdo($pdo,$sql, $arguments)->fetchAll();
    }
}






if($term){
    
    $arguments['term1'] ='%'.$term.'%'; 
    $arguments['term2'] ='%'.$term.'%';            // three times as placeholders
    $arguments['term3'] ='%'.$term.'%';


    $sql="SELECT COUNT(id) 
    from czytelnik
    where imie like :term1
    or id like :term2
    or nazwisko like :term3;";


    $count = 0;
    $count = pdo($pdo, $sql, $arguments)->fetchColumn();

    if ($count > 0) {  
        $arguments['show'] = $show;                       // Add to array for pagination
        $arguments['from'] = $from; 
        

        $sql="SELECT ID,imie,nazwisko,numer_telefonu,adres_email
            FROM czytelnik
            where imie like :term1
            or id like :term2
             or nazwisko like :term3
            order by id desc
            limit :show
            OFFSET :from;";
        $czytelnicy = pdo($pdo,$sql,$arguments)->fetchAll();
    }
}


if ($count > $show) {                                     // If matches is more than show
    $total_pages  = ceil($count / $show);                 // Calculate total pages
    $current_page = ceil($from / $show) + 1;              // Calculate current page
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
<div class="czytelnicy">

    <div class="ramka1">
    <h1>Czytelnicy: </h1>
    <br>
    <div class="szukaj">
    <form action="czytelnicy.php" method="get" class="form-search">
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
                
                    <?= $pojedynczo['imie']; ?>
                    <?= $pojedynczo['nazwisko']; ?><br>
                    <?= "Nr telefonu: ".$pojedynczo['numer_telefonu']; ?> <br>
                    <?= "E-mail: ".$pojedynczo['adres_email']; ?>
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