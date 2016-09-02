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
                            <?= form_open( current_url(), ['class' => 'smart-form','id' => 'static-page-content','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Page Name <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Page Name" name="<?=($page->page_name!='default') ? 'page_name' :'' ?>" <?=($page->page_name=='default')  ? 'readonly' : '';?> required=""   value="<?=!empty($page->page_name) ? $page->page_name : '';?>" >
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Page Url(short) <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Page Url" name="<?=($page->page_name!='default') ? 'page_url' :'' ?>" <?=($page->page_name=='default')  ? 'readonly' : '';?> required=""  value="<?=!empty($page->page_url) ? $page->page_url : '';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Meta Title <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Meta Title" name="meta_title" required=""  value="<?=(!empty($page->meta_title) ) ? $page->meta_title : '';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Meta Keywords <span class="asterisk">*</span></label>
                                                                <label class="textarea">
                                                                    <textarea placeholder="Meta Keywords" name="meta_keywords" required=""><?=(!empty($page->meta_keywords)) ? $page->meta_keywords : '';?></textarea>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Meta Description <span class="asterisk">*</span></label>
                                                                <label class="textarea">
                                                                    <textarea placeholder="Meta Description" name="meta_description" required=""><?=(!empty($page->meta_description)) ? $page->meta_description : '';?></textarea>
                                                                </label>
                                                            </section>
                                                            <?php
																if($page->page_name!='default'){
                                                            ?>
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
                                                            <?php } ?>
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
