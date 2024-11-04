<?php
// تحديث المعلومات في قاعدة البيانات

// معلومات الاتصال بقاعدة البيانات
$host = "localhost"; // أو أي مضيف تستخدمه
$username = "root"; // اسم المستخدم
$password = ""; // كلمة المرور
$database = "university_system"; // اسم قاعدة البيانات

// إنشاء اتصال
$conn = new mysqli($host, $username, $password, $database);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// الحصول على البيانات من الطلب
$data = json_decode(file_get_contents("php://input"), true);

// التأكد من أن البيانات ليست فارغة
if (isset($data['university_id'])) {
    $university_id = $conn->real_escape_string($data['university_id']);
    $college = $conn->real_escape_string($data['college']);
    $major = $conn->real_escape_string($data['major']);
    $email = $conn->real_escape_string($data['email']);
    $phone = $conn->real_escape_string($data['phone']);

    // استعلام التحديث
    $sql = "UPDATE users SET college='$college', major='$major', email='$email', phone='$phone' WHERE university_id='$university_id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid input"]);
}

// إغلاق الاتصال
$conn->close();
?>
