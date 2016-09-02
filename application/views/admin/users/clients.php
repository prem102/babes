<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Users (Clients) List</strong>
               </h3>
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
                            <h2><?=!empty($list_heading) ? $list_heading : '';?></h2>
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
											<form action="<?=current_url();?>" id="client-serach-form" method="post">
												<tr role="row">
												<th style="width:15%" class="hasinput" rowspan="1" colspan="1">
													<input type="text" name="username" placeholder="Filter User Name" class="form-control" value="<?=(isset($searchUsername) && !empty($searchUsername)) ? $searchUsername : '';?>">
												</th>
												<th style="width:20%" class="hasinput" rowspan="1" colspan="1">
													<input type="text" name="email" placeholder="Filter Email" class="form-control" value="<?=(isset($searchUserEmail) && !empty($searchUserEmail)) ? $searchUserEmail : '';?>">
												</th>
												<th style="width:15%" class="hasinput" rowspan="1" colspan="1">
													<input type="text" name="contact" placeholder="Filter Contact" class="form-control" value="<?=(isset($searchUserContact)) ? $searchUserContact : '';?>">
												</th>
												<th style="width:15%" class="hasselect" rowspan="1" colspan="1">
													<select name="active" class="form-control">
														<option value="">Select Status</option>
														<option value="1" <?=(!empty($searchUserStatus) && $searchUserStatus==1) ? 'selected' : '';?>>Active</option>
														<option value="2" <?=(!empty($searchUserStatus) && $searchUserStatus==2) ? 'selected' : '';?>>Inactive</option>
													</select>
												</th>
												<th style="width:15%" class="hasinput" rowspan="1" colspan="1">
													<input type="submit" class="btn btn-primary" class="form-control" value="Search" name="search">
													<input type="submit" class="btn btn-warning" class="form-control" value="Reset" name="reset">
												</th>
												</tr>
											</form>
											<tr>
                                                <th>User-Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Status</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                          if (!empty($users) && is_array($users)) {
                                             foreach ($users as $user) {
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
												<?php
													$userStatus = "";$userStatusClass = "";
													if($user->active==1){
														$userStatusClass = "label-success";$userStatus = "Active";
													}else{
														$userStatusClass = "label-warning";$userStatus = "Inactive";
													}
												?>
												<span class="view<?=$user->id;?> label <?=$userStatusClass;?>" id="status<?=$user->id;?>"><?=$userStatus;?></span>
                                            </td>
											<td>
												<a class="btn btn-success commonBtn" data-type ="edit" data-row-id="<?=$user->id.'_A';?>" data-id="<?=$user->id;?>" href="<?=base_url('admin/users/editClient/'.$user->id)?>" >Edit</a>
											</td>
                                        </tr>
                                        <?php } }else{ ?>
											<tr>
												<td colspan="5" align="center">
													<span>No Records Found</span>
												</td>
											</tr>
										<?php } ?>
                                    </tbody>
                                    
                                </table>

                            </div>
                            
                            <!-- Testing-->
                            <div class="dt-toolbar-footer">
								<div class="col-sm-6 col-xs-6 hidden-xs">
									<div class="dataTables_info" id="dt_basic_info" role="status" aria-live="polite">Showing 
									<span class="txt-color-darken"><?=$recordsFrom;?></span> to <span class="txt-color-darken"><?=($totalRecords < $limit ) ? $totalRecords : $limit;?></span>
									of <span class="text-primary"><?=$totalRecords;?></span> entries
									</div>
								</div>
								
                            <div class="col-xs-6 col-sm-6">
								<div class="dataTables_paginate paging_simple_numbers" id="dt_basic_paginate">
									<ul class="pagination pagination-sm">
                            <?php
								echo $links;
                            ?>
									</ul>
								</div>
							</div>
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

<script type="text/javascript">
    $(document).ready(function () {
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
