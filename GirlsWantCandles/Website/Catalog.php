<?php
    session_start();
    include 'ConnectionDatabase.php';
    $query = "SELECT * FROM products";

    if(isset($_GET['category']) && ($_GET['category']) != 0)
    {
        $query .= " WHERE id_category = {$_GET['category']}";
    }
    
    $result = mysqli_query($database, $query);
?>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
        <title>Каталог</title>
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
        <br>
        <form action="Catalog.php" method=GET>
            <div class='main-block'>
                <h2>КАТАЛОГ ТОВАРОВ</h2>
                <div class='main-block'>
                    <p>Категория:    </p>
                    <select name='category'>
                        <option value='0'> все </option>
                        <?php
                            $queryCategory = "SELECT * FROM category";
                            $resultCategory = mysqli_query($database, $queryCategory);
                            if($resultCategory)
                            {
                                while($rowCategory = mysqli_fetch_assoc($resultCategory))
                                {
                                    if(isset($_GET['category']))
                                    {
                                        if($_GET['category'] == $rowCategory['id'])
                                        {
                                            $isSelected = 'selected';
                                        }
                                        else
                                        {
                                            $isSelected = '';
                                        }
                                    }
                                    else
                                    {
                                        $isSelected = '';
                                    }
                                    echo "<option value='{$rowCategory['id']}' {$isSelected}>" . $rowCategory['name'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    <input type='submit' value='Применить' class='submit_1'>
                </div>
            </div>
        </form>
        <div class="product-grid">
        <?php
            if($result)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<form action='Basket.php' method=POST>";
                    echo "<div class='product-card'>";
                    echo "<img src=" . $row['path_img'] . "><br><br>";
                    echo mb_strtoupper($row['name']) . "<br>";
                    echo $row['description'] . "<br><br>";
                    echo "<div class='main-block'>";


                    if($row['availability'] == 0){
                        echo "Наличие в магазине: Отсутствует<br>";
                    }
                    if($row['availability'] == 1){
                        echo "Наличие в магазине: В наличие<br>";
                    }

                    echo "<br>";

                    echo $row['price'] . " руб<br>";
                    echo "<input type='hidden' name='id_product' value='{$row['id']}'>";
                    echo "<input type='submit' name='add' value='Добавить в корзину' class='submit_1'>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                }
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