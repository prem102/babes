<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>States List</strong>
               </h3>
           </div>
           <?php
				if($permissionValue==4 || $permissionValue==5 || $permissionValue==6 || $permissionValue==7){
			?>
			<div class="pull-right">
				<a href="<?php echo base_url('admin/location/addState');?>" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Add State
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
                                                <th>State</th>
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
                                            if (!empty($states)) {
                                                foreach ($states as $state) {
										?>
                                        <tr id="<?=$state->id.'_A';?>">
                                           <?= form_open( 'admin/location/customStateEdit', ['class' => 'smart-form','id' => 'state-form-'.$state->id.' ','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
											
                                            <td>
												<span class="view<?=$state->id;?>" id="name<?=$state->id;?>"><?=(!empty($state->name)) ? $state->name : "N/A";?></span>
												<input class="a<?=$state->id;?> editable"  type="text" maxlength="100" placeholder="State Name" name="name" required=""  value="<?=!empty($state->name) ? $state->name : '';?>">
												<input type="hidden" name="state_id" required=""  value="<?=!empty($state->id) ? $state->id : 0;?>">
											</td>
											
                                            <td>
												<?php
													$stateStatus = "";$stateStatusClass = "";
													if($state->status==1){
														$stateStatusClass = "label-success";$stateStatus = "Active";
													}else{
														$stateStatusClass = "label-warning";$stateStatus = "Inactive";
													}
												?>
												<span class="view<?=$state->id;?> label <?=$stateStatusClass;?>" id="status<?=$state->id;?>">
												<?=$stateStatus;?>
												</span>
												<select name="status" class="a<?=$state->id;?> editable"  data-parsley-required id="status" class="a<?=$state->id;?>">
													<option value="1" <?=($state->status==1) ? 'selected' : '' ?> >Active</option>
													<option value="0" <?=($state->status==0) ? 'selected' : '' ?>>Inactive</option>
												</select>
                                            </td>
											<?php
												if($permissionValue==2 || $permissionValue==3 || $permissionValue==6 || $permissionValue==7){
											?>
											<td>
												<a class="btn btn-success view<?=$state->id;?>" href="javascript:void(0)" data-id="<?=$state->id?>" data-view-id="<?=$state->id?>">Edit</a>
												<button class="btn btn-success update  editable a<?=$state->id?>" data-id="<?=$state->id?>" onClick='submitDetailsForm('<?=$state->id?>')'>Update</button>
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
