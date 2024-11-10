<?php
session_start();

// 接收 POST 數據
$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['uid'])) {
    // 創建 session
    $_SESSION['user'] = [
        'uid' => $data['uid'],
        'email' => $data['email'],
        'displayName' => $data['displayName'],
        'photoURL' => $data['photoURL'] ?? null
    ];
    $_SESSION['loggedin'] = true;
    
    echo json_encode(['success' => true]);
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '無效的請求數據']);
} 