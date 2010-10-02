<div id="box1" class="box box-100"><!-- box full-width -->
    <div class="boxin">
        <div class="header">
            <h3><?php echo $title;?></h3>
        </div>
        <div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
            <?php if($showBulkActions) : ?>
                <form class="plain" action="<?php echo $deleteUrl; ?>" method="post" id="bulk_form" enctype="multipart/form-data">
            <?php endif; ?>
            <fieldset>
                <table cellspacing="0">
                    <thead><!-- universal table heading -->
                        <tr>
                            <?php if($showBulkActions) : ?>
                                <td class="tc"><input type="checkbox" id="bulk_all" name="bulk_all" value="true" /></td>
                            <?php endif; ?>
                            <?php foreach($columns as $k => $v) : ?>
                                <td class="tc"><?php echo $v; ?></td>
                            <?php endforeach; ?>
                            <?php if($showBulkActions) : ?>
                                <td class="tc"><?php echo $this->lang->line('actions'); ?></td>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tfoot><!-- table foot - what to do with selected items -->
                        <tr>
                            <?php if($showBulkActions) : ?>
                                <td colspan="<?php echo count($columns) + 2; ?>"><!-- do not forget to set appropriate colspan if you will edit this table -->
                            <?php else : ?>
                                <td colspan="<?php echo count($columns); ?>"><!-- do not forget to set appropriate colspan if you will edit this table -->
                            <?php endif; ?>
                                <?php if($showBulkActions) : ?>
                                    <label>
                                        <?php echo $this->lang->line('selectionLabel'); ?>:
                                        <select name="bulk_actions">
                                            <option value="delete">delete</option>
                                        </select>
                                    </label>
                                    <input type="hidden" name="action" value="bulk" id="action">
                                    <input class="button altbutton" type="button" onclick="showConfirmation();" value="OK" />
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if(!is_null($items)) : ?>
                            <?php $x = 0;?>
                            <?php foreach($items as $i) : ?>
                                <?php $counter++;?>
                                <tr <?php echo ($counter==1)? 'class="first"' : '';?>><!-- .first for first row of the table (only if there is thead) -->
                                    <?php if($showBulkActions) : ?>
                                        <td class="tc"><input type="checkbox" class="bulk_item" name="bulk_item[]" value="<?php echo $i->id;?>" /></td>
                                    <?php endif; ?>
                                    <?php foreach($columns as $k => $v) : ?>
                                        <td class="tc"><?php echo $i->{$k};?></td>
                                    <?php endforeach; ?>
                                    <?php if($showBulkActions) : ?>
                                        <td class="tc"><!-- action icons - feel free to add/modify your own - icons are located in "/images/backoffice/led-ico/*" -->
                                            <ul class="actions">
                                                <li><a class="ico eraseButton" href="#" rel="<?php echo $deleteUrl; ?>" id="<?php echo $i->id;?>"><img src="/images/backoffice/led-ico/delete.png" alt="delete" /></a></li>
                                            </ul>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td class="tc" colspan="12">
                                    <strong><?php echo $this->lang->line('noInfo'); ?></strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </fieldset>
            <?php if($showBulkActions) : ?>
                </form>
            <?php endif; ?>
            <?php if($showPaginator) : ?>
                <div class="pagination"><!-- pagination underneath the box's content -->
                    <?php echo $paginator;?>
                </div>
            <?php endif; ?>
        </div><!-- .content#box-1-holder -->
    </div>
</div>

<div id="dialog-confirm" class="hidden" title="<?php echo $this->lang->line("areYouSureTitle"); ?>">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $this->lang->line("areYouSure"); ?></p>
</div>