	 bootstrap_alert = function() {}    
    bootstrap_alert.warning = function(message) {
			var html = '<div class="alert alert-warning fade in"><button data-dismiss="alert" class="close">';
			html += '&Cross;</button><i class="fa-fw fa fa-warning "></i><strong>Warning</strong>';
			html += message+'</div>';
						
            $('#show_alert_message').html(html)
       		 $(".alert-warning").fadeTo(4000, 500).slideUp(500, function(){
			    $(".alert-warning").alert('close');
				});
        }
    bootstrap_alert.success = function(message) {
			var msghtml = '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close">';
			msghtml += '&Cross;</button><i class="fa-fw fa fa-check "></i><strong>Success </strong>';
			msghtml += message+'</div>';
           $('#show_alert_message').html(msghtml);
      		$(".alert-success").fadeTo(4000, 500).slideUp(500, function(){
			    $(".alert-success").alert('close');
				});
        }
      bootstrap_alert.danger = function(message) {
			var html = '<div class="alert alert-danger fade in"><button data-dismiss="alert" class="close">';
			html += '&Cross;</button><i class="fa-fw fa fa-times "></i><strong>Error ! </strong>';
			html += message+'</div>';
            $('#show_alert_message').html(html)
        		$(".alert-danger").fadeTo(4000, 500).slideUp(500, function(){
			    $(".alert-danger").alert('close');
				});
        }
