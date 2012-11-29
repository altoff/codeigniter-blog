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
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet">

	<script src="/js/jquery-1.8.3.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="/">CodeIgniter Blog</a>
				<div class="nav-collapse collapse">
					<p class="navbar-text pull-right">
						<?if($this->session->userdata('id') > 0):?>
							Вы авторизованы [<?=$this->session->userdata('mail');?>]. <a href="/personal/logout">Выйти</a><?if($this->session->userdata('group') == 99):?> | <a href="/admin/">Администрирование</a><?endif;?>
						<?else:?>
							Вы не авторизованы. <a href="/personal/auth/" class="navbar-link">Войти</a>
						<?endif;?>
					</p>
					<ul class="nav">
						<li class="active"><a href="/">Главная</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="span3">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<?if(isset($categorytree) && count($categorytree) > 0):?>
							<li class="nav-header">Разделы</li>
							<?foreach($categorytree as $cat):?>
								<li><a href="/<?=$cat['CODE'];?>"><?=$cat['NAME'];?></a></li>
							<?endforeach;?>
						<?endif;?>
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<div class="span9">
				<div class="hero-unit">
					<h1>Добро пожаловать!</h1>
					<p>Мы открылись.</p>
					<p><a class="btn btn-primary btn-large">читать »</a></p>
				</div>
				<div class="row-fluid">