
<header class="header">

<?php $nazwa="Imie nazwisko"; ?>
    
    <div class="inner_header">
        <label class="logo">
            <div class="logo_container">
                <a href="index.php"><h1>Library </h1></a>
            </div>
        </label>
        <ul class="navigatione">
            <li class="li1"><a class="active" href="czytelnicy.php"> Zarządzanie czytelnikami  </a></li>
            <li class="li1"><a class="active" href="ksiazki.php">  Zarządzanie ksiązkami </a></li> 
            <li class="li2"> <span><?= $nazwa ?></span> <br>
            <a class="active" href="logout.php">Wyloguj sie   </a></li>
            
        </ul>

    </div>
  
</header>