
<header class="header">

<?php $nazwa="Imie nazwisko"; ?>
    
    <div class="inner_header">
        <label class="logo">
            <div class="logo_container">
                <a href="index.php"><h1>Library </h1></a>
            </div>
        </label>
        <ul class="navigatione">
            <a class="active" href="czytelnicy.php"><li><i class="fa fa-search"></i> <br> Zarządzanie <br> czytelnikami </li> </a>
            <a class="active" href="ksiazki.php"><li> <i class="fa fa-plus"></i>  <br> Zarządzanie <br> ksiązkami </li> </a>
            <li><br> <?= $nazwa ?> <br>
            <a class="active" href="logout.php"><i class="fa fa-search"></i> Wyloguj sie  </li> </a>
            
        </ul>

    </div>
  
</header>