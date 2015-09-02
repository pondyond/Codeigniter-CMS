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
            <table class="table">
			  <thead>
                    <tr>
                        <th style="width: 50px;"></i>ID</th>
                        <th><i class="icon-caret-right blue"></i>Email</th>
                        <th><i class="icon-caret-right blue"></i>Status</th>
                        <th></th>
                    </tr>
                </thead>
			</table>
        </div>
    </div>
</div>
<?php $this->load->view('admin/templates/footer'); ?>