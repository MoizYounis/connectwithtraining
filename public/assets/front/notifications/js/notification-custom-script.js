  
    /* Default Notifications */

         function default_noti(){
			Lobibox.notify('default', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    msg: msg
		    });
		  }


        function info_noti(){
			Lobibox.notify('info', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    icon: 'fa fa-info-circle',
		    msg: msg
		    });
		  }

        function warning_noti(){
			Lobibox.notify('warning', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    icon: 'fa fa-exclamation-circle',
		    msg: msg
		    });
		  }		 

		  function error_noti(){
			Lobibox.notify('error', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    icon: 'fa fa-times-circle',
		    msg: msg
		    });
		  }		 

		  function success_noti(){
			Lobibox.notify('success', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    icon: 'fa fa-check-circle',
		    msg: msg
		    });
		  }		 




/* Rounded corners Notifications */

         function round_default_noti(msg){
			Lobibox.notify('default', {
		    pauseDelayOnHover: true,
		    size: 'mini',
		    rounded: true,
		    delayIndicator: false,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    msg: msg,
		    sound: false,
		    });
		  }


        function round_info_noti(msg){
			Lobibox.notify('info', {
		    pauseDelayOnHover: true,
		    size: 'mini',
		    rounded: true,
		    icon: 'fa fa-info-circle',
		    delayIndicator: false,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    msg: msg
		    });
		  }

        function round_warning_noti(msg){
			Lobibox.notify('warning', {
		    pauseDelayOnHover: true,
		    size: 'mini',
		    rounded: true,
		    delayIndicator: false,
		    icon: 'fa fa-exclamation-circle',
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    msg: msg,
		    sound: false,
		    });
		  }		 

		  function round_error_noti(msg){
			Lobibox.notify('error', {
		    pauseDelayOnHover: true,
		    size: 'mini',
		    rounded: true,
		    delayIndicator: false,
		    icon: 'fa fa-times-circle',
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    msg: msg,
		    sound: false,
		    });
		  }		 

		  function round_success_noti(msg){
			Lobibox.notify('success', {
		    pauseDelayOnHover: true,
		    size: 'mini',
		    rounded: true,
		    icon: 'fa fa-check-circle',
		    delayIndicator: false,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    msg: msg,
		    sound: false,
		    });
		  }		 




     /* Notifications With Images*/

         function img_default_noti(){
			Lobibox.notify('default', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    img: 'assets/plugins/notifications/img/1.jpg', //path to image
		    msg: msg
		    });
		  }


        function img_info_noti(){
			Lobibox.notify('info', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            icon: 'fa fa-info-circle',
		    position: 'top right',
		    img: 'assets/plugins/notifications/img/2.jpg', //path to image
		    msg: msg
		    });
		  }

        function img_warning_noti(){
			Lobibox.notify('warning', {
		    pauseDelayOnHover: true,
		    icon: 'fa fa-exclamation-circle',
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    img: 'assets/plugins/notifications/img/3.jpg', //path to image
		    msg: msg
		    });
		  }		 

		  function img_error_noti(){
			Lobibox.notify('error', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            icon: 'fa fa-times-circle',
		    position: 'top right',
		    img: 'assets/plugins/notifications/img/4.jpg', //path to image
		    msg: msg
		    });
		  }		 

		  function img_success_noti(){
			Lobibox.notify('success', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    icon: 'fa fa-check-circle',
		    img: 'assets/plugins/notifications/img/5.jpg', //path to image
		    msg: msg
		    });
		  }		 
		 




     /* Notifications With Images*/


      function pos1_default_noti(){
			Lobibox.notify('default', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'center top',
		    size: 'mini',
		    msg: msg
		    });
		  }

        function pos2_info_noti(){
			Lobibox.notify('info', {
		    pauseDelayOnHover: true,
		    icon: 'fa fa-info-circle',
            continueDelayOnInactiveTab: false,
		    position: 'top left',
		    size: 'mini',
		    msg: msg
		    });
		  }

        function pos3_warning_noti(){
			Lobibox.notify('warning', {
		    pauseDelayOnHover: true,
		    icon: 'fa fa-exclamation-circle',
            continueDelayOnInactiveTab: false,
		    position: 'top right',
		    size: 'mini',
		    msg: msg
		    });
		  }		 

		  function pos4_error_noti(){
			Lobibox.notify('error', {
		    pauseDelayOnHover: true,
		    icon: 'fa fa-times-circle',
		    size: 'mini',
            continueDelayOnInactiveTab: false,
		    position: 'bottom left',
		    msg: msg
		    });
		  }		 

		  function pos5_success_noti(){
			Lobibox.notify('success', {
		    pauseDelayOnHover: true,
		    size: 'mini',
		    icon: 'fa fa-check-circle',
            continueDelayOnInactiveTab: false,
		    position: 'bottom right',
		    msg: msg
		    });
		  }	




     /* Animated Notifications*/


      function anim1_noti(){
			Lobibox.notify('default', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'center top',
		    showClass: 'fadeInDown',
            hideClass: 'fadeOutDown',
            width: 600,
		    msg: msg
		    });
		  }


		  function anim2_noti(){
			Lobibox.notify('info', {
		    pauseDelayOnHover: true,
		    icon: 'fa fa-info-circle',
            continueDelayOnInactiveTab: false,
		    position: 'center top',
		    showClass: 'bounceIn',
            hideClass: 'bounceOut',
            width: 600,
		    msg: msg
		    });
		  }

		  function anim3_noti(){
			Lobibox.notify('warning', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            icon: 'fa fa-exclamation-circle',
		    position: 'center top',
		    showClass: 'zoomIn',
            hideClass: 'zoomOut',
            width: 600,
		    msg: msg
		    });
		  }

		  function anim4_noti(){
			Lobibox.notify('error', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            icon: 'fa fa-times-circle',
		    position: 'center top',
		    showClass: 'lightSpeedIn',
            hideClass: 'lightSpeedOut',
            width: 600,
		    msg: msg
		    });
		  }

		  function anim5_noti(){
			Lobibox.notify('success', {
		    pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
		    position: 'center top',
		    showClass: 'rollIn',
            hideClass: 'rollOut',
            icon: 'fa fa-check-circle',
            width: 600,
		    msg: msg
		    });
		  }