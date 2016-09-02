<?php
	$this->load->view('frontend/top');
	$this->load->view('frontend/header');
?>
<div class="client-page-richard-outer">
	<div class="container">
    	<div class="clent-richaed-main-box cf">
        <div class="client-details-section">
			<?php
				$clientName		= !empty($client->first_name) ? $client->first_name.' '.$client->last_name : '';
				$clientEmail	= !empty($client->email) ? $client->email : '';
				$clientPhone	= !empty($client->phone) ? $client->phone : '';
				$clientImage	= !empty($client->image) ? $client->image : 'client-img-pro.jpg';
				$smsNotified	= !empty($client->sms_notified) ? $client->sms_notified : '';
				$emailNotified	= !empty($client->email_notified) ? $client->email_notified : '';
			?>
        	<figure>
            	<a href="<?=base_url("assets/front/")?>/images/client-img-pro.jpg" data-lightbox="example-3"><img src="<?=base_url('assets/front/clients/'.$clientImage)?>" alt="image"></a>
            </figure>
            <div class="client-view-div">
            <h1><label id="clientName"><?=$clientName;?></label>
				<a href="javascript:void(0)" id="editProfile">
					<img src="<?=base_url("assets/front/")?>/images/edit-icone.png" alt="image">
				</a>
			</h1>
            <a href="#">
				<img src="<?=base_url("assets/front/")?>/images/mail-icone-client-page.png" alt="image">
				<label id="clientEmail"><?=$clientEmail;?></label>
			</a>
            <a href="#">
				<img src="<?=base_url("assets/front/")?>/images/call-icone-client-page.png" alt="image">
				<label id="clientPhone"><?=$clientPhone;?></label>
			</a>
			</div>
			<!--****** Editbale client infor div -->
			<div class="client-edit-div" style="display:none">
				<?=form_open(current_url(),array('id'=>'profile-form'))?>
				<input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?=!empty($client->first_name) ? $client->first_name : '';?>">
				<input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?=!empty($client->last_name) ? $client->last_name : '';?>">
				<input type="text" name="email" id="email" placeholder="Email" value="<?=$clientEmail;?>">
				<input type="text" name="phone" id="phone" placeholder="Contact" value="<?=$clientPhone;?>">
				<a href="#" class="cancel" id="cancel">
					cancel
					<!--<img src="<?=base_url("assets/front/images/close.png")?>" alt="image">-->
				</a>
				<a href="#" class="update" id="update">
					update
					<!--<img src="<?=base_url("assets/front/images/close.png")?>" alt="image">-->
				</a>
				<?=form_close()?>
			</div>
			
            
      </div>
      <div class="client-mail-mo-section">
      	<h3>How the want to be notified?</h3>
        <ul>
        	<li class="notified <?=($smsNotified) ? 'notified-class' :'';?>" data-status="<?=($smsNotified) ? 'Yes' :'No';?>" data-type="sms_notified" id="smsNotification">
				<a href="javascript:void(0)">
					<img src="<?=base_url("assets/front/")?>/images/sms-icone.png" alt="image">
				SMS
				</a>
			</li>
            <li class="notified email-ic-cl <?=($emailNotified) ? 'notified-class' :'';?> " class="notified" data-status="<?=($emailNotified) ? 'Yes' :'No';?>" data-type="email_notified" id="emailNotification">
				<a href="javascript:void(0)">
					<img src="<?=base_url("assets/front/")?>/images/email-icone-cl.png" alt="image">
				Email
				</a>
			</li>
        </ul>
      </div>
    </div>
