<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
    <head>
    
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-style-type" content="text/css" />
        <meta http-equiv="content-script-type" content="text/javascript" />
        
        <title><?php echo $title?></title>
        
        <link rel="stylesheet" type="text/css" href="/css/backoffice/black.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/common/jquery-ui.css" />
        <!--[if lte IE 7.0]><link rel="stylesheet" type="text/css" href="/css/backoffice/ie.css" media="all" /><![endif]-->
        <!--[if IE 8.0]>
            <style type="text/css">
                form.fields fieldset {margin-top: -10px;}
            </style>
        <![endif]-->
        
        <script type="text/javascript" src="/js/common/jquery.min.js"></script>
        <script type="text/javascript" src="/js/common/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/backoffice/functions.js"></script>
        <?php if(!is_null($jsFile)) : ?>
            <script type="text/javascript" src="<?php echo $jsFile; ?>"></script>
        <?php endif; ?>
        <!-- Adding support for transparent PNGs in IE6: -->
        <!--[if lte IE 6]>
            <script type="text/javascript" src="/js/common/ddpng.js"></script>
            <script type="text/javascript">
                DD_belatedPNG.fix('h3 img');
                DD_belatedPNG.fix('#nav #h-wrap .h-ico');
                DD_belatedPNG.fix('.ico img');
                DD_belatedPNG.fix('.msg p');
                DD_belatedPNG.fix('table.calendar thead th.month a img');
                DD_belatedPNG.fix('table.calendar tbody img');
            </script>
        <![endif]-->
        
    </head>
    <body id="<?php echo $className?>">
        <?php if($className != 'login') : ?>
            <?php $this->load->view($layoutHeader);?>
        <?php endif; ?>
        <?php $this->load->view($content);?>
        <?php if($className != 'login') : ?>
            <?php $this->load->view($layoutFooter);?>
        <?php endif; ?>
    </body>
</html>