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
                   <strong>Add Permission</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
                        <div class="tabbable">
                            <?= form_open( current_url(), ['class' => 'smart-form','id' => 'permission-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Permission Name<span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-user"></i>
                                                                    <input type="text" placeholder="Permission Name" name="name" data-parsley-maxlength="100" required=""  value="<?=set_value('name')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Description</label>
                                                                <label class="textarea">
                                                                    <textarea name="description" id="description" data-parsley-maxlength="500" placeholder="Permission Description"><?=set_value('description')?></textarea>
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
<!-- PAGE RELATED PLUGIN(S) -->
