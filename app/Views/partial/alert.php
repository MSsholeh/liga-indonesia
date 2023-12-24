<?php
if(session()->getFlashData('success')){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashData('success') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
}
?>

<?php
if(session()->getFlashData('error')){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashData('error') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
}
?>

<?php
if(session()->getFlashData('info')){
?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <?= session()->getFlashData('error') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
}
?>
