<?php
$file = 'status.txt';

// Kiểm tra nếu có dữ liệu từ ESP8266 gửi đến
if (isset($_GET['status'])) {
    $data = trim($_GET['status']); // Xóa khoảng trắng đầu/cuối
    
    // Tách dữ liệu thành mảng
    $dataArray = explode(',', $data);
    
    // Đảm bảo có đủ 2 phần tử
    for ($i = 0; $i < 2; $i++) {
        if (!isset($dataArray[$i]) || trim($dataArray[$i]) === '') {
            $dataArray[$i] = '0';
        }
    }
    
    // Chuyển mảng về chuỗi với dấu phẩy ngăn cách
    $formattedData = implode(',', $dataArray);
    
    // Ghi dữ liệu vào file, kiểm tra lỗi
    if (file_put_contents($file, $formattedData) === false) {
        echo "Lỗi khi ghi file!";
    } else {
        echo "Dữ liệu đã được lưu!";
    }
} else {
    echo "Không nhận được dữ liệu!";
}
?>
