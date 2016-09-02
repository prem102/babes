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
                   <strong>Add Sub Admin</strong>
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
                            <form class="smart-form" id="sub-admin-form"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?= current_url() ?>">
                            <?= form_open( current_url(), ['class' => 'smart-form','id' => 'sub-admin-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
															<section>
																<label class="label">User Group <span class="asterisk">*</span></label>
																<label class="select"> 
                                                                    <i class="fa fa-fw fa-users"></i>
																<select name="group" class="form-control">
																	<option value="">Select Group</option>
																	<?php
																		if(!empty($groups) && is_array($groups)){
																			foreach($groups as $group){
																				echo '<option value="'.$group->id.'">'.ucfirst($group->name).'</option>';
																			}
																		}
																	?>
																</select>
																</label>
															</section>
                                                            <section>
                                                                <label class="label">User Name <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-user"></i>
                                                                    <input type="text" placeholder="User name" id="username" name="username" required="" data-parsley-length="[4, 100]"  value="<?=set_value('username')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Email <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-envelope-o"></i>
                                                                    <input type="text" placeholder="email@example.com" data-parsley-type="email" required="" data-parsley-length="[4, 100]" name="email" id="email" value="<?=set_value('email')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Password <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-unlock-alt"></i>
                                                                    <input type="password" placeholder="Password" id="password" name="password" required="" data-parsley-length="[6, 10]" value="<?=set_value('password')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Conform Password</label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-unlock-alt"></i>
                                                                    <input type="password" placeholder="Confirm Password" data-parsley-equalto="#password" id="con_password" name="con_password" value="<?=set_value('con_password')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Contact No <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-mobile"></i>
                                                                    <input type="text" placeholder="Contact Number" name="phone" data-parsley-length="[6, 15]" data-parsley-type="digits" required=""  value="<?=set_value('phone')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">User Active/Inactive</label>
                                                                <div class="input input-radio">
                                                                    <div class="col col-3">
																		<label class="radio state-success">
																			<input type="radio" name="active" value="1" checked>
																			<i></i>Active
																		</label>
																		</div>
																		<div class="col col-3">
																		<label class="radio state-error">
																			<input type="radio" name="active" value="0">
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

