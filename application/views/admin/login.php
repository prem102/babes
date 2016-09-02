<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 login-area">
                <div class="well no-padding">
                    <form action="" id="login-form" class="smart-form client-form" method="post">
						<?php
							if(!empty($error)){
						?>
						<div class="alert alert-block alert-danger">
							<a href="#" data-dismiss="alert" class="close">×</a>
							<h4 class="alert-heading"><i class="fa fa-warning"></i> Login Error!</h4>
							<p>
								<?php
									echo $error;
								?>
							</p>
						</div>
						<?php
							}else{
						?>
                        <header>
                            Sign In 
                        </header>
                        <?php } ?>
                        <fieldset>

                            <section>
                                <label class="label">Username</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="username" value="<?=!empty($remUser) ? $remUser : '';?>">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i>
                                     Please enter Username</b></label>
                            </section>

                            <section>
                                <label class="label">Password</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="password" value="<?=!empty($remPass) ? $remPass : '';?>">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                                <div class="note" style="display: none">
                                    <a href="<?php echo base_url(); ?>/forgotpassword.php">Forgot password?</a>
                                </div>
                            </section>

                            <section>
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" value="1" <?=!empty($remUser) ? 'checked' : '';?>>
                                    <i></i>Stay signed in</label>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                Sign in
                            </button>
                        </footer>
                    </form>

                </div>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    //runAllForms();

    $(function () {
        // Validation
        $("#login-form").validate({
            // Rules for form validation
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                }
            },
            // Messages for form validation
            messages: {
                email: {
                    required: 'Please enter your email address',
                    email: 'Please enter a valid email address'
                },
                password: {
                    required: 'Please enter your password'
                }
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
    });
</script>
