<?php
define('DEFAULT_CONTROLLER', 'home');
define('_ARL_AUTHECARD', 1);

require 'mysql.php';
//Core Class
class core extends mysql
{
	function __construct()
	{
		parent::__construct();
	}

	/*
	验证用户API读取权限
	*/
	function user_apilegal($utkn, $resid)
	{
		$return = array('errid'=>-1, 'err_msg'=>'not completed');
		//
		$qTknLine = $this->db->query("SELECT * FROM `api_resource_control` WHERE `tkn` LIKE '{$utkn}' LIMIT 0 ,1;");
		if($qTknLine->num_rows)
		{
			$tknInfo = $qTknLine->fetch_assoc();
			foreach(json_decode($tknInfo['permission']) as $pnode)
			{
				if($pnode == $resid)
				{
					$return = array('errid'=>200, 'err_msg'=>'token authenticated');
					return $return;
				}
			}
			$return = array('errid'=>403, 'err_msg'=>'token illegal');
			return $return;
		}
		else
		{
			$return = array('errid'=>404, 'err_msg'=>'token not exists!');
			return $return;
		}
	}
	/*
	验证访问频度和日请求量
	*/
	function user_queryfreqlegal($utkn, $resid)
	{
	
	}
}


//Page Error
class PageError
{
	function HttpError($ecode)
	{
		require dirname(__FILE__)."/../static/{$ecode}.php";
		die();
	}
}
//
if( !@IN_PAGE )
{
	PageError::HttpError(403);
}
//URL Parser
//Define $req_uri
//
//REQUEST_URI
$req_uri_clearq = explode('?', $_SERVER['REQUEST_URI']);
$req_uri_clearm = explode(':', $req_uri_clearq[0]);
$req_uri = array_slice(explode('/', $req_uri_clearm[0]), 1);
//
$_GET['_controller'] = @ $req_uri[0];
$_GET['_action'] = @ $req_uri[1];

if( empty($_GET['_controller']))
{
	$_GET['_controller'] = DEFAULT_CONTROLLER;
	require dirname(__FILE__).'/../controller/'.$_GET['_controller'].'.php';
	$page = new $_GET['_controller'];
	$_pHandle = $page->_default(@$req_uri_clearm[1]);
}
else
{
	$fp_file = dirname(__FILE__).'/../controller/'.$_GET['_controller'].'.php';
	$fp = @ fopen($fp_file, 'r');
	if($fp)
	{
		require dirname(__FILE__).'/../controller/'.$_GET['_controller'].'.php';
		if( empty($_GET['_action']) )
		{
			
			$page = new $_GET['_controller'];
    		$_pHandle = $page->_default(@$req_uri_clearm[1]);
		}
		else
		{
			$page = new $_GET['_controller'];
            $_pHandle = $page->$_GET['_action'](@$req_uri_clearm[1]);
		}
	}
	else
	{
		PageError::HttpError(404);
	}
}

?>
