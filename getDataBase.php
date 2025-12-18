<?php
$file = 'database.txt';

// Kiểm tra nếu có dữ liệu từ ESP8266 gửi đến
if (isset($_GET['database'])) {
    $data = $_GET['database']; // Lấy dữ liệu từ tham số "database"
    
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

    
} else {
    echo "Không nhận được dữ liệu!";
}
?>
