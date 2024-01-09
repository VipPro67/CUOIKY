<?php
session_start();

$method = $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST["action"];
} else {
    $action = $_GET["action"];
}
$conn = new mysqli("localhost", "root", "", "dlthuexe");
if ($conn->connect_error) {
    die("CONNECTION FAILED" . $conn->connect_error);
}
if ($action == 'loadKH') {
    $sql = "SELECT MAKH, TENKH FROM KHACHHANG";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
}
if ($action == 'TRAXE') {
    $MAKH = $_GET["MAKH"];
    $SOXE = $_GET["SOXE"];
    $NGAYTHUE = $_GET["NGAYTHUE"];
    $NGAYTRA = $_GET["NGAYTRA"];
    //calculate price
    $sql = "SELECT DGTHUE FROM XE WHERE SOXE = '$SOXE'";
    $result = $conn->query($sql);
    $DGTHUE = $result->fetch_assoc()["DGTHUE"];
    $sql = "SELECT DATEDIFF('$NGAYTRA', '$NGAYTHUE') AS DIFF";
    $result = $conn->query($sql);
    $DIFF = $result->fetch_assoc()["DIFF"];
    $THANHTIEN = $DIFF * $DGTHUE;
    //update XE
    $sql = "UPDATE XE SET TINHTRANG = 0 WHERE SOXE = '$SOXE'";
    $conn->query($sql);
    //insert into THUEXE
    $sql = "INSERT INTO THUEXE (MAKH, SOXE, NGAYTHUE, NGAYTRA, THANHTIEN) VALUES ('$MAKH', '$SOXE', '$NGAYTHUE', '$NGAYTRA', '$THANHTIEN')";
    $conn->query($sql);
    echo "<script>alert('Trả xe thành công'); window.location.href='bt2.html';</script>";
}

$conn->close();
