<?php
session_start();

// تدمير جميع بيانات الجلسة
session_unset();
session_destroy();

// حذف الكوكيز المتعلقة بالجلسة إذا كانت موجودة
if (isset($_COOKIE['PHPSESSID'])) {
    setcookie('PHPSESSID', '', time() - 3600, '/'); // حذف الكوكيز عن طريق تعيين وقت انتهاء سابق
}

// إعادة التوجيه إلى صفحة تسجيل الدخول
header("Location: login.html");
exit();
?>
