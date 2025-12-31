<?php
// tom_tat_he_co_quan.php
$he_co_quan = [
    ['Hệ vận động', 'Xương, khớp, cơ', 'Cho phép cơ thể di chuyển, nâng đỡ cơ thể'],
    ['Hệ tuần hoàn', 'Tim, mạch máu, máu', 'Vận chuyển O2, chất dinh dưỡng, thải CO2 và chất thải'],
    ['Hệ hô hấp', 'Mũi, họng, thanh quản, khí quản, phế quản, phổi', 'Trao đổi khí O2 ↔ CO2'],
    ['Hệ tiêu hóa', 'Miệng, thực quản, dạ dày, ruột non, ruột già, gan, tụy', 'Phân giải thức ăn thành chất dinh dưỡng'],
    ['Hệ bài tiết', 'Thận, niệu quản, bàng quang, niệu đạo', 'Loại bỏ chất thải (ure, muối dư...) qua nước tiểu'],
    ['Hệ da', 'Da, tóc, móng, tuyến mồ hôi', 'Bảo vệ cơ thể, điều hòa nhiệt độ, cảm nhận'],
    ['Hệ thần kinh', 'Não, tủy sống, dây thần kinh, các giác quan', 'Điều khiển và phối hợp hoạt động cơ thể'],
    ['Hệ nội tiết', 'Các tuyến nội tiết (tuyến yên, giáp, tụy, thượng thận, sinh dục)', 'Điều hòa hoạt động cơ thể qua hormone'],
    ['Hệ sinh sản', 'Cơ quan sinh dục nam/nữ', 'Sinh sản và duy trì nòi giống']
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tóm tắt 9 hệ cơ quan - Sinh học lớp 8</title>
    <style>
        table {border-collapse: collapse; width: 100%; max-width: 900px; margin: 30px auto;}
        th, td {border: 1px solid #ccc; padding: 12px; text-align: left;}
        th {background: #bbdefb; color: #0d47a1;}
        caption {font-size: 1.5em; margin: 20px 0; color: #d81b60; font-weight: bold;}
    </style>
</head>
<body>

<table>
    <caption>9 HỆ CƠ QUAN CHÍNH TRONG CƠ THỂ NGƯỜI (Sinh học 8)</caption>
    <tr>
        <th>Hệ cơ quan</th>
        <th>Cơ quan chính</th>
        <th>Chức năng chính</th>
    </tr>
    <?php foreach ($he_co_quan as $he): ?>
    <tr>
        <td><strong><?= $he[0] ?></strong></td>
        <td><?= $he[1] ?></td>
        <td><?= $he[2] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<p style="text-align:center; color:#555; margin-top:40px;">
    Học tốt môn Sinh học lớp 8 nha các bạn! 💪🧬
</p>

</body>
</html>
