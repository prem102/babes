<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/wysiwyg.js"></script>
<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Edit Page</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
                        <div class="tabbable">
                            <?= form_open( current_url(), ['class' => 'smart-form','id' => 'content-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Page Name <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Page Name" name="page_name" required=""  value="<?=!empty($page->page_name) ? $page->page_name : '';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Page Url(short) <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Page Url" name="page_url" required=""  value="<?=!empty($page->page_url) ? $page->page_url : '';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Page Content <span class="asterisk">*</span></label><br>
                                                                <label class="input">
																	
																			<textarea name="page_content" class="tinymce" required  ><?=!empty($page->page_content) ? $page->page_content : '';?></textarea>
																		
                                                              
                                                                </label>
                                                            </section>
                                                             <section>
                                                                <label class="label">Variables <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text"   placeholder="Page variable" name="variables" required=""  value="<?=!empty($page->variables) ? $page->variables : '';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Status</label>
                                                                <div class="input input-radio">
                                                                    <div class="col col-3">
																		<label class="radio state-success">
																			<input type="radio" name="status" value="1" <?=(!empty($page->status) && $page->status==1) ? 'checked' : '';?>>
																			<i></i>Enable
																		</label>
																		</div>
																		<div class="col col-3">
																		<label class="radio state-error">
																			<input type="radio" name="status" value="0" <?=($page->status==0) ? 'checked' : '';?>>
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
                                    
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-success pull-right" type="submit">
                                        Update
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
