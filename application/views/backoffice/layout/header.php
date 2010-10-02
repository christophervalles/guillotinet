<div id="header">
    <div class="inner-container clearfix">
        <h1 id="logo">
            <a class="home" href="#" title="<?php echo $this->lang->line('goToAdmin');?>">
                <?php echo $this->lang->line('projectTitle');?> <!-- your title -->
            </a><br />
            <a class="button" href="/web" target="_blank"><?php echo $this->lang->line('goToSite');?></a>
        </h1>
        <div id="userbox">
            <div class="inner">
                <strong><?php echo $_SESSION['username'];?></strong>
                <ul class="clearfix">
                    <li><a href="#"><?php echo $this->lang->line('profile');?></a></li>
                    <li><a href="#"><?php echo $this->lang->line('settings');?></a></li>
                </ul>
            </div>
            <a id="logout" href="/login/doLogout"><?php echo $this->lang->line('logout');?><span class="ir"></span></a>
        </div><!-- #userbox -->
    </div><!-- .inner-container -->
</div><!-- #header -->
<div id="nav">
    <div class="inner-container clearfix">
        <div id="h-wrap">
            <div class="inner">
                <h2>
                    <span class="h-ico <?php echo $menu['selected']['icon'];?>"><span><?php echo $this->lang->line($menu['selected']['translationKey']);?></span></span>
                    <span class="h-arrow"></span>
                </h2>
                <ul class="clearfix">
                    <!-- Admin sections - feel free to add/modify your own icons are located in "/images/backoffice/h-ico/*" -->
                    <?php foreach($menu['items'] as $m) : ?>
                        <li><a class="h-ico <?php echo $m['icon'] ?>" href="<?php echo $m['url'] ?>"><span><?php echo $this->lang->line($m['translationKey']); ?></span></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div><!-- #h-wrap -->
        <form action="" method="post"><!-- Search form -->
            <fieldset>
                <label class="a-hidden" for="search-q"><?php echo $this->lang->line('searchQuery'); ?>:</label>
                <input id="search-q" class="text fl" type="text" name="search-q" size="20" value="<?php echo $this->lang->line('searchDefault'); ?>" />
                <input class="hand fr" type="image" src="/images/backoffice/search-button.png" alt="<?php echo $this->lang->line('search'); ?>" />
            </fieldset>
        </form>
    </div><!-- .inner-container -->
</div><!-- #nav -->

<div id="container">
    <div class="inner-container">