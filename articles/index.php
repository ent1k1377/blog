<?php
    include '../db.php';
    connection_db();
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else{
        echo 123;
        //header("Location: ../404.php");
    }
    $query = "SELECT * FROM article WHERE id = $id";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $data = mysqli_fetch_assoc($result);
    if (count($data) == 0){
        //header("Location: ../404.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../css/styles.css">
    <title><?=$data['title']?></title>
</head>
<body>
<div id="wrapper">
<h1>Блог</h1>
<?php
    echo '<div class="note">
            <p>
                <span class="date">'.$data['date'].'</span>
                <span class="name">'.$data['title'].'</span>
            </p>
            <p>
                '.$data['text'].'  
            </p>
        </div>';

?>
<div>
    <nav>
        <ul class="pagination">
        
<?php
    $query = "SELECT COUNT(*) as c1 FROM article";
    $resultAll = mysqli_fetch_assoc(mysqli_query($link, $query))['c1'] or die(mysqli_error($link));
    
    $idRight = $id + 1;
    if ($idRight > $resultAll){
        $class = ' class="disabled"';
    }
    else{
        $class = '';
    }
    echo '<li'.$class.'>
                <a href="?id='.$idRight.'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>';
    $idLeft = $id - 1;
    if ($idLeft <= 0){
        $class = ' class="disabled"';
    }
    else{
        $class = '';
    }
    echo '<li'.$class.'>
                <a href="?id='.$idLeft.'" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';
?>
        </ul>
    </nav>
</div>
</div>
</body>
</html>
