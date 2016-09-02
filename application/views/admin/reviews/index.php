<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Clients Reviews</strong>
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
											<?= form_open( current_url(), ['class' => 'smart-form','id' => 'review-serach-form']); ?>
												<tr role="row">
												<th style="width:20%" class="hasinput" rowspan="1" colspan="1">
													<input type="text" name="client" placeholder="Filter Client Name" class="form-control" value="<?=(isset($searchClient) && !empty($searchClient)) ? $searchClient : '';?>">
												</th>
												<th style="width:20%" class="hasinput" rowspan="1" colspan="1">
													<input type="text" name="staff" placeholder="Filter Staff Name" class="form-control" value="<?=(isset($searchStaff) && !empty($searchStaff)) ? $searchStaff : '';?>">
												</th>
												<th style="width:20%" class="hasselect" rowspan="1" colspan="1">
													<select name="approve" class="form-control">
														<option value="">Select Status</option>
														<option value="1" <?=(!empty($searchApprove) && $searchApprove==1) ? 'selected' : '';?>>Approved</option>
														<option value="2" <?=(!empty($searchApprove) && $searchApprove==2) ? 'selected' : '';?>>Not Approved</option>
													</select>
												</th>
												<th style="width:20%" class="hasinput" rowspan="1" colspan="1">
													<input type="submit" class="btn btn-primary" class="form-control" value="Search" name="search">
                                                    <input type="submit" class="btn btn-warning" class="form-control" value="Reset" name="reset">
												</th>
												
												</tr>
                                                
											<?=form_close();?>
                                            </thead><thead>
											<tr>
                                            
                                                <th>Clients</th>
                                                <th>Staff</th>
                                                <th>Rating</th>
                                                <th>Comments</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                          if (!empty($reviews) && is_array($reviews)) {
                                             foreach ($reviews as $review) {
												$client			= (!empty($review->client)) ? ucfirst($review->client) : "N/A";
												$clientEmail	= (!empty($review->clientEmail)) ? $review->clientEmail : "N/A";
												$staff			= (!empty($review->staff)) ? ucfirst($review->staff) : "N/A";
												$staffEmail		= (!empty($review->staffEmail)) ? $review->staffEmail : "N/A";
												$rating			= (!empty($review->rating)) ? $review->rating : 0;
												$comment		= (!empty($review->comments)) ? $review->comments : "N/A";
												$approved		= ($review->approval==1) ? 'checked' : '' ;
										?>
                                        <tr id="<?=$review->id.'_A';?>" >
                                            <td>
												<span class="view_mode"><?=$client;?></span>
                                            </td>
                                            <td>
												<span class="view_mode"><?=$staff;?></span>
                                            </td>
                                            <td>
												<div class="rating">
													<?php
														for($i=1;$i<=5;$i++){
															if($i <= $rating){
																echo '<label for="stars-rating-5"><i class="fa fa-star text-primary"></i></label>';
															}else{
																echo '<label for="stars-rating-5"><i class="fa fa-star "></i></label>';
															}
														}
													?>
													
												</div>
                                            </td>
                                            <td>
												<span class="view_mode"><?=ellipsize($comment,50);?></span>
                                            </td>
											<td>
												<span class="public-approval-checkbox">
													<input type="checkbox" name="approval" value="1" <?=$approved;?>  class="public-review" data-id="<?=$review->id;?>"> Public
												</span>
												<a class="btn btn-info btn-xs clientReview" data-rating="<?=$review->rating;?>"  data-comment="<?=$comment;?>"
													data-client="<?=$client.' ('.$clientEmail.' )' ?>"  data-staff="<?=$staff.' ('.$staffEmail.' )' ?>" href="javascript:void(0);">View</a>
												<a data-target="#confirm-delete" data-toggle="modal" data-record-title="<?=$client;?>" data-record-id="<?=$review->id;?>" data-remove-row="<?=$review->id.'_A';?>"  class="btn btn-danger btn-xs" href="javascript:void(0);">Delete</a>
											</td>
                                        </tr>
                                        <?php } }else{ ?>
											
										<tr>
											<td colspan="5" align="center">
												<span><strong>Records Not Found !</strong></span>
											</td>
                                        </tr>
										<?php }?>
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

<!--****** Asking for View Client Review ******-->
<div class="modal fade" id="view-review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="client-review-modal">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong>Client Review</strong></h4>
                <span><strong>Review by </strong></span><span id="review-by"> Natalia(natalia@gmail.com)</span>
            </div>
            <div class="modal-body">
				<label><strong>Review to </strong></label><span id="review-to"> Natalia(natalia@gmail.com)</span>
				<h4 class="modal-sub-title" id="myModalLabel">Comments -:</h4>
				<div class="review-rating">
					
				
				</div>
                <p id="client-comments">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, Ipsum.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            $.post("<?=base_url('admin/reviews/removeReview')?>",{'reviewId':id}, function (responce){
				var data = JSON.parse(responce);
				if(data.status=='Yes'){
					bootstrap_alert.success(data.msg);
					$('#confirm-delete').modal('hide');
					$('#'+rowId).remove();
				}else{
					bootstrap_alert.warning(data.msg);
					$('#confirm-delete').modal('hide');
				}
			});
        });
        
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
            $('.btn-ok', this).data('removeRow', data.removeRow);
        });
        
		//****** Making Review Public / Unpublic *****//
		
		$('.public-review').click(function (){
			if($(this).prop("checked") == true){
				var status = 1;
			}
			else if($(this).prop("checked") == false){
				var status = 2;
			}
			var id = $(this).attr('data-id');
				$.post("<?=base_url('admin/reviews/manageReviewApproval')?>",{'reviewId':id,'status':status}, function (responce){
					var data = JSON.parse(responce);
					if(data.status=='Yes'){
						bootstrap_alert.success(data.msg);
					}else{
						bootstrap_alert.warning(data.msg);
					}
				});
		});
		
		//****** View Client Review Sectoin ******//
		$('.clientReview').click( function (){
			var client = $(this).attr('data-client');
			var staff = $(this).attr('data-staff');
			var rating = $(this).attr('data-rating');
			var comment = $(this).attr('data-comment');
			var ratinHtml = "";
			if(rating){
				for (var i = 1; i <=5; i++) {
					if(i <= rating){
						ratinHtml += '<label for="stars-rating-5"><i class="fa fa-star text-primary"></i></label>';
					}else{
						ratinHtml += '<label for="stars-rating-5"><i class="fa fa-star "></i></label>';
					}				}
			}
			$('.review-rating').html(ratinHtml);
			$('#review-by').text(client);
			$('#review-to').text(staff);
			$('#client-comments').text(comment);
			$('#view-review').modal('show');
		});
    })

</script>
