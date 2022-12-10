<?php

include "src/bootstrap.php";

$i = 0;
$nieoddane = 0;

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT); // Validate id
if (!$id) {
    header("Location: nieznaleziono.php");
    exit(); // If no valid id
}

$wypozyczenie = $cms->getWypozyczenie()->getWypozyczeniaCzytelnika($id);
if ($_SESSION["id"] !== $id) {
    header("Location: nieznaleziono.php");
    exit();
}
$czytelnik = $cms->getCzytelnik()->getCzytelnik($id);
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
		<?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>



	</head>

	<body>
		
		<?php foreach ($wypozyczenie as $pojedynczo) {
      		$i++;
			if ($pojedynczo["zakonczona"] == 0) {
				$nieoddane++;
			}
 		 } ?>
	<div class="cont">
		<h1 class="czytelnik_h1">Profil</h1>
		<div class="czytelnik">
		
			<div class="czytelnik_dane">
				<?= "ID: " . $czytelnik["id"] ?><br>
				<?= $czytelnik["imie"] ?>
				<?= $czytelnik["nazwisko"] ?> <br>
				<?= "Nr telefonu: " . $czytelnik["numer_telefonu"] ?><br>
				<?= "Adres email: " . $czytelnik["login"] ?><br>
			</div>
			<div class="czytelnik_liczby">
				<?= "Suma wypozyczeń: " . $i ?> <br>
				<?= "Liczba nieoddanych: " . $nieoddane ?> <br>
			</div>
		</div>
	</div>
	<div class="czytelnik_ksiazki">
			<?php foreach ($wypozyczenie as $pojedynczo) { ?>
			<?php if ($pojedynczo["zakonczona"] == 0) { ?>
			<div class="czytelnik-book">
				<div class="czytelnik-book-img">
					<img class="czytelnik-book-img-img" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
				</div>
				<div class="czytelnik-book-dane">
					<?= "ID: " . $pojedynczo["id"] ?> <br>
					<?= "Tytuł: " . $pojedynczo["tytul"] ?> <br>
					<?= "Autor: " . $pojedynczo["autor"] ?> <br>



					<?= "Czas wypożyczenia:" ?>
					<?= date("Y-m-d", strtotime($pojedynczo["Data_wypozyczenia"])) ?> <?= " - " .
					$pojedynczo["Do"] ?> <br>

				</div>
			</div>

			<?php } else { ?>
			<div class="czytelnik-book">
				
				<div class="czytelnik-book-img">
					<img class="czytelnik-book-img-img" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
				</div>
				<div class="czytelnik-book-dane">
					<?= "ID: " . $pojedynczo["id"] ?> <br>
					<?= "Tytuł: " . $pojedynczo["tytul"] ?> <br>
					<?= "Autor: " . $pojedynczo["autor"] ?> <br>



					<?= "Czas wypożyczenia:" ?>
					<?= date("Y-m-d", strtotime($pojedynczo["Data_wypozyczenia"])) ?> <?= " - " .
					$pojedynczo["Do"] ?> <br>
				</div>
			</div>

			<?php } ?>

			<?php } ?>
	</div>

		<?php include "includes/footer.php"; ?>
	</body>

</html>