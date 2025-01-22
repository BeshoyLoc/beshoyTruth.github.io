<?php
// قم بتحديد الإجابة الصحيحة
$correctAnswer = "secret"; // الإجابة الصحيحة

// اجلب البيانات المرسلة عبر POST
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['answer'])) {
    echo json_encode([
        "success" => false,
        "message" => "Answer is required"
    ]);
    exit;
}

$userAnswer = strtolower(trim($data['answer']));

// تحقق من الإجابة
if ($userAnswer === $correctAnswer) {
    // توليد كود فريد
    $uniqueCode = "DX-" . strtoupper(substr(md5(uniqid()), 0, 8));
    echo json_encode([
        "success" => true,
        "code" => $uniqueCode
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Incorrect answer"
    ]);
}
