<?php
include 'config.php';
include 'blocks/main.php';
?>
<link rel="stylesheet" href="/styles/dashboard.css">


<div class="page">
    <div class="page__content">
        <div class="page__content__left">
            <form method="POST" action="" enctype="multipart/form-data">
                <h2>Create New Product</h2>

                <div class="form__field">
                    <label for="">Title:</label>
                    <input type="text" name="title" placeholder="Enter your title..." required />
                </div>

                <div class="form__field">
                    <label for="">Description:</label>
                    <textarea name="description" placeholder="Enter description..."></textarea>
                </div>

                <div class="form__line">
                    <div class="form__field">
                        <label for="">Price:</label>
                        <input type="number" name="price" required />
                    </div>
                    <div class="form__field">
                        <label for="">Image:</label>
                        <input type="file" name="image" required />
                    </div>

                    <input type="hidden" name="type" value="create_new_product" required />
                </div>
                <button class="btn">Save</button>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $type = $_POST['type'];

                    if ($type == "create_new_product") {
                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                        $check = getimagesize($_FILES["image"]["tmp_name"]);

                        if ($check !== false) {
                            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                            $title = $_POST['title'];
                            $description = $_POST['description'];
                            $price = $_POST['price'];
                            $image = "/uploads/" . $_FILES["image"]["name"];
                            $date_now = date("Y/m/d");

                            $sql = "INSERT INTO products (title, description, price, image, userId, createdAt) VALUES ('$title', '$description', '$price', '$image', '$user_id', '$date_now')";
                            $result = $conn->query($sql);

                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }
                }
                ?>
            </form>
        </div>
        <div class="page__content__right">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>User ID</th>
                    <th>CreatedAt</th>
                    <th>Delete</th>
                </tr>
                <?php
                $products = $conn->query("SELECT * FROM products");
                if ($products > 0) {
                    foreach ($products as $product) {
                        echo "<tr><td>" .
                            $product['id'] . "</td><td>" .
                            $product['title'] . "</td><td>" .
                            $product['price'] . "$" . "</td><td>" .
                            "<img src='$product[image]' alt='image' />" . "</td><td>" .
                            $product['userId'] . "</td><td>" .
                            $product['createdAt'] . "</td><td>" .
                            "<form method='POST'>
                                <input type='hidden' name='product_id' value='$product[id]' />
                                <input type='hidden' name='type' value='delete_product' />
                                <button class='btn'>Del</button>
                            </form>" .
                            "</td></tr>";
                    }
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $type = $_POST['type'];

                    if ($type == 'delete_product') {
                        $product_id = $_POST['product_id'];
                        $sql = "DELETE FROM products WHERE id='$product_id'";
                        $result = $conn->query($sql);
                        echo "<script>window.location.href='/dashboard.php'</script>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>


<?php
include 'blocks/footer.php';
?>