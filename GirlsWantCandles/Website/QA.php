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
        <title>Q&A</title>
        <link rel="stylesheet" href="Style.css">
        <style>
            table{
                width: 60%;
                margin: auto;
            }
            td{
                height: 100px;
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
        <h2>Q&A</h2>
        <table>
            <tr>
                <td>Каков ассортимент ваших свечей?</td>
                <td>Наш ассортимент включает классические столбиковые свечи, ароматизированные свечи, свечи в стекле и многие другие разнообразные варианты. Со всей продукцикй вы можете ознакомиться во вкладке Каталог.</td>
            </tr>
            <tr>
                <td>Какие материалы используются при производстве свечей?</td>
                <td>Мы используем высококачественные парафиновые смеси, натуральные масла и стекло высокой прочности для наших свечей.</td>
            </tr>
            <tr>
                <td>Какие варианты доставки у вас есть??</td>
                <td>Доставка осуществляется СДЭКом. Однако вы можете оформить заказ на ozon и забрать в ближайшем пункте выдачи.</td>
            </tr>
            <tr>
                <td>Сколько времени занимает доставка?</td>
                <td>Сроки доставки зависят от вашего местоположения. Обычно стандартная доставка занимает от 2 до 5 рабочих дней.</td>
            </tr>
            <tr>
                <td>Какое качество ваших свечей?</td>
                <td>Мы гордимся высоким качеством наших свечей. Все продукты проходят строгий контроль качества перед выпуском.</td>
            </tr>
            <tr>
                <td>Есть ли гарантия на ваши товары?</td>
                <td>Мы предоставляем гарантию на все наши свечи. Если у вас есть проблемы с продукцией, свяжитесь с нашей службой поддержки.</td>
            </tr>
        </table>
        <br><br><br>
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