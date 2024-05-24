<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION["user"]; // Retrieve username from session

//Vulnerable file upload code
if (isset($_POST["upload"])) {
    // Check if file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Check file size (arbitrarily large limit for demonstration)
        if ($_FILES["file"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            exit();
        }

        // Allow any file type (no proper validation)
        $uploadOk = 1;

        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded.";
    }

//File upload Secure code: 
// if (isset($_POST["upload"])) {
//     if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
//         $target_dir = "images/";
//         $uploadOk = 1;
//         $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
//         $check = getimagesize($_FILES["file"]["tmp_name"]);

//         // Check if image file is an actual image or fake image
//         if ($check !== false) {
//             echo "File is an image - " . $check["mime"] . ".";
//             $uploadOk = 1;
//         } else {
//             echo "File is not an image.";
//             $uploadOk = 0;
//         }

//         // Check file size
//         if ($_FILES["file"]["size"] > 500000) {
//             echo "Sorry, your file is too large.";
//             $uploadOk = 0;
//         }

//         // Allow certain file formats
//         $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
//         if (!in_array($imageFileType, $allowed_types)) {
//             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//             $uploadOk = 0;
//         }

//         // Rename the file to avoid using user-supplied names
//         $new_file_name = uniqid('img_', true) . '.' . $imageFileType;
//         $target_file = $target_dir . $new_file_name;
//         // Check if $uploadOk is set to 0 by an error
//         if ($uploadOk == 0) {
//             echo "Sorry, your file was not uploaded.";
//         } else {
//             // if everything is ok, try to upload file
//             if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
//                 echo "The file " . basename($_FILES["file"]["name"])  . " has been uploaded.";
//             } else {
//                 echo "Sorry, there was an error uploading your file.";
//             }
//         }
//     } else {
//         echo "No file uploaded.";
//     }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Welcome, <?php echo htmlspecialchars($username); ?></h1> <!-- Display username -->
        <h2>Upload Profile Picture</h2>
        <form action="" method="post" enctype="multipart/form-data" class="mt-3">
            <div class="mb-3">
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" name="upload">Upload</button>
        </form>
        <?php if (isset($target_file)) : ?>
            <div class="mt-3">
                <p>Uploaded file:</p>
                <img src="<?php echo htmlspecialchars($target_file); ?>" alt="Profile Picture" class="img-thumbnail" style="max-width: 200px;">
            </div>
        <?php endif; ?>

        <div class="button-container">
       <!-- Home button -->
        <form action="product.php" method="post" class="log-out-btn">
            <button type="submit" class="btn btn-success">Go To Shop</button>
        </form>

        <!-- Logout button -->
        <form action="logout.php" method="post" class="log-out-btn">
            <button type="submit" class="btn btn-danger">Log Out</button>
        </form>
        </div>
    </div>
    
</body>

</html>