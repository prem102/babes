<script src="<?php echo base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>
<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Add Group</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
                        <div class="tabbable">
                            <?= form_open( current_url(), ['class' => 'smart-form','id' => 'category-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <fieldset>
															
                                                            <section>
                                                                <label class="label">Group Name <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-user"></i>
                                                                    <input type="text" placeholder="Group Name" name="name" required=""  value="<?=set_value('name')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Description</label>
                                                                <label class="textarea">
                                                                    <textarea name="description" id="description" data-parsley-maxlength="500" placeholder="Group Description"><?=set_value('description')?></textarea>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Status</label>
                                                                <div class="input input-radio">
                                                                    <div class="col col-3">
																		<label class="radio state-success">
																			<input type="radio" name="status" value="1" checked>
																			<i></i>Enable
																		</label>
																		</div>
																		<div class="col col-3">
																		<label class="radio state-error">
																			<input type="radio" name="status" value="0">
																			<i></i>Disable
																		</label>
																	</div>
                                                                </div>
                                                            </section>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
														<fieldset>
															<h2>Permissions</h2>
															<?php
															//var_dump($permissions);
																if(!empty($permissions)){
																	foreach($permissions as $permission){
															?>
																<div class="form-group permission-check-box col-lg-12 col-sm-12">
																		<label class="col-sm-4 col-lg-4 col-md-4 col-xs-4 control-label">
																			<strong><?=$permission->name;?></strong>
																		</label>
																		
																		<div class="col-sm-8 col-md-8 col-lg-8 col-xs-8">
																		<input type="hidden" name="permission[<?=$permission->id;?>]" value="0" id="<?=$permission->id;?>">
																		<label class="btn btn-default">
																			<input type="checkbox"  value="4" data-id="<?=$permission->id;?>" class="form-control getValue" >Add
																		</label>
																		<label class="btn btn-default">
																			<input type="checkbox"  value="2" data-id="<?=$permission->id;?>" class="form-control getValue" >Edit
																		</label>
																		<label class="btn btn-default">
																			<input type="checkbox" value="1" data-id="<?=$permission->id;?>" 
																				class="form-control getValue" >Delete
																		</label>
																		</div>
																</div>
															<?php	
																	}
																}
															?>
														</fieldset>
													</div>
                                                    
                                            </article>

                                        </div>

                                    </div>
                                    
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-success pull-right" type="submit">
                                        Submit
                                    </button>
                                    <button onclick="window.history.back();" class="btn btn-default" type="button">Back</button>
                                </footer>

                            <?= form_close(); ?>

                        </div>
                        
                </div>
            </div>
        </section>

    </div>
</div>
</div>
<script>
	$(".getValue").click( function (){
		if(this.checked==true){
			var id = $(this).attr('data-id');
			var value = this.value;
			var permission = $('#'+id).val();
			var permi = Number(permission) + Number(value);
			$('#'+id).val(permi);
		}else{
			var id = $(this).attr('data-id');
			var value = this.value;
			var permission = $('#'+id).val();
			var permi = Number(permission) - Number(value);
			$('#'+id).val(permi);
		}
	});
</script>
<!-- PAGE RELATED PLUGIN(S) -->
