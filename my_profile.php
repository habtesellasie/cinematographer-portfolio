<?php

$header_title = 'My Profile';
$navigate_to = '';
$nav_item = '';
$style = './styles/my_profile-style.css';
require './includes/header.php';
$footer_title = '';

$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tanchiwedia';

$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
$statement = $pdo->query("SELECT * FROM admin");
$statement->execute();
$user = $statement->fetchAll(PDO::FETCH_ASSOC);
$id = $_POST['id'] ?? "";
// $actual_name = '';
// $actual_email = '';
// $actual_password = '';
$error_msg = '';

// foreach ($user as $adm) {
//     $actual_name = $adm['name'];
//     $actual_email = $adm['email'];
//     $actual_password = $adm['password'];
// }

if (isset($_POST['update'])) {
    $admin_name = htmlspecialchars(trim($_POST['name']));
    $admin_password = htmlspecialchars($_POST['password']);
    $admin_email = htmlspecialchars($_POST['email']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    $target_dir = './static_photos/';
    $photo = $_FILES['photo']['name'];
    $target_file_path = $target_dir . $photo;
    if ($_FILES['photo']['size'] > 0) {

        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file_path) && $admin_password === $confirm_password) {
                $updated = $pdo->prepare("UPDATE admin SET profile_picture = :profile_picture, name = :name, email = :email, password = :password WHERE id = :id");
                $updated->bindValue(":id", $id);
                $updated->bindValue(":profile_picture", $target_file_path);
                $updated->bindValue(":name", $admin_name);
                $updated->bindValue(':email', $admin_email);
                $updated->bindValue(":password", $admin_password);
                $updated->execute();
                header('Location: admin.php');
                exit();
            } else {
                $error_msg = "Failed to upload the photo.";
            }
        } else {
            $error_msg = 'Failed to upload the photo';
        }
    } else {
        if ($admin_password === $confirm_password) {
            $statement = $pdo->prepare("SELECT * FROM admin WHERE id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            $this_user = $statement->fetch(PDO::FETCH_ASSOC);
            $updated = $pdo->prepare("UPDATE admin SET profile_picture = :profile_picture, name = :name, email = :email, password = :password WHERE id = :id");
            $updated->bindValue(":id", $id);
            $updated->bindValue(":profile_picture", $this_user['profile_picture']);
            $updated->bindValue(":name", $admin_name);
            $updated->bindValue(':email', $admin_email);
            $updated->bindValue(":password", $admin_password);
            $updated->execute();
            header('Location: admin.php');
            exit();
        } else {
            $error_msg = "Passwords do not match";
        }
    }
}

?>

<h1 style="padding: 23px 0px 5px 32px; color: var(--clr-welldone);">My Profile</h1>
<form action="my_profile.php" id="form" method="POST" enctype="multipart/form-data">
    <?php foreach ($user as $admin) : ?>
        <div class="image-wrapper">
            <img src="<?php echo $admin['profile_picture'] ?>" alt="">
        </div>
        <div class="form-control" style="margin: 0;">
            <label for="photo" id="update-pp">Update profile picture:</label>
            <input type="file" name="photo" id="photo">
        </div>
        <div class="passwords">
            <div class="form-control">
                <input type="hidden" name="id" value="<?php echo $admin['id'] ?>">
                <label class="label" for="name">Name:</label>
                <input type="text" name="name" id="name" required value="<?php echo isset($_POST['name']) ? $_POST['name'] : $admin['name'] ?>" class="inputs">
            </div>
        </div>
        </div>
        <div class="form-control">
            <label class="label" for="email">Email: </label>
            <input type="email" name="email" id="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : $admin['email'] ?>" class="inputs">
        </div>
        <div class="passwords">
            <!-- <div class="form-control">
                <label class="label" for="password">Old Password: </label>
                <input type="password" name="password" id="password" required class="inputs">
            </div> -->
            <div class="form-control">
                <label class="label" for="password">New Password: </label>
                <input type="password" name="password" id="password" required value="<?php echo isset($_POST['password']) ? $_POST['password'] : $admin['password'] ?>" class="inputs">
            </div>
            <div class="form-control">
                <label class="label" for="confirm_password">Confirm Password: </label>
                <input type="password" name="confirm_password" id="confirm_password" class="inputs" required>
                <span class="<?php echo $error_msg ? 'warning' : '' ?>"><?php echo $error_msg ?></span>
            </div>
        </div>
        <div class="form-control flex">
            <input type="hidden" value="<?php echo $admin['id'] ?>">
            <input type="submit" class="input-submit" name="update" id="update" value="Update">
            <a href="admin.php" class="cancel">Cancel</a>
        </div>
        <div class="form-control">
        <?php endforeach; ?>
        </div>
</form>

<?php require './includes/footer.php' ?>