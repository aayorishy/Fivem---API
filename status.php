<?php
// 服务器配置
$server_settings = [
    'title' => "Default", // 服务器名称
    'ip' => "localhost", // 服务器 IP
    'port' => "30120", // 服务器端口
    'max_slots' => 64 // 允许的最大玩家数量
];

// 获取服务器信息的函数
function fetchServerInfo($ip, $port) {
    return json_decode(file_get_contents("http://$ip:$port/info.json"), true);
}

// 获取玩家信息的函数
function fetchPlayerInfo($ip, $port) {
    return json_decode(file_get_contents("http://$ip:$port/players.json"), true);
}

// 检查服务器状态
$content = fetchServerInfo($server_settings['ip'], $server_settings['port']);
if ($content) {
    $player_data = fetchPlayerInfo($server_settings['ip'], $server_settings['port']);
    $player_count = count($player_data); // 获取在线玩家数量
    $server_status = "<span style='color: green;'>在线</span>"; // 在线状态
} else {
    $player_count = 0; // 如果服务器离线，玩家数量为 0
    $server_status = "<span style='color: red;'>离线</span>"; // 离线状态
}
?>

<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $server_settings['title']; ?> - 服务器状态</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* 设置字体 */
            background-color: #f4f4f4; /* 背景颜色 */
            color: #333; /* 字体颜色 */
            text-align: center; /* 文本居中 */
            padding: 50px; /* 内边距 */
        }
        .status {
            font-size: 24px; /* 状态字体大小 */
            margin-bottom: 20px; /* 下边距 */
        }
        .player-count {
            font-size: 20px; /* 玩家数量字体大小 */
            color: #555; /* 玩家数量字体颜色 */
        }
        .container {
            background: white; /* 容器背景颜色 */
            border-radius: 8px; /* 圆角 */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* 阴影效果 */
            padding: 30px; /* 内边距 */
            display: inline-block; /* 使容器为行内块元素 */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="status">服务器状态: <?php echo $server_status; ?></div> <!-- 显示服务器状态 -->
        <div class="player-count">在线玩家: <?php echo "$player_count / {$server_settings['max_slots']}"; ?></div> <!-- 显示在线玩家数量 -->
    </div>
</body>
</html>
