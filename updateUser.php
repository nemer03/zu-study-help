<?php
session_start();
include 'database_connection.php'; // تأكد من تضمين الاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $university_id = $_POST['university_id'];
    $college = $_POST['college'];
    $major = $_POST['major'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = "UPDATE users SET university_id = ?, college = ?, major = ?, email = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $university_id, $college, $major, $email, $phone, $user_id);

    if ($stmt->execute()) {
        echo "Success"; // يمكنك إرسال رسالة توضح النجاح
    } else {
        echo "Error"; // رسالة عند وجود خطأ
    }
}
?>
