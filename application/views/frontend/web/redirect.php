<div id="container" class="clearfix">
    <section id="content">
        <h1>
            <?php echo $this->lang->line('redirect');?><br />
            <a href="<?php echo $url->url ?>"><?php echo $urlWoTransport;?></a>
        </h1>
        <h3>
            <?php echo $this->lang->line('redirectNoSupported') ?>
        </h3>
    </section>
    <section id="ads">
        <p>
            <?php echo $this->lang->line('adsRemember'); ?><a href="<?php echo base_url();?>">Guilloti.net</a><?php echo $this->lang->line('adsShortUrl'); ?>
        </p>
    </section>
</div>