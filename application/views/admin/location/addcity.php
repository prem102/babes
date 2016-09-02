<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Add City</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
                        <div class="tabbable">
                            <?= form_open( current_url(), ['class' => 'smart-form','id' => 'State-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
															
                                                            <section>
                                                                <label class="label">State <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-map-marker"></i>
                                                                    <select class="form-control" name="state" required>
																		<option value="">Select State</option>
																		<?php
																			if(!empty($states) && is_array($states)){
																				foreach($states as $state){
																					echo '<option value="'.$state->id.'">'.ucfirst($state->name).'</option>';
																				}
																			}
																		?>
																	</select>
                                                                </label>
                                                            </section>
															
                                                            <section>
                                                                <label class="label">City Name <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-map-marker"></i>
                                                                    <input type="text" placeholder="City Name" name="name" data-parsley-length="[3, 50]" required="" data-parsley-pattern="^[a-zA-Z ]{2,50}$"   value="<?=set_value('name')?>">
                                                                </label>
                                                            </section>
                                                            
                                                            <section>
                                                                <label class="label">Status</label>
                                                                <div class="input input-radio">
                                                                    <div class="col col-3">
																		<label class="radio state-success">
																			<input type="radio" name="status" value="1" checked>
																			<i></i>Active
																		</label>
																		</div>
																		<div class="col col-3">
																		<label class="radio state-error">
																			<input type="radio" name="status" value="0">
																			<i></i>Inactive
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
