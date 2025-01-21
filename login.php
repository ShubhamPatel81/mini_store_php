<?php
    include 'config.php';
    include 'blocks/main.php';
?>
<link rel="stylesheet" href="/styles/login.css">

<div class="page">
    <img src="https://images.unsplash.com/photo-1645354730201-52d7e726c9e5?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fERvbGxob3VzZXxlbnwwfHwwfHx8MA%3D%3D" alt="DollHouse">
    <div class="page__item">
        <form method='POST' action="">
        <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST['Email'];
                    $password = $_POST['Password'];

                    $sql = "SELECT id, username, email FROM Users WHERE email='$email' AND password='$password'";
                    $is_user_exist = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($is_user_exist) > 0) {
                        $userData = $is_user_exist->fetch_assoc();

                        setcookie("UserUsername", $userData['username'], time() + (86400 * 30));
                        setcookie("UserID", $userData['id'], time() + (86400 * 30));
                        setcookie("UserEmail", $userData['email'], time() + (86400 * 30));

                        header("Location: /dashboard.php");
                        exit();
                    } else {
                        echo "<p style='background-color: #DD1323; color: white; padding: 10px; border-radius: 8px; width:100%; text-align:center' >Email or Password is incorrect!</p>";
                    }
                    
                }
            ?>

            <h1>Login</h2>

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
            <p>You don't have an account? 
                <a href="/registration.php">Registraion</a>
            </p>

        </form>
    </div>
    <img src="https://images.unsplash.com/photo-1645354730199-2ff21d0f874c?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fERvbGxob3VzZXxlbnwwfHwwfHx8MA%3D%3D" alt="DollHouse">
</div>

<?php
    include 'blocks/footer.php';
?>