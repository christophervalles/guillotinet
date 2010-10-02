<div class="box box-50"><!-- box 50% width -->
    <div class="boxin">
        <div class="header">
            <h3><?php echo $title; ?></h3>
        </div>
        <div class="content">
            <ul class="simple"><!-- ul.simple for simple listings of pages, categories, etc. -->
                <?php if(!empty($items)) : ?>
                    <?php foreach($items as $i) : ?>
                        <li>
                            <strong><?php echo $i->label; ?></strong>
                            <span><?php echo $i->info;?></span>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li><strong><?php echo $this->lang->line('noInfo'); ?></strong></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>