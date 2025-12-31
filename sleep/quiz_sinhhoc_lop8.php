<?php
// quiz_sinhhoc_lop8.php
$cau_hoi = [
    [
        'cau' => 'Tim thuộc hệ cơ quan nào?',
        'dap_an' => ['Hệ vận động', 'Hệ tuần hoàn', 'Hệ hô hấp', 'Hệ tiêu hóa'],
        'dung' => 1 // index bắt đầu từ 0
    ],
    [
        'cau' => 'Phổi thuộc hệ cơ quan nào?',
        'dap_an' => ['Hệ tuần hoàn', 'Hệ hô hấp', 'Hệ bài tiết', 'Hệ thần kinh'],
        'dung' => 1
    ],
    [
        'cau' => 'Dạ dày thuộc hệ cơ quan nào?',
        'dap_an' => ['Hệ tiêu hóa', 'Hệ sinh sản', 'Hệ nội tiết', 'Hệ vận động'],
        'dung' => 0
    ],
    [
        'cau' => 'Thận thuộc hệ cơ quan nào?',
        'dap_an' => ['Hệ hô hấp', 'Hệ bài tiết', 'Hệ tuần hoàn', 'Hệ thần kinh'],
        'dung' => 1
    ]
];

$ket_qua = '';
$diem = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $diem = 0;
    foreach ($cau_hoi as $i => $q) {
        $ten = "cau$i";
        if (isset($_POST[$ten]) && $_POST[$ten] == $q['dung']) {
            $diem++;
        }
    }
    $ket_qua = "<h3 style='color:#2e7d32'>Bạn được $diem / " . count($cau_hoi) . " điểm!</h3>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trắc nghiệm Sinh học lớp 8 - Cơ quan cơ thể người</title>
    <style>
        body {font-family: Arial, sans-serif; max-width: 700px; margin: 30px auto;}
        .cauhoi {margin: 25px 0; padding: 15px; background:#f5f5f5; border-radius:8px;}
        h1 {color:#d81b60; text-align:center;}
        button {padding:10px 25px; background:#1976d2; color:white; border:none; border-radius:5px; cursor:pointer;}
    </style>
</head>
<body>

<h1>Trắc nghiệm vui Sinh học lớp 8</h1>
<p style="text-align:center">Hãy chọn đáp án đúng cho từng câu hỏi nhé!</p>

<form method="POST">
    <?php foreach ($cau_hoi as $i => $q): ?>
        <div class="cauhoi">
            <strong>Câu <?= $i+1 ?>: <?= $q['cau'] ?></strong><br><br>
            <?php foreach ($q['dap_an'] as $j => $da): ?>
                <label>
                    <input type="radio" name="cau<?= $i ?>" value="<?= $j ?>" required> 
                    <?= $da ?>
                </label><br>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div style="text-align:center; margin:30px 0;">
        <button type="submit">Nộp bài & xem điểm</button>
    </div>
</form>

<?= $ket_qua ?>

</body>
</html>
