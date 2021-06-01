<?php include('./config/database.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>User Registration and Login System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 25rem;">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">User Profile</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php echo $_SESSION['firstname']; ?>
                        <?php echo $_SESSION['lastname']; ?>
                        <p class="card-text">Email address: <?php echo $_SESSION['email']; ?></p>
                        <p class="card-text">Username: <?php echo $_SESSION['username']; ?></p>
                        <a class="btn btn-danger btn-block" href="logout.php">Log out</a>
                    </h6>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
