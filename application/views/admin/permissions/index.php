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
                   <strong>Permissions List</strong>
               </h3>
           </div>
           <?php
				if($permissionValue==4 || $permissionValue==5 || $permissionValue==6 || $permissionValue==7){
			?>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/permissions/add');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Permission</a>
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
                                                <th>Permission</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                            if (!empty($permissions)) {
                                                foreach ($permissions as $permission) {
										?>
                                        <tr id="<?=$permission->id.'_A';?>">

                                            <td>
												<span class="view<?=$permission->id;?>" id="name<?=$permission->id;?>"><?=(!empty($permission->name)) ? $permission->name : "N/A";?></span>
												<?= form_open( current_url(), ['class' => '','id' => 'permission-form-'.$permission->id.'','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
												<input class="a<?=$permission->id;?> editable"  type="text" placeholder="Permission Name" name="name" required="" maxlength="100"  value="<?=!empty($permission->name) ? $permission->name : '';?>">
												<input type="hidden" name="id" required=""  value="<?=!empty($permission->id) ? $permission->id : 0;?>">
											</td>
                                            <td>
												<p class="view<?=$permission->id;?>" id="description<?=$permission->id;?>"><?=(!empty($permission->description)) ? ellipsize($permission->description,50) : "N/A";?></p>
												<textarea class="a<?=$permission->id;?> editable"  name="description" id="description" data-parsley-maxlength="500" placeholder="Permission Description"><?=!empty($permission->description) ? $permission->description : '';?></textarea>
											</td>
                                            <td>
												<?php
													$permissionStatus = "";$permissionStatusClass = "";
													if($permission->status==1){
														$permissionStatusClass = "label-success";$permissionStatus = "Active";
													}else{
														$permissionStatusClass = "label-warning";$permissionStatus = "Inactive";
													}
												?>
												<span class="view<?=$permission->id;?> label <?=$permissionStatusClass;?>" id="status<?=$permission->id;?>"><?=$permissionStatus;?></span>
												<select name="status" class="a<?=$permission->id;?> editable"  data-parsley-required id="status" class="a<?=$permission->id;?>">
													<option value="1" <?=($permission->status==1) ? 'selected' : '' ?> >Active</option>
													<option value="0" <?=($permission->status==0) ? 'selected' : '' ?>>Inactive</option>
												</select>
                                            </td>
											<td>
												<a class="btn btn-success view<?=$permission->id;?>" href="javascript:void(0)" data-id="<?=$permission->id?>" data-view-id="<?=$permission->id?>">Edit</a>
												<?php
													//base_url('services/edit/'.$service->id);
												?>
												<button class="btn btn-success update pull-right editable a<?=$permission->id ?>" data-id="<?=$permission->id?>">Update</button>
											</td>
                                        <?= form_close(); ?>
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
			var formData = $('#permission-form-'+id).serialize();
			if(formData){
				$.post('<?=base_url('admin/permissions/customEdit');?>',formData, function (data){
					var data = JSON.parse(data);
					if(data.status=='Yes'){
						bootstrap_alert.success(data.msg);
						$('#name'+id).text(data.name);
						$('#description'+id).text(data.description);
						if(data.active==1){
							$('#status'+id).text('Active');
							$('#status'+id).removeClass();
							$('#status'+id).addClass('view'+id+' label label-success');
						}else{
							$('#status'+id).text('Inactive');
							$('#status'+id).removeClass();
							$('#status'+id).addClass('view'+id+' label label-warning');
						}
						$('.editable').hide();
						$('.view'+id).show();
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

	})

</script>
