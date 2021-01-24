<?php

session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="text-align: center;padding-top: 100px">

<?php
$msg = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $image = $_FILES['image']['tmp_name'];
    $img = file_get_contents($image);
//    $pname=$_POST('name');
//    $pcost=$_POST('cost');
    $con = mysqli_connect('localhost','root','','webmini') or die('Unable To connect');
    $sql = "INSERT INTO `imagelist`(image,name,cost) VALUES (?,?,?)";
    $stmt = mysqli_prepare($con,$sql);

    mysqli_stmt_bind_param($stmt, "ssi",$img,$name,$cost);
    $name=$_POST['name'];
    $cost=$_POST['cost'];
    if (empty($img)) { array_push($errors, "Image is required"); }
    elseif (empty($name)) { array_push($errors, "Name is required"); }
    elseif (empty($cost)) { array_push($errors, "Cost is required"); }
    else{
        mysqli_stmt_execute($stmt);
    }
//    $query = "INSERT INTO register (email, password) VALUES('$email', '$password')";
//  	mysqli_query($db, $query);
    $check = mysqli_stmt_affected_rows($stmt);
    if($check==1){
        $msg = 'Image Successfully Uploaded';
    }else{
        $msg = 'Error uploading image';
    }
    mysqli_close($con);
}
?>
<form action="index.php" method="post" enctype="multipart/form-data">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="image">Select Image of food item:</label>
    <input type="file" name="image" /><br/><br/>
    <label for="name">Enter Name of food item:</label>
    <input type="text" name="name" /><br/><br/>
    <label for="cost">Enter Cost of food item:</label>
    <input type="text" name="cost" /><br/><br/>
    <button>Upload</button>
</form>
<p style="color: #dff0d8">
<?php
echo $msg;
?>
</p>
</body>
</html>