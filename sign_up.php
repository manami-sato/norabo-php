<?php

/*
sign_up.phpはPOSTされた情報をユーザーデータベースの中に追加して新規登録を行います。
流れ）
  1.メールアドレスから既に登録ユーザーか確認
  2.未登録メールならユーザーデータベースに追加
*/
//2022.07.20
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
//jsonを取得
$post_data = json_decode(file_get_contents("php://input"), true);
$email = $post_data['email'];
$nick_name = $post_data['nick_name'];
$age = $post_data['age'];
$pw = $post_data['pw'];
$hash_password = password_hash($pw, PASSWORD_DEFAULT);
$gender = $post_data['gender'];
///////////
$records = array();
if (isset($post_data['pw'])) {
  $conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
  if (mysqli_connect_error()) {
    die("データベースの接続に失敗しました");
  }
  mysqli_query($conn, "set names utf8");
    $sql = "SELECT * FROM DB_USER WHERE EMAIL = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "ユーザーは存在します。";
    } else {
      $img = "./static/img/e1"; //デフォルトイメージの登録
      $sql = "INSERT INTO DB_USER (EMAIL,NICK_NAME,AGE,PW,GENDER, DATE, IMG) VALUES ('$email','$nick_name','$age','$hash_password','$gender',NOW(),'$img')";
      if ($conn->query($sql) === TRUE) {
        $sql = "SELECT * FROM DB_USER WHERE EMAIL = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $records[] = $row;   
          }
        }
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  $conn->close();
  echo json_encode($records, JSON_PRETTY_PRINT);
}
