
<header class="gora">

<?php $nazwa=$_SESSION['imie']." ".$_SESSION['nazwisko']; ?>
 
            <p class="nazwa"> <span> Zalogowano : <?=" ".$nazwa ?></span> </p>

</header>

<header class="header">
   
    <div class="inner_header">
        <label class="logo">
            <div class="logo_container">
                <a href="index.php"><h1>Library </h1></a>
            </div>
        </label>
        <ul class="navigatione">
        <a class="active" href="czytelnicy.php"> <li class="li1"> Zarządzanie czytelnikami  </li></a>
        <a class="active" href="ksiazki.php">   <li class="li1">  Zarządzanie ksiązkami </li> </a>
        <a class="active" href="logout.php"> <li class="li2">  Wyloguj sie </li> </a>
            
        </ul>

    </div>
  
</header>