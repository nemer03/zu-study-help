<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university_system";

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// تسجيل مستخدم جديد
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $university_id = $_POST["university_id"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $college = $_POST["college"];
    $major = $_POST["major"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO users (university_id, password, college, major, email, phone)
            VALUES ('$university_id', '$password', '$college', '$major', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "تم إنشاء الحساب بنجاح";
    } else {
        echo "حدث خطأ أثناء التسجيل: " . $conn->error;
    }
}

$conn->close();
?>
