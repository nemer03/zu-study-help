<?php
session_start();
include('db_connection.php'); // الاتصال بقاعدة البيانات

// افترض أنك قد قمت بتخزين معلومات المستخدم في الجلسة
$user_id = $_SESSION['user_id'];

// استرجاع معلومات المستخدم من قاعدة البيانات
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // تحديث معلومات المستخدم
    $university_id = $_POST['university_id'];
    $major = $_POST['major'];

    $update_query = "UPDATE users SET university_id = ?, major = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssi", $university_id, $major, $user_id);
    $update_stmt->execute();

    echo "تم تحديث المعلومات بنجاح!";
}
?>

<form method="POST" action="">
    <label for="university_id">الرقم الجامعي:</label>
    <input type="text" id="university_id" name="university_id" value="<?php echo $user['university_id']; ?>" required>
    
    <label for="major">التخصص:</label>
    <input type="text" id="major" name="major" value="<?php echo $user['major']; ?>" required>

    <button type="submit">تحديث المعلومات</button>
</form>
