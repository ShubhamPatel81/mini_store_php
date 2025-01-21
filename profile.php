<?php
include 'config.php';
include 'blocks/main.php';
?>
<link rel="stylesheet" href="/styles/profile.css">

<div class="page">
    <div class='page__item'>
        <?php
        $userUsername = $_GET['username'];
        $sql = "SELECT * FROM Users WHERE username='$userUsername'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        echo "<div class='page__item__right'><h1>$user[username]</h1><h3>$user[email]</h3></div>";
        ?>
    </div>
</div>

<?php
include 'blocks/footer.php';
?>