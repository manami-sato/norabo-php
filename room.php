<?php
/*
  room.phpは今入った人の一覧を表示します。
  このルームはhome.phpの「参加する」ボタン押すとユーザーの情報が渡されます。
  そのユーザーの情報をそのルームのデータベーステーブルに追加します。
  その後更新できたルームのメンバーを表示します。
*/
//2022.07.20
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$post_data = json_decode(file_get_contents("php://input"), true);
$user_id = $post_data['user_id'];
if (isset($post_data['user_id'])) {
  //$email = $post_data['email'];
  //$nick_name = $post_data['nick_name'];
  //$age = $post_data['age'];
  //$gender = $post_data['gender'];
  //$img =  $post_data['img'];  
  $room_num = $post_data['room_num'];
  //ログイン画面に移動させる。
  //echo "<script> parent.location.href='sign_in.php'; </script>";
} else {
  echo '
    <script>alert("fail");
  ';
}
$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_errno($conn)) {
  die("DB Error " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
$sql_select = "	SELECT * FROM ".$room_num."_MATCH_ROOM WHERE USER_ID =".$user_id."" ;
$result_select = mysqli_query($conn, $sql_select);
				  if ($result_select->num_rows > 0) {
            while ($row = $result_select->fetch_assoc()) {
              $serch_id = $row['USER_ID'];
              if($user_id == $serch_id){
                continue;
              }
            }
				  }else{
            $insert_match = "INSERT INTO ".$room_num."_MATCH_ROOM (USER_ID, AUTHORITY, READY) VALUES('$user_id', '0', '0' )";
                $inser2 = mysqli_query($conn, $insert_match);
          }
//マッチルームに入っている人たちの情報を呼び出す。
$sql_select = "	SELECT * FROM ".$room_num."_MATCH_ROOM";
$result_select = mysqli_query($conn, $sql_select);
if ($result_select->num_rows > 0) {
  while ($row = $result_select->fetch_assoc()) {
    $records[] = $row;
  }
}
//json_encode($records); //出力
echo json_encode($records, JSON_PRETTY_PRINT);
$conn->close();