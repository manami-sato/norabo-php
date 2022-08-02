<?php
	/*

		room_serch.phpはhome.phpでルームを生成する時選択した
		条件と生成者のユーザーID,タイトル等をPOSTでもらって
		その通りにデータベースに作成を行います。

		$user_id = $_POST["user_id"];　
		$platt = $_POST["platt"];　　　　　　　　//PS4かPC等のフラットフォーム
		$game = $_POST["game"];　　　　　　　　　
		$same = strval($_POST["same"]);	　　　　//同性チェック
		$style = strval($_POST['style']);　　　//プレイヤーのスタイル
		$rank = strval($_POST['rank']);
		$title = $_POST["title"];             //ルーム名
		$area_text = $_POST["area_text"];　　 //ルームの内容　　　
		$filter = $same.$style.$rank;　　　　//条件の表示　-> 111 1(同性か？)1(スタイルは？)1(ランクは？)


		ルーム作成が終わったらそのルーム番号が付けている新しいデータベースのテーブルを生成します。
		新しく作られたルームには自動的に生成者が一番目に追加されます。

		$make_match = "
			CREATE TABLE `sys3_itweb_g`.`".$r_id."_MATCH_ROOM` (
			`USER_ID` INT(4) NOT NULL ,
			`AUTHORITY` TINYINT(1) NOT NULL ,
			`READY` TINYINT(1) NOT NULL,
			INDEX `idx_user`(USER_ID)
			) ENGINE = InnoDB;
		";
		AUTHORITY : 権限（作った人の表示。以後ルームマスターの権限の通りの機能があるかもしれませんので。
		READY : ルームチーム員のお待ちの状況。　確認しました。などの表示の為

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
	$title = $post_data["title"];
	$area_text = $post_data["area_text"];
	$filter = $same . $style . $rank;
	$records = array();

	if (isset($post_data["user_id"])) {
		$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
		if (mysqli_connect_errno($conn)) {
			die("DB Error:  " . mysqli_connect_error());
		}
		mysqli_set_charset($conn, "utf8");
		$make_room = "INSERT INTO HOME_ROOM (G_NAME,PLATFORM, TITLE, M_TEXT, FILTER, CLIENT_USER, DATE) VALUES(
			'$game','$platform','$title','$area_text','$filter','$user_id', NOW())";
		$result1 = mysqli_query($conn, $make_room);

		$select_r_id = "SELECT * FROM HOME_ROOM WHERE CLIENT_USER = " . $user_id . "";
		mysqli_set_charset($conn, "utf8");
		$result_select = mysqli_query($conn, $select_r_id);
		if ($result_select->num_rows > 0) {
			while ($row = $result_select->fetch_assoc()) {
				$r_id = $row['R_ID'];
			}
		}
		$make_match = "CREATE TABLE `sys3_itweb_g`.`" . $r_id . "_MATCH_ROOM` (
			`USER_ID` INT(4) NOT NULL ,
			`AUTHORITY` TINYINT(1) NOT NULL ,
			`READY` TINYINT(1) NOT NULL,
			INDEX `idx_user`(USER_ID)
			) ENGINE = InnoDB;
			";
		$result2 = mysqli_query($conn, $make_match);

		$insert_match = "INSERT INTO " . $r_id . "_MATCH_ROOM (USER_ID, AUTHORITY, READY)
			VALUES('$user_id', '1', '0' )";
		$inser2 = mysqli_query($conn, $insert_match);

		$sql_select = "SELECT * FROM " . $r_id . "_MATCH_ROOM";
		$result_select = mysqli_query($conn, $sql_select);
		if ($result_select->num_rows > 0) {
			while ($row = $result_select->fetch_assoc()) {
				$records[] = $row;
			}
		}
		mysqli_close($conn);
		echo json_encode($records, JSON_PRETTY_PRINT);
	}
