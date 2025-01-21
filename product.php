<?php
include 'config.php';
include 'blocks/main.php';
?>
<link rel="stylesheet" href="/styles/product.css">

<div class="page">
    <div class="page__header">
        <p>/<a href="/product_list.php">Product List</a>/<?= $_GET['id']; ?></p>
    </div>
    <div class='page__item'>
        <?php
        $postId = $_GET['id'];

        if (!filter_var($postId, FILTER_VALIDATE_INT)) {
            die('Invalid post ID');
        }

        $sql = "SELECT * FROM products WHERE id = '$postId'";
        $result = $conn->query($sql);

        if ($result) {
            $product = $result->fetch_assoc();

            $userId = $product['userId'];
            $userResult = $conn->query("SELECT  * FROM Users WHERE id='$userId'");
            $user = $userResult->fetch_assoc();

            echo "<div class='product__header'><h1>$product[title]</h1> <h2>$product[price].00$</h2></div>" .
                "<div class='product__header'><a>" . $user['username'] . "</a><span>" . $product['createdAt'] . "</span></div>" .
                "<img src='$product[image]' alt='$product[title]' />" .
                "<div class='product__text'>" . $product['description'] . "</div>";
        }
        ?>
    </div>
</div>

<?php
include 'blocks/footer.php';
?>