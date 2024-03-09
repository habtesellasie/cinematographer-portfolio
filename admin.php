<?php
$header_title = 'ADMIN PAGE';
$navigate_to = './post.php';
$nav_item = 'POST';
$style = './styles/admin_style.css';
require './includes/header.php';
$footer_title = 'ADMIN';

$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tanchiwedia';

$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $pdo->query("SELECT * FROM posts");
$posts = $query->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->query("SELECT * FROM admin");
$statement->execute();
$user = $statement->fetchAll(PDO::FETCH_ASSOC);
$thePhoto = '';
foreach ($user as $admin) {
    $thePhoto = $admin['profile_picture'];
}
?>

<div class="dashboard-hero">
    <div class="dashboard">

        <div class="dashboard__title">
            <h2 class="posts-title">Admin Dashboard</h2>
            <h2 class="new-post"><a href="post.php">POST NEW</a></h2>
        </div>
        <a class="img-container" href="my_profile.php">
            <div class="dashboard__image-container">
                <img src="<?php echo $thePhoto ?>" alt="" width="55px" class="dashboard__img">
            </div>
            <span>Profile</span>
        </a>
    </div>
</div>
<?php if (empty($posts)) : ?>
    <h3 style="width: 100vw; height: 70vh; display: flex;justify-content: center;align-items: center;">Records you post appear &nbsp;<a href="post.php" style="color: var(--clr-light-blue)">here.</a></h3>
<?php else : ?>
    <div class="grid_container">
        <?php foreach ($posts as $post) : ?>
            <div class="grid">
                <div class="content">
                    <div class="head">
                        <span><?php echo $post['is_landscape'] ? 'Landscape' : 'Portrait' ?></span>
                        <div class="button_container">
                            <form action="update.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
                                <input type="submit" name="submit" value='Update' class="update-button">
                            </form>
                            <form action="delete.php" method="POST" class="delete" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                <input type="submit" value="Delete" class="delete-button">
                            </form>
                        </div>
                    </div>
                    <div class="grid_contents">

                        <div class="image_wrapper">
                            <img src="<?php echo $post['photo'] ?>" alt="" class="<?php echo $post['is_landscape'] ? 'landscape' : '' ?>">
                        </div>
                        <div class="description">
                            <p>Exposure: <span class="<?php echo ($post['exposure'] == null) ? "not-provided" : ''  ?>"><?php echo ($post['exposure'] == null) ?  'Not provided' : $post['exposure']   ?></span> </p>
                            <p>Focus: <span class="<?php echo ($post['focus'] == null) ? "not-provided" : ''  ?>"><?php echo ($post['focus'] == null) ? 'Not provided' : $post['focus'] ?></span> </p>
                            <p>Focal Length: <span class="<?php echo ($post['focal_length'] == null) ? "not-provided" : ''  ?>"><?php echo ($post['focal_length'] == null) ? 'Not provided' : $post['focal_length']  ?></span> </p>
                            <p>Device Model: <span class="<?php echo ($post['device_model'] == null) ? "not-provided" : ''  ?>"><?php echo ($post['device_model'] == null) ? 'Not provided' : $post['device_model']  ?></span> </p>
                            <p>Description: <span class="<?php echo ($post['description'] == null) ? "not-provided" : ''  ?>"><?php echo ($post['description'] == null) ? 'Not provided' : $post['description'] ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>


    <script src="index.js">
    </script>


    <?php require './includes/footer.php' ?>