<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="/styles/main.css">

    <title>Mini Store</title>
</head>

<body>

    <?php
    $user_id = '';
    $user_email = '';
    $user_username = '';

    if (isset($_COOKIE['UserID'])) {
        $user_id = $_COOKIE['UserID'];
        $user_email = $_COOKIE['UserEmail'];
        $user_username = $_COOKIE['UserUsername'];
    }
    ?>

    <?php if (isset($_COOKIE['UserID'])) { ?>

        <header>
            <div class="header__item">
                <div class="">
                    <a href="/product_list.php">Product List</a>
                    <a href="/dashboard.php">Dashboard</a>
                    <a href="/profile.php?username=<?= $user_username ?>"><?= $user_username ?></a>
                    <form method="POST" action="">
                        <input type="hidden" name="type" value="logout">
                        <button class="btn">Logout</button>
                    </form>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $type = $_POST['type'];

                        if ($type == 'logout') {
                            setcookie("UserUsername", '', time() - 3600);
                            setcookie("UserID", '', time() - 3600);
                            setcookie("UserEmail", '', time() - 3600);

                            header("Location: /login.php");
                            exit();
                        }
                    }
                    ?>
                </div>
            </div>
        </header>

    <?php } ?>
</body>

</html>