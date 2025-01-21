<?php
    include 'config.php';
    include 'blocks/main.php';
?>
<link rel="stylesheet" href="/styles/login.css">

<div class="page">
    <img src="https://images.unsplash.com/photo-1645354730201-52d7e726c9e5?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fERvbGxob3VzZXxlbnwwfHwwfHx8MA%3D%3D" alt="DollHouse">
    <div class="page__item">
        <form method='POST' action="/registration.php">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['Username'];
                $email = $_POST['Email'];
                $password = $_POST['Password'];
                $date_now = date("Y/m/d");

                $check_sql = "SELECT ID FROM Users WHERE email='$email' OR username='$username'";
                $is_user_exist = $conn->query($check_sql);

                if (mysqli_num_rows($is_user_exist) == 0) {
                    $sql = "INSERT INTO Users (username, email, password, photo, createdAt) VALUES ('$username', '$email', '$password', '...', '$date_now')";
                    $result = $conn->query($sql);

                    if ($result) {
                        $insertedUserId = $conn->insert_id; 

                        $fetchUserSql = "SELECT * FROM Users WHERE ID = $insertedUserId";
                        $userResult = $conn->query($fetchUserSql);

                        if ($userResult) {
                            $userData = $userResult->fetch_assoc();

                            setcookie("UserUsername", $userData['username'], time() + (86400 * 30));
                            setcookie("UserID", $userData['id'], time() + (86400 * 30));
                            setcookie("UserEmail", $userData['email'], time() + (86400 * 30));

                            header("Location: /dashboard.php");
                            exit();
                        } else {
                            echo "<p style='background-color: #DD1323; color: white; padding: 10px; border-radius: 8px; width:100%; text-align:center' >User data retrieval failed!</p>";
                        }
                    } else {
                        echo "<p style='background-color: #DD1323; color: white; padding: 10px; border-radius: 8px; width:100%; text-align:center' >User didn't create!</p>";
                    }

                } else {
                    echo "<p style='background-color: #DD1323; color: white; padding: 10px; border-radius: 8px; width:100%; text-align:center' >User is exist!</p>";
                }
            }
        ?>
            
            <h1>Registraion</h2>

            <div class="form__field">
                <label for="">Username</label>
                <input type="text" 
                    name="Username" 
                    placeholder="Enter your username..." 
                    required />
            </div>

            <div class="form__field">
                <label for="">Email</label>
                <input type="email" 
                    name="Email" 
                    placeholder="Enter your email..." 
                    required />
            </div>

            <div class="form__field">
                <label for="">Password</label>
                <input type="password" 
                    name="Password" 
                    placeholder="Enter your password..." 
                    required />
            </div>

            <button class="btn">Continue</button>
            <p>You have an account? 
                <a href="/login.php">Login</a>
            </p>

        </form>
    </div>
    <img src="https://images.unsplash.com/photo-1645354730199-2ff21d0f874c?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fERvbGxob3VzZXxlbnwwfHwwfHx8MA%3D%3D" alt="DollHouse">
</div>

<?php
    include 'blocks/footer.php';
?>