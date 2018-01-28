<?php
	// 引入函数
	include '../../function.php';

	// 查询一堆数据 并返回
	// 文章总数
	$totalPostsCount = count(my_select("select * from posts"));
	// 文章草稿数
	$totalPostsCount_cg = count(my_select("select * from posts where status = 'drafted'"));

	// 分类数
	$categoriesCount = count(my_select("select * from categories"));

	// 评论数
	$totalCommentsCount = count(my_select("select * from comments"));
	// 待审核评论数
	$totalCommentsCount_dsh = count(my_select("select * from comments where status='held'"));

	// 查询出来的信息
	$backData = array(
		'totalPostCount'=>$totalPostsCount,
		'totalPostsCount_cg'=>$totalPostsCount_cg,
		'categoriesCount'=>$categoriesCount,
		'totalCommentsCount'=>$totalCommentsCount,
		'totalCommentsCount_dsh'=>$totalCommentsCount_dsh
	);

	// 格式化为json返回
	echo json_encode($backData);

?>