<?php
include 'db.php';

if (isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE UserID = :UserID");
    $stmt->bindParam(':UserID', $UserID);
    $stmt->execute();
    $user = $stmt->fetch();
}

if (isset($_POST['update'])) {
    $UserID = $_POST['UserID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $stmt = $conn->prepare("UPDATE admin SET fname = :fname, lname = :lname, email = :email, :password, usertype = :usertype WHERE UserID = :UserID");
    $stmt->bindParam(':UserID', $UserID);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':usertype', $usertype);
    $stmt->execute();

    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <form method="POST">
        <input type="hidden" name="UserID" value="<?php echo $user['UserID']; ?>">
        <input type="text" name="fname" value="<?php echo $user['fname']; ?>" required>
        <input type="text" name="lname" value="<?php echo $user['lname']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <input type="password" name="password" value="<?php echo $user['password']; ?>" required>
        <input type="text" name="usertype" value="<?php echo $user['usertype']; ?>" required>
        <button type="submit" name="update">Update User</button>
    </form>
</body>
</html>