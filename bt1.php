<?php
session_start();
$method = $_SERVER['REQUEST_METHOD'];
$conn = new mysqli("localhost", "root", "", "dlthuexe");
if ($conn->connect_error) {
    die("CONNECTION FAILED" . $conn->connect_error);
}
$SOXE = $_POST['MAXE'];
$TENXE = $_POST['TENXE'];
$HANGXE = $_POST['HANGXE'];
$SOCHO = $_POST['SOCHO'];
$NAMSX = $_POST['NAMSX'];
$DGTHUE = $_POST['DGTHUE'];
$TINHTRANG = 0;

$sql = "INSERT INTO XE (SOXE, TENXE, HANGXE, SOCHO, NAMSX, DGTHUE, TINHTRANG) VALUES ('$SOXE', '$TENXE', '$HANGXE', '$SOCHO', '$NAMSX', '$DGTHUE', '$TINHTRANG')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Thêm thành công'); window.location.href='bt1.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
