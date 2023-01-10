<?php
session_start();
include 'includes/scripts.php';
require_once 'includes/sendgrid.php';
require_once 'includes/php_list.php';

if(isset($_POST['g-recaptcha-response'])){         $captcha=$_POST['g-recaptcha-response'];

	$ip = $_SERVER['REMOTE_ADDR'];
	        // post request to server
	$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($recaptcha_secretkeyv2) .  '&response=' . urlencode($captcha);
	$response = file_get_contents($url);
	$responseKeys = json_decode($response,true);
}

if(isset($_REQUEST['email']))	$email = pvalidate($_REQUEST['email']);
if(isset($_REQUEST['name'])) $name = pvalidate($_REQUEST['name']);


if(isset($_POST['submit'])){
    if($responseKeys["success"]) {
        $username = pvalidate($_POST['username']);
        $title = pvalidate($_POST['title']);
        $type = pvalidate($_POST['type']);
        $address = pvalidate($_POST['address']);
        $phone = pvalidate($_POST['phone']);
        $description = pvalidate($_POST['description']);
        $contactperson = pvalidate($_POST['contactperson']);
        $email = strtolower(pvalidate($_POST['email']));
        $password = pvalidate($_POST['password']);
        $cpassword = pvalidate($_POST['cpassword']);
        $video = pvalidate($_POST['video']);
        $facebook = pvalidate($_POST['facebook']);
        $twitter = pvalidate($_POST['twitter']);
        $linkedin = pvalidate($_POST['linkedin']);
        $youtube = pvalidate($_POST['youtube']);
        $package = pvalidate($_POST['package']);
        
        $path_parts = pathinfo($_FILES["photo"]["name"]);
        $extension = $path_parts['extension'];
        $image = uniqid(time()).".$extension";
        $image_tmp = $_FILES['photo']['tmp_name'];
        $token = uniqid(uniqid(time()));
    	$paymentmsg = "";
        if($package!='basic'){
            $paymentmsg = "After verification, you will be redirected to paypal for payment. ";
        }
    
        $query = "INSERT INTO businesses (id, username, type, title, description, address, phone, contactperson, email, password, video, facebook, photo, twitter, linkedin, youtube, package, token) VALUES (NULL, '$username', '$type', '$title', '$description', '$address', '$phone', '$contactperson', '$email', '$password', '$video', '$facebook', '$image', '$twitter', '$linkedin', '$youtube', '$package', '$token')";
         if(mysqli_query($conn, $query)){
                move_uploaded_file($image_tmp, "assets/img/businesses/$image");
                $_SESSION['message'] = "<div class='alert alert-success'>
                Business Added Successfuly!!  Please check your email for verification.
                </div>";
    		 	$to = $email;
    			$subject = 'Please verify your email address';
    			include 'verifybmail.php';

    			//subsAdd($emailAddr,8); 
    			sendgrid($to, $title, $subject, $message);
    			            
    			$adminmessage = "New Business Registered <br/>Contact Person Name:".$contactperson."<br/>Email:".$email;
            sendgrid($adminemail, "StudyInCanada", "New Business Registered", $adminmessage);
    		 	unset($_SESSION['businessid']);
    		 	unset($_SESSION['package']);
                header('location:business-login');
         }else{
               echo mysqli_error($conn);
        }
    }
}

function pvalidate($value){
global $conn;
$value = mysqli_real_escape_string($conn, htmlentities(strip_tags($value)));
return $value;
}

