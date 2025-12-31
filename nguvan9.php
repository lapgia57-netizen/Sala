<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tác giả - Tác phẩm Ngữ văn 9</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { border: 1px solid #999; padding: 12px; text-align: left; }
        th { background: #4CAF50; color: white; }
        tr:nth-child(even) { background: #f2f2f2; }
    </style>
</head>
<body>

<h2 style="text-align:center">Tác giả & Tác phẩm Ngữ Văn lớp 9 (chương trình hiện hành)</h2>

<?php
$tac_gia_tac_pham = [
    ["Tác giả" => "Huy Cận", "Tác phẩm" => "Đoàn thuyền đánh cá", "Thể loại" => "Thơ"],
    ["Tác giả" => "Đồng chí", "Tác phẩm" => "Chính Hữu", "Thể loại" => "Thơ"],
    ["Tác giả" => "Kim Lân", "Tác phẩm" => "Làng", "Thể loại" => "Truyện ngắn"],
    ["Tác giả" => "Nguyễn Quang Sáng", "Tác phẩm" => "Chiếc lược ngà", "Thể loại" => "Truyện ngắn"],
    ["Tác giả" => "Nam Cao", "Tác phẩm" => "Lão Hạc", "Thể loại" => "Truyện ngắn"],
    ["Tác giả" => "Nguyễn Tuân", "Tác phẩm" => "Người lái đò sông Đà", "Thể loại" => "Tùy bút"],
    ["Tác giả" => "Tố Hữu", "Tác phẩm" => "Từ ấy", "Thể loại" => "Thơ"],
];

echo "<table>";
echo "<tr><th>STT</th><th>Tác giả</th><th>Tác phẩm</th><th>Thể loại</th></tr>";

$stt = 1;
foreach ($tac_gia_tac_pham as $item) {
    echo "<tr>";
    echo "<td>$stt</td>";
    echo "<td>{$item['Tác giả']}</td>";
    echo "<td>{$item['Tác phẩm']}</td>";
    echo "<td>{$item['Thể loại']}</td>";
    echo "</tr>";
    $stt++;
}
echo "</table>";
?>

</body>
</html>
