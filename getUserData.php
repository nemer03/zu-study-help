<?php
header('Content-Type: application/json');

// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'university_system');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$university_id = $_GET['university_id'];

$sql = "SELECT university_id, college, major, email, phone FROM users WHERE university_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $university_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    echo json_encode($userData);
} else {
    echo json_encode(null);
}

$stmt->close();
$conn->close();
?>