?>
    <title>Register a Business</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css" rel="stylesheet" />
    <style>
        .account-wall {

            padding: 20px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .login-title {
            color: #555;
            font-size: 18px;
            font-weight: 400;
            display: block;
        }

        .dropzone {
            background: white;
            border-radius: 5px;

            border-image: none;
            /* max-width: 500px; */
            margin-left: auto;
            margin-right: auto;
            padding: 50px;
            text-align: center;
            vertical-align: middle;
            border: 2px dashed #bd2130;
        }
    </style>
</head>
<body>

    <div class="super_container">

        <!-- Header -->

        <?php //include 'includes/alternate-nav.php'; ?>
         <?php include 'includes/nav.php'; ?>

        <!-- Home -->



        <!-- Features -->
       
        <div class="features" style="padding-top:80px;padding-bottom:80px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <br>
                        <br>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="setup-content" id="step-1">
                                <br>
                                <h3 style="color:black"><?=$LANG['Register_a_Businesses'];?></h3>
                                
                                <hr style="background:#bd2130;height:1px">

                                <div class="d-none">
                                    <br>
                                    <div class="account-wall">
                                        <div class="form-group">
                                            <select name="type" class="form-control" id="">
                                                <option value="">Business Category</option>
                                                <?php
                                                    include 'admin/db.php';
                                                    $query = "select * from businesscategories";             
                                                    $run = mysqli_query($conn, $query);
                                                    if(mysqli_num_rows($run)> 0){
                                                        while($row = mysqli_fetch_array($run)){
                                                ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="title" placeholder="Ad title">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="Ad description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="address" placeholder="Location address">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                                        </div>


                                    </div>

                                </div>
                                <div class="">
                                    <br>
                                    <div class="account-wall">
                                        <div class="form-group">
                                            <h3 style="color:black"><?=$LANG['User_Profile'];?></h3>
                                            <hr>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="contactperson" value="<?php if(isset($name)) echo $name; ?>" placeholder="Contact person (optional)">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" value="<?php if(isset($username)) echo $username; ?>" placeholder="Enter a username (Allowed characters : a-z 0-9)" pattern="[a-z0-9]+" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="Enter your email address" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="cpassword" placeholder="Confirm password" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none">
                                <br>
                                <div class="account-wall">
                                    <div class="form-group">
                                        <h3 style="color:black"><?=$LANG['Media'];?></h3>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?=$LANG['Featured_Ad_Photo'];?></label>
                                        <input type="file" name="photo" class="form-control" placeholder="Featured ad photo">

                                    </div>
                                    <div class="form-group">
                                        <label for=""><?=$LANG['FileUploadNote'];?></label>

                                            <div id="dropzoneDiv" class="dropzone dz-clickable">
                                                <div class="dz-default dz-message">
                                                    <span><?=$LANG['Drop_files_here_to_upload'];?></span>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="text" placeholder="Welcome video youtube url (optional)" class="form-control" name="video">
                                    </div>
                                </div>
                            </div>
                            <div class="d-none">
                                <br>
                                <div class="account-wall">
                                    <div class="form-group">
                                        <h3 style="color:black"><?=$LANG['Social_Media'];?> (<?=$LANG['optional'];?>)</h3>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                    <input type="text" class="form-control" name="facebook" placeholder="Your business facebook url">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="twitter" placeholder="Your business twitter url">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="youtube" placeholder="Your business youtube url">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="linkedin" placeholder="Your business linkedin url">
                                </div>
                                </div>
                            </div>
                             <div class="d-none">
                                <br>
                                <div class="account-wall">
                                    <div class="form-group">
                                        <h3 style="color:black"><?=$LANG['Select_your_Registration_Package'];?></h3>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label style="font-size:20px;font-weight:bold;color:black"><input type="radio" name="package" checked value="basic" style="margin-right:5px"> <?=$LANG['Basic'];?>: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <p style="padding:10px;border:1px solid #e8e8e8"><?=$LANG['Stadard_Ad_Expires'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                           <div class="row">
                                               <div class="col-md-4">
                                               <label style="font-size:20px;font-weight:bold;color:black"><input type="radio" name="package"  value="premium" style="margin-right:5px"> <?=$LANG['Premium'];?>: </label>
                                           </div>
                                           <div class="col-md-8">
                                               <p style="padding:10px;border:1px solid #e8e8e8">
                                                   <?=$LANG['PremiumText'];?> $9.99
                                               </p>
                                           </div>
                                       </div>
                                        
                                    </div>
                                    <div class="form-group">
                                       <div class="row">
                                           <div class="col-md-4">
                                               <label style="font-size:20px;font-weight:bold;color:black"><input type="radio" name="package"  value="featured" style="margin-right:5px"> <?=$LANG['Featured'];?>: </label>
                                           </div>
                                           <div class="col-md-8">
                                               <p style="padding:10px;border:1px solid #e8e8e8">
                                                   <?=$LANG['FeaturedText'];?> $129.99
                                               </p>
                                           </div>
                                       </div>
                                        
                                    </div>
                                                                               
                                 </div>
                            </div>
                            <div class="account-wall form-group">
                                            <p style="padding:10px;border:1px solid #e8e8e8"><b>* <?=$LANG['BizregContent'];?></b></p>
                                            <p style="padding:10px;border:1px solid #e8e8e8">
                                                <b><?=$LANG['BizregContent2'];?> <a href="disclaimer"><?=$LANG['Disclaimer'];?></a> and <a href="privacy"> <?=$LANG['Privacy_Policy'];?></a></b>

                                            </p>
                                            
                                            <p style="padding:10px;border:1px solid #e8e8e8"><b>Protecting your privacy is fundamental to our mission and business<br>We never sell your data or information <br>We never send you junk email<br>We don't own the content you add to our website </b>

                                            </p>
                                            

                                        </div>
                                        <div class="form-group text-center">
      	                                        <div style="display: inline-block;" class="g-recaptcha" data-sitekey="<?php echo $recaptcha_sitekeyv2; ?>" data-callback="enableBtn"></div>
                                        </div>
                                        <div class="form-group"> 
                                                    <input type="checkbox" > I agree to the <a href="#">Terms of Service</a> and <a href="https://www.studyingincanada.org/privacy">Privacy Policy</a>.
                                            </div> 
                                                                                     
                                        <div class="form-group">
                                            <br>
                                            <input type="submit" class="btn btn-danger btn-block" name="submit" id="submit" value="Continue">
                                        </div> 
                        </form>
                    </div>                    
                </div>
                
            </div>
            
        </div>
        
        <?php include 'includes/footer.php'; ?>


        

    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="plugins/greensock/TweenMax.min.js"></script>
    <script src="plugins/greensock/TimelineMax.min.js"></script>
    <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="plugins/greensock/animation.gsap.min.js"></script>
    <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="js/custom.js"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
    <script>
        document.getElementById("submit").disabled = true;
        function enableBtn(){
            document.getElementById("submit").disabled = false;
        }
        
        var dropzone = null;
        Dropzone.autoDiscover = false;
        $(document).ready(function() {

            dropzone = $("#dropzoneDiv").dropzone({
                url: "/search",
                acceptedFiles: 'image/*,video/*',
                autoProcessQueue: false,
                createImageThumbnails: true,
                addRemoveLinks: true
            });
        });

        function submitForm() {
            dropzone.processQueue();
            return false;
        }

    </script>
    


</body>

</html>
