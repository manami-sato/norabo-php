<?php
/*
sign_out.phpはログアウトすると今の時間をデータベースに更新して接続状態を'0'にします。
0 : ログアウト 1 : 接続中
ログアウトはuser_idかEmailかどっちかをフレームワークから利用しやすいもの選んでも構いません。
*/
//2022.07.20
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$post_data = json_decode(file_get_contents("php://input"), true);
/* 
EMAILから取得して行う文
$email = $post_data['email'];
$sql="UPDATE DB_USER SET LOGIN = '0', LAST_LOGIN = NOW() WHERE EMAIL = '$email'";
*/
$user_id = $post_data['user_id'];
$sql="UPDATE DB_USER SET LOGIN = '0', LAST_LOGIN = NOW() WHERE USER_ID = '$user_id'";
$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_errno($conn)) {
  die("DB Error " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
$result = mysqli_query($conn, $sql);
$conn->close();
?>
