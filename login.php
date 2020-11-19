<?php
    include 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="container">
    <br>
    <div class="jumbotron">
        <h3 class="text-center">Login Here</h3>
    </div>

    <form action="" class="form-group" method="POST">
        <label>Email:</label>
        <input type="text" name="name_email" placeholder="Enter your email" class="form-control"/> <br />
        <label>Password:</label>
        <input type="password" name="user_pass" placeholder="Enter your password" class="form-control"/> <br />
        <input type="submit" name="login" value="Submit" class="btn btn-dark col-md" /> <br />
        <div class="text-center"><a href="index.php" class="btn btn-link">Not a member? Sign up!</a></div>

        <?php
            if(isset($_POST['login'])) {
                $text = validate($_POST['name_email']);
                $pass = validate($_POST['user_pass']);

                //CHECKING FOR USERNAME OR EMAIL (AUTHENTICATION)
                $sql = "SELECT * FROM tbl_users WHERE usr_name = '$text' OR usr_email = '$text' AND usr_pass = '$pass' LIMIT 1";
                
                $res = mysqli_query($con, $sql);
                if ($row = mysqli_num_rows($res) > 0) {
                    $rows = mysqli_fetch_assoc($res);
                    session_start();
                    $user_name              = $rows["usr_name"];
                    $user_id                = $rows["user_id"];
                    $user_email             = $rows["usr_email"];
                    $_SESSION["user_name"]  = $user_name;
                    $_SESSION["user_id"]    = $user_id;
                    $_SESSION["user_email"] = $user_email;
                    header("location: profile.php");
                }
                else {
                    echo '<p class="alert alert-danger">No such user exists</p>';
                    header("refresh:5; location:index.php");
                }
            } 
        ?>
    </form>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>