<?php
$file = 'data.txt';

// Kiểm tra nếu có dữ liệu từ ESP8266 gửi đến
if (isset($_GET['data'])) {
    $data = $_GET['data']; // Lấy dữ liệu từ tham số "data"
    
    // Tách dữ liệu thành mảng
    $dataArray = explode(',', $data);
    
    // Đảm bảo có đủ 6 phần tử, nếu thiếu thì thêm giá trị 0
    for ($i = 0; $i < 6; $i++) {
        if (!isset($dataArray[$i]) || trim($dataArray[$i]) === '') {
            $dataArray[$i] = '0';
        }
    }
    
    // Chuyển mảng về chuỗi với dấu phẩy ngăn cách
    $formattedData = implode(',', $dataArray);
    
    // Ghi đè dữ liệu vào file
    file_put_contents($file, $formattedData);

    // Chạy checkStatus.php sau 3 giây (không chặn tiến trình chính)
    exec("php checkStatus.php > /dev/null 2>&1 &");

    echo "Dữ liệu đã được nhận và xử lý!";
} else {
    echo "Không nhận được dữ liệu!";
}
?>
