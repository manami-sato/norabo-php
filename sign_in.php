<?php
//2022.07.20
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$post_data = json_decode(file_get_contents("php://input"), true);
$email = $post_data['email'];
$pw = $post_data['pw'];

if (isset($post_data['email'])) { //emailのpostを受けたら
  $conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g'); //データベースに接続
  if (mysqli_connect_error()) {
    die("データベースの接続に失敗しました");
  }
  mysqli_query($conn, "set names utf8");
  $sql = "SELECT * FROM DB_USER WHERE EMAIL = '$email'"; //データベースからこのEmailが登録されているアカウントを探す。
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $checkpassword = $row["PW"];    //$checkpassword : あのアカウントのPWを変数に入れる
      if ( password_verify ( $pw, $checkpassword )) {  //受けた$pwからあのアカウントに登録されている暗号化と比較
        $user_id = $row['USER_ID'];
        $nick_name = $row["NICK_NAME"];
        $email = $row["EMAIL"];
        $gender = $row['GENDER'];
        $age = $row['AGE'];
        $img = $row["IMG"];
        $records[] = $row;

        //LOGIN時間の更新
        $up_sql = "UPDATE DB_USER SET LOGIN = '1', LAST_LOGIN = NOW() WHERE USER_ID = '$user_id'";
        $up_result = mysqli_query($conn, $up_sql);
        echo json_encode($records, JSON_PRETTY_PRINT); //アカウントは正しいです。
      } else {
        //echo "<script>alert('パスワードが間違えた。')</script>"; //入力値と保存されているPWが違います。
        echo 'パスワードが間違えました。'; //入力値と保存されているPWが違います。
      }
    }
  } else {
    echo 'アカウントが存在しません。'; //入力されたemailは存在しません。
  }
  $conn->close();
}
?>