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
                   <strong>Edit Client</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
                        <div class="tabbable">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="" aria-expanded="false">
                                        Basic Information
                                    </a>
                                </li>
                            </ul>
                            <?= form_open( current_url(), ['class' => 'smart-form','id' => 'client-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                    <fieldset>
                                                            <section>
                                                                <label class="label">User Name <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-gift"></i>
                                                                    <input type="text" placeholder="User name" id="username" name="username" required="" data-parsley-length="[6, 100]"  value="<?=$user->username;?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Email <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-envelope-o"></i>
                                                                    <input type="text" placeholder="email@example.com" data-parsley-type="email" required="" data-parsley-length="[4, 100]" name="email" id="email" value="<?=$user->email;?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Contact No <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-mobile"></i>
                                                                    <input type="text" placeholder="Contact Number" name="phone" data-parsley-length="[6, 10]" data-parsley-type="digits" required=""  value="<?=$user->phone?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">User Active/Inactive</label>
                                                                <div class="input input-radio">
                                                                    <div class="col col-3">
																		<label class="radio state-success">
																			<input type="radio" name="active" value="1" <?=(!empty($user->active) && $user->active == 1 ) ? 'checked' : '';?>>
																			<i></i>Active
																		</label>
																		</div>
																		<div class="col col-3">
																		<label class="radio state-error">
																			<input type="radio" name="active" value="0" <?=($user->active == 0 ) ? 'checked' : '';?>>
																			<i></i>Inactive
																		</label>
																	</div>
                                                                </div>
                                                            </section>
                                                        </fieldset>
												</div>
                                            </article>
                                    </div>
                                    
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-success pull-right" type="submit">
                                        Update
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

