<?php
session_start();
include 'db.php';
connection_db();
if (isset($_GET['page'])){
    $page = (int)$_GET['page'];
}
else{
    $page = 1;
}
$numberArticlesPerPage = 5;
$num = ($page - 1) * $numberArticlesPerPage;
$queryNumbersArticles = "SELECT COUNT(*) as c1 FROM article";
$result = mysqli_fetch_assoc(mysqli_query($link, $queryNumbersArticles))['c1'] or die(mysqli_error($link));
$numberLinks = ceil($result / $numberArticlesPerPage);
if ($page <= 0 or $page > $numberLinks){
    header('Location: 404.php');
}


?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Блог</title>
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
		<div id="wrapper">
			<h1>Блог</h1>
			<div>
				<nav>
				  <ul class="pagination">
<?php
    function echoLi($page, $i){
        if ($page == $i){
            $class = ' class="active"';
        }
        else{
            $class = '';
        }
        echo "<li$class><a href=\"?page=$i\">$i</a></li>";
    }
    $queryNumbersArticles = "SELECT COUNT(*) as c1 FROM article";
    $result = mysqli_fetch_assoc(mysqli_query($link, $queryNumbersArticles))['c1'] or die(mysqli_error($link));
    $numberLinks = ceil($result / $numberArticlesPerPage);
    $linkLeft = $page-1;
    if ($linkLeft <= 0){
        $class = ' class="disabled"';
    }
    else{
        $class = '';
    }
    echo '<li'.$class.'>
            <a href="?page='.$linkLeft.'"  aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            </a>
        </li>';
                        

    

    
    if ($numberLinks >= 5){
        if ($page > 2 and $numberLinks - 2 > $page){
            for ($i=$page-2;$i<$page+3;$i++){
                echoLi($page, $i);
            }
        }
        else if ($page <= 2){
            for ($i=1;$i<=5;$i++){
                echoLi($page, $i);
            }
        }
        else if ($page > $numberLinks - 5){
            for ($i=$numberLinks-4;$i<=$numberLinks;$i++){
                echoLi($page, $i);
            }
        }
    }
    else{
        for ($i=1;$i<=$numberLinks;$i++){
            echoLi($page, $i);
        }
    }
    $linkRight = $page+1;
    if ($linkRight > $numberLinks){
        $class = ' class="disabled"';
    }
    else{
        $class = '';
    }
    echo '<li'.$class.'>
            <a href="?page='.$linkRight.'" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>';
    if (isset($_SESSION['name'])){
        echo "<li><a href=\"admin/add.php/\">Добавить запись</a></li>";
        echo "<li><a href=\"admin/logout.php\">Выйти</a></li>";
    }
?>
					
				  </ul>
				</nav>
			</div>
<?php
$query = "SELECT * FROM article ORDER BY id DESC LIMIT $num, $numberArticlesPerPage";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);
foreach ($data as $row){
    if (isset($_SESSION['name'])){
        $edit = '<a href="admin/edit.php?id='.$row['id'].'">Редактировать запись</a>';
    }
    else{
        $edit = '';
    }
    echo '<a href="articles/?id='.$row['id'].'"><div class="note">
            <p>
                <span class="date">'.$row['date'].'</span>
                <span class="name">'.$row['title'].'</span>
                '.$edit.'
            </p>
            <p>
                '.substr($row['text'], 0, 100).'...    
            </p>
        </div></a>';
}
?>
		</div>
	</body>
</html>
