

<script src="https://kit.fontawesome.com/2a11efd126.js" crossorigin="anonymous"></script>

<header class="header">
   
    <div class="inner_header">
        <label class="logo">
            <a href="index.php"><div class="logo_container">
                <h1>Library<i class="fa-solid fa-book"></i> </h1>
            </div></a>
        </label>

        <ul class="header_list">
            <li class="list_item">
                <a class='active' href="ksiazki.php">  Książki</a> 
            </li> 
            
            <li class="list_item">
                <a class="active" href="logowanie.php"> Logowanie </a>
            </li>
            <li id="list_item_hamburger">
                 <i class="fa-solid fa-bars"></i> 
            </li>
            
        </ul>
            

    </div>
    <div id="div_items">
            <div class="div_item">
                <a class='active' href="ksiazki.php">  Książki</a> 
            </div> 
            
            <div class="div_item">
                <a class="active" href="logowanie.php"> Logowanie </a>
            </div>
    </div>


            <script>


let object = document.getElementById('list_item_hamburger');
let div_items = document.getElementById('div_items');

let show = false;

object.addEventListener("click", onClick);

function onClick() {
    console.log(show);
    if(show==true){
        div_items.style.display = "block";
        show=false;
    } else {
        div_items.style.display = "none";
        show=true;
    }
}
</script>


</header>
