<?php
session_start();
if (isset($_SESSION["user"])) { 
   header("Location: profile.html"); //redirects to dashboard if logged in 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes"; 
                    header("Location: profile.html");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";                    
                }
            }else{
                echo "<div class='alert alert-danger'>Please fill all the fields</div>";
            }
        }
        ?>
        <div class="alert alert-success" role="alert" style="text-align:center"><div class="text-center"><div><br>
        
        <p>Login Again<a href="login.html"><br>Login</a></p></div></div></div>
    </div>
</body>
</html>
