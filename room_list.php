<?php
//2022.07.20
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
//fetchされた情報を取得します。 
$post_data = json_decode(file_get_contents("php://input"), true);

$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_error()) {
  die("データベースの接続に失敗しました");
}
mysqli_set_charset($conn, "utf8");
$sql_select = "	SELECT * FROM HOME_ROOM";
$result_select = mysqli_query($conn, $sql_select);
//json
$records = array();
if ($result_select->num_rows > 0) {
  while ($row = $result_select->fetch_assoc()) {
    $records[] = $row;
  }
}
//json_encode($records); //出力
echo json_encode($records, JSON_PRETTY_PRINT);
?>