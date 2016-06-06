<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    <html>
        
<?php $bodyClss = 'bodyClss'; ?>

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