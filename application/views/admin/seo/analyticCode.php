<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Update Google Analytics Code</strong>
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
															<?php
																if(!empty($preCode)){
															?>
                                                            <section>
                                                                <label class="label"><strong>Previous Google Analytics Code <?=!empty($preCode->updated_at) ? ' on '.date('Y-m-d', strtotime($preCode->updated_at)).' ' : '';?></strong></label>
                                                                <label class="textarea">
                                                                    <textarea class="textareaToSpan" readonly><?=!empty($preCode->code) ? $preCode->code : '';?></textarea>
                                                                </label>
                                                            </section>
                                                            <?php } ?>
                                                            <section>
                                                                <label class="label">Google Analytics Code <span class="asterisk">*</span></label>
                                                                <label class="textarea">
                                                                    <textarea placeholder="Google Analytics Code" rows="6" name="code" required=""><?=(!empty($code) ) ? $code : '';?></textarea>
                                                                </label>
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
