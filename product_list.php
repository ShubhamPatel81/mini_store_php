<?php
include 'config.php';
include 'blocks/main.php';
?>
<link rel="stylesheet" href="/styles/login.css">
<link rel="stylesheet" href="/styles/product_list.css">

<div class="page">
    <div class="page__products">
        <?php
        $products = $conn->query("SELECT * FROM products");
        if ($products > 0) {
            foreach ($products as $product) {
                $userId = $product['userId'];
                $userResult = $conn->query("SELECT * FROM Users WHERE id='$userId'");
                $user = $userResult->fetch_assoc();

                echo "<div class='product'>" .
                    "<a class='product__title' href='/product.php?id=$product[id]'>" . $product['title'] . "</a>" .
                    "<div class='product__header'><a>" . $user['username'] . "</a><span>" . $product['createdAt'] . "</span></div>" .
                    "<img src='" . $product['image'] . "' alt='" . $product['title'] . "' />" .
                    "</div>";
            }
        }
        ?>
    </div>
</div>

<?php
include 'blocks/footer.php';
?>