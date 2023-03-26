<?php
if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
    die("Image file is required");
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']))
{
    // Check if file was uploaded successfully
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("File upload failed with error code: " . $_FILES['image']['error']);
    }

    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext_arr = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext_arr));
    $file_contents = file_get_contents($file_tmp);

    // $extensions = array("jpeg","jpg","png","gif");
    $extensions = array("png");

    if(in_array($file_ext,$extensions) === false){
        // echo "Extension not allowed, please choose a JPEG, JPG, PNG, or GIF file.";
        echo "Extension not allowed, please choose a PNG file.";
        exit();
    }

    if($file_size > 2097152) {
        echo 'File size must be less than 2 MB';
        exit();
    }
}

// echo "File contents: " . $file_contents . "<br>";
// var_dump($file_contents);
// var_dump($image_data);

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connection.php";

$sql = "INSERT INTO users (name, email, admin, userName, pass, profileImage)
        VALUES (?, ?, ?, ?, ?, ?)";
$inserted_id = mysqli_insert_id($mysqli);
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$admin=0;
// $null = null;
$image_data = file_get_contents($_FILES['image']['tmp_name']);
$stmt->bind_param("ssisss",
                  $_POST["name"],
                  $_POST["email"],
                  $admin,
                  $_POST['userName'],
                  $password_hash,
                  $image_data);

$param = $mysqli->stmt_init();
$param->prepare("UPDATE users SET profileImage = ? WHERE id = ?");
// $param->bind_param("bi", $file_contents, $inserted_id);
// $param->send_long_data(0, $file_contents);
                                 
if ($stmt->execute()) {
    $param->bind_param("bi", $file_contents, $inserted_id);
    $param->send_long_data(0, $file_contents);
    $param->execute();
    header("Location: ../pages/index.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}



