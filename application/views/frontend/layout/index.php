<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <?php if($redirect) : ?>
        <meta http-equiv="refresh" content="5;url=<?php echo $url->url;?>">
    <?php endif; ?>
    
    <link rel="stylesheet" href="http://static.guilloti.net/css/frontend/style.css" type="text/css" media="screen" />
    
    <title><?php echo $title; ?></title>
</head>
<body>
    <?php if(!$redirect) : ?>
        <?php include 'menu.php';?>
    <?php endif; ?>
    
    <div id="page">
        <?php $this->load->view($content);?>
    </div>
    
    <div id="footer">
        <div id="footer-wrapper">
            <?php echo $this->lang->line('createdBy'); ?><a href="http://www.christophervalles.com">Christopher Valles</a>
        </div>
    </div>
    
    <script src="http://static.guilloti.net/js/common/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    
    <!-- Custom JS per page -->
    <?php if(!is_null($jsFile)) : ?>
        <script type="text/javascript" src="http://static.guilloti.net<?php echo $jsFile; ?>"></script>
    <?php endif; ?>
    
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-16433488-1']);
        _gaq.push(['_setDomainName', 'guilloti.net']);
        _gaq.push(['_trackPageview']);
        
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
</body>
</html>