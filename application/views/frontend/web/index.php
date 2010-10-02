<div id="container" class="clearfix">
    <section id="content">
        <h1><?php echo $this->lang->line('slogan') ?></h1>
        <form action="" method="post" accept-charset="utf-8" id="shorten">
            <section id="fields" class="clearfix">
                <p>
                    <label for="f-url">
                        <span><?php echo $this->lang->line('targetUrl') ?></span>
                        <input type="text" name="url" value="<?php echo $shortURL;?>" autofocus id="f-url" />
                    </label>
                </p>
                <p class="button">
                    <input type="button" name="create_ajax" id="create_ajax" value="<?php echo $this->lang->line('guillotineButton') ?>" class="hidden f-submit"/>
                    <input type="submit" name="create" id="create" value="<?php echo $this->lang->line('guillotineButton') ?>" class="f-submit" />
                </p>
            </section>
        </form>
    </section>
</div>