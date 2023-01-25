//filter course
function filterCourse(postRequest='', design='', classNamm=''){
   	$.ajax({
       	url: baseUrl+"/filterBy",
       	type: "post",
       	data: {postRequest: postRequest, design: design},
       	dataType: "json",
       	success:function(response) {
       		if(response.error == 'false'){
       			$(classNamm).html(response.result);
       		}
       		else{
       			$(classNamm).html(response.msg);	
       		}
       		//$('#pre-loader').hide();
       	},
        error: function(response){
            round_error_noti('Connection Error...');
        }
   	});
}

//get related courses
function getRelatedCourse(postRequest='', className='', limit='', design='', token=''){
    $.ajax({
       	url: baseUrl+"/getRelatedCourse",
       	type: "post",
       	data: {limit: limit, design: design, _token: token, postRequest: postRequest},
       	dataType: "json",
       	success:function(response) {
       		if(response.error == 'false'){
           		$(className).html(response.result);
       		}
       		else{
       		    $(className).html(response.msg);
       		}
       	},
        error: function(response){
            round_error_noti('Connection Error...');
        }
    });
}

// get cart
function loadCart(){
    $.ajax({
       	url: baseUrl+'/getCartHtml',
       	type: "post",
       	dataType: "json",
       	success:function(response) {
       		if(response.error == 'false'){
           		$('.cartData').html(response.data);
       		}
       		else{
       		    $('.cartData').html(response.msg);
       		}
       		$('.subTotal').html(response.totalPrice);
       		$('.shippingCharges').html(response.shippingCharges);
       		$('.cartTotalPrice').html(response.finalAmount);
           	$('.pro-item').html('You have '+response.totalItem+' courses in your cart');
           	$('.cartCount').attr("data-count", response.totalItem);
       	},
        error: function(response){
            round_error_noti("Connection Error...");
        }
    });
}

//add to cart
function addToCart(courseName, cid){
    if(courseName !== '' && cid !== ''){
        $.ajax({
           	url: baseUrl+"/addtocart",
           	type: "post",
           	data: {"course_name" : courseName, 'id': cid},
           	dataType: "json",	
           	success:function(response) {
           		if(response.error == 'false'){
           		    loadCart();
           			round_success_noti(response.msg);
           		}
           	},
            error: function(response){
                round_error_noti('Connection Error...');
            }
        });
    }
}
   
//price add to cart
function priceAddToCart(courseName, cid){
    if(courseName !== '' && cid !== ''){
        $.ajax({
           	url: baseUrl+"/addtocart",
           	type: "post",
           	data: {"course_name" : courseName, 'id': cid},
           	dataType: "json",	
           	success:function(response) {
           		if(response.error == 'false'){
           		    loadCart();
           			round_success_noti(response.msg);
                       $(location).attr('href', baseUrl+"/cart");
           		}
           	},
            error: function(response){
                round_error_noti('Connection Error...');
            }
        });
    }
}
//add to fav
function addToFav(courseName='', cid=''){
    if(cid !== ''){
        $.ajax({
           	url: baseUrl+"/addtofav",
           	type: "post",
           	data: {"course_name" : courseName, 'id': cid},
           	dataType: "json",	
           	success:function(response) {
           		if(response.error == 'false'){
           		    loadFav();
           			round_success_noti(response.msg);
                       $(location).attr('href', baseUrl+"/cart");
           		}
           		else{
           		    round_error_noti(response.msg);
           		}
           	},
            error: function(response){
                round_error_noti('Connection Error...');
            }
        });	
    }
}

// get fav items
function loadFav(){
    $.ajax({
       	url: baseUrl+"/getFavItems",
       	type: "post",
       	dataType: "json",
       	success:function(response) {
       		$('.favList').html(response.data);
       	},
        error: function(response){
            round_error_noti('Connection Error!');
        }
    });
}

// delete from cart
function deleteFromCart(cartNo){
    $.ajax({
       	url: baseUrl+"/deleteCartItemHtml",
       	data: {cartNo:cartNo},
       	type: "post",
       	dataType: "json",
       	success:function(response) {
       		if(response.error == 'false'){
       			round_success_noti("Course Removed From Cart.");
       			loadCart();
       		}
       	},
        error: function(response){
            round_error_noti("Connection Error...");
        }
    });
}

function checkShippingAddress(){
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var city = $('#city').val();
    var state = $('#state').val();
    var pincode = $('#pincode').val();
    
    if(fname !== '' && lname !== '' && email !== '' && address !== '' && city !== '' && state !== '' && pincode !== ''){
        // $.ajax({
        //   	url: baseUrl+"/getRelatedCourse",
        //   	type: "post",
        //   	data: {_token: token, postRequest: postRequest},
        //   	dataType: "json",
        //   	success:function(response) {
        //   		if(response.error == 'false'){
        //       		$(className).html(response.result);
        //   		}
        //   		else{
        //   		    $(className).html(response.msg);
        //   		}
        //   	},
        //     error: function(response){
        //         round_error_noti('Connection Error...');
        //     }
        // });
        location.href = baseUrl+'/order-summary';
    }
    else{
        round_error_noti("Please Enter Your Shipping Address!");
    }
}

