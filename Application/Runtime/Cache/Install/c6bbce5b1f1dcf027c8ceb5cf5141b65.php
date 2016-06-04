<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    <html>
    
<?php $bodyClss = 'bodyClss'; ?>
<?php $modalKeyBoard = '1'; ?>

    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7;IE=9;IE=10;IE=Edge;IE=8">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
<?php echo (L("title")); ?>
</title>
    <meta name="keywords" content="<block keywords><block>" />
    <meta name="description" content="<block description><block>" />
    <link rel="stylesheet" media="screen" href="" />
    
    <!--[if lt IE 8]>
      <link href="" rel="stylesheet">
      <![endif]-->
    <!--[if lt IE 9]>
      <script src=""></script>
      <![endif]-->
      <!-- [if IE 8]
      <script  src=""></script>
      <![endif]-->
    
    </head>
    <body class="<?php echo ($bodyClss); ?>">
        
            
            
            
            
            
            
        
        
    <div id="modal" class="modal" <?php if(!empty($modalKeyBoard)): ?>data-keyboard="false"<?php endif; ?></div>
    
    
    
    
    
        <script src="<?php echo (C("PUBLIC_PATH")); ?>/jquery/jquery.min.js"></script>
        <script src="<?php echo (C("PUBLIC_PATH")); ?>/bootstrap/js/bootstrap.min.js"></script>

        <script>
            var themePath = '<?php echo ($themePath); ?>';
            var public = '<?php echo (C("PUBLIC_PATH")); ?>/';
        </script>
        
    </body>
    </block>
</html>