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
        <style>
            table{
                width: 60%;
                margin: auto;
            }
            td{
                height: 300px;
            }
            td img{
                max-height: 300px;
                width: auto;
                padding: 10px;
            }
        </style>
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
        <br><br>
        <h2>О НАС</h2>
        <table>
            <tr>
                <td><img src="../Images/124284.png"></td>
                <td>Добро пожаловать в наш уютный интернет-магазин свечей, где каждая мгновение превращается в особенный момент благодаря теплому свету и неповторимым ароматам. Мы – команда энтузиастов, преданных искусству создания уютных вечеров и домашнего комфорта.<br><br>
                Наш магазин был основан с любовью к деталям и заботой о вашем уюте. Мы начали свой путь с желанием предоставить нашим клиентам не только высококачественные свечи, но и неповторимый опыт, который оставит в сердце теплые воспоминания.
                </td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <footer>
            <div class="column">
                <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo"></a>
                <h3>Girls want candles</h3>
                <p>свечи ручной работы</p>
            </div>
            <div class="column">
                <h3>Меню</h3>
                <a href="Catalog.php">Каталог</a><br>
                <a href="AboutUs.php">О нас</a><br>
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