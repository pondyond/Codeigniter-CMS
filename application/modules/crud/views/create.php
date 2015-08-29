<?php $this->load->view('admin/templates/header'); ?>
<body>
    <?php $this->load->view('admin/templates/header_secondary'); ?>
    <div class="main-container" id="main-container">        
        <div class="main-container-inner">
            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>
            <?php $this->load->view('admin/templates/side_nav'); ?>
            <div class="main-content">               
                <div class="page-content">
                	<div class="page-header">
                        <h1>
                            <?php echo $title; ?>
                            <small>
                                <i class="icon-double-angle-right"></i>
                                <?php echo $sub_title; ?>
                            </small>
                        </h1>
                    </div>                    
                    <div class="row">
                            <?php 
                                if(isset($messages['type'])){ messages($messages); }
                                if(!$validation['message'] == ''){ validate($validation); }
                            ?>
                            <div class="col-md-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <?php echo form_open('',array('class'=>'form-horizontal')); ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label no-padding-right">E-mail <span class="red">*</span></label>
                                        <div class="col-md-9">
                                            <?php echo form_input(array('name'=>'email', 'value'=>set_value('email',@$form_data['email']), 'class'=>'col-md-5')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label no-padding-right">Password Field <span class="red">*</span></label>
                                        <div class="col-md-9">
                                            <?php echo form_input(array('type'=>'password', 'name'=>'pass', 'value'=>set_value('pass',@$form_data['password']), 'class'=>'col-md-5')); ?>
                                            <span class="help-inline col-md-4">
                                                <span class="middle"><small class="grey">help text</small></span>
                                            </span>
                                        </div>
                                    </div>         
                                    <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <?php echo form_submit(array('name'=>'submit', 'value'=>'submit', 'class'=>'btn btn-info')); ?>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    CKEDITOR.replace( 'editor1' );
                                </script>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div>
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container-inner -->
    </div><!-- /.main-container -->
<?php $this->load->view('admin/templates/footer'); ?>