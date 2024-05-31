<?php
    session_start();
    include 'ConnectionDatabase.php';

    if(isset($_POST['add'])){
        $id_product = $_POST['id_product'];
        $product_exists = false;

        if (isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $key => $item)
            {
                if ($item['id_product'] == $id_product && $item['size'] == $size) 
                {
                    $_SESSION['cart'][$key]['quantity'] += 1;
                    $product_exists = true;
                    break;
                }
            }
        }

        if (!$product_exists) { 
            $newItem = [
                'id_product' => $id_product,
                'quantity' => 1,
            ];

            $_SESSION['cart'][] = $newItem;
        }
    }

    if(isset($_POST['update']))
    {
        $id_product_update = $_POST['id_product'];
        $quantity_update = $_POST['quantity'];

        foreach($_SESSION['cart'] as $key => $item)
        {
            if($item['id_product'] == $id_product_update)
            {
                if($quantity_update > 0)
                {
                    $_SESSION['cart'][$key]['quantity'] = $quantity_update;
                }
                else
                {
                    unset($_SESSION['cart'][$key]); 
                }
                
            }
        }
    }

    if(isset($_POST['delete']))
    {
        $id_product_delete = $_POST['id_product'];
        foreach($_SESSION['cart'] as $key => $item)
        {
            if($item['id_product'] == $id_product_delete)
            {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
    if(isset($_POST['clear']))
    {
        unset($_SESSION['cart']);
    }

    if(isset($_POST['buy']))
    {
        $name = $_POST['name'];
        $telephone = $_POST['telephone'];
        $address = $_POST['address'];

        foreach($_SESSION['cart'] as $key => $item)
        {
            $queryOrder = "INSERT INTO orders (`id`, `name`, `telephone`, `address`, `id_product`, `quantity`, `date`, `sost`) VALUES (NULL, '{$name}', '{$telephone}', '{$address}', '{$item['id_product']}', '{$item['quantity']}', NOW(), 0);";
            $resultOrder = mysqli_query($database, $queryOrder);
            if ($resultOrder) 
            {
                unset($_SESSION['cart'][$key]); 
            }
            else
            {
                echo "Ошибка покупки <br>";
            }
        }
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
        <title>Корзина</title>
        <link rel="stylesheet" href="Style.css">
        <style>
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
        <br>
        <h2>КОРЗИНА</h2>
        <div class='container'>
            <?php
                if(isset($_SESSION['cart'])){
                    foreach($_SESSION['cart'] as $key => $item)
                    {
                        $queryProduct = "SELECT * FROM products WHERE id={$item['id_product']}";
                        $resultProduct = mysqli_query($database, $queryProduct);
                        $product = mysqli_fetch_assoc($resultProduct);
                        echo "<form action='Basket.php' method=POST>";
                        echo "<div class='cart-item'>";
                            echo "<div class='main-block'>";
                                echo "<img src='{$product['path_img']}'>";
                                echo "<div>";
                                    echo mb_strtoupper($product['name']) . "<br>";
                                    echo "<input type='number' name='quantity' value='{$item['quantity']}' class='input-number' min=0><br><br>";
                                    echo $product['price'] * $item['quantity'] . " руб";
                                    $sum += $product['price'] * $item['quantity'];
                                echo "</div>";
                            echo "</div>";
                            echo "<div>";
                                echo "<input type='hidden' name='id_product' value='{$item['id_product']}'>";
                                echo "<input type='submit' name='update' value='Изменить' class='submit_1'><br><br>";
                                echo "<input type='submit' name='delete' value='Удалить' class='submit_1'>";
                            echo "</div>";
                        echo "</div>";
                        echo "</form>";
                    }
                }
                if(!empty($_SESSION['cart']))
                {
                    echo "Итого: " . $sum . " руб <br><br>";
                    echo "<div class='main-block'>";
                    echo "<form action='Basket.php' method=POST>";
                    echo "<input type='submit' name='clear' value='Очистить' class='submit_1'>";
                    echo "</form>";

                    echo "<form action='FormBuy.php' method=POST>";
                    echo "<input type='hidden' name='sum' value='{$sum}'>";
                    echo "<input type='submit' value='Купить' class='submit_1'>";
                    echo "</form>";

                    echo "</div>";
                }
            ?>
        </div>
        
        <br><br>
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