<?php
    session_start();
    include 'ConnectionDatabase.php';

    if(isset($_POST['registration']))
    {
        $queryCheck = "SELECT * FROM users WHERE login = '{$_POST['login']}'";
        $resultCheck = mysqli_query($database, $queryCheck);

        if(mysqli_num_rows($resultCheck) == 0)
        {
            $queryInsert = "INSERT INTO users (`id`, `login`, `password`, `role`) VALUES (NULL, '{$_POST['login']}', '{$_POST['password']}', 'user')";
            $resultInsert = mysqli_query($database, $queryInsert);
            if($resultInsert)
            {
                header('Location: Authorization.php');
                exit();
            }
        }
        else{
            $messege = 'Запись с таким именем уже существует';
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
        <title>Регистрация</title>
        <link rel="stylesheet" href="Style.css">
        <style>
            body{
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            table{
                width: 500px;
                background-color: #333;
                border-radius: 10px;  
                border-spacing: 40px;
            }
            input{
                width: 100%;
            }
            tr{
                margin: 60px;
            }
            td{
                width: 50%;
            }

        </style>
    </head>
    <body>
        <form action="#" method="POST">
            <table>
                <tr>
                    <td colspan='2'><h2>РЕГИСТРАЦИЯ</h2><br>Логин<br><input type="text" name="login" require></td>
                </tr>

                <tr>
                    <td colspan='2'>Пароль<br><input type="password" name="password" require></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Зарегистрироваться" class='submit_1' name='registration'><br><br>
                        <?php
                            echo $messege;
                        ?>                
                    </td>
                </tr>
            </table>
        </form>
        
    </body>
</html>