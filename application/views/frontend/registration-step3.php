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
                        <li><label>Social </label></li>
                    </ul>
                </div>
            </div>
            <div class="staf-ragistration-form cf">
            	<form class="cf">
                	<div class="information-client-box cf">
                    	
                        <div class="informataion-details cf">
                        	<h3>picture gallery</h3>
                            <div class="upload-picture">
                            	<label>profile image</label>
                            	<div class="input-group">
                                    <input type="text" class="form-control" readonly>
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                           choose file<input type="file" style="display: none;" multiple>
                                        </span>
                                    </label>
                                    <span class="dimantional">Profile image not more then 500 x 500 pixel</span>
                                </div>
                            </div>
                            <div class="upload-picture">
                            <label>featured image</label>
                            	<div class="input-group">
                                    <input type="text" class="form-control" readonly>
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                           choose file<input type="file" style="display: none;" multiple>
                                        </span>
                                    </label>
                                    <span class="dimantional">Featured image should be 2000 x 600 pixel</span>
                                </div>
                            </div>
                        </div>
                        <div class="informataion-details cf">
                        	<div class="picture-gallery-drag-box">
                            <label>picture gallery</label>
                                <div class="picture-gallery-drag">
                                    <div class="darg-img">
                                        <figure>
                                            <img src="<?=base_url("assets/front/")?>/images/drag-icon.png">
                                            <h4>Drag & Drop file here</h4>
                                            <h5>or</h5>
                                        </figure>
                                        <label class="btn btn-primary upload-gellery-img">
                                            choose file<input type="file" style="display: none;">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="picture-gallery-img-show">
                            <label>uploaded image</label>
                            	<ul class="cf">
                                	<li><img src="<?=base_url("assets/front/")?>/images/upload-img-1.jpg"></li>
                                    <li><img src="<?=base_url("assets/front/")?>/images/upload-img-2.jpg"></li>
                                    <li><img src="<?=base_url("assets/front/")?>/images/upload-img-3.jpg"></li>
                                    <li><img src="<?=base_url("assets/front/")?>/images/upload-img-4.jpg"></li>
                                    <li><img src="<?=base_url("assets/front/")?>/images/upload-img-5.jpg"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="informataion-details cf">
                        	<h3>upload your video</h3>
                            <div class="upload-sectio">
                            	<ul class="cf">
                                	<li>enter your youTube video link</li>
                                    <li><img src="<?=base_url("assets/front/")?>/images/help-icone.png"> how to upload video
                                    	<div class="follow-link-sec">
                                        	<h6>please follow the link</h6>
                                            <a href="#">https://support.google.com/youtube/answer/57407?hl=en</a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="step-two-information1 cf">
                                	<div class="vedio-link-in">
                                    	<input type="text" placeholder="">
                                    </div>
                                    <img  class="remove-btn" src="<?=base_url("assets/front/")?>/images/crose-icone.png">
                                </div>
                                <div class="step-two-information1 cf">
                                    <div class="vedio-link-in">
                                    	<input type="text" placeholder="">
                                    </div>
                                    <img  class="remove-btn" src="<?=base_url("assets/front/")?>/images/add-icone.png">
                                    </div>
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
<script type="text/javascript">
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});
</script>
