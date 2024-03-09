<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tanchiwedia';
// echo "<pre>";
// var_dump($_FILES);
// var_dump($_POST);
// echo "</pre>";

$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $query->bindValue(':id', $id);
    $query->execute();
    $post = $query->fetchAll(PDO::FETCH_ASSOC);
    // foreach ($post as $po) {
    //     echo $po['exposure'];
    //     $image_path = $po['photo'];
    //     echo '<img ' . "src=" . "$image_path " . ' width="124px">';
    // }
    // echo "<pre>";
    // var_dump($_FILES);
    // var_dump($_POST);
    // echo "</pre>";
    $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $statement->bindValue('id', $id);
    $statement->execute();
}

header("Location: admin.php");
exit();
