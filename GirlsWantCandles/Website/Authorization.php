<?php
    session_start();
    include 'ConnectionDatabase.php';

    if(isset($_POST['log_in']))
    {
        $query = "SELECT * FROM users WHERE login = '{$_POST['login']}' AND password = '{$_POST['password']}'";
        $result = mysqli_query($database, $query);

        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            if($row['role'] == 'user')
            {
                $_SESSION['user'] = $row['id'];
                $_SESSION['login'] = $row['login'];
                header('Location: PersonalAccount.php');
                exit();
            }
            else{
                header('Location: ../Admin/Admin.php');
                exit();
            }
        }
    }

    if(isset($_POST['registration']))
    {
        header('Location: Registration.php');
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
        <title>Авторизация</title>
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
            .submit_1{
                width: 100%;
            }
        </style>
    </head>
    <body>
        <form action="#" method="POST">
            <table>
                <tr>
                    <td colspan='2'><h2>ВХОД В ЛИЧНЫЙ КАБИНЕТ</h2><br>Логин<br><input type="text" name="login" require></td>
                </tr>

                <tr>
                    <td colspan='2'>Пароль<br><input type="password" name="password" require></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Войти" class='submit_1' name='log_in'></td>
                    <td><input type="submit" value="Зарегистрироваться" class='submit_1' name='registration'></td>
                </tr>
            </table>
        </form>
    </body>
</html>