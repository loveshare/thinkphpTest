<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    
<?php $bodyClss = 'body'; ?>
<?php $htmlClss = 'html'; ?>

    
	<?php $publicScript[] = 'validator/js/bootstrapValidator.min'; ?>
	<?php $publicCss[] = 'validator/css/bootstrapValidator.min'; ?>

    <html class="<?php echo ($htmlClss); ?>">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=7;IE=9;IE=10;IE=Edge;IE=8">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo (L("setConfig")); ?></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <!--[if lt IE 9]>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->
        <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/ie-emulation-modes-warning.js"></script>
        <!--[if lt IE 9]>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/html5shiv.min.js"></script>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" media="screen" href="<?php echo (C("PUBLIC_PATH")); ?>/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" media="screen" href="<?php echo (C("PUBLIC_PATH")); ?>/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" media="screen" href="<?php echo (C("PUBLIC_PATH")); ?>/css/theme.css" />
        <?php
 if(!empty($publicCss)){ foreach($publicCss as $k=>$v){ if($v) echo "<link href='",C('PUBLIC_PATH'),"/",$v,".css' />"; } } if(!empty($themeCss)){ foreach($themeCss as $k=>$v){ if($v) echo "<link href='",$themePath,"/",$v,".css' />"; } } if(!empty($loadCss)){ foreach($loadScript as $k=>$v){ if($v) echo "<link href='",$v,"' />"; } } if(!empty($styleCss)){ echo "<style>",$style,"</style>"; } ?>
        
        
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
	            <li class="hidden-sm hidden-md"><a href="#">介绍</a></li>
	            <li class="hidden-sm hidden-md"><a href="#">配置文件</a></li>
	          </ul>
	        </div>
	      </div>
	    </div>
	</header>

            
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron">
					<h1 class="text-center"><?php echo (L("title")); ?></h1>
					
	<h4 class="text-primary"><?php echo (L("setData")); ?></h4>
	<form method="post" id="dataForm" class="form-horizontal" action="<?php echo U('Install/Install/step',array('step'=>2));?>" novalidate="novalidate">
		<div class="alert alert-info" role="alert"><?php echo (L("setIntroduction")); ?></div>
		<div class="form-group has-feedback">
            <label class="col-lg-3 control-label"><?php echo (L("dataName")); ?></label>
            <div class="col-lg-5">
                <input type="text" class="form-control" name="dbname" data-bv-field="dbname" placeholder="<?php echo (L("dataName")); ?>">
              </div>
        </div>
        <div class="form-group has-feedback">
            <label class="col-lg-3 control-label"><?php echo (L("userName")); ?></label>
            <div class="col-lg-5">
                <input type="text" class="form-control" name="uname" data-bv-field="uname" placeholder="<?php echo (L("userName")); ?>">
             </div>
        </div>
        <div class="form-group has-feedback">
            <label class="col-lg-3 control-label"><?php echo (L("passWord")); ?></label>
            <div class="col-lg-5">
                <input type="text" class="form-control" name="passWord" data-bv-field="passWord" placeholder="<?php echo (L("passWord")); ?>">
             </div>
        </div>
        <div class="form-group has-feedback">
            <label class="col-lg-3 control-label"><?php echo (L("host")); ?></label>
            <div class="col-lg-5">
                <input type="text" class="form-control" name="dbhost" data-bv-field="dbhost" placeholder="<?php echo (L("host")); ?>">
             </div>
        </div>
        <!-- <div class="form-group has-feedback">
            <label class="col-lg-3 control-label"><?php echo (L("domain")); ?></label>
            <div class="col-lg-5">
                <input type="text" class="form-control" name="domain" data-bv-field="domain" placeholder="<?php echo (L("domain")); ?>">
             </div>
        </div>
        <div class="form-group has-feedback">
            <label class="col-lg-3 control-label"><?php echo (L("siteCode")); ?></label>
            <div class="col-lg-5">
                <input type="text" class="form-control" name="siteCode" data-bv-field="siteCode" placeholder="<?php echo (L("siteCode")); ?>">
             </div>
        </div> -->
		<p class="step">
		<button type="submit" class="btn btn-primary"><?php echo (L("submit")); ?></button></p>
	</form>

				</div>
			</div>
		</div>
	</div>

            
	<footer></footer>

            
            
            
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/jquery/jquery.min.js"></script>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo (C("PUBLIC_PATH")); ?>/js/ie10-viewport-bug-workaround.js"></script>
            <script>
                var themePath = '<?php echo ($themePath); ?>';
                var public = '<?php echo (C("PUBLIC_PATH")); ?>/';
                <?php
 if(!empty($varScript)){ foreach($varScript as $k=>$v){ if($v) echo 'var ',$k,' = ',$v,';'; } } if(!empty($codeScript)){ echo $codeScript; } ?>
            </script>
            
	<script>
		var noempty = '<?php echo (L("noempty")); ?>';
		var preg_w = '<?php echo (L("preg_w")); ?>';
		var noValidate = '<?php echo (L("noValidate")); ?>';
		var preg_w_wn = '<?php echo (L("preg_w_wn")); ?>';
		var maxLength30 = '<?php echo (L("maxLength30")); ?>';
		<?php $publicScript[] = 'js/installStep1'; ?>
	</script>

            <?php
 if(!empty($publicScript)){ foreach($publicScript as $k=>$v){ if($v) echo "<script src='",C('PUBLIC_PATH'),"/",$v,".js'></script>"; } } if(!empty($themeScript)){ foreach($themeScript as $k=>$v){ if($v) echo "<script src='",$themePath,"/",$v,".js'></script>"; } } if(!empty($loadScript)){ foreach($loadScript as $k=>$v){ if($v) echo "<script src='",$v,"'></script>"; } } ?>
            
        </body>
    </html>