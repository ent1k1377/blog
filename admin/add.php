<?php
session_start();
if (!isset($_SESSION['name'])){
    header('Location: /admin');
    exit;
}
include '../db.php';
connection_db();
$name = $_SESSION['name'];
if (isset($_POST['send'])){
    $title = $_POST['title'];
    $text = $_POST['text'];
    $date = date('Y-m-d', time());
    $query = "INSERT INTO article (title, text, date) VALUES ('$title', '$text', '$date')";
    mysqli_query($link, $query) or die(mysqli_error($link));
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Document</title>
</head>
<body>
    <div id="wrapper">
        <h1>Добавление записи</h1>
        <form action="" method="post">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title"><br>
            <label for="text">Текст</label>
            <textarea name="text" id="text" cols="30" rows="10"></textarea><br>
            <input type="submit" value="Отправить" name="send">
        </form>
    </div>
    <style>
        label{
            width: 100px;
        }
        input, textarea{
            width: 300px;
        }
        input[type='submit']{
            width: 404px;
        }
    </style>
</body>
</html>