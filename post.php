<?php

$header_title = 'POST PAGE';
$navigate_to = './admin.php';
$nav_item = 'ADMIN';
$style = './styles/post.css';

require './includes/header.php';

$footer_title = 'POST';
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tanchiwedia';
$id = $_POST['id'] ?? "";

$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {

    if (isset($_POST['post'])) {
        $exposure = htmlspecialchars(trim($_POST['exposure']));
        $focus = htmlspecialchars(trim($_POST['focus']));
        $focal_length = htmlspecialchars(trim($_POST['focal_length']));
        $device_model = htmlspecialchars(trim($_POST['device_model']));
        $description = htmlspecialchars(trim($_POST['description']));
        $photo = $_FILES['photo']['name'];
        $is_landscape = htmlspecialchars($_POST['is_landscape']);
        $targetDirectory = './gallery/';
        $targetFilePath = $targetDirectory . $photo;



        if ($is_landscape) {
            $is_landscape = 1;
        } else {
            $is_landscape = 0;
        }
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
            $statement = $pdo->prepare("INSERT INTO posts (exposure, focus, focal_length, device_model, description, photo, is_landscape) VALUES (:exposure, :focus, :focal_length, :device_model, :description, :photo, :is_landscape)");
            $statement->bindValue(":exposure", $exposure);
            $statement->bindValue(":focus", $focus);
            $statement->bindValue(":focal_length", $focal_length);
            $statement->bindValue(":device_model", $device_model);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":photo", $targetFilePath);
            $statement->bindValue(":is_landscape", $is_landscape);

            $statement->execute();
            header("Location: admin.php");
            exit();
        } else {
            echo "Failed to upload the photo";
        }
    }
} catch (PDOException $error) {
    echo "Connection Failed: " . $error->getMessage();
}

?>
<div class="form-container">

    <form action="post.php" id="form" method="POST" enctype="multipart/form-data">
        <div class="form-control_container">


            <div class="form-control">
                <h1>POST</h1>
                <label for="photo">Upload Picture</label>
                <input type="file" id="photo" name="photo" required>
                <span class='warning'>max ~ 250KB</span>
            </div>
            <div class="form-control_landscape">
                <input type="checkbox" name="is_landscape" id="is_landscape">
                <label for="is_landscape" class="is_landscape" class="label">Landscape</label>
            </div>
            <div class="form-control">
                <label for="exposure" class="label">Exposure</label>
                <input type="text" name="exposure" id="exposure" max="20" class="inputs">
                <span class='warning'>max 20 characters</span>
            </div>
            <div class="form-control">
                <label for="focus" class="label">Focus</label>
                <input type="text" name="focus" id="focus" class="inputs">
                <span class='warning'>max 20 characters</span>
            </div>
            <div class="form-control">
                <label for="focal_length" class="label">Focal Length</label>
                <input type="text" name="focal_length" id="focal_length" class="inputs">
                <span class='warning'>max 20 characters</span>
            </div>
            <div class="form-control">
                <label for="device_model" class="label">Device Model</label>
                <input type="text" name="device_model" class="dv-mod inputs" id="device_model">
                <span class='warning'>max 128 characters</span>
            </div>
            <div class="form-control desc">
                <label for="description" class="label">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="inputs"></textarea>
                <span class='warning'>max 256 characters</span>
            </div>

            <div class="form-control form-buttons">
                <input type="submit" value="POST" name="post" class="input-submit">
                <a href="admin.php" class="input-submit cancel">CANCEL</a>
            </div>
        </div>
    </form>
</div>

<!-- <style style="display: block; border: solid black;margin: 0rem 2rem; width: 250px; height: 250px;" contenteditable="true"> -->
<!-- </style> -->
<?php require './includes/footer.php' ?>