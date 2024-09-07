<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?=session()->getFlashdata('error')?>
    </div>
<?php elseif (session()->getFlashdata('success')): ?>
    <div class="alert alert-primary">
        <?=session()->getFlashdata('success')?>
    </div>
<?php endif;?>