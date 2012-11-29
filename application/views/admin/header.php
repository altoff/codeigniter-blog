<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title><? echo $this->config->item('title'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<? echo $this->config->item('description'); ?>">
	<meta name="keywords" content="<? echo $this->config->item('keywords'); ?>">
	<meta name="author" content="">
	<link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="/css/unicorn.main.css">
	<link rel="stylesheet" href="/css/unicorn.grey.css" class="skin-color">
	<link rel="stylesheet" href="/css/redactor.css">
	<link rel="stylesheet" href="/css/datepicker.css">
	<script src="/js/jquery-1.8.3.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery.dataTables.min.js"></script>
	<script src="/js/redactor.js"></script>
	<script src="/js/redactor803-ru.js"></script>
	<script src="/js/bootstrap-datepicker.js"></script>
	<script src="/js/bootstrap-datepicker.ru.js"></script>
	<script src="/js/unicorn.js"></script>
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div id="header">
		<h1><a href="/admin">CodeIgniter Blog</a></h1>		
	</div>
	<div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav btn-group" style="width: auto; margin: 0px;">
            <li class="btn btn-inverse"><a title="" href="/personal"><i class="icon icon-user"></i> <span class="text">Профиль</span></a></li>
            <li class="btn btn-inverse"><a title="" href="/personal/logout"><i class="icon icon-share-alt"></i> <span class="text">Выход</span></a></li>
        </ul>
    </div>
        
	<div id="sidebar">
		<a href="/admin" class="visible-phone"><i class="icon icon-home"></i> Администрирование</a>
		<ul style="display: block;">
			<li><a href="/admin"><i class="icon icon-home"></i> <span>Администрирование</span></a></li>
			<li class="submenu">
				<a href="#"><i class="icon icon-file"></i> <span>Записи</span></a>
				<ul>
					<li><a href="/admin/posts">Все записи</a></li>
					<li><a href="/admin/editpost">Добавить запись</a></li>
				</ul>
			</li>
			<li><a href="/admin/category"><i class="icon icon-th-list"></i> <span>Разделы</span></a></li>
			<li class="submenu">
				<a href="#"><i class="icon icon-user"></i> <span>Пользователи</span></a>
				<ul>
					<li><a href="/admin/users">Все пользователи</a></li>
					<li><a href="/admin/editusers">Добавить пользователя</a></li>
				</ul>
			</li>
		</ul>
	
	</div>

	<div id="content">