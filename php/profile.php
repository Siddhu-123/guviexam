<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<div class="custom-container container">
    <div class="mb-3 d-flex flex-row justify-content-between">
        <h1 class="text-start">Home</h1>
        <img src="../photo.JPG" class="rounded-circle img-fluid">
    </div>
    <?php if (isset($user)): ?>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Hello, <?= htmlspecialchars($user["name"]) ?></h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email: <?= htmlspecialchars($user["email"]) ?></li>
                    <li class="list-group-item">Phone Number: <?= htmlspecialchars($user["phone"]) ?></li>
                    <li class="list-group-item">Date of Birth: <?= htmlspecialchars($user["dob"]) ?></li>
                    <li class="list-group-item">Address: <?= htmlspecialchars($user["address"]) ?></li>
                </ul>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="update-register.php" class="btn btn-primary me-md-2">Update</a>
                    <a href="logout.php" class="btn btn-primary">Log out</a>
                </div>
            </div>
        </div>
        
    <?php else: ?>
        
        <div class="d-flex justify-content-center mt-3">
            <a href="login.php" class="btn btn-primary me-2">Log in</a>
            <p class="align-self-center"> or </p>
            <a href="../register.html" class="btn btn-secondary ms-2">Sign up</a>
        </div>
        
    <?php endif; ?>
</div>

</body>
</html>