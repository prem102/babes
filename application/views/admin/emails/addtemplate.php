<script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script>
<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Add Email Template</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
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
                                                            <section>
                                                                <label class="label">User Group <span class="asterisk">*</span></label>
                                                                <label class="select">
                                                                    <select class="" name="user_group_id" required>
																		<option value="">Select User Group</option>
																		<?php
																			if(!empty($userGroups) && is_array($userGroups)){
																				foreach($userGroups as $userGroup){
																					echo '<option value="'.$userGroup->id.'">'.ucfirst($userGroup->name).'</option>';
																				}
																			}
																		?>
																	</select>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Template Name <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Template Name" name="template_name" data-parsley-range="[3, 255]" required=""  value="<?=set_value('template_name')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Template Subject  <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Template Subject" name="template_subject" data-parsley-range="[3, 255]" required=""  value="<?=set_value('template_subject')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Template Header <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Template Header" name="template_header" data-parsley-range="[3, 255]" required=""  value="<?=set_value('template_header')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Template Content <span class="asterisk">*</span></label><br>
                                                                <label class="input">
																	<div role="content">
																		<div class="jarviswidget-editbox">
																		</div>
																		<div class="widget-body no-padding">
																			<textarea name="template_content" class="ckeditor" required style="visibility: hidden; display: none;"><?=set_value('template_content')?></textarea>
																		</div>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Template Text<span class="asterisk">*</span></label>
                                                                <label class="textarea">
                                                                    <textarea placeholder="Template Text" name="template_text" data-parsley-range="[3, 255]" required=""><?=set_value('template_text')?></textarea>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Status <span class="asterisk">*</span></label>
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
                                            </article>
                                            
                                        </div>
                                        
                                    </div>
                                   </div>
                                    
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-success pull-right" type="submit">
                                        Submit
                                    </button>
                                    <button onclick="window.history.back();" class="btn btn-default frm-submit" type="button">Back</button>
                                </footer>

                            <?= form_close(); ?>

                        </div>
                        
                </div>
            </div>
        </section>

    </div>
</div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->
