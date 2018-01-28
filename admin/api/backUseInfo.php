<?php 
	// 用户登陆之后 用户的信息 保存在哪里? session
	// 设置编码格式
	header('content-type:text/html;charset=utf-8');
	// 开启session
	session_start();

	// 获取用户信息
	$data = $_SESSION['user'];
	// 只返回 必要的信息
	// 用户名 
	$userName = $data[0][4];
	// 用户的头像
	$userIcon = $data[0][5];
	// 可以把 php中的关系型数组 直接转化为 JSON格式的字符串
	$backData = array(
		'userName'=>$userName,
		'userIcon'=>$userIcon
	);
	// 使用一个封装好的函数 进行格式转换
	echo json_encode($backData);

?>