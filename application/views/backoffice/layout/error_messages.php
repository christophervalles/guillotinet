<?php if ($this->session->flashdata('statusMsgType')): ?>
    <?php if ($this->session->flashdata('statusMsgType') == "SUCCESS"): ?>
        <div class="msg msg-ok">
            <p><?php echo $this->session->flashdata('statusMsg');?></p>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('statusMsgType') == "INFO"): ?>
        <div class="msg msg-info">
            <p><?php echo $this->session->flashdata('statusMsg');?></p>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('statusMsgType') == "WARN"): ?>
        <div class="msg msg-warn">
            <p><?php echo $this->session->flashdata('statusMsg');?></p>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('statusMsgType') == "ERROR"): ?>
        <div class="msg msg-error">
            <p><?php echo $this->session->flashdata('statusMsg');?></p>
        </div>
    <?php endif; ?>
<?php endif; ?>