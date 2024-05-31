<?php
    session_start();

    if(isset($_POST['log_out']))
    {
        session_destroy();
        header('Location: MainPage.php');
        exit();
    }
?>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
        <title>Личный кабинет</title>
        <link rel="stylesheet" href="Style.css">
        <style>
            body{
                height: 100%;
            }
            table{
                width: 500px;
                background-color: #333;
                border-radius: 10px;  
                border-spacing: 40px;
                margin: auto;
            }

            footer{
                position: absolute;
                bottom: 0;
                width: 100%;
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
                <a href="PersonalAccount.php" class="profile"><img src="../Images/icon_profile.png" alt="Cart"></a>
            </div>
        </header>
        <br><br><br>
        
        <form action="#" method="POST">
            <table>
                <tr>
                    <td colspan='2'><h2>ЛИЧНЫЙ КАБИНЕТ</h2><br>Логин: <?php echo $_SESSION['login']?></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Выйти" class='submit_1' name='log_out'></td>
                </tr>
            </table>
        </form>


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