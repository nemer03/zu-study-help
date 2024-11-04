<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university_system";

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التحقق من بيانات تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $university_id = $_POST["university_id"];
    $password = $_POST["password"];

    // استخدام استعلام محضر للحماية من هجمات SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE university_id = ?");
    $stmt->bind_param("s", $university_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["university_id"] = $university_id; // حفظ الجلسة
            echo "success"; // إرجاع "success" عند نجاح تسجيل الدخول
        } else {
            echo "كلمة المرور غير صحيحة";
        }
    } else {
        echo "رقم الجامعة غير صحيح";
    }
    $stmt->close();
}
$conn->close();
?>
