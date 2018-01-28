<?php

define('HOSTNAME','127.0.0.1'); // 数据库地址
define('USERNAME','root');      // 用户名
define('USERPASS','root');      // 用户密码
define('DBNAME','baixiu');       // 数据库名

// 为常量 赋值 常量是不能赋值
// HOSTNAME = '124';


    // 查询数据
function my_select($sql)
{
    // 人为的声明 告诉php 这些变量时 全局作用域中的变量
    // global $hostName,$userName,$userPass,$dbName;

    // 连接数据库
    $link = mysqli_connect(HOSTNAME,USERNAME,USERPASS,DBNAME);
    
    // 执行SQL语句
    $result = mysqli_query($link, $sql);
    
    // 解析结果
    $data = mysqli_fetch_all($result);
    
    // 关闭连接
    mysqli_close($link);
    // 返回数据
    return $data;
}



    // 增删改
function my_ZSG($sql)
{
    // 连接数据库
    $link = mysqli_connect(HOSTNAME,USERNAME,USERPASS,DBNAME);
    
    // 执行SQL语句
    mysqli_query($link, $sql);
    
    // 获取受影响的行数
    $rowNUm = mysqli_affected_rows($link);
    
    // 关闭连接
    mysqli_close($link);

    // 返回数据
    return $rowNUm;
}

    // 上传文件的函数
    // 封装为一个 文件上传函数 目的是保证 中文不会乱码
function my_uploadFile($fileName, $targetPath)
{
  // 获取文件名
    $name = $_FILES[$fileName]['name'];
  /*
      转换编码格式
      utf-8的编码格式 转换为 gb2312
      代码的编码格式是utf-8 浏览器传递给服务器的数据的编码也是 utf-8
      windows操作系统的 文件系统的编码格式是 gbk 
      转换之后 就可以正常保存了
      工作中碰到了某个具体的问题 不会解决
          百度 谷歌 找到关键字
              blog 网站 帖子
          再去文档
              前端开发 w3c（离线版本）
              MDN（主要是前端 内容比较新）
              php离线文档  php官方网站
  */
    $name= iconv("UTF-8", "gb2312", $name);
    
    // . 是php中的拼接字符串
    move_uploaded_file($_FILES[$fileName]['tmp_name'], $targetPath.$name);

    // 返回文件的名字 保证后续的 使用
    // 因为$name 已经被转换为 gb2312的编码格式 而数据库中的编码格式是 utf8 所以我们返回的是 之前的数据 不要返回$name
    return $_FILES[$fileName]['name'];
}
