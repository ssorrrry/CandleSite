<?php
    session_start();
    if(isset($_POST['sum']))
    {
        $sum = $_POST['sum'];
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
        <title>Girls want candles</title>
        <link rel="stylesheet" href="Style.css">
        <style>
            body{
                text-align: center;
            }
            form{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div>
            <h2>ОФОРМЛЕНИЕ ЗАКАЗА</h2>
            <form action="Basket.php" method=POST>
                Имя: <input type='text' name='name' placeholder="Ваше имя" required><br>
                Телефон: <input type='tel' name='telephone' placeholder="x (xxx) xxx-xx-xx" required pattern="[0-9]{11}"><br>
                Адрес доставки: <input type='text' name='address' placeholder="Адрес доставки"><br>
                Сумма к оплате: <?php echo $sum;?> руб<br> 
                <input type='submit' name='buy' value='Заказать' class='submit_1'>
            </form>
        </div>
    </body>
</html>
