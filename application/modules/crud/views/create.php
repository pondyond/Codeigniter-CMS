<?php $this->load->view('admin/templates/header'); ?>
<div class="container">
    <div class="row">
        <?php
            if(isset($messages['type'])){ messages($messages); }
            if(!$validation['message'] == ''){ validate($validation); }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Crud:  <small>Create</small></h1>
            <?php echo form_open('',array('class'=>'form-horizontal')); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <?php
                $data = array(
                	'type'          => 'email',
                    'name'          => 'email',
                    'value'         => set_value('email',@$form_data['email']),
                    'maxlength'     => '255',
                    'class'         => 'form-control',
                    'placeholder'   => 'Email'
                );
                echo form_input($data);
				?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <?php
                $data = array(
                    'name'          => 'pass',
                    'value'         => set_value('email',@$form_data['email']),
                    'maxlength'     => '255',
                    'class'         => 'form-control',
                    'placeholder'   => 'Password'
                );
                echo form_password($data);
                ?>
            </div> 
            <?php 
            $data = array(
                    'name'          => 'submit',
                    'value'         => 'submit',
                    'class'         => 'form-control btn btn-info',
                );	
            echo form_submit($data); 
            ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php $this->load->view('admin/templates/footer'); ?>