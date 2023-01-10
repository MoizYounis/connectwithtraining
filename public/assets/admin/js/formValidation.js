 $(document).ready(function(){
   $(document).on('keyup', '.input-check', function(e){
      $(this).next('.text-danger').remove();
      var code = e.keyCode || e.which;
      if(code == '9') {
        // tab pressed
         $(this).removeClass('is-invalid');
          $(this).next('.text-danger').remove();
      }else{
        if($(this).val() === ''){
          $(this).after(`<p style="font-size:12px;" class="text-danger">This field is required.</p>`);
          $(this).addClass('is-invalid');
        }else{
          $(this).removeClass('is-invalid');
          $(this).next('.text-danger').remove();
        }
      }
    });
   $(document).on('change', '.select-check', function(){
      if($(this).val() == ''){
        $(this).after(`<p style="font-size:12px;" class="text-danger">This field is required.</p>`);
        $(this).addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger').remove();
      }
    });
    
 });
 // notification initialize
 function error_noti(message){
  Lobibox.notify('error', {
    pauseDelayOnHover: true,
    size: 'mini',
    rounded: true,
    delayIndicator: false,
    icon: 'fa fa-times-circle',
    continueDelayOnInactiveTab: false,
    position: 'top right',
    msg: message
    });
  }		 

  function success_noti(message){
  Lobibox.notify('success', {
    pauseDelayOnHover: true,
    size: 'mini',
    rounded: true,
    icon: 'fa fa-check-circle',
    delayIndicator: false,
    continueDelayOnInactiveTab: false,
    position: 'top right',
    msg: message
    });
  }