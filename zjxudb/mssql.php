<?php 
$serverSite="10.20.1.14"; 
$db="zjxushare";
$name="songhao";
$pass="songhao@zjxu"; 
$conn=@mssql_connect($serverSite,$name,$pass) or die("数据库连接错误！"); 
@mssql_select_db("zjxushare",$conn); 
?> 
