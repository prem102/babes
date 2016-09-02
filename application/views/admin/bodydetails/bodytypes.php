<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Body Types List</strong>
               </h3>
           </div>
           <?php
				if($permissionValue==4 || $permissionValue==5 || $permissionValue==6 || $permissionValue==7){
			?>
			<div class="pull-right">
				<a href="<?php echo base_url('admin/bodydetails/addBodyType');?>" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Add Body Type
				</a>
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
                                                <th>Body Type</th>
                                                <th>Gender</th>
                                                <th>Status</th>
											<?php
												if($permissionValue==2 || $permissionValue==3 || $permissionValue==6 || $permissionValue==7){
											?>
                                                <th class="sorting">Action</th>
                                            <?php
												}
                                            ?>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                            if (!empty($bodyTypes)) {
                                                foreach ($bodyTypes as $bodyType) {
										?>
                                        <tr id="<?=$bodyType->id.'_A';?>">
                                           <?= form_open( 'admin/bodydetails/customBodyTypeEdit', ['class' => 'smart-form','id' => 'body-type-form-'.$bodyType->id.' ','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                            <td>
												<span class="view<?=$bodyType->id;?>" id="name<?=$bodyType->id;?>"><?=(!empty($bodyType->name)) ? $bodyType->name : "N/A";?></span>
												<input class="a<?=$bodyType->id;?> editable"  type="text" maxlength="100" placeholder="Body Type" name="name" required=""  value="<?=!empty($bodyType->name) ? $bodyType->name : '';?>">
												<input type="hidden" name="id" required=""  value="<?=!empty($bodyType->id) ? $bodyType->id : 0;?>">
											</td>
											<td>
												<span class="view<?=$bodyType->id;?>" id="name<?=$bodyType->id;?>">
												<?php
													if($bodyType->type==1){
														echo "Female";
													}
													if($bodyType->type==2){
														echo "Male";
													}
													if($bodyType->type==3){
														echo "Other";
													}
												?>
												</span>
												<select name="type" class="a<?=$bodyType->id;?> editable"  data-parsley-required id="status" class="a<?=$bodyType->id;?>">
													<option value="">Select Gender</option>
													<option value="1" <?=!empty($bodyType->type) && $bodyType->type=='1' ? 'selected' : '' ; ?> >Female</option>
													<option value="2" <?=!empty($bodyType->type) && $bodyType->type=='2' ? 'selected' : '' ; ?> >Male</option>
													<option value="3" <?=!empty($bodyType->type) && $bodyType->type=='3' ? 'selected' : '' ; ?> >Other</option>
												</select>
											</td>
                                            <td>
												<?php
													$bodyStatus = "";$bodyStatusClass = "";
													if($bodyType->status==1){
														$bodyStatusClass = "label-success";$bodyStatus = "Active";
													}else{
														$bodyStatusClass = "label-warning";$bodyStatus = "Inactive";
													}
												?>
												<span class="view<?=$bodyType->id;?> label <?=$bodyStatusClass;?>" id="status<?=$bodyType->id;?>">
												<?=$bodyStatus;?>
												</span>
												<select name="status" class="a<?=$bodyType->id;?> editable"  data-parsley-required id="status" class="a<?=$bodyType->id;?>">
													<option value="1" <?=($bodyType->status==1) ? 'selected' : '' ?> >Active</option>
													<option value="0" <?=($bodyType->status==0) ? 'selected' : '' ?>>Inactive</option>
												</select>
                                            </td>
											<?php
												if($permissionValue==2 || $permissionValue==3 || $permissionValue==6 || $permissionValue==7){
											?>
											<td>
												<a class="btn btn-success view<?=$bodyType->id;?>" href="javascript:void(0)" data-id="<?=$bodyType->id?>" data-view-id="<?=$bodyType->id?>">Edit</a>
												<button class="btn btn-success update pull-right editable a<?=$bodyType->id?>" data-id="<?=$bodyType->id?>" onClick='submitDetailsForm('<?=$bodyType->id?>')'>Update</button>
											</td>
											<?php }  ?>
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
    })
</script>
