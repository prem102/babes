<script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script>
<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Users List</strong>
               </h3>
           </div>
       </div>
        <!-- widget grid -->
        <section id="users-by-group" class="users-by-group" >

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
                            <div class="widget-body no-padding" >

                                <table id="dt_basic" class="table table-striped table-bordered table-hover editable-seller-info" width="100%">
                                    <thead>
											<form action="<?=current_url();?>" id="client-serach-form" method="post">
												<tr role="row">
												<th style="width:15%" class="hasselect" rowspan="1" colspan="1">
													<select name="group" class="form-control">
														<option value="">Select Group</option>
														<?php
															if(!empty($groups) && is_array($groups)){
																foreach($groups as $group){
																	if(!empty($searchUserGroup)){
																		$sell = ($searchUserGroup==$group->id) ? 'selected' : '';
																	}else{
																		$sell = ($group->id==2) ? 'selected' : '';
																	}
																	echo '<option value="'.$group->id.'" '.$sell.'>'.ucfirst($group->name).'</option>';
																}
															}
														?>
													</select>
												</th>
												<th style="width:15%" class="hasinput" rowspan="1" colspan="1">
													<input type="text" name="username" placeholder="Filter User Name" class="form-control" value="<?=(isset($searchUsername) && !empty($searchUsername)) ? $searchUsername : '';?>">
												</th>
												<th style="width:20%" class="hasinput" rowspan="1" colspan="1">
													<input type="text" name="email" placeholder="Filter Email" class="form-control" value="<?=(isset($searchUserEmail) && !empty($searchUserEmail)) ? $searchUserEmail : '';?>">
												</th>
												<th style="width:15%" class="hasinput" rowspan="1" colspan="1">
													<input type="text" name="contact" placeholder="Filter Contact" class="form-control" value="<?=(isset($searchUserContact) && !empty($searchUserContact)) ? $searchUserContact : '';?>">
												</th>
												<th style="width:15%" class="hasinput" rowspan="1" colspan="1">
													<input type="submit" class="btn btn-primary" class="form-control" value="Search" name="search">
													<input type="submit" class="btn btn-warning" class="form-control" value="Reset" name="reset">
												</th>
												</tr>
											</form>
											<tr>
                                                <th><input type="checkbox" class="checkAll" id="checkAll">User-Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Status</th>
                                                <th class="sorting">Location</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                          if (!empty($users) && is_array($users)) {
                                             foreach ($users as $user) {
												$userName			= (!empty($user->username)) ? $user->username : "N/A";
												$userEmail			= (!empty($user->email)) ? $user->email : "N/A";
												$userContact		= (!empty($user->phone)) ? $user->phone : "N/A";
												$userStatus			= ($user->active==1) ? 'Active' : 'Inactive' ;
										?>
                                        <tr id="<?=$user->id;?>" class="selectAllCheckbox" >
                                            <td>
												<input type="checkbox" name="users[]" value="<?=$user->id;?>" class="selectUser">
												<span class="view_mode"><?=$userName;?></span>
                                            </td>
                                            <td>
												<span class="view_mode"><?=$userEmail;?></span>
                                            </td>
                                            <td>
												<span class="view_mode"><?=$userContact;?></span>
                                            </td>
                                            <td>
												<span class="view_mode"><?=$userStatus;?></span>
                                            </td>
											<td>
												Location 
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
									<?php
										if(!empty($users)) {
									?>
									<a class="btn btn-success proceedBtn"  href="javscript:void(0)" >
										<i class="fa fa-paper-plane" aria-hidden="true"></i> Mail Proceed..</a>
									<?php } ?>
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

		<section id="send-mail" class="send-mail" style="display:none;">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
                        <div class="tabbable">
							<?= form_open( current_url(), ['class' => 'smart-form','id' => 'email-template-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
															<input type="hidden" id="userIds" value="">
                                                            <section>
                                                                <label class="label">Select Email Template <span class="asterisk">*</span></label>
                                                                <label class="select">
																	<i class="fa fa-fw fa-users"></i>
                                                                    <select class="" name="email_template_id" id="email_template_id" required>
																		<option value="">Select Email Template</option>
																		<!--<option value="custom-mail-template">Custom Template</option>-->
																		<?php
																			if(!empty($templates) && is_array($templates)){
																				foreach($templates as $template){
																					echo '<option value="'.$template->alias.'">'.ucfirst($template->template_name).'</option>';
																				}
																			}
																		?>
																	</select>
                                                                </label>
                                                            </section>
                                                        </fieldset>
                                                    </div>
                                            </article>
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable" id="custom-mail-content" style="display:none">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Custom Subject</label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Custom Subject" name="custom_subject" id="custom_subject" data-parsley-maxlength="100" value="<?=set_value('custom_subject')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Custom Content </label><br>
                                                                <label class="input">
																	<div role="content">
																		<div class="jarviswidget-editbox">
																		</div>
																		<div class="widget-body no-padding">
																			<textarea name="custom_content" id="custom_content" class="ckeditor" style="visibility: hidden; display: none;"><?=set_value('custom_content')?></textarea>
																		</div>
                                                                </label>
                                                            </section>
                                                        </fieldset>
                                                    </div>
                                            </article>
                                            
                                        </div>
                                        
                                    </div>
                                   </div>
                                    
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-success pull-right" type="button" id="mail-sending">
                                       <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Mail
                                    </button>
                                    <button class="btn btn-default" id="users-list" type="button">Back</button>
                                </footer>
                           <?= form_close(); ?>
                        </div>
                        
                </div>
            </div>
        </section>

    </div>
</div>

    </div>


<script type="text/javascript">
    $(document).ready(function () {
		
	// ****** Select All Chckbox Function ****** //
		$('#checkAll').click(function(event){
			if(this.checked) { // check select status
				$('.selectUser').each(function() { //loop through each checkbox
					this.checked = true;  //select all checkboxes with class "checkbox1"               
				});
			}else{
				$('.selectUser').each(function() { //loop through each checkbox
					this.checked = false; //deselect all checkboxes with class "checkbox1"                       
				});         
			}
		});
		
	// ****** Send Mail Proceed Functionality ******//
		$('.proceedBtn').on('click', function (e){
			e.preventDefault();
			var checkValues = $('.selectUser:checked').map(function(){
				return $(this).val();
			}).get();
			if(checkValues==""){
				bootstrap_alert.warning(' Select User to send mail..');
			}else{
				$('#userIds').val(checkValues);
				$('#users-by-group').hide();
				$('#send-mail').show();
			}
		});
		
	// ****** Back Button Functionality ****** //
		$('#users-list').click(function (){
				$('#users-by-group').show();
				$('#send-mail').hide();
		});
		
	// ****** Select Custom Mail Template ****** //
		$('#email_template_id').change(function (){
			var template = $(this).val();
			if(template !="" && template=='custom-mail-template'){
				$('#custom-mail-content').show();
			}else{
				$('#custom-mail-content').hide();
			}
		});
	// ***** Sending Mail Function ****** //
	
		$('#mail-sending').click(function (){
			var userIds  = $('#userIds').val();
			var templateAlias = $('#email_template_id').val();
			var subject = "";
			var content = "";
			if(templateAlias==""){
				$('#email_template_id').focus();
				bootstrap_alert.warning(' Select Email template');
				return false;
			}else{
				if(templateAlias=='custom-mail-template'){
					subject = $('#custom_subject').val();
					content = $('#custom_content').val();
				}
				$.post("<?=base_url('admin/emails/mail')?>",{'templateAlias':templateAlias,'userIds':userIds,'subject':subject,'content':content}, function (responce){
					
				});
			}
			
		});
	
    })

</script>
