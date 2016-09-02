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
                   <strong>Add Service</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
                        <div class="tabbable">
                            <?= form_open( current_url(), ['class' => 'smart-form','id' => 'service-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
															
															<section>
                                                                <label class="label">Service Type </label>
                                                                <div class="input input-radio">
                                                                    <div class="col col-3">
																		<label class="radio state-success">
																			<input type="radio" name="service_type" value="0" checked>
																			<i></i>Main
																		</label>
																		</div>
																		<div class="col col-3">
																		<label class="radio state-error">
																			<input type="radio" name="service_type" value="1">
																			<i></i>Extra
																		</label>
																	</div>
                                                                </div>
                                                            </section>
                                                            <br><br>
                                                            <section>
                                                                <label class="label">Service Name <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-female"></i>
                                                                    <input type="text" placeholder="Service Name" name="name" required=""  value="<?=set_value('name')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Description </label>
                                                                <label class="textarea">
                                                                    <textarea name="description" id="description" data-parsley-maxlength="500" placeholder="Service Description"><?=set_value('description')?></textarea>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Service Price </label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-usd"></i>
                                                                    <input type="text" placeholder="Service Price Hourly" name="price"  data-parsley-length="[1, 5]"  data-parsley-type="number" value="<?=set_value('price')?>">
                                                                </label>
                                                            </section>
                                                             <section>
                                                                <label class="label">Gender </label>
                                                              <label class="select"> 
                                                                    <i class="fa fa-fw fa-users"></i>
																<select name="type" class="form-control" equired="" id="type" >
																	<option value="">Select Gender</option>
																		<option value="2">Male</option>
																			<option value="1">Female</option>
																				<option value="3">Other</option>
																	</select>
																</label>
															</section>
                                                             <section>
                                                                <label class="label">Icon </label>
                                                              <label class="select"> 
                                                                  
																<input type="file"  name="images" />
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