function emptyCart(token=''){
    $.ajax({
      	url: baseUrl+"/emptyCart",
      	type: "post",
      	data: {_token: token},
      	dataType: "json",
      	success:function(response) {
      		if(response.error == 'false'){
      		    loadCart();
          		round_success_noti(response.msg);
      		}
      		else{
      		    round_error_noti(response.msg);
      		}
      	},
        error: function(response){
            round_error_noti('Connection Error...');
        }
    });
}

function moveToCart(courseName, cNo){
    addToFav(courseName, cNo);
    addToCart(courseName, cNo);
}

function moveToFav(items){
    if(items.length > 0){
        getCourseByCart(items);
        // for(var i=0; i < items.length; i++){
        //     // addToFav(null, items[i]);
        // }
    }
    else{
        round_error_noti('Please Select Course!');
    }
}

function removeFromCart(items){
    if(items.length > 0){
        for(var i=0; i < items.length; i++){
            deleteFromCart(items[i]);
        }
    }
    else{
        round_error_noti('Please Select Course!');
    }
}

function getCourseByCart(items){
    $.ajax({
      	url: baseUrl+"/getCourseByCart",
      	type: "post",
      	data: {items:items},
      	dataType: "json",
      	success:function(response) {
      		if(response.error == 'false'){
      		    for(var i = 0; i < response.data.length; i++){
      		        addToFav(response.data[i].course_name, response.data[i].cid);
      		    }
      		}
      		else{
      		    round_error_noti(response.msg);
      		}
      	},
        error: function(response){
            round_error_noti('Connection Error...');
        }
    });
}

function doSubscribe(token){
    if($('#emailAddress').val() !== ""){
        $.ajax({
          	url: baseUrl+"/subscribe",
          	type: "post",
          	data: {email: $('#emailAddress').val(), _token: token},
          	dataType: "json",
          	success:function(response) {
          		if(response.error == 'false'){
          		    round_success_noti(response.msg);
          		}
          		else{
          		    round_error_noti(response.msg);
          		}
          	},
            error: function(response){
                round_error_noti('Connection Error...');
            }
        });
    }
    else{
        round_error_noti('Please Enter Email!');
    }
}

function doSubscribe1(token){
    if($('.subEmail').val() !== ""){
        $.ajax({
          	url: baseUrl+"/subscribe",
          	type: "post",
          	data: {email: $('.subEmail').val(), _token: token, status:"1"},
          	dataType: "json",
          	success:function(response) {
          		if(response.error == 'false'){
          		    round_success_noti(response.msg);
          		}
          		else{
          		    round_error_noti(response.msg);
          		}
          		$('.subEmail').val("");
          	},
            error: function(response){
    		    var errors = response.responseJSON;
                if(errors.errors.email[0] !== ""){
                    round_error_noti(errors.errors.email[0]);
                }
            }
        });
    }
    else{
        round_error_noti('Please Enter Email!');
    }
}

function setCurrency(sel, token){
    if(sel !== null){
        var currencyValue = sel.value;
        var currencyCode = sel.options[sel.selectedIndex].text;
        currencyValue = currencyValue.trim();
        currencyCode = currencyCode.trim();
        if(currencyValue !== null && currencyCode !== null){
            $.ajax({
              	url: baseUrl+"/setCurrency",
              	type: "post",
              	data: {currencyCode: currencyCode, currencyValue: currencyValue, _token: token},
              	dataType: "json",
              	success:function(response) {
              		if(response.error == 'false'){
              		    location.reload();
              		}
              		else{
              		    round_error_noti('Connection Error...');
              		}
              	},
                error: function(response){
                    round_error_noti('Connection Error...');
                }
            });
        }
        else{
            round_error_noti('Connection Error...');
        }
    }
    else{
        round_error_noti('Connection Error...');
    }
}

$('#chatWithInstructor').on('submit', function(event){
    event.preventDefault();
    if($('#chatWithInstructor .email').val() !== ""){
        if($('#chatWithInstructor .phone').val() !== ""){
            if($('#chatWithInstructor .inscid').val() !== ""){
            
                var email = $('#chatWithInstructor .email').val();
                var phone = $('#chatWithInstructor .phone').val();
                var course_id = $('#chatWithInstructor .inscid').val();
              
            	$.ajax({
            		url: baseUrl+"/chatWithInstructor",
            		type: "POST",
            		data: {email:email, phone:phone, course_id:course_id},
            		dataType: "json",
            		success:function(response) {
            		  if(response.error == "false"){ $('.successMsg p').html(response.msg); }
            		  else{ $('.successMsg p').html(response.msg); }
            		  document.getElementById("chatWithInstructor").reset();
            		  $('.emailError').html("");
            		  $('.phoneError').html("");
            		},
            		error: function(response){
            		    var errors = response.responseJSON;
                        if(errors.errors.email[0] !== ""){
                            $('.emailError').html(errors.errors.email[0]);
                        }
                        if(errors.errors.phone[0] !== ""){
                            $('.phoneError').html(errors.errors.phone[0]);
                        }
                    }
            	});
            }
            else{
                $('#successMsg').html("Please Try After Sometime!");
            }
        }   
        else{
            $('.phoneError').html("Please Enter Your Phone!");
        }
    }
    else{
        $('.emailError').html("Please Enter Your Email!");
    }
});