<?php
session_start();
include 'config.php'; // تأكد من تضمين ملف الاتصال بقاعدة البيانات

$user_id = $_SESSION['user_id']; // افترض أنك تحفظ ID المستخدم في الجلسة

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_info = $result->fetch_assoc();
    echo json_encode($user_info); // أعد البيانات على شكل JSON
} else {
    echo json_encode([]);
}
?>
