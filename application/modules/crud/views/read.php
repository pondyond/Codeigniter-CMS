<?php $this->load->view('admin/templates/header'); ?>
<script type="text/javascript">
  function ConfirmDelete(row){
        if (confirm("Confirm Delete."))
             location.href='<?php echo base_url(); ?>app/crud/delete/'+row;
  }
  function SortSubmit(){
    var formObject = document.forms['sorter'];
    formObject.submit();
  }
</script>
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
                    <div>
                        <?php if(isset($messages['type'])){ messages($messages); } ?>
                        <div class="dataTables_wrapper">
                            <div class="row" style="height: 60px;">
                                    <div class="col-md-3" style="margin-right:0px;padding-right: 0px">
                                    	<form id="sorter" method="post">
                                            <?php echo form_dropdown('by', $sort_options, set_value('by',$sort_data['by']));
                                            foreach (array('asc','desc') as $key => $value) { ?>
	                                            <input onchange="SortSubmit()" class="ace" type="radio" name="sort_value" value="<?php echo $value; ?>" <?php if($value == set_value('sort_value',$sort_data['sort_value'])) { echo 'checked'; } ?>>
	                                            <span class="lbl"><?php echo $value; ?></span>
                                            <?php } ?>
                                        </form>
                                    </div>
                                    <div class="dataTables_filter" id="sample-table-2_filter">
                                    <div class="col-md-9 pull-right">
                                        <form method="post">
                                            <div class="col-md-1 pull-right" style="width: 85px; padding: 0px"><input type="submit" value="Reset" name="reset" class="btn btn-sm btn-warning" style="padding-bottom: 0px; float:left;"></div>
                                            <div class="col-md-1 pull-right" style="width: 85px;"><input type="submit" value="Search" name="search" class="btn btn-sm btn-success" style="padding-bottom: 0px;"></div>
                                            <div class="col-md-4 pull-right" style="width: 285px;">
                                                <?php echo form_input(array('name'=>'search_value', 'value'=>set_value('search_value',$search_data['search_value']), 'style' => 'width:100%;')); ?>
                                            </div>
                                            <div class="col-md-2 pull-right" style="width: 100px;">
                                                <?php echo form_dropdown('by', $search_options, set_value('by',$search_data['by']), 'style="width:100%;",tab'); ?>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <!-- PAGE CONTENT BEGINS -->
                                    <table class="table table-bordered table-striped">
                                        <thead class="thin-border-bottom">
                                            <tr>
                                                <th style="width: 50px;"><i class="icon-caret-right blue"></i>ID</th>
                                                <th><i class="icon-caret-right blue"></i>Email</th>
                                                <th><i class="icon-caret-right blue"></i>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!$result){ ?>
                                                <tr>
                                                    <td colspan="4">No result</td>
                                                </tr>
                                            <?php } ?>
                                            <?php if($result){ ?>
                                            <?php foreach ($result as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo $value['id']; ?></td>
                                                    <td><?php echo $value['email']; ?></td>
                                                    <td><?php status_button('app/crud/',$value['status'],$value['id']); ?></td>
                                                    <td>
                                                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">                                                          
                                                            <a href="<?php echo base_url(); ?>app/crud/update/<?php echo $value['id']; ?>" class="green">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a>
                                                            <a href="#" onclick="ConfirmDelete(<?php echo $value['id']; ?>)" class="red">
                                                                <i class="icon-trash bigger-130"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } } ?>                                            
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_paginate paging_bootstrap">
                                                <ul class="pagination">
                                                    <?php echo $links; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"></div>
                                    </div>
                                    <!-- PAGE CONTENT ENDS -->
                                </div><!-- /.col -->
                            </div>
                        </div>
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container-inner -->
    </div><!-- /.main-container -->
<?php $this->load->view('admin/templates/footer'); ?>