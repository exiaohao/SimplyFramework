<?php
class login extends core
{
	function __construct()
	{
		parent::__construct();
	}
	function _default()
	{
		
	}
	/*
	TakeLogin Act
	*/
	function takelogin()
	{
		
	}
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户登录</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/login.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
	<div class="login-area">
		<form method="post" action="/login/takelogin"  class="form-signin">
			<h3>ETNWS Data Box</h3>
			<input name="account" type="text" id="account" class="form-control" placeholder="账号" required autofocus>
			<input name="password" type="password" id="inputPassword" class="form-control" placeholder="密码" required>
			<input name="checkcode" type="hidden" value="">
			<button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
			<p>ETNWS DBAPI <br />version 0.1</p>
		</form>
	</div>	
</div>
