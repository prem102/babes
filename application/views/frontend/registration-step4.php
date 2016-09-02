<?php  $this->load->view('frontend/top');
		$this->load->view('frontend/header');
		
?>
<!------------main content start------------------->
<div class="staff-ragistarion-outer">
    	<div class="container">
    		<div class="staff-ragistration-head cf">
            	<h1>Girl Registration</h1>
                <p>Please enter your Detail </p>
                <div class="staff-ragistration-step cf">
                	<ul class="cf">
                    	<li class="active"><label>Personal Detail</label></li>
                        <li class="active"><label>Services</label></li>
                        <li class="active"><label>Gallery</label></li>
                        <li class="active"><label>Social </label></li>
                    </ul>
                </div>
            </div>
            <div class="staf-ragistration-form cf">
            	<form class="cf">
                	<div class="information-client-box cf">
                    	
                        <div class="informataion-details cf">
                        	<h3>Social media</h3>
                            <div class="soacl-link-area">
                            	<label>enter your facebook link</label>
                                <input type="text" placeholder="">
                                <span class="socail-left"><img src="<?=base_url("assets/front/")?>/images/face-book-socal.png"></span>
                            </div>
                        </div>
                        <div class="informataion-details cf">
                            <div class="soacl-link-area">
                            	<label>enter your twiter link</label>
                                <input type="text" placeholder="">
                                <span class="socail-left"><img src="<?=base_url("assets/front/")?>/images/tweeter-socal.png"></span>
                            </div>
                        </div>
                        <div class="informataion-details cf">
                            <div class="soacl-link-area">
                            	<label>enter your instagram link</label>
                                <input type="text" placeholder="">
                                <span class="socail-left"><img src="<?=base_url("assets/front/")?>/images/instgram-socal.png"></span>
                            </div>
                        </div>
                        <div class="btn-box">
                        <button type="submit" value="submit" class="submit" name="submit">submit<img src="<?=base_url("assets/front/")?>/images/arrow-submit.png"></button>
                        
                        </div>
                        <div class="btn-box">
                        <button type="submit" value="reset">reset</button>
                        </div>
                    </div>
                </form>
            </div>
    	</div>
    </div>
<!-----------------main content end-------------->
<?php
	$this->load->view('frontend/footer');
	$this->load->view('frontend/bottom');
	
?>