</div>
</div>
<div class="client-order-details-outer">
	<div class="container">
    	<div class="client-order-details">
        	<h2> my orders</h2>
            <div class="girl-details-clien-order-main">
            	<div class="girl-details-clien-order">
                	<div class="profile-pic-girl">
                    <figure>
                    	<a href="<?=base_url("assets/front/")?>/images/11.jpg" data-lightbox="example-1"><img src="<?=base_url("assets/front/")?>/images/girl-profile-pic1.jpg" alt="image"></a>
                        </figure>
                        <div class="msg-me">
                        	<h4><img src="<?=base_url("assets/front/")?>/images/msg-me.png" alt="image"> msg me</h4>
                          
                        </div>
                       
                    </div>
                    <div class="about-girl-about-area">
                    <div class="about-girl-about-area-head cf">
                    	<h3>Christina Robertson</h3>
                        <ul>
                         <li>
                            	<img src="<?=base_url("assets/front/")?>/images/end-icone-img.png" alt="image">
                                <p>546/114-13 Brookhollow Avenue Norwest Business Park, NSW 2153</p>
                            </li>
                        	<li>
                            	<img src="<?=base_url("assets/front/")?>/images/date-icone-img.png" alt="image">
                               		<h5>March 31, 2016</h5>
                            </li>
                            <li>
                            	<img src="<?=base_url("assets/front/")?>/images/start-icone-img.png" alt="image">
                                <h5>6px to 9px</h5>
                            </li>
                           
                        </ul>
                        </div>
                        <div class="girl-services-of-client cf">
                        	<div class="girl-services-of-client-box-main">
                                <div class="girl-services-of-client-box">
                                <h3>services</h3>
                                    <ul>
                                        <li>
                                            <h6>Topless G-string Waitress</h6>
                                            <span class="price-of-girl">$300</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Topless Waitress</h6>
                                            <span class="price-of-girl">$200</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Topless Poker Dealer</h6>
                                            <span class="price-of-girl">$100</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Promo Models</h6>
                                            <span class="price-of-girl">$50</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Bikini/Lingerie</h6>
                                            <span class="price-of-girl">$50</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="girl-services-of-client-box">
                                <h3>Extra service</h3>
                                    <ul>
                                        <li>
                                            <h6>Topless G-string Waitress</h6>
                                            <span class="price-of-girl">$300</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Topless Waitress</h6>
                                            <span class="price-of-girl">$200</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Topless Poker Dealer</h6>
                                            <span class="price-of-girl">$100</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Promo Models</h6>
                                            <span class="price-of-girl">$50</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Bikini/Lingerie</h6>
                                            <span class="price-of-girl">$50</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                    </ul>
                                </div>
                           	</div>
                            <div class="total-girls-amount-section">
                            	<h4>total</h4>
                                <h5>$900.00</h5>
                                <h6>8 hours</h6>
                                <a href="#" class="view_profile">view profile</a>
                                <a href="#" class="amend_order">amend order</a>
                                <a href="#" class="cancle_the_order">cancle the order</a>
                            </div>
                        </div>
                    </div>
                    <div class="conformed-rebn">
                    	<img src="<?=base_url("assets/front/")?>/images/conformed-icone.png" alt="image">
                    </div>
                </div>
               </div>
               <div class="girl-details-clien-order-main">
            	<div class="girl-details-clien-order">
                	<div class="profile-pic-girl">
                    <figure>
                    	<a href="<?=base_url("assets/front/")?>/images/sign-up-left.jpg" data-lightbox="example-2"><img src="<?=base_url("assets/front/")?>/images/girl-profile-pic2.jpg" alt="image"></a>
                        </figure>
                        <div class="msg-me">
                        	<h4><img src="<?=base_url("assets/front/")?>/images/msg-me.png" alt="image"> msg me</h4>
                             
                        </div>
                    </div>
                    <div class="about-girl-about-area">
                    	<div class="about-girl-about-area-head cf">
                    	<h3>Christina Robertson</h3>
                        <ul>
                         <li>
                            	<img src="<?=base_url("assets/front/")?>/images/end-icone-img.png" alt="image">
                                <p>546/114-13 Brookhollow Avenue Norwest Business Park, NSW 2153</p>
                            </li>
                        	<li>
                            	<img src="<?=base_url("assets/front/")?>/images/date-icone-img.png" alt="image">
                               		<h5>March 31, 2016</h5>
                            </li>
                            <li>
                            	<img src="<?=base_url("assets/front/")?>/images/start-icone-img.png" alt="image">
                                <h5>6px to 9px</h5>
                            </li>
                           
                        </ul>
                        </div>
                        
                        <div class="girl-services-of-client cf">
                        	<div class="girl-services-of-client-box-main">
                                <div class="girl-services-of-client-box">
                                <h3>services</h3>
                                    <ul>
                                        <li>
                                            <h6>Topless G-string Waitress</h6>
                                            <span class="price-of-girl">$300</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Topless Waitress</h6>
                                            <span class="price-of-girl">$200</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Topless Poker Dealer</h6>
                                            <span class="price-of-girl">$100</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Promo Models</h6>
                                            <span class="price-of-girl">$50</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Bikini/Lingerie</h6>
                                            <span class="price-of-girl">$50</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="girl-services-of-client-box">
                                <h3>Extra service</h3>
                                    <ul>
                                        <li>
                                            <h6>Topless G-string Waitress</h6>
                                            <span class="price-of-girl">$300</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Topless Waitress</h6>
                                            <span class="price-of-girl">$200</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Topless Poker Dealer</h6>
                                            <span class="price-of-girl">$100</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Promo Models</h6>
                                            <span class="price-of-girl">$50</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                        <li>
                                            <h6>Bikini/Lingerie</h6>
                                            <span class="price-of-girl">$50</span>
                                            <span class="hours-of-girl">1 hours</span>
                                        </li>
                                    </ul>
                                </div>
                           	</div>
                            <div class="total-girls-amount-section">
                            	<h4>total</h4>
                                <h5>$900.00</h5>
                                <h6>8 hours</h6>
                                <a href="#" class="view_profile">view profile</a>
                                <a href="#" class="amend_order">amend order</a>
                                <a href="#" class="cancle_the_order">cancle the order</a>
                            </div>
                        </div>
                    </div>
                    <div class="conformed-rebn">
                    	<img src="<?=base_url("assets/front/")?>/images/awated-icone.png" alt="image">
                    </div>
                </div>
               </div>
           
            
        </div>
    </div>
