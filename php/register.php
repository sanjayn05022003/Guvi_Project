<?php
session_start();
if (isset($_SESSION["user"])) { 
   header("Location: profile.php"); //redirects to dashboard if logged in 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>
<body>
    <div class="container">
        
        <?php
         if(isset($_POST["submit"])){
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if(empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
                array_push($errors, "All fields are required");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
            if(strlen($password)<8){
                array_push($errors, "Password must be atleast 8 characters long");
            }
            if($password!=$passwordRepeat){
                array_push($errors, "Password does not match");
            }

            require_once "database.php";

            $sql= "SELECT * FROM users WHERE email = '$email'";
            $result= mysqli_query($conn, $sql);
            $rowCount= mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors, "Email already exists!");
            }

            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                } 
            }

            else{
                //insert into db
                
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";

                //USE OF PREPARED STATEMENTS
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                if($prepareStmt){
                    // echo json_encode(array('success' => true));

                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash); //sss-> 3 strings
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'> You are registered successfully.</div>";

                
                }
                else{
                    die("Something went wrong!");
                }
            }
        } 
        ?>
    
    <div class="alert alert-warning" role="alert" style="text-align:center"><div class="text-center"><div><br><p>Register again <a href="register.html">Register</a></p></div></div></div>
    <div class="alert alert-success" role="alert" style="text-align:center"><div class="text-center"><div><br><p>Login <a href="login.html">Login</a></p></div></div></div>
    </div>
</body>

</html>