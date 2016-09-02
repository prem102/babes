<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Cities List</strong>
               </h3>
           </div>
           <?php
				if($permissionValue==4 || $permissionValue==5 || $permissionValue==6 || $permissionValue==7){
			?>
			<div class="pull-right">
				<a href="<?php echo base_url('admin/location/addCity');?>" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Add City
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
                                                <th>City</th>
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
                                            if (!empty($cities)) {
                                                foreach ($cities as $city) {
										?>
                                        <tr id="<?=$city->id.'_A';?>">
                                           <?= form_open( 'admin/location/customCityEdit', ['class' => 'smart-form','id' => 'city-form-'.$city->id.' ','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                            <td>
												<span class="view<?=$city->id;?>" id="name<?=$city->id;?>"><?=(!empty($city->name)) ? $city->name : "N/A";?></span>
												<input class="a<?=$city->id;?> editable"  type="text" maxlength="100" placeholder="City Name" name="name" required=""  value="<?=!empty($city->name) ? $city->name : '';?>">
												<input type="hidden" name="city_id" required=""  value="<?=!empty($city->id) ? $city->id : 0;?>">
											</td>
											<td>
												<span class="view<?=$city->id;?>" id="name<?=$city->id;?>"><?=(!empty($city->stateName)) ? $city->stateName : "N/A";?></span>
												<select name="state" class="a<?=$city->id;?> editable"  data-parsley-required id="status" class="a<?=$city->id;?>">
													<option value="">Select State</option>
													<?php
														if(!empty($states)){
															foreach($states as $state){
																$sell = !empty($city->state) && $city->state==$state->id ? 'selected' : '';
																echo '<option value="'.$state->id.'" '.$sell.'>'.$state->name.'</option>';
															}
														}
													?>
												</select>
											</td>
                                            <td>
												<?php
													$cityStatus = "";$cityStatusClass = "";
													if($city->status==1){
														$cityStatusClass = "label-success";$cityStatus = "Active";
													}else{
														$cityStatusClass = "label-warning";$cityStatus = "Inactive";
													}
												?>
												<span class="view<?=$city->id;?> label <?=$cityStatusClass;?>" id="status<?=$city->id;?>">
												<?=$cityStatus;?>
												</span>
												<select name="status" class="a<?=$city->id;?> editable"  data-parsley-required id="status" class="a<?=$city->id;?>">
													<option value="1" <?=($city->status==1) ? 'selected' : '' ?> >Active</option>
													<option value="0" <?=($city->status==0) ? 'selected' : '' ?>>Inactive</option>
												</select>
                                            </td>
											<?php
												if($permissionValue==2 || $permissionValue==3 || $permissionValue==6 || $permissionValue==7){
											?>
											<td>
												<a class="btn btn-success view<?=$city->id;?>" href="javascript:void(0)" data-id="<?=$city->id?>" data-view-id="<?=$city->id?>">Edit</a>
												<button class="btn btn-success update editable a<?=$city->id?>" data-id="<?=$city->id?>" onClick='submitDetailsForm('<?=$city->id?>')'>Update</button>
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