</div>

<?php
	$this->load->view('frontend/footer');
	$this->load->view('frontend/bottom');
?>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
	
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


</script>
<script>
$(document).ready(function(){
	$(".notification-num-area").click(function(e){
		e.stopPropagation();
		$(".notification-drop-down1").slideToggle();
	});
	
	$('.notification-drop-down1').click(function(e){
		e.stopPropagation();
	});
	
	$(".msg-me h4").click(function(){
		$(".msg-write-area").slideToggle();
	});
	
	//****** Edit Profile Section ******//
	$('#editProfile').click( function (){
		$('.client-view-div').hide();
		$('.client-edit-div').show();
	});
	
	//****** Cancel , Update Profile Section ******//
	$('.client-edit-div').on('click','#cancel', function (){
		$('.client-edit-div').hide();
		$('.client-view-div').show();
	});
	
	$('.client-edit-div').on('click','#update', function (){
		$.post('<?=base_url('updateProfile');?>',$('#').submit(),function (response){
			
		})
		$('.client-edit-div').hide();
		$('.client-view-div').show();
	});
	
	//****** Notified function ******//
	$('.notified').click( function (){
		var status		= $(this).attr('data-status');
		var notifiedType= $(this).attr('data-type');
		var id			= this.id;
		if(status!="" && notifiedType !=""){
			$.post('<?=base_url('updateNotification');?>',{'status':status,'notifiedType':notifiedType}, function (response){
				var data = JSON.parse(response);
				if(data.status=='Yes'){
					if(status=='Yes'){
						$('#'+id).removeClass('notified-class');
						$('#'+id).attr('data-status','No');
					}else{
						$('#'+id).addClass('notified-class');
						$('#'+id).attr('data-status','Yes');
					}
				}
			});
		}
	});

 });
$(document).click(function(){
	$('.notification-drop-down1').slideUp();
})
</script>

