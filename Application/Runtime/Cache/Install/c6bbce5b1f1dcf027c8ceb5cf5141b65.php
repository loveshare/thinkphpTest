<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    
<?php $bodyClss = 'body'; ?>
<?php $htmlClss = 'html'; ?>

    <html class="<?php echo ($htmlClss); ?>">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=7;IE=9;IE=10;IE=Edge;IE=8">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>
<?php echo (L("title")); ?>
</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link rel="stylesheet" media="screen" href="<?php echo (C("PUBLIC_PATH")); ?>/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" media="screen" href="<?php echo (C("PUBLIC_PATH")); ?>/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" media="screen" href="<?php echo (C("PUBLIC_PATH")); ?>/css/theme.css" />
        
        <!--[if lt IE 9]>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->
        <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/ie-emulation-modes-warning.js"></script>
        <!--[if lt IE 9]>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/html5shiv.min.js"></script>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/respond.min.js"></script>
        <![endif]-->
        
        </head>
        <body class="<?php echo ($bodyClss); ?>">
            
            
	<header>
		<div class="navbar navbar-inverse noRadius">
	      <div class="container">
	        <div class="navbar-header">
	          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand hidden-sm active"><?php echo (L("title")); ?></a>
	        </div>
	        <div class="navbar-collapse collapse" role="navigation">
	          <ul class="nav navbar-nav">
	            <li class="hidden-sm hidden-md"><a href="#" target="_blank" >Bootstrap2中文文档</a></li>
	          </ul>
	        </div>
	      </div>
	    </div>
	</header>

            
	<div class="container border-ltrb border-muted border-size-1">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center"><?php echo (L("title")); ?></h1>
				<block name="control">
				<p><?php echo (L("welcome")); ?></p>
				<?php echo (L("installNeed")); ?>
				<?php echo (L("introduction")); ?>
				<p>
					<a type="button" class="btn btn-primary" href="<?php echo U('Install/Install/step',array('step'=>1));?>">
						<?php echo (L("nowInstall")); ?>
					</a>
				</p>
				
            
	<footer></footer>

            
            <div id="modal" class="modal" <?php if(!empty($modalKeyBoard)): ?>data-keyboard="false"<?php endif; ?></div>
            
            
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/jquery/jquery.min.js"></script>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/ie10-viewport-bug-workaround.js"></script>
            <script>
                var themePath = '<?php echo ($themePath); ?>';
                var public = '<?php echo (C("PUBLIC_PATH")); ?>/';
            </script>
            
        </body>
    </html>