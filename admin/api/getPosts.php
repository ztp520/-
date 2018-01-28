<?php 
	// 引入函数
	include '../../function.php';

	// 设置返回的类型为JSON
	header('content-type:application/json;charset=utf-8');

	// 接收提交过来的参数
	$pageNum = isset($_GET['pageNum'])?$_GET['pageNum']:1;
	$pageSize = isset($_GET['pageSize'])?$_GET['pageSize']:10;

	// 计算起始的索引
	$startIndex = ($pageNum-1)*$pageSize;

	// 数据库查询 某一页的数据
	$sql = "
	select 
	posts.id,
	posts.title,
	users.nickname,
	categories.name,
	posts.created,
	posts.status
	from posts
	inner join users on posts.user_id = users.id
	inner join categories  on posts.category_id = categories.id
	limit $startIndex,$pageSize
	";

	// 查询数据
	// 当前页数据
	$pageData = my_select($sql);

	// 查询 总数据 进而计算 总页数
	$totalCount = count(my_select("select * from posts"));

	// 总页数 向上取整
	$totalPage = ceil($totalCount/$pageSize);

	// 返回给浏览器
	$backData = array(
		'pageData'=>$pageData,
		'totalPage'=>$totalPage,
		'pageNum'=>$pageNum
	);

	// 转化为json 并返回
	echo json_encode($backData);

?>