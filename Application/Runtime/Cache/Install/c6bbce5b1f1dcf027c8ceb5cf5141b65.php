<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>安装</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo (C("PUBLIC_PATH")); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo (C("PUBLIC_PATH")); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">  
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            
	<ol class="breadcrumb">
		<li><a href="<?php echo U('Install/Index/index');?>"  class="active text-danger">安装协议</a></li>
		<li><a href="javascript:;">环境检测</a></li>
		<li><a href="javascript:;">创建数据库</a></li>
		<li><a href="javascript:;">安装</a></li>
		<li><a href="javascript:;">完成</a></li>
	</ol>

            
            <div>

            </div>
            <div class="article">
                

	<div class="container panel panel-default">
	<header>
		<h1 class="text-center"><?php echo (L("__NAME__")); ?>安装协议</h1>

		<section class="text-muted"><?php echo (L("copyright")); ?></section>
	</header>
	<section class="article-content" style="text-indent: 2em">
		<p><?php echo (L("youUse")); ?></p>
		<p><?php echo (L("install_agreement")); ?></p>
	</section>
	
	<block name="footer">
	<a class="btn btn-primary" href="<?php echo U('Install/Install/step',array('step'=>1));?>"><?php echo (L("nowInstall")); ?></a><p></p>
	

                <div>
                    
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo (C("PUBLIC_PATH")); ?>/jquery/jquery.min.js"></script>
<script src="<?php echo (C("PUBLIC_PATH")); ?>/bootstrap/js/bootstrap.min.js"></script>
    
</body>
</html>