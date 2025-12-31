<?php
// file: toan9.php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Toán 9 - Công cụ tính toán vui</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: #f8f9fa;
            color: #333;
        }
        h1, h2 { color: #d63384; }
        .container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        .form-group { margin: 20px 0; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="number"], input[type="text"], select {
            width: 100%; max-width: 320px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.1rem;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover { background: #0056b3; }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #e9ffe9;
            border-left: 5px solid #28a745;
            border-radius: 5px;
        }
        .error { background: #ffecec; border-left-color: #dc3545; }
    </style>
</head>
<body>

<div class="container">
    <h1>🧮 Toán 9 - Công cụ hỗ trợ học tập</h1>
    <p>Chọn bài toán bạn muốn giải và điền thông tin nhé!</p>

    <form method="POST">
        <div class="form-group">
            <label for="loai">Chọn dạng bài:</label>
            <select name="loai" id="loai" required>
                <option value="">--- Chọn bài toán ---</option>
                <option value="phuong_trinh_bac2" <?= isset($_POST['loai']) && $_POST['loai']==='phuong_trinh_bac2'?'selected':'' ?>>Phương trình bậc 2</option>
                <option value="he_bac_nhat_2an" <?= isset($_POST['loai']) && $_POST['loai']==='he_bac_nhat_2an'?'selected':'' ?>>Hệ phương trình bậc nhất 2 ẩn</option>
                <option value="can_bac_hai" <?= isset($_POST['loai']) && $_POST['loai']==='can_bac_hai'?'selected':'' ?>>Rút gọn biểu thức căn bậc hai</option>
                <option value="so_nghiem_cua_he" <?= isset($_POST['loai']) && $_POST['loai']==='so_nghiem_cua_he'?'selected':'' ?>>Số nghiệm của hệ (hình học)</option>
            </select>
        </div>

        <?php
        $loai = $_POST['loai'] ?? '';

        // =============================================
        // PHƯƠNG TRÌNH BẬC 2
        // =============================================
        if ($loai === 'phuong_trinh_bac2'):
        ?>
        <div class="form-group">
            <label>Phương trình dạng: ax² + bx + c = 0</label>
            <input type="number" name="a" step="any" placeholder="a" required style="width:90px;" value="<?= htmlspecialchars($_POST['a']??'') ?>"> x² +
            <input type="number" name="b" step="any" placeholder="b" required style="width:90px;" value="<?= htmlspecialchars($_POST['b']??'') ?>"> x +
            <input type="number" name="c" step="any" placeholder="c" required style="width:90px;" value="<?= htmlspecialchars($_POST['c']??'') ?>"> = 0
        </div>

        <?php
        elseif ($loai === 'he_bac_nhat_2an'):
        // =============================================
        // HỆ PHƯƠNG TRÌNH BẬC NHẤT 2 ẨN
        // =============================================
        ?>
        <div class="form-group">
            <label>Hệ phương trình:</label>
            <input type="number" name="a1" step="any" style="width:80px;" value="<?= htmlspecialchars($_POST['a1']??'1') ?>">x +
            <input type="number" name="b1" step="any" style="width:80px;" value="<?= htmlspecialchars($_POST['b1']??'2') ?>">y =
            <input type="number" name="c1" step="any" style="width:80px;" value="<?= htmlspecialchars($_POST['c1']??'5') ?>"><br><br>

            <input type="number" name="a2" step="any" style="width:80px;" value="<?= htmlspecialchars($_POST['a2']??'3') ?>">x +
            <input type="number" name="b2" step="any" style="width:80px;" value="<?= htmlspecialchars($_POST['b2']??'-1') ?>">y =
            <input type="number" name="c2" step="any" style="width:80px;" value="<?= htmlspecialchars($_POST['c2']??'8') ?>">
        </div>

        <?php
        elseif ($loai === 'can_bac_hai'):
        // =============================================
        // RÚT GỌN BIỂU THỨC CĂN BẬC HAI
        // =============================================
        ?>
        <div class="form-group">
            <label>Nhập số dưới dấu căn (ví dụ: 72, 50, 200...):</label>
            <input type="number" name="so_can" placeholder="Số cần rút gọn" required value="<?= htmlspecialchars($_POST['so_can']??'') ?>">
        </div>

        <?php
        elseif ($loai === 'so_nghiem_cua_he'):
        ?>
        <div class="form-group">
            <label>Số nghiệm của hệ (hình học - đường thẳng):</label>
            <select name="dieu_kien">
                <option value="trung_nhau" <?= ($_POST['dieu_kien']??'')==='trung_nhau'?'selected':'' ?>>Trùng nhau (vô số nghiệm)</option>
                <option value="cat_nhau" <?= ($_POST['dieu_kien']??'')==='cat_nhau'?'selected':'' ?>>Cắt nhau tại 1 điểm</option>
                <option value="song_song_khong_trung" <?= ($_POST['dieu_kien']??'')==='song_song_khong_trung'?'selected':'' ?>>Song song, không trùng</option>
            </select>
        </div>
        <?php endif; ?>

        <button type="submit">TÍNH →</button>
    </form>

    <?php
    // XỬ LÝ KẾT QUẢ
    if ($_SERVER['REQUEST_METHOD'] === 'POST'):
        echo '<div class="result">';
        echo '<h3>KẾT QUẢ:</h3>';

        switch($loai) {
            case 'phuong_trinh_bac2':
                $a = floatval($_POST['a']);
                $b = floatval($_POST['b']);
                $c = floatval($_POST['c']);

                if ($a == 0) {
                    echo '<p class="error">Đây không phải phương trình bậc 2 (a = 0)</p>';
                    break;
                }

                $delta = $b*$b - 4*$a*$c;
                echo "<p>Δ = b² - 4ac = $delta</p>";

                if ($delta < 0) {
                    echo "<p class='error'>Phương trình vô nghiệm (Δ < 0)</p>";
                } else if ($delta == 0) {
                    $x = -$b / (2*$a);
                    echo "<p>Phương trình có nghiệm kép: x = " . number_format($x, 3) . "</p>";
                } else {
                    $x1 = (-$b + sqrt($delta)) / (2*$a);
                    $x2 = (-$b - sqrt($delta)) / (2*$a);
                    echo "<p>Phương trình có 2 nghiệm phân biệt:</p>";
                    echo "<p>x₁ = " . number_format($x1, 3) . "<br>x₂ = " . number_format($x2, 3) . "</p>";
                }
                break;

            case 'he_bac_nhat_2an':
                $a1 = floatval($_POST['a1']); $b1 = floatval($_POST['b1']); $c1 = floatval($_POST['c1']);
                $a2 = floatval($_POST['a2']); $b2 = floatval($_POST['b2']); $c2 = floatval($_POST['c2']);

                $d  = $a1*$b2 - $a2*$b1;
                $dx = $c1*$b2 - $c2*$b1;
                $dy = $a1*$c2 - $a2*$c1;

                echo "<p>Định thức D = $d</p>";

                if ($d == 0) {
                    if ($dx == 0 && $dy == 0) {
                        echo "<p>Hệ có vô số nghiệm (2 đường thẳng trùng nhau)</p>";
                    } else {
                        echo "<p class='error'>Hệ vô nghiệm (2 đường thẳng song song, không trùng)</p>";
                    }
                } else {
                    $x = $dx / $d;
                    $y = $dy / $d;
                    echo "<p>Hệ có nghiệm duy nhất:</p>";
                    echo "<p><strong>x = " . number_format($x, 3) . "<br>y = " . number_format($y, 3) . "</strong></p>";
                }
                break;

            case 'can_bac_hai':
                $n = intval($_POST['so_can']);
                if ($n <= 0) {
                    echo "<p class='error'>Vui lòng nhập số dương!</p>";
                    break;
                }

                $nguyen = 1;
                for($i=2; $i*$i<=$n; $i++){
                    while($n % ($i*$i) == 0){
                        $nguyen *= $i;
                        $n /= ($i*$i);
                    }
                }
                echo "<p>√$n = ";
                if($nguyen > 1) echo "$nguyen";
                echo ($n > 1) ? "√$n" : "";
                echo "</p>";
                break;

            case 'so_nghiem_cua_he':
                $dk = $_POST['dieu_kien'] ?? '';
                switch($dk){
                    case 'trung_nhau': echo "<p>→ Hệ có <strong>vô số nghiệm</strong></p>"; break;
                    case 'cat_nhau': echo "<p>→ Hệ có <strong>1 nghiệm</strong></p>"; break;
                    case 'song_song_khong_trung': echo "<p>→ Hệ <strong>vô nghiệm</strong></p>"; break;
                    default: echo "<p>Vui lòng chọn điều kiện</p>";
                }
                break;
        }

        echo '</div>';
    endif;
    ?>

    <hr style="margin:40px 0">
    <p style="color:#666; font-size:0.9rem; text-align:center;">
        Dành cho học sinh lớp 9 - Chương trình giáo dục phổ thông 2018<br>
        Chúc bạn học tốt môn Toán! 🚀
    </p>
</div>

</body>
</html>
