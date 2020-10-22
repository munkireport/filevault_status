<?php $this->view('partials/head', array(
	"scripts" => array(
		"clients/client_list.js"
	)
)); ?>

<div class="container">
    
  <div class="row">
    <?php $widget->view($this, 'filevault_status'); ?>
    <?php $widget->view($this, 'auth_restart_support'); ?>
    <?php $widget->view($this, 'institutional_recovery_key'); ?>
  </div> <!-- /row -->
    
  <div class="row">
    <?php $widget->view($this, 'personal_recovery_key'); ?>
    <?php $widget->view($this, 'conversion_state'); ?>
  </div> <!-- /row -->

  <div class="row">
    <?php $widget->view($this, 'bootstraptoken_supported'); ?>
    <?php $widget->view($this, 'bootstraptoken_escrowed'); ?>
  </div> <!-- /row -->
    
</div>  <!-- /container -->

<script src="<?php echo conf('subdirectory'); ?>assets/js/munkireport.autoupdate.js"></script>

<?php $this->view('partials/foot'); ?>
