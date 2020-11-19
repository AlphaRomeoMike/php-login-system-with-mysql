<?php
include 'config.php';
?>

<!doctype html>
<html lang="en">

<head>
    <title>Registeration</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="container">
    <br>
    <div class="jumbotron">
        <h3 class="text-center">Register Here</h3>
    </div>

    <form action="" class="form-group" method="POST">
        <label>Username:</label>
        <input type="text" name="user_name" placeholder="Enter your name" class="form-control" /> <br />
        <label>Email:</label>
        <input type="text" name="user_email" placeholder="Enter your email" class="form-control" /> <br />
        <label>Password:</label>
        <input type="password" name="user_pass" placeholder="Enter your password" class="form-control" /> <br />
        <label>Confirm Password:</label>
        <input type="password" name="user_cpass" placeholder="Confirm your password" class="form-control" /> <br />
        <input type="submit" name="submit" value="Submit" class="btn btn-dark col-md" /> <br />
        <div class="text-center"><a href="login.php" class="btn btn-link">Already a member? Login!</a></div>

        <?php
        if (empty($_SESSION["user_name"])) {
            if (isset($_POST['submit']) && !empty($_POST['user_name']) && !empty($_POST['user_email']) && !empty($_POST['user_pass']) && !empty($_POST['user_cpass'])) {
                $user_name  = validate($_POST['user_name']);
                $user_email = validate($_POST['user_email']);
                $user_pass  = validate($_POST['user_pass']);
                $user_cpass = validate($_POST['user_cpass']);
                $time       = date("d-m-Y h:i:sa");

                // echo $time;
                // echo $user_name, $user_email, $user_pass;

                //CHECKING FOR ALREADY PRESENT USERS
                $sql = "SELECT * FROM tbl_users WHERE usr_name = '$user_name' OR usr_email = '$user_email'";
                $res = mysqli_query($con, $sql);
                $row = mysqli_num_rows($res);

                if ($row > 0) {
                    echo '<p class="alert alert-danger">Username or email already taken</p>';
                } elseif ($user_pass != $user_cpass) {
                    echo '<p class="alert alert-warning">Passwords do not match</p>';
                } else {

                    //INSERT INTO DATABASE
                    $sql_i = "INSERT INTO tbl_users (usr_name, usr_email, usr_pass, created_at) VALUES ('$user_name', '$user_email', '$user_pass', '$time')";
                    $res_i = mysqli_query($con, $sql_i);
                    if ($res_i) {
                        echo '<p class="alert alert-success">User has been registered successfully</p>';
                        header("location:login.php");
                    } else {
                        echo '<p class="alert alert-dark">User could not be registered</p>';
                    }
                    // var_dump($sql_i);
                    // die();
                }
            } else {
                echo '<p class="alert alert-info">Please fill all fields</p>';
            }
        } else {
            header("location:profile.php");
        }
        ?>
    </form>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>