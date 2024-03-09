<?php

$header_title = 'LOG AS ADMIN';
$navigate_to = '';
$nav_item = '';
$style = './styles/authe.css';
require './includes/header.php';
$footer_title = '';
$server = 'localhost';
$username = 'root';
$dbname = 'tanchiwedia';
$db_password = '';

$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $pdo->query("SELECT * FROM admin");
$adm = $query->fetchAll(PDO::FETCH_ASSOC);


$actual_name = '';
$actual_email = '';
$actual_password = '';
$error_msg = '';

foreach ($adm as $part) {

    $actual_name = $part['name'];
    $actual_email = $part['email'];
    $actual_password = $part['password'];
}

if (isset($_POST['login'])) {

    if (htmlspecialchars(trim($_POST['email'])) === $actual_email && htmlspecialchars($_POST['password']) === $actual_password) {
        header("Location: admin.php");
        exit();
    } else {
        $error_msg = "Email or password did not match";
    }
}


?>

<form action="authentication.php" id="form" method="POST" enctype="multipart/form-data">
    <h2>LOGIN</h2>
    <div class="form-control_container">
        <div class="form-control">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="inputs" required>
        </div>
        <div class="form-control">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="inputs" required>
        </div>
        <div class="form-control form-buttons">
            <span class='warning'><?php echo $error_msg ?></span>
            <input type="submit" value="LOGIN" name="login" class="input-submit" required>
        </div>
    </div>
</form>


<?php require './includes/footer.php' ?>