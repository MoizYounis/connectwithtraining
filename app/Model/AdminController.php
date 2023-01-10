<?php

class AdminController extends Zend_Controller_Action {

    public function init() {
		
		$this->_helper->layout()->setLayout("admin");
    }

    public function indexAction() { 
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth'); 
		
		if(isset($authUserNamespace->userid) && $authUserNamespace->userid !="")
		$this->_redirect("/admin/home");
		
		
        $this->_helper->layout()->setLayout("login");
        
		if ($this->_request->isPost()) {
            $username = $this->_request->getParam('username');
            $password = $this->_request->getParam('password');
            //$usernameescape = mysql_real_escape_string($username);
            //$passwordescape = mysql_real_escape_string($password);
            $adminlogin = new Chez_Model_DbTable_User();
            $user_row = $adminlogin->fetchRow($adminlogin->select()
                            ->where("email='$username' AND password ='$password'"));
            if ($user_row != "" && sizeof($user_row) > 0) {
                $authUserNamespace->userid = $user_row->user_id;
                $authUserNamespace->fname = $user_row->first_name;
                $authUserNamespace->lname = $user_row->last_name;
                $authUserNamespace->user_name = $user_row->username;
                $authUserNamespace->username = $user_row->username;
                $authUserNamespace->userrole = $user_row->role;
                $authUserNamespace->ds_image_pre_id = time();
                $this->view->msg = "";
                $this->_redirect('/admin/home');
            } else {
                $this->view->msg = "inactive";
            }
        }
		
    }
	public function checkloginAction()
	{
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth'); 
		
		$posted_data = $this->getRequest()->getPost(); //prd($posted_data);	
		
		$username = $posted_data['username'];
		$password = $posted_data['password'];
		
		$adminlogin = new Chez_Model_DbTable_User();
		/*$user_row = $adminlogin->fetchRow($adminlogin->select()
						->where("email='$username' AND password ='$password'"));*/
		$user_row = $adminlogin->fetchRow($adminlogin->select()
						->where("email='$username' AND password ='$password' AND role='admin'"));				
		if ($user_row != "" && sizeof($user_row) > 0) {
			$authUserNamespace->userid = $user_row->user_id;
			$authUserNamespace->fname = $user_row->first_name;
			$authUserNamespace->lname = $user_row->last_name;
			$authUserNamespace->user_name = $user_row->username;
			$authUserNamespace->username = $user_row->username;
			$authUserNamespace->userrole = $user_row->role;
			$authUserNamespace->ds_image_pre_id = time();
			
			//$this->_redirect('/admin/home');
			echo 'SUCCESS||Login successfully';
			
		} else {
			echo 'ERROR||Wrong username or password, please try again!';
		}
		exit;
	}
    public function homeAction() {
        $authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
        if(!isset($authUserNamespace->userid) || $authUserNamespace->userid=="")$this->_redirect("/admin");
        $this->_helper->layout()->setLayout("admin");
        $authUserNamespace->admin_page_title = "Home";
        
    }

    public function deleteallimagesAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $deleteALlObj = new Ecommerce_Model_DbTable_Imageupload();
        $where = '1=1';
        $deleteALlObj->delete($where);
        $this->_redirect('/school/welcome');
    }

    public function homeimagesAction() {
        $authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
        $authUserNamespace->admin_page_title = "Manage Home Page";
        if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "")
            $this->_redirect("/admin");
        $homeimgObj = new Chez_Model_DbTable_HomeImages();
        //$homeinfo = $homeimgObj->fetchRow();
        $homeinfo = $homeimgObj->fetchRow($homeimgObj->select()
                        ->where("id='1'"));
        $this->view->homeinfo = $homeinfo;
        //$authUserNamespace->homeheadline = $homeinfo->headline_text;
        $occasionObj = new Chez_Model_DbTable_OccasionCategory();
        $selectOccsion = $occasionObj->fetchAll($occasionObj->select());
        $this->view->occasion = $selectOccsion;
        if ($this->_request->isPost()) {
            $image1 = $this->_request->getParam('image1upload');
            $image2 = $this->_request->getParam('image2upload');
            $image3 = $this->_request->getParam('image3upload');
            $image4 = $this->_request->getParam('image4upload');
            $image5 = $this->_request->getParam('image5upload');
            $image6 = $this->_request->getParam('image6upload');
            $rolltext1 = $this->_request->getParam('image1text');
            $rolltext2 = $this->_request->getParam('image2text');
            $rolltext3 = $this->_request->getParam('image3text');
            $rolltext4 = $this->_request->getParam('image4text');
            $rolltext5 = $this->_request->getParam('image5text');
            $headline = $this->_request->getParam('headlinetxt');
            $subheadline = $this->_request->getParam('subheadline');
            $today = date("Y-m-d H:i:s");

            if ($this->_request->isXmlHttpRequest()) {
                $this->_helper->layout()->disableLayout();
                $this->_helper->viewRenderer->setNoRender(true);
                $response = array();
                $headfilecheck1 = basename($image1);
                $headext1 = substr($headfilecheck1, strrpos($headfilecheck1, '.') + 1);
                $headext1 = strtolower($headext1);
                $img1 = $this->_request->getParam("check_image1");
                $f = 0;
                if ($img1 == "") {
                    $f = 1;
                    if ($image1 == "")
                        $response["data"]["image1upload"] = "null";
                    //	elseif($headext1 == "png")$response['data']['headerfile1']="valid";
                    elseif ($headext1 == "jpg" || $headext1 == "jpeg" || $headext1 == "gif" || $headext1 == "pjpeg" || $headext1 == "png")
                        $response['data']['image1upload'] = "valid";
                    else
                        $response["data"]["image1upload"] = "invalid";
                }
                if (($img1 != "" || $img1 != null) && ($image1 != "" || $image1 != null)) {
                    if ($headext1 == "jpg" || $headext1 == "jpeg" || $headext1 == "gif" || $headext1 == "pjpeg" || $headext1 == "png")
                        $response['data']['image1upload'] = "valid";
                    else {
                        $response["data"]["image1upload"] = "invalid";
                        //echo" ".$response;exit;
                    }
                } else {
                    if ($f != 1) {
                        $response["data"]["image1upload"] = "valid";
                    }
                }
                if ($rolltext1 == "")
                    $response["data"]["image1text"] = "null";
                else
                    $response["data"]["image1text"] = "valid";
                $headfilecheck2 = basename($image2);
                $headext2 = substr($headfilecheck2, strrpos($headfilecheck2, '.') + 1);
                $headext2 = strtolower($headext2);
                $img2 = $this->_request->getParam("check_image2");
                $f = 0;
                if ($img2 == "") {
                    $f = 1;
                    if ($image2 == "")
                        $response["data"]["image2upload"] = "null";
                    //	elseif($headext1 == "png")$response['data']['headerfile1']="valid";
                    elseif ($headext2 == "jpg" || $headext2 == "jpeg" || $headext2 == "gif" || $headext2 == "pjpeg" || $headext2 == "png")
                        $response['data']['image2upload'] = "valid";
                    else
                        $response["data"]["image2upload"] = "invalid";
                }
                if (($img2 != "" || $img2 != null) && ($image2 != "" || $image2 != null)) {
                    if ($headext2 == "jpg" || $headext2 == "jpeg" || $headext2 == "gif" || $headext2 == "pjpeg" || $headext2 == "png")
                        $response['data']['image2upload'] = "valid";
                    else {
                        $response["data"]["image2upload"] = "invalid";
                        //echo" ".$response;exit;
                    }
                } else {
                    if ($f != 1) {
                        $response["data"]["image2upload"] = "valid";
                    }
                }
                if ($rolltext2 == "")
                    $response["data"]["image2text"] = "null";
                else
                    $response["data"]["image2text"] = "valid";
                $headfilecheck3 = basename($image3);
                $headext3 = substr($headfilecheck3, strrpos($headfilecheck3, '.') + 1);
                $headext3 = strtolower($headext3);
                $img3 = $this->_request->getParam("check_image3");
                $f = 0;
                if ($img3 == "") {
                    $f = 1;
                    if ($image3 == "")
                        $response["data"]["image3upload"] = "null";
                    //	elseif($headext1 == "png")$response['data']['headerfile1']="valid";
                    elseif ($headext3 == "jpg" || $headext3 == "jpeg" || $headext3 == "gif" || $headext3 == "pjpeg" || $headext3 == "png")
                        $response['data']['image3upload'] = "valid";
                    else
                        $response["data"]["image3upload"] = "invalid";
                }
                if (($img3 != "" || $img3 != null) && ($image3 != "" || $image3 != null)) {
                    if ($headext3 == "jpg" || $headext3 == "jpeg" || $headext3 == "gif" || $headext3 == "pjpeg" || $headext3 == "png")
                        $response['data']['image3upload'] = "valid";
                    else {
                        $response["data"]["image3upload"] = "invalid";
                        //echo" ".$response;exit;
                    }
                } else {
                    if ($f != 1) {
                        $response["data"]["image3upload"] = "valid";
                    }
                }
                if ($rolltext3 == "")
                    $response["data"]["image3text"] = "null";
                else
                    $response["data"]["image3text"] = "valid";
                //vimal add
                $headfilecheck4 = basename($image4);
                $headext4 = substr($headfilecheck4, strrpos($headfilecheck4, '.') + 1);
                $headext4 = strtolower($headext4);
                $img4 = $this->_request->getParam("check_image4");
                $f = 0;
                if ($img4 == "") {
                    $f = 1;
                    if ($image4 == "")
                        $response["data"]["image4upload"] = "null";
                    //	elseif($headext1 == "png")$response['data']['headerfile1']="valid";
                    elseif ($headext4 == "jpg" || $headext4 == "jpeg" || $headext4 == "gif" || $headext4 == "pjpeg" || $headext4 == "png")
                        $response['data']['image4upload'] = "valid";
                    else
                        $response["data"]["image3upload"] = "invalid";
                }
                if (($img4 != "" || $img4 != null) && ($image4 != "" || $image4 != null)) {
                    if ($headext4 == "jpg" || $headext4 == "jpeg" || $headext4 == "gif" || $headext4 == "pjpeg" || $headext4 == "png")
                        $response['data']['image4upload'] = "valid";
                    else {
                        $response["data"]["image4upload"] = "invalid";
                        //echo" ".$response;exit;
                    }
                } else {
                    if ($f != 1) {
                        $response["data"]["image4upload"] = "valid";
                    }
                }
                if ($rolltext4 == "")
                    $response["data"]["image4text"] = "null";
                else
                    $response["data"]["image4text"] = "valid";
                $headfilecheck5 = basename($image5);
                $headext5 = substr($headfilecheck5, strrpos($headfilecheck5, '.') + 1);
                $headext5 = strtolower($headext5);
                $img5 = $this->_request->getParam("check_image5");
                $f = 0;
                if ($img5 == "") {
                    $f = 1;
                    if ($image5 == "")
                        $response["data"]["image5upload"] = "null";
                    //	elseif($headext1 == "png")$response['data']['headerfile1']="valid";
                    elseif ($headext5 == "jpg" || $headext5 == "jpeg" || $headext5 == "gif" || $headext5 == "pjpeg" || $headext5 == "png")
                        $response['data']['image5upload'] = "valid";
                    else
                        $response["data"]["image5upload"] = "invalid";
                }
                if (($img5 != "" || $img5 != null) && ($image5 != "" || $image5 != null)) {
                    if ($headext5 == "jpg" || $headext5 == "jpeg" || $headext5 == "gif" || $headext5 == "pjpeg" || $headext5 == "png")
                        $response['data']['image5upload'] = "valid";
                    else {
                        $response["data"]["image5upload"] = "invalid";
                        //echo" ".$response;exit;
                    }
                } else {
                    if ($f != 1) {
                        $response["data"]["image5upload"] = "valid";
                    }
                }
                if ($rolltext5 == "")
                    $response["data"]["image5text"] = "null";
                else
                    $response["data"]["image5text"] = "valid";

                $headfilecheck6 = basename($image6);
                $headext6 = substr($headfilecheck6, strrpos($headfilecheck6, '.') + 1);
                $headext6 = strtolower($headext6);
                $img6 = $this->_request->getParam("check_image6");
                $f = 0;
                if ($img6 == "") {
                    $f = 1;
                    if ($image6 == "")
                        $response["data"]["image6upload"] = "null";
                    //	elseif($headext1 == "png")$response['data']['headerfile1']="valid";
                    elseif ($headext6 == "jpg" || $headext6 == "jpeg" || $headext6 == "gif" || $headext6 == "pjpeg" || $headext6 == "png")
                        $response['data']['image6upload'] = "valid";
                    else
                        $response["data"]["image6upload"] = "invalid";
                }
                if (($img6 != "" || $img6 != null) && ($image6 != "" || $image6 != null)) {
                    if ($headext6 == "jpg" || $headext6 == "jpeg" || $headext6 == "gif" || $headext6 == "pjpeg" || $headext6 == "png")
                        $response['data']['image6upload'] = "valid";
                    else {
                        $response["data"]["image6upload"] = "invalid";
                        //echo" ".$response;exit;
                    }
                } else {
                    if ($f != 1) {
                        $response["data"]["image6upload"] = "valid";
                    }
                }
                //end
                if (!in_array('null', $response['data']) && !in_array('invalid', $response['data']) && !in_array('notmatch', $response['data']) && !in_array('duplicate', $response['data']))
                    $response['returnvalue'] = "success";
                else
                    $response['returnvalue'] = "validation";
                echo json_encode($response);
            }
            else {
                $img_type1 = $_FILES["image1upload"]["type"];
                //echo "<pre>";print_r($_FILES["image1upload"]);
                if ($img_type1 != "" || $img_type1 != null) {
                    $keyilenametemp1 = stripslashes($_FILES["image1upload"]["name"]);                    
                    $extensiontemp1 = $this->findexts($keyilenametemp1);                    
                    $extension1 = strtolower($extensiontemp1);                    
                    $temp1imagename = date("Ymdhis") . time() . rand() . '.' . $extension1;                    
                    $target1 = HOMEBANNERUPLOAD . $temp1imagename;                      
                   if (move_uploaded_file($_FILES["image1upload"]["tmp_name"], $target1)) {                    
                    echo "The file " . basename($_FILES["image1upload"]["name"]) . " has been uploaded";
                    }
                }
                $img_type2 = $_FILES["image2upload"]["type"];
                if ($img_type2 != "" || $img_type2 != null) {                    
                    $keyilenametemp2 = stripslashes($_FILES["image2upload"]["name"]);                    
                    $extensiontemp2 = $this->findexts($keyilenametemp2); 
                    $extension2 = strtolower($extensiontemp2);             
                    $temp2imagename = date("Ymdhis") . time() . rand() . '.' . $extension2;                    
                    $target2 = HOMEBANNERUPLOAD . $temp2imagename;
                     if (move_uploaded_file($_FILES["image2upload"]["tmp_name"], $target2)) {                    
                    echo "The file " . basename($_FILES["image2upload"]["name"]) . " has been uploaded";
                    }
                }
                $img_type3 = $_FILES["image3upload"]["type"];
                if ($img_type3 != "" || $img_type3 != null) {
                    $keyilenametemp3 = stripslashes($_FILES["image3upload"]["name"]);                    
                    $extensiontemp3 = $this->findexts($keyilenametemp3); 
                    $extension3 = strtolower($extensiontemp3);             
                    $temp3imagename = date("Ymdhis") . time() . rand() . '.' . $extension3;                    
                    $target3 = HOMEBANNERUPLOAD . $temp3imagename;
                     if (move_uploaded_file($_FILES["image3upload"]["tmp_name"], $target3)) {                    
                    echo "The file " . basename($_FILES["image3upload"]["name"]) . " has been uploaded";
                    }
                }
                $img_type4 = $_FILES["image4upload"]["type"];
                if ($img_type4 != "" || $img_type4 != null) {                    
                    $keyilenametemp4 = stripslashes($_FILES["image4upload"]["name"]);                    
                    $extensiontemp4 = $this->findexts($keyilenametemp4); 
                    $extension4 = strtolower($extensiontemp4);             
                    $temp4imagename = date("Ymdhis") . time() . rand() . '.' . $extension4;                    
                    $target4 = HOMEBANNERUPLOAD . $temp4imagename;
                     if (move_uploaded_file($_FILES["image4upload"]["tmp_name"], $target4)) {                    
                    echo "The file " . basename($_FILES["image4upload"]["name"]) . " has been uploaded";
                    }
                }
                $img_type5 = $_FILES["image5upload"]["type"];
                if ($img_type5 != "" || $img_type5 != null) {
                    $keyilenametemp5 = stripslashes($_FILES["image5upload"]["name"]);                    
                    $extensiontemp5 = $this->findexts($keyilenametemp5); 
                    $extension5 = strtolower($extensiontemp5);             
                    $temp5imagename = date("Ymdhis") . time() . rand() . '.' . $extension5;                    
                    $target5 = HOMEBANNERUPLOAD . $temp5imagename;
                     if (move_uploaded_file($_FILES["image5upload"]["tmp_name"], $target5)) {                    
                    echo "The file " . basename($_FILES["image5upload"]["name"]) . " has been uploaded";
                    }
                }
                $img_type6 = $_FILES["image6upload"]["type"];
                if ($img_type6 != "" || $img_type6 != null) {
                    $keyilenametemp6 = stripslashes($_FILES["image6upload"]["name"]);                    
                    $extensiontemp6 = $this->findexts($keyilenametemp6); 
                    $extension6 = strtolower($extensiontemp6);             
                    $temp6imagename = date("Ymdhis") . time() . rand() . '.' . $extension6;      
                    $target6 = HOMEBANNERUPLOAD . $temp6imagename;
                     if (move_uploaded_file($_FILES["image6upload"]["tmp_name"], $target6)) {                    
                    echo "The file " . basename($_FILES["image6upload"]["name"]) . " has been uploaded";
                    }
                }
                if (sizeof($homeinfo) > 0) {
                    if ($img_type1 != "" || $img_type1 != null) {
                        $data = array("img_name1" => $temp1imagename);
                        $homeimgObj->update($data, "id='1'");
                    }
                    if ($img_type2 != "" || $img_type2 != null) {
                        $data = array("img_name2" => $temp2imagename);
                        $homeimgObj->update($data, "id='1'");
                    }
                    if ($img_type3 != "" || $img_type3 != null) {
                        $data = array("img_name3" => $temp3imagename);
                        $homeimgObj->update($data, "id='1'");
                    }
                    if ($img_type4 != "" || $img_type4 != null) {
                        $data = array("img_name4" => $temp4imagename);
                        $homeimgObj->update($data, "id='1'");
                    }
                    if ($img_type5 != "" || $img_type5 != null) {
                        $data = array("img_name5" => $temp5imagename);
                        $homeimgObj->update($data, "id='1'");
                    }
                    if ($img_type6 != "" || $img_type6 != null) {
                        $data = array("img_name" => $temp6imagename);
                        $homeimgObj->update($data, "id='1'");
                    }
                    $data = array("roll_over_text1" => $rolltext1, "roll_over_text2" => $rolltext2, "roll_over_text3" => $rolltext3, "roll_over_text4" => $rolltext4, "roll_over_text5" => $rolltext5, "headline_text" => $headline, "sub_headline_text" => $subheadline, "lastupdatedate" => $today);
                    $homeimgObj->update($data, "id='1'");
                    $msg = " Data Updated Successfully";
                    $authUserNamespace->admin_homeimage_msg = $msg;
                    $this->_redirect("/admin/homeimages");
                } else {
                    $data = array("id" => '1',"img_name1" => $temp1imagename, "img_name2" => $temp2imagename, "img_name3" => $temp3imagename, "img_name4" => $temp4imagename,"img_name5" => $temp5imagename, "roll_over_text1" => $rolltext1, "roll_over_text2" => $rolltext2, "roll_over_text3" => $rolltext3, "roll_over_text4" => $rolltext4, "roll_over_text5" => $rolltext5, "headline_text" => $headline, "img_name" => $temp6imagename, "sub_headline_text" => $subheadline, "lastupdatedate" => $today);
                    $homeimgObj->insert($data);
                    $msg = "Data Added Successfully";
                    $authUserNamespace->admin_homeimage_msg = $msg;
                    $this->_redirect("/admin/homeimages");
                }
                //print_r($img_type2);echo "------";print_r($img_content2);exit;
            }
        }
    }

    public function viewimageAction() {
        $authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
        $homeinfoObj = new Chez_Model_DbTable_HomeImages();
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $img_id = $this->_request->getParam("id");
        $image_content = $this->_request->getParam("image_content");
        $view_img = $homeinfoObj->fetchRow("id='$img_id'");
        header('Content-Type: image/jpeg');
        print $view_img[$image_content];
    }

    public function inspirationAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        //$headlinesObj = new Chez_Model_DbTable_Headlines();
    }

    public function fashionfriendsAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        //$headlinesObj = new Chez_Model_DbTable_Headlines();
    }

    public function headlinesAction() {
        //$this->_helper->layout()->disableLayout();
        //$this->_helper->viewRenderer->setNoRender(true);
        //$headlinesObj = new Chez_Model_DbTable_Headlines();
        //$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
        $pageName = $this->_request->getParam("name");
        $pageId = $this->_request->getParam("id");
        echo $pageName;
        echo $pageId;
    }

    public function logoutAction() {
        $authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        Zend_Session::destroy(true, true);
        //$this->_redirect('/admin');
        $this->_redirect('/admin?msg=logout');
    }

    public function changepasswordAction() {
        $authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
        $authUserNamespace->admin_page_title = "Change Password";
        if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "")
            $this->_redirect("/admin");
        if ($this->_request->isPost()) {
            $passwordObj = new Chez_Model_DbTable_User();
            $user_id = $authUserNamespace->userid;
            $current_password = $this->_request->getParam('CurrentPassword');
            $new_password = $this->_request->getParam('NewPassword');
            $confirm_password = $this->_request->getParam('ConfirmPassword');
            $response = array();
            if ($this->_request->isXmlHttpRequest()) {
                $this->_helper->layout()->disableLayout();
                $this->_helper->viewRenderer->setNoRender(true);
                $password_row = $passwordObj->fetchRow("password='$current_password' and user_id='$user_id'");
                if ($current_password == "")
                    $response["data"]["CurrentPassword"] = "null";
                elseif (!sizeof($password_row) > 0)
                    $response["data"]["CurrentPassword"] = "invalid";
                else
                    $response["data"]["CurrentPassword"] = "valid";
                if ($new_password == "")
                    $response["data"]["NewPassword"] = "null";
                else
                    $response["data"]["NewPassword"] = "valid";
                if ($confirm_password == "")
                    $response["data"]["ConfirmPassword"] = "null";
                elseif ($confirm_password != $new_password)
                    $response["data"]["ConfirmPassword"] = "notmatch";
                else
                    $response["data"]["ConfirmPassword"] = "valid";
                if (!in_array('null', $response['data']) && !in_array('invalid', $response['data']) && !in_array('notmatch', $response['data']) && !in_array('duplicate', $response['data']))
                    $response['returnvalue'] = "success";
                else
                    $response['returnvalue'] = "validation";
                echo json_encode($response);
            }else {
                $data['password'] = $new_password;
                $passwordObj->update($data, "user_id='$user_id'");
                $authUserNamespace->status_message_change_password = "Password Updated Successfully.";
                $this->_redirect("/admin/changepassword");
            }
        }
    }

    public function deleteheadlinesinfoAction() {
        $authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
        if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "")
            $this->_redirect("/admin");
        $headlineinfoObj = new Chez_Model_DbTable_Headlines();
        $homeimageobj = new Chez_Model_DbTable_HomeImages();
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);        
        $pageName = $this->_request->getParam("name");
        $imgid = $this->_request->getParam("imgid");        
        if ($imgid == 1) {                      
            $data1 = array(img_name1 => "");
        } elseif ($imgid == 2) {            
            $data1 = array(img_name2 => "");
        } elseif ($imgid == 3) {            
            $data1 = array(img_name3  => "");
        } elseif ($imgid == 4) {
            $data1 = array(img_name4  => "");
        } elseif ($imgid == 5) {            
            $data1 = array(img_name5  => "");
        } elseif ($imgid == 6) {            
            $data1 = array(img_name  => "");
        }
        $homeimageobj->update($data1, "id = 1");
        $authUserNamespace->status_message_manage_headline = "Data Deleted Successfully.";
        $this->_redirect('/admin/homeimages/');
    }
private function findexts($keyilename) {
        $keyilename = strtolower($keyilename);
        $exts = @split("[/\\.]", $keyilename);
        $n = count($exts) - 1;
        $exts = $exts[$n];
        return $exts;
    }
}
