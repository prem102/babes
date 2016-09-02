<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Pages List</strong>
               </h3>
           </div>
			<?php
				if($permissionValue==4 || $permissionValue==5 || $permissionValue==6 || $permissionValue==7){
			?>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/seo/addIndivisualPageMeta');?>" class="btn btn-primary">
               <i class="fa fa-plus"></i>Add Page</a>
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
                                                <th>Page Name</th>
                                                <th>Page Url</th>
                                                <th>Meta Title</th>
                                                <th>Meta Keywords</th>
                                                <th>Meta Description</th>
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
                                            if (!empty($pages)) {
                                                foreach ($pages as $page) {
													$defaultClass = (!empty($page->page_name) && $page->page_name=='default') ? 'success' :'';
										?>
                                        <tr id="<?=$page->id.'_A';?>" class="<?=$defaultClass;?>">
                                            <td>
												<?=(!empty($page->page_name)) ? $page->page_name : 'N/A';?>
											</td>
											<td>
												<?=(!empty($page->page_url)) ? $page->page_url : 'N/A';?>
											</td>
											<td>
												<?=(!empty($page->meta_title)) ? $page->meta_title : 'N/A';?>
											</td>
											<td>
												<?=(!empty($page->meta_keywords)) ? $page->meta_keywords : 'N/A';?>
											</td>
											
											<td>
												<?=(!empty($page->meta_description)) ? ellipsize($page->meta_description, 50) : 'N/A';?>
											</td>
                                            <td>
												<?php
													$pageStatus = "";$pageStatusClass = "";
													if($page->status==1){
														$pageStatusClass = "label-success";$pageStatus = "Active";
													}else{
														$pageStatusClass = "label-warning";$pageStatus = "Inactive";
													}
												?>
												<span class="view<?=$page->id;?>  label <?=$pageStatusClass;?>" id="status<?=$page->id;?>"><?=$pageStatus;?></span>
                                            </td>
											<?php
												if($permissionValue==2 || $permissionValue==3 || $permissionValue==6 || $permissionValue==7){
											?>
											<td>
												<a class="btn btn-success view<?=$page->id;?>" href="<?=base_url('admin/seo/editIndivisualPageMeta/'.$page->id)?>" >Edit</a>
											</td>
											<?php } ?>
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
<script src="<?= base_url(); ?>assets/admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
					"t" +
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth": true,
		});
	});
</script>
