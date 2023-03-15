<?php
    session_start();
    if (!isset($_SESSION["user"])) { 
        header("Location: login.html"); //redirects to login page if not logged in 
    }
    else{
        header("Location: profile.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="/js/profile.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        
        <?php
        if (isset($_POST["submit"])) {
            //connection to MongoDB
            $mongoClient = new MongoDB\Client('mongodb://mongodb-deployment:27017'); //'mongodb://localhost:27017'
            $collection = $mongoClient-> login-register -> login-register-collection;

            // retrieve form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $dob = $_POST['dob'];

            // create document to store in MongoDB
            $document = [
                'name' => $name,
                'email' => $email,
                'contact' => $contact,
                'dob' => $dob
            ];

            // insert document into MongoDB collection
            $insertOneResult = $collection->insertOne($document);

            // check if insertion was successful
            if ($insertOneResult->getInsertedCount() == 1) {
                echo "User data has been successfully updated";
            } else {
                echo "Something went wrong!";
            }
        }
        ?>
    

        <div class="alert alert-success" role="alert" style="text-align:center"><div class="text-center"><div><br>
            
            <p>Updated Successfully</p></div></div>
        </div>

    </div>
    

</body>

</html>