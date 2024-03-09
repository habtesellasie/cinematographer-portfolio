<?php
$header_title = 'UPDATE PAGE';
$navigate_to = './admin.php';
$nav_item = 'ADMIN';
$style = './styles/post.css';
require './includes/header.php';

$footer_title = 'UPDATE';
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tanchiwedia';
$id = $_POST['id'] ?? "";

$exposure = '';
$focus = '';
$focal_length = '';
$device_model = '';

try {
    $pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $query->bindValue(':id', $_POST['id']);
    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $exposure = htmlspecialchars(trim($_POST['exposure']));
        $focus = htmlspecialchars(trim($_POST['focus']));
        $focal_length = htmlspecialchars(trim($_POST['focal_length']));
        $device_model = htmlspecialchars(trim($_POST['device_model']));
        $description = htmlspecialchars(trim($_POST['description']));
        $is_landscape = htmlspecialchars($_POST['is_landscape']);

        $photo = $_FILES['photo']['name'];
        $targetDirectory = './gallery/';
        $targetFilePath = $targetDirectory . $photo;

        if ($is_landscape) {
            $is_landscape = 1;
        } else {
            $is_landscape = 0;
        }
        if ($_FILES['photo']['size'] > 0) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                $statement = $pdo->prepare("UPDATE posts SET photo = :photo WHERE id = :id");
                $statement->bindValue(':photo', $targetFilePath);
                $statement->bindValue(':id', $id);
                $statement->execute();
            } else {
                echo 'Failed to upload the photo.';
            }
        }


        $statement = $pdo->prepare("UPDATE posts SET exposure = :exposure, focus = :focus, focal_length = :focal_length, device_model = :device_model, description = :description, is_landscape = :is_landscape WHERE id = :id");
        $statement->bindValue(':exposure', $exposure);
        $statement->bindValue(':focus', $focus);
        $statement->bindValue(':focal_length', $focal_length);
        $statement->bindValue(':device_model', $device_model);
        $statement->bindValue(':description', $description);
        $statement->bindValue(":is_landscape", $is_landscape);
        $statement->bindValue(':id', $id);
        $statement->execute();
        header('Location: admin.php');
        exit();
    } else if (isset($_POST['cancel'])) {
        header('Location: admin.php');
        exit();
    }
} catch (PDOException $error) {
    echo 'Connection Failed: ' . $error->getMessage();
}

?>
<div class="form-container">
    <form action="update.php" method="post" enctype="multipart/form-data" id="form">
        <div class="form-control_container">
            <h1 style="padding-left: 10px;font-size: clamp(22px, 2vw, 28px);">UPDATE POST</h1>
            <?php foreach ($posts as $post) : ?>
                <div class="form-control">
                    <div class="photo-hold <?php echo $post['is_landscape'] ? 'landscape_holder' : 'portrait' ?>">
                        <img src="<?= $post['photo'] ?>" alt="<?= $post['description'] ?>" width="125px">
                    </div>
                    <label for="photo">Update Picture</label>
                    <input type="file" id="photo" name="photo" class="choose-file">
                    <span class='warning'>max ~ 250KB</span>
                </div>
                <div class="form-control_landscape">
                    <input type="checkbox" name="is_landscape" id="is_landscape" <?php echo $post['is_landscape'] ? 'checked' : 'unchecked' ?> class="inputs">
                    <label for="is_landscape">Landscape</label>
                </div>
                <div class="form-control">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <label for="exposure" class="label">Exposure</label>
                    <input type="text" name="exposure" id="exposure" max="20" value="<?= $post['exposure'] ?>" class="inputs">
                    <span class='warning'>max 20 characters</span>
                </div>
                <div class="form-control">
                    <label for="focus" class="label">Focus</label>
                    <input type="text" name="focus" id="focus" value="<?= $post['focus'] ?>" class="inputs">
                    <span class='warning'>max 20 characters</span>
                </div>
                <div class="form-control">
                    <label for="focal_length" class="label">Focal Length</label>
                    <input type="text" name="focal_length" id="focal_length" value="<?= $post['focal_length'] ?>" class="inputs">
                    <span class='warning'>max 20 characters</span>
                </div>
                <div class="form-control">
                    <label for="device_model" class="label">Device Model</label>
                    <input type="text" name="device_model" class="dv-mod inputs" id="device_model" value="<?= $post['device_model'] ?>">
                    <span class='warning'>max 128 characters</span>
                </div>
                <div class="form-control">
                    <label for="description" class="label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="inputs"><?= $post['description'] ?></textarea>
                    <span class='warning'>max 256 characters</span>
                </div>
                <div class="form-control form-buttons">
                    <input type="submit" value="UPDATE" name="update" class="input-submit">
                    <input type="submit" value="CANCEL" name="cancel" class="cancel input-submit">
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</div>

<?php require './includes/footer.php' ?>