<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Message Templates List</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/emails/addMessageTemplate');?>" class="btn btn-primary">
               <i class="fa fa-plus"></i>Add Template</a>
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

                                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>
											<tr>
                                                <th>Template Name</th>
                                                <th>Template Text</th>
                                                <th>User Group</th>
                                                <th>Status</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                            if (!empty($templates)) {
                                                foreach ($templates as $template) {
										?>
                                        <tr id="<?=$template->id.'_A';?>">
                                            <td>
												<?=(!empty($template->template_name)) ? $template->template_name : 'N/A';?>
											</td>
											
											<td>
												<?=(!empty($template->template_text)) ? ellipsize($template->template_text, 50) : 'N/A';?>
											</td>
											<td>
												<?=(!empty($template->userGroup)) ? ucfirst($template->userGroup) : 'N/A';?>
											</td>
                                            <td>
												<?php
													$emailStatus = "";$emailStatusClass = "";
													if($template->status==1){
														$emailStatusClass = "label-success";$emailStatus = "Active";
													}else{
														$emailStatusClass = "label-warning";$emailStatus = "Inactive";
													}
												?>
												<span class="view<?=$template->id;?> label <?=$emailStatusClass;?>" id="status<?=$template->id;?>"><?=$emailStatus;?></span>
                                            </td>
											<td>
												<a class="btn btn-success view<?=$template->id;?>" href="<?=base_url('admin/emails/editMessageTemplate/'.$template->id)?>" >Edit</a>
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
