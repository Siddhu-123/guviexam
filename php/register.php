<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}


if ( ! preg_match("/[a-z]/i", $_POST["password_confirmation"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["phone"])) {
    die("Password must contain at least one number");
}
if (empty($_POST["dateofbirth"])) {
    die("date of birth is required");
}
if (empty($_POST["address"])) {
    die("address is required");
}

$password_hash = password_hash($_POST["password_confirmation"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash, phone, dob, address)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param(
    "sssiss",
    $_POST["name"],
    $_POST["email"],
    $password_hash,
    $_POST["phone"],
    $_POST["dateofbirth"],
    $_POST["address"]
);

if ($stmt->execute()) {
    header("Location: ../login.html");
    exit;
} else {
    if ($stmt->errno === 1062) {
        $error_message = "Email already taken";
        echo $error_message;
    } else {
        die("Error: " . $stmt->error . " " . $stmt->errno);
    }
}
?>