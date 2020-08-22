<?php
session_start();
if (isset($_POST['send'])){
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    if ($name == 'root' and $password == '63a9f0ea7bb98050796b649e85481845'){
        $_SESSION['name'] = $name;
        header('Location: /');
        exit;
    }
    else{
        echo 'Пароль не правильный';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Авторизация</title>
</head>
<body>
    <div id="wrapper">
        <h1>Авторизация</h1>
        <form action="" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"><br>
            <input type="submit" value="Отправить" name="send">
        </form>
    </div>
    <style>
        label{
            width: 100px;
        }
        input{
            width: 200px;
        }
        input[type='submit']{
            width: 304px;
        }
    </style>
</body>
</html>
