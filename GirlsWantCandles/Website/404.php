<?php
    session_start();
?>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
        <title>Girls want candles</title>
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>
    <header>
            <div>
                <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo"></a>
            </div>
            <div class="menu">
                <a href="Catalog.php">Каталог</a>
                <a href="AboutUs.php">О нас</a>
                <a href="QA.php">Q&A</a>
            </div>
            <div class="">
                <a href="Basket.php"><img src="../Images/icon_cart.png" alt="Cart"></a>
                <?php
                    if(isset($_SESSION['user']))
                    {
                        echo "<a href='PersonalAccount.php' class='profile'><img src='../Images/icon_profile.png'></a>";
                    }
                    else{
                        echo "<a href='Authorization.php' class='profile'><img src='../Images/icon_profile.png'></a>";
                    }
                ?>
            </div>
        </header>
        <br><br><br><br>
        <div class='main'>
            <img src='../Images/404.png'>
            <p>СТРАНИЦА НАХОДИТСЯ В РАЗРАБОТКЕ</p>
        </div>
        <br><br><br><br> 
        <footer>
            <div class="column">
                <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo"></a>
                <h3>Girls want candles</h3>
                <p>свечи ручной работы</p>
            </div>
            <div class="column">
                <h3>Меню</h3>
                <a href="Catalog.php">Каталог</a><br>
                <a href="404.php">О нас</a><br>
                <a href="QA.php">Q&A</a><br>
            </div>
            <div class="column">
            <h3>Контакты</h3>
                <p>Телефон: +7 (123) 456-7890</p>
                <p>Email: info@example.com</p>
            </div>
        </footer>
    </body>
</html>