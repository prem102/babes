<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Users (Sub Admin) List</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/users/addUser');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add User</a>
           </div>
       </div>
        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                        
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2><?=$list_heading?></h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <div class="jarviswidget-editbox">
                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body no-padding">

                                <table id="dt_basic" class="table table-striped table-bordered table-hover editable-seller-info" width="100%">
                                    <thead>
											<tr>
                                                <th>User-Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Group</th>
                                                <th>Status</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                          if (!empty($users) && is_array($users)) {
                                             foreach ($users as $user) {
												$userGroup			= (!empty($user->group)) ? $user->group : "N/A";
												$userName			= (!empty($user->username)) ? $user->username : "N/A";
												$userEmail			= (!empty($user->email)) ? $user->email : "N/A";
												$userContact		= (!empty($user->phone)) ? $user->phone : "N/A";
												$userStatus			= ($user->active==1) ? 'Active' : 'Inactive' ;
										?>
                                        <tr id="<?=$user->id;?>" >
                                            <td>
												<span class="view_mode"><?=$userName;?></span>
                                            </td>
                                            <td>
												<span class="view_mode"><?=$userEmail;?></span>
                                            </td>
                                            <td>
												<span class="view_mode"><?=$userContact;?></span>
                                            </td>
                                            <td>
												<span class="view_mode"><?=ucfirst($userGroup);?></span>
                                            </td>
                                            <td>
												<?php
													$serStatus = "";$serStatusClass = "";
													if($user->active==1){
														$userStatusClass = "label-success";$userStatus = "Active";
													}else{
														$userStatusClass = "label-warning";$userStatus = "Inactive";
													}
												?>
												<span class="view<?=$user->id;?> label <?=$userStatusClass;?>" id="status<?=$user->id;?>"><?=$userStatus;?></span>
                                            </td>
											<td>
												<a class="btn btn-success commonBtn" data-type ="edit" data-row-id="<?=$user->id.'_A';?>" data-id="<?=$user->id;?>" href="<?=base_url('admin/users/editUser/'.$user->id)?>" >Edit</a>
											</td>
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->
            </div>

        </section>

    </div>

<!--**** Asking for Delete Confirmation ****-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-ok">Delete</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,

        });
        
        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var rowId = $(this).data('removeRow');
            var msg = 'Selected product successfully removed!';
            $.post("<?=base_url('products/removeProduct')?>",{'productId':id}, function (responce){
				if(responce){
					bootstrap_alert.success(msg);
					$('#confirm-delete').modal('hide');
					$('#'+rowId).remove();
				}
			})
        });
        
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
            $('.btn-ok', this).data('removeRow', data.removeRow);
        });
        
    })

</script>
