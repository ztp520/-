<?php  
	// 引入函数
	include '../function.php';

	// 定义提示
	$message = null;
	// 判断请求的方式
	if($_SERVER['REQUEST_METHOD']=='POST'){
		// 接收数据 如果是post
		$userEmail = $_POST['userEmail'];
		$userPass = $_POST['userPass'];

		// 查询数据--数据库
		$sql = "select * from users where email='$userEmail' and password = '$userPass'";
		// 测试代码
		// var_dump($sql);
		$data = my_select($sql);
		
		if(count($data)!=0){
			// 对的 保存为session
			session_start();
			$_SESSION['user'] = $data;
			// 去首页
			header('location:./index.php');
		}else{
			// 错误的 提示用户
			$message ='哥们,用户名或密码错误';
		}
	}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" method='post'>
      <img class="avatar" src="../assets/img/default.png">
			<!-- 有错误信息时展示 -->
			<?php if($message!=null){ ?>
				<div class="alert alert-danger">
					<strong>错误！</strong> <?php echo $message; ?>
				</div>
			<?php } ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name='userEmail' type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" name='userPass' type="password" class="form-control" placeholder="密码">
      </div>
      <button type='submit' class="btn btn-primary btn-block" >登 录</button>
    </form>
  </div>
</body>
</html>
