<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Pages Labels List</strong>
               </h3>
           </div>
			<?php
				if($permissionValue==4 || $permissionValue==5 || $permissionValue==6 || $permissionValue==7){
			?>
			<div class="pull-right">
			   <a href="<?php echo base_url('admin/contents/addLabel');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Label</a>
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
                                                <th>Page Url (Short)</th>
                                                <th>Label</th>
                                                <th>Label Value</th>
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
                                            if (!empty($pagesLabels)) {
                                                foreach ($pagesLabels as $pageLabel) {
										?>
                                        <tr id="<?=$pageLabel->id.'_A';?>">
                                            <td>
												<?=(!empty($pageLabel->page_name)) ? $pageLabel->page_name : 'N/A';?>
											</td>
											<td>
												<?=(!empty($pageLabel->page_url)) ? $pageLabel->page_url : 'N/A';?>
											</td>
											<td>
												<?=(!empty($pageLabel->variable_name)) ? $pageLabel->variable_name : 'N/A';?>
											</td>
											<td>
												<?=(!empty($pageLabel->variable_value)) ? ellipsize($pageLabel->variable_value, 50) : 'N/A';?>
											</td>
                                            <td>
												<?php
													$serStatus = "";$serStatusClass = "";
													if($pageLabel->status==1){
														$serStatusClass = "label-success";$serStatus = "Active";
													}else{
														$serStatusClass = "label-warning";$serStatus = "Inactive";
													}
												?>
												<span class="view<?=$pageLabel->id;?> label <?=$serStatusClass;?>" id="status<?=$pageLabel->id;?>"><?=$serStatus;?></span>
                                            </td>
                                            <?php
												if($permissionValue==2 || $permissionValue==3 || $permissionValue==6 || $permissionValue==7){
											?>
											<td>
												<a class="btn btn-success view<?=$pageLabel->id;?>" href="<?=base_url('admin/contents/editLabel/'.$pageLabel->id)?>" >Edit</a>
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
<!--<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div>-->
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
		$('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var rowId = $(this).data('removeRow');
            var msg = 'Selected Page Label successfully deleted!';
            $.post("<?=base_url('admin/contents/removeLabel')?>",{'id':id}, function (responce){
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
    })

</script>
