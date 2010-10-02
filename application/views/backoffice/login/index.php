<div class="box box-50 altbox">
    <div class="boxin">
        <div class="header">
            <h3><?php echo $this->lang->line('projectTitle');?></h3>
            <ul>
                <li><a href="/login" class="active"><?php echo $this->lang->line('loginTitle');?></a></li><!-- .active for active tab -->
                <!-- <li><a href="#"><?php echo $this->lang->line('lostPassword');?></a></li> -->
            </ul>
        </div>
        <form class="table" action="/login/doLogin" method="post"><!-- Default forms (table layout) -->
            <div class="inner-form">
                <?php $this->load->view($error_messages)?>
                <table cellspacing="0">
                    <tr>
                        <th><label for="username"><?php echo $this->lang->line('username');?>:</label></th>
                        <td><input class="txt" type="text" id="username" name="username" /></td>
                    </tr>
                    <tr>
                        <th><label for="password"><?php echo $this->lang->line('password');?>:</label></th>
                        <td><input class="txt pwd" type="password" id="password" name="password" /></td><!-- class error for wrong filled inputs -->
                    </tr>
                    <tr>
                        <th></th>
                        <td class="tr proceed">
                            <input class="button" type="submit" value="<?php echo $this->lang->line('login');?>" />
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>