<?php
/*

*/
//2022.07.20
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
//jsonを取得
$post_data = json_decode(file_get_contents("php://input"), true);
//if($_POST['serch_1'] == 1){
$user_id = $post_data["user_id"];
$platform = $post_data["platform"];
$game = $post_data["game"];
$same = strval($post_data["same"]);
$style = strval($post_data['style']);
$rank = strval($post_data['rank']);
$filter = $same . $style . $rank;  //ユーザー選択のフィルター
$filter_num = intval($filter);   //数字に変換
$records = array();

/////フィルターの通りの
$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_error()) {
  die("データベースの接続に失敗しました");
}
mysqli_set_charset($conn, "utf8");
$sql_select = "	SELECT * FROM HOME_ROOM WHERE G_NAME = " .$game. " AND PLATFORM = '". $platform . "' AND FILTER =" .$filter_num;
$result_select = mysqli_query($conn, $sql_select);

if ($result_select->num_rows > 0) {
  while ($row = $result_select->fetch_assoc()) {
    $records[] = $row;
  }
}else{
	//全く一緒なルームが存在しないと一番近い選択のルームを提案
	$sql_select = "SELECT * FROM HOME_ROOM WHERE G_NAME = " .$game. " AND PLATFORM = '". $platform . "' ORDER BY ABS(FILTER-".$filter_num.") LIMIT 1;";
	$result_select = mysqli_query($conn, $sql_select);
	if ($result_select->num_rows > 0) {
		while ($row = $result_select->fetch_assoc()) {
		$records[] = $row;
		}		
	}
}
mysqli_close($conn);
echo json_encode($records, JSON_PRETTY_PRINT);