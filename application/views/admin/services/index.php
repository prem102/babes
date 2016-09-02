<style>
	.editable{
		display:none;
		}
		input[type=file] {
    display: none;
    width:95px;
}
input[type=text] {
    
    width:95px;
}
</style>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>
<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Services List</strong>
               </h3>
           </div>
           <?php
				if($permissionValue==4 || $permissionValue==5 || $permissionValue==6 || $permissionValue==7){
			?>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/services/add');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Service</a>
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
                                                <th>Service Type</th>
                                                <th>Service</th>
                                                 <th>Icon</th>
                                                <th>Description</th>
                                                <th>Price USD (Hourly)</th>
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
                                            if (!empty($services)) {
                                                foreach ($services as $service) {
													$serviceType = ($service->service_type==0) ? "Main " : "Extra "; 
										?>
                                        <tr id="<?=$service->id.'_A';?>">
                                           <?= form_open( 'admin/services/customEdit', ['class' => 'smart-form','id' => 'service-form-'.$service->id.' ','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
												 <td>
												<span class="view<?=$service->id;?>" id="service_type<?=$service->id;?>"><?=$serviceType;?></span>
												<select name="service_type" class="a<?=$service->id;?> editable"  data-parsley-required id="service_type" class="a<?=$service->id;?>">
													<option value="0" <?=($service->service_type==0) ? 'selected' : '' ?> >Main</option>
													<option value="1" <?=($service->service_type==1) ? 'selected' : '' ?>>Extra</option>
												</select>
											</td>
                                            <td>
												<span class="view<?=$service->id;?>" id="name<?=$service->id;?>"><?=(!empty($service->name)) ? $service->name : "N/A";?></span>
												<input class="a<?=$service->id;?> editable"  type="text" maxlength="100" placeholder="Service Name" name="name" required=""  value="<?=!empty($service->name) ? $service->name : '';?>">
												<input type="hidden" name="id" required=""  value="<?=!empty($service->id) ? $service->id : 0;?>">
											</td>
											<td>
												
												<span class="view<?=$service->id;?>" id="images<?=$service->id;?>">
													<?php
														if(!empty($service->images)){
															$imgPath	= FCPATH.'assets/front/services-images/'.$service->images;
															$imgSrc		= base_url('assets/front/services-images/'.$service->images);
															if($imgPath){
																echo '<img src="'.$imgSrc.'" >';
															}else{
																echo 'N/A';
															}
														}else{
															echo 'N/A';
														}
													?>
												</span>
												<input type="file" class="service-edit-img a<?=$service->id;?> editable" name="images" class="a<?=$service->id;?> editable"/>
											</td>
                                            <td>
												<p class="view<?=$service->id;?>" id="description<?=$service->id;?>"><?=(!empty($service->description)) ? ellipsize($service->description,50) : "N/A";?></p>
												<textarea class="a<?=$service->id;?> editable"  name="description" id="description" data-parsley-length="[0, 500]" placeholder="Service Description"><?=!empty($service->description) ? $service->description : '';?></textarea>
											</td>
                                            <td>
												<span class="view<?=$service->id;?>" id="price<?=$service->id;?>"><?=(!empty($service->price)) ? $service->price : 0;?></span>
												<input class="a<?=$service->id;?> editable"  type="text" placeholder="Service Price Hourly" name="price"  maxlength="5" value="<?=!empty($service->price) ? $service->price : '';?>">
											</td>
											<?php
													$catStatus = "";$select='';$select1='';$select2='';
													if($service->type=='1'){
														$catStatus="Female";
														$select='selected';
													}
													if($service->type=='2'){
														$catStatus="Male";
														$select1='selected';
													}
													if($service->type=='3'){
														$catStatus="Other";
														$select2='selected';
													}
												?>
											<td><span class="view<?=$service->id;?>  " id="type<?=$service->id;?>"><?=$catStatus;?></span>
												<select name="type" class="a<?=$service->id;?> editable"  data-parsley-required id="status" class="a<?=$service->id;?>">
												
													<option value="1" <?=$select ?> >Female</option>
													<option value="2" <?=$select1?>>Male</option>
													<option value="3" <?=$select2?>>Other</option>
												</select></td>
                                            <td>
												<?php
													$catStatus = "";$catStatusClass = "";
													if($service->status==1){
														$serStatusClass = "label-success";$serStatus = "Active";
													}else{
														$serStatusClass = "label-warning";$serStatus = "Inactive";
													}
												?>
												<span class="view<?=$service->id;?> label <?=$serStatusClass;?>" id="status<?=$service->id;?>"><?=$serStatus;?></span>
												<select name="status" class="a<?=$service->id;?> editable"  data-parsley-required id="status" class="a<?=$service->id;?>">
													<option value="1" <?=($service->status==1) ? 'selected' : '' ?> >Active</option>
													<option value="0" <?=($service->status==0) ? 'selected' : '' ?>>Inactive</option>
												</select>
                                            </td>
											<?php
												if($permissionValue==2 || $permissionValue==3 || $permissionValue==6 || $permissionValue==7){
											?>
											<td>
												<a class="btn btn-success view<?=$service->id;?>" href="javascript:void(0)" data-id="<?=$service->id?>" data-view-id="<?=$service->id?>">Edit</a>
												<?php
													//base_url('services/edit/'.$service->id);
												?>
												
												<button class="btn btn-success update pull-right editable a<?=$service->id	?>" data-id="<?=$service->id?>" onClick='submitDetailsForm('<?=$service->id?>')'>Update</button>
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
