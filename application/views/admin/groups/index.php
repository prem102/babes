<style>
	.editable{
		display:none;
		}
</style>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>
<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Groups List</strong>
               </h3>
           </div>
           <?php
				if($permissionValue==4 || $permissionValue==5 || $permissionValue==6 || $permissionValue==7){
			?>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/groups/add');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Group</a>
           </div>
			<?php
				}
			?>
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

                                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>
											<tr>
                                                <th>User Group</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                            if (!empty($groups)) {
                                                foreach ($groups as $group) {
										?>
                                        <tr id="<?=$group->id.'_A';?>">

                                            <td>
												<span class="view<?=$group->id;?>" id="name<?=$group->id;?>"><?=(!empty($group->name)) ? $group->name : "N/A";?></span>
												<form class="smart-form" id="group-form-<?=$group->id;?>"  method="post" data-parsley-validate="" enctype="multipart/form-data">
												<input class="a<?=$group->id;?> editable"  type="text" placeholder="Group Name" name="name" required=""  value="<?=!empty($group->name) ? $group->name : '';?>">
												<input type="hidden" name="id" required=""  value="<?=!empty($group->id) ? $group->id : 0;?>">
											</td>
                                            <td>
												<p class="view<?=$group->id;?>" id="description<?=$group->id;?>"><?=(!empty($group->description)) ? ellipsize($group->description,50) : "N/A";?></p>
												<textarea class="a<?=$group->id;?> editable"  name="description" id="description" data-parsley-length="[50, 500]" required="" placeholder="Group Description"><?=!empty($group->description) ? $group->description : '';?></textarea>
											</td>
											<td>
												<?php
													$groupStatus = "";$groupStatusClass = "";
													if($group->status==1){
														$groupStatusClass = "label-success";$groupStatus = "Active";
													}else{
														$groupStatusClass = "label-warning";$groupStatus = "Inactive";
													}
												?>
												<span class="view<?=$group->id;?> label <?=$groupStatusClass;?>" id="status<?=$group->id;?>"><?=$groupStatus;?></span>
												<select name="status" class="a<?=$group->id;?> editable"  data-parsley-required id="status" class="a<?=$group->id;?>">
													<option value="1" <?=($group->status==1) ? 'selected' : '' ?> >Active</option>
													<option value="0" <?=($group->status==0) ? 'selected' : '' ?>>Inactive</option>
												</select>
                                            </td>
											<td>
												<a class="btn btn-success view<?=$group->id;?>" href="<?=base_url('admin/groups/edit/'.$group->id)?>" data-id="<?=$group->id?>" data-view-id="<?=$group->id?>">Edit</a>
												<button class="btn btn-success update pull-right editable a<?=$group->id ?>" data-id="<?=$group->id?>">Update</button>
											</td>
                                        </form>
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
        
        /*
        $('#dt_basic').on('click','.btn-success', function (){
			var id = $(this).attr('data-id');
			var vId = $(this).attr('data-view-id');
			$('.view'+vId).css('display', 'none');
			if(id){
				$('.a'+id).css('display', 'block');
			}
		});
		
		$('#dt_basic').on('click','.update', function (){
			var id = $(this).attr('data-id');
			var formData = $('#group-form-'+id).serialize();
			if(formData){
				$.post('<?=base_url('admin/groups/customEdit');?>',formData, function (data){
					var data = JSON.parse(data);
					if(data.status=='Yes'){
						bootstrap_alert.success(data.msg);
						$('#name'+id).text(data.name);
						$('#description'+id).text(data.description);
						if(data.active==1){
							$('#status'+id).text('Active');
							$('#status'+id).removeClass();
							$('#status'+id).addClass('view'+id+' center-block padding-5 label label-success');
						}else{
							$('#status'+id).text('Inactive');
							$('#status'+id).removeClass();
							$('#status'+id).addClass('view'+id+' center-block padding-5 label label-warning');
						}
						$('.editable').css('display', 'none');
						$('.view'+id).css('display', 'block');
					}else{
						bootstrap_alert.warning(data.msg);
					}
				});
			}
			return false;
			$('.view').css('display', 'block');
			if(id){
				$('.a'+id).css('display', 'none');
			}
		});
		
		$('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var rowId = $(this).data('removeRow');
            var msg = 'Selected group successfully deleted!';
            $.post("<?=base_url('admin/groups/removeGroup')?>",{'id':id}, function (responce){
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
        */
    });

</script>
