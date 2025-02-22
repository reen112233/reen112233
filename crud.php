<?php
include 'db.php';

// Create
if (isset($_POST['create'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $stmt = $conn->prepare("INSERT INTO admin (fname, lname, email, password, usertype) VALUES (:fname, :lname, :email, :password, :usertype)");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':usertype', $usertype);
    $stmt->execute();
}

// Read
$stmt = $conn->prepare("SELECT * FROM admin");
$stmt->execute();
$users = $stmt->fetchAll();

// Update
if (isset($_POST['update'])) {
    $UserID = $_POST['UserID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $stmt = $conn->prepare("UPDATE admin SET fname = :fname, lname = :lname, email = :email, usertype = :usertype WHERE UserID = :UserID");
    $stmt->bindParam(':UserID', $UserID);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':usertype', $usertype);
    $stmt->execute();
}

// Delete
if (isset($_GET['delete'])) {
    $UserID = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM admin WHERE UserID = :UserID");
    $stmt->bindParam(':UserID', $UserID);
    $stmt->execute();

    header("Location: admin.php");
}
?>