
<header class="gora">

<?php $nazwa=$_SESSION['imie']." ".$_SESSION['nazwisko']; ?>
 
            <p class="nazwa"> <span> Zalogowano : <?=" ".$nazwa ?></span> </p>

</header>
<script src="https://kit.fontawesome.com/2a11efd126.js" crossorigin="anonymous"></script>

<header class="header">
   
    <div class="inner_header">
        <label class="logo">
            <a href="index.php"><div class="logo_container">
                <h1>Library<i class="fa-solid fa-book"></i> </h1>
            </div></a>
        </label>
        <ul class="navigatione">
        <a class="active" href="czytelnicy.php"> <li class="li1" > Zarządzanie czytelnikami  </li></a>
        <a class="active" href="ksiazki.php">   <li class="li1">  Zarządzanie ksiązkami </li> </a>
        <a class="active" href="logout.php"> <li class="li2">  Wyloguj sie </li> </a>
            
        </ul>

    </div>
  
</header>