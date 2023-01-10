<?php
class DesignstudioController extends Zend_Controller_Action {
	public function init() {
		// $this->_helper->layout()->setLayout("mainlayout_2left");
		$this->_helper->layout()->setLayout("mainlayout");
	}

	public function indexAction() {
		$result = new stdClass(); //create a new
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$authUserNamespace->searchText = "";
		$result->userid = 0;

		if (isset($authUserNamespace->userid) && $authUserNamespace->userid != ""):
			$result->userid = $authUserNamespace->userid;
		endif;

		if (isset($authUserNamespace->ds_image_pre_id) && $authUserNamespace->ds_image_pre_id != ""):
			$this->view->image_pre_id = $authUserNamespace->ds_image_pre_id;
		else:
			$authUserNamespace->ds_image_pre_id = time();
			$this->view->image_pre_id = $authUserNamespace->ds_image_pre_id;
		endif;

		$authUserNamespace->selectmenu = "designstudio";

		$cartvalue = $this->_request->getParam("cart");
		if (isset($cartvalue) && $cartvalue != "") {
			$this->view->cartval = $cartvalue;
			$this->_helper->layout()->setLayout("mainlayoutcart");
		}

		$bodyTypeObj = new Chez_Model_DbTable_BodyType();
		$garmentsObj = new Chez_Model_DbTable_GarmentType();
		$skincolorObj = new Chez_Model_DbTable_Skincolor();
		$usermodelObj = new Chez_Model_DbTable_UserModel();
		$colorObj = new Chez_Model_DbTable_Color();
		$OccasionCategoryObj = new Chez_Model_DbTable_OccasionCategory();
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$fashionwallimgObj = new Chez_Model_DbTable_Fashionwall();
		$istempsave = 0;
		if (!empty($this->_request->getParam("share"))) {
			$issharemode = 1;
			$modelObj = new Chez_Model_DbTable_DsModelShare();
		} else {
			$modelObj = new Chez_Model_DbTable_DsModel();
		}
		//$bodytype = $bodyTypeObj->fetchAll();
		$bodytype = $bodyTypeObj->getBodyTypeList();
		$garments = $garmentsObj->fetchAll();
		$adviceObj = new Chez_Model_DbTable_Advice();
		$occasionObj = new Chez_Model_DbTable_OccasionImages();
		$adviceRow = $adviceObj->fetchRow($adviceObj->select()
				->setIntegrityCheck(false)
				->from(array('c' => DATABASE_PREFIX . "advice"))
				->order("c.lastupdatedate desc")
				->limit(1));
		$temp = $adviceRow->id + 1;
		$this->view->id = $temp;
		$occasion_rows = $occasionObj->fetchAll($occasionObj->select()
				->setIntegrityCheck(false)
				->from(array('oc' => DATABASE_PREFIX . "occasion_images"))
				->joinLeft(array('lv' => DATABASE_PREFIX . "lov"), 'oc.occasion_id=lv.id', array('value')));

		if (isset($authUserNamespace->userid) && $authUserNamespace->userid != "") {
			$modelrows = $usermodelObj->userModelDetails($authUserNamespace->userid);
			$this->view->skin_color_id = $modelrows->skin_color;
			$this->view->skin_color_code = $modelrows->code;
			$this->view->usermodelcolor = $modelrows->skin_color . "-" . $modelrows->code;
			$this->view->body_type = $modelrows->chez_bodytype_id;
			$this->view->frontbodyimage = $modelrows->front_image_name;
			$this->view->backbodyimage = $modelrows->back_image_name;
			$this->view->backbodyimage = $modelrows->back_image_name;

		} else {
			$modelrows = $usermodelObj->defaultUserModel();
			if (sizeof($modelrows) > 0) {
				// select second color
				$colorsini = $skincolorObj->fetchRow("id=2");
				if (sizeof($colorsini) > 0) {
					$this->view->skin_color_id = $colorsini->id;
					$this->view->skin_color_code = $colorsini->code;
					$this->view->usermodelcolor = $colorsini->id . "-" . $colorsini->code;
				}
				$this->view->body_type = $modelrows->id;
				$this->view->frontbodyimage = $modelrows->front_image_name; // 'mannequin-face.png';
				$this->view->backbodyimage = $modelrows->back_image_name;
			}
		}

		// update mannequin image if garment type is assigned a mannequin (for example Mask) assigned in 'chez_garment_type' table.
		$garmentTypeId = $this->_getParam('garmenttype', '0');
		if ($garmentTypeId != '0') {
			$garment = $garmentsObj->fetchRow($garmentsObj->select()
					->setIntegrityCheck(false)
					->from(array('gt' => DATABASE_PREFIX . "garment_type"))
					->joinLeft(array('m' => DATABASE_PREFIX . "mannequin"), 'gt.mannequin_id=m.id', array('front_image_name', 'back_image_name'))
					->where('gt.id=' . $garmentTypeId)); //prd($garment);
			if ($garment->front_image_name != '') {
				$this->view->frontbodyimage = $garment->front_image_name; //prd($this->view->frontbodyimage);  // 'mannequin-face.png';
			}
			if ($garment->back_image_name != '') {
				$this->view->backbodyimage = $garment->back_image_name;
			}
		}
		$actions = '';
		if (!empty($this->_getParam('actions'))) {
			$actions = $this->_getParam('actions');
		}
		$modelId = $this->_getParam('modelid', '0');
		if ($modelId != '0') {
			if ($issharemode == 1) {
				$model = $modelObj->fetchRow($modelObj->select()
						->setIntegrityCheck(false)
						->from(array('dm' => DATABASE_PREFIX . "ds_model_share"))
						->joinLeft(array('gt' => DATABASE_PREFIX . "garment_type"), 'dm.category_id=gt.id', array('mannequin_id'))
						->joinLeft(array('m' => DATABASE_PREFIX . "mannequin"), 'gt.mannequin_id=m.id', array('front_image_name', 'back_image_name'))
						->where('dm.id=' . $modelId));
			} else {
				$model = $modelObj->fetchRow($modelObj->select()
						->setIntegrityCheck(false)
						->from(array('dm' => DATABASE_PREFIX . "ds_model"))
						->joinLeft(array('gt' => DATABASE_PREFIX . "garment_type"), 'dm.category_id=gt.id', array('mannequin_id'))
						->joinLeft(array('m' => DATABASE_PREFIX . "mannequin"), 'gt.mannequin_id=m.id', array('front_image_name', 'back_image_name'))
						->where('dm.id=' . $modelId));
			}
			//prd($model);
			if ($model->front_image_name != '') {
				$this->view->frontbodyimage = $model->front_image_name; //prd($this->view->frontbodyimage);  // 'mannequin-face.png';
			}
			if ($model->back_image_name != '') {
				$this->view->backbodyimage = $model->back_image_name;
			}
		}
		//$this->view->frontbodyimage =  '20201021050749160328026931038.mannequin-face.png';

		$actions = $this->_request->getParam("actions");
		$modelid = $this->_request->getParam("modelid");
		$issavereload = $this->_request->getParam("issavereload");

		$this->view->issavereload = $issavereload;

		$result->inspactions = $actions;

		if ($modelid):
			$inspAllrow = $modelObj->getModelDress($modelid);
			$result->dress = $inspAllrow;
		endif;

		$zoom = '';
		$drag = '';
		if (isset($inspAllrow) && sizeof($inspAllrow) > 0) {
			$adviceObj = new Chez_Model_DbTable_Advice();
			$result->adminquestion = $adviceObj->getAdminAdviceQustion($modelid, $issharemode == 1 ? 'share' : '');
			$zoom = $inspAllrow->zoom;
			$drag = $inspAllrow->drag;
			if ($inspAllrow->top_front_color_id > 0) {
				$colors = $colorObj->getModelColor($inspAllrow->top_front_color_id);
				$this->view->insptfco = $colors->id . "-" . $colors->code . "-" . $colors->name;
				$this->view->insptbco = $colors->id . "-" . $colors->code . "-" . $colors->name;
			} else {
				$printObj = new Chez_Model_DbTable_Print();
				$prints = $printObj->getModelPrints($inspAllrow->top_print_id);

				if ($prints->top_print_image != ''):
					$top_print = $prints->top_print_image;
				else:
					$top_print = $prints->user_print_image;
				endif;
				if ($prints->allover_top_print_image != ''):
					$allover_top_print = $prints->allover_top_print_image;
				else:
					$allover_top_print = $prints->user_print_image;
				endif;
				if ($prints->allover_bottom_print_image != ''):
					$allover_bottom_print = $prints->allover_bottom_print_image;
				else:
					$allover_bottom_print = $prints->user_print_image;
				endif;
				if ($inspAllrow->top_print_id === $inspAllrow->bottom_print_id):
					$this->view->instopprintid = $prints->print_id . "-" . $prints->print_name . "-" . $allover_top_print;
					$this->view->insbottomprintid = $prints->print_id . "-" . $prints->print_name . "-" . $allover_bottom_print;
				else:
					$this->view->instopprintid = $prints->print_id . "-" . $prints->print_name . "-" . $top_print;
				endif;
			}

			if ($inspAllrow->bottom_front_color_id > 0) {
				$colors = $colorObj->getModelColor($inspAllrow->bottom_front_color_id);
				$this->view->inspbfco = $colors->id . "-" . $colors->code . "-" . $colors->name;
				$this->view->inspbbco = $colors->id . "-" . $colors->code . "-" . $colors->name;
			} else {
				if ($inspAllrow->top_print_id !== $inspAllrow->bottom_print_id):
					$printObj = new Chez_Model_DbTable_Print();
					$bprints = $printObj->getModelPrints($inspAllrow->bottom_print_id);

					if ($bprints->bottom_print_image != ''):
						$image = $bprints->bottom_print_image;
					else:
						$image = $bprints->user_print_image;
					endif;
					$this->view->insbottomprintid = $bprints->print_id . "-" . $bprints->print_name . "-" . $image;
				endif;
			}

			if ($inspAllrow->left_sleeve_color_id > 0) {
				//------ both sleeves color are same---------//
				$colors = $colorObj->getModelColor($inspAllrow->left_sleeve_color_id);
				$this->view->insplsco = $colors->id . "-" . $colors->code . "-" . $colors->name;
				$this->view->insplbacksco = $colors->id . "-" . $colors->code . "-" . $colors->name;
			}

			if ($inspAllrow->right_sleeve_color_id > 0) {
				$colors = $colorObj->getModelColor($inspAllrow->right_sleeve_color_id);
				//------ both sleeves color are same---------//
				$this->view->insprsco = $colors->id . "-" . $colors->code . "-" . $colors->name;
				$this->view->insprbacksco = $colors->id . "-" . $colors->code . "-" . $colors->name;
			}

			$modelrow = $usermodelObj->fetchRow("chez_user_id='$authUserNamespace->userid'");
			if (sizeof($modelrow) > 0) {
				$inspskncolor = $modelrow->skin_color;
				if (sizeof($inspskncolor) > 0 && $inspskncolor != 0) {
					$colors = $skincolorObj->fetchRow("id='$inspskncolor'");
					$this->view->inspskincolor = $colors->id . "-" . $colors->code;
				}
			} else {
				$inspskncolor = $inspAllrow->skin_color;
				if (sizeof($inspskncolor) > 0 && $inspskncolor != 0) {
					$colors = $skincolorObj->fetchRow("id='$inspskncolor'");
					$this->view->inspskincolor = $colors->id . "-" . $colors->code;
				}
			}
			if (sizeof($modelrow) > 0) {
				$this->view->inspbodytypeid = $modelrow->chez_bodytype_id;
			} else {
				$this->view->inspbodytypeid = $inspAllrow->body_type_id;
			}
		}
		$this->view->zoom = $zoom;
		$this->view->drag = $drag;
		unset($authUserNamespace->modelinstIDid);
		$this->view->occasions = $occasion_rows; //prd($occasion_rows);
		$this->view->bodytype = $bodytype; //prd($bodytype);
		$this->view->garments = $garments; //prd($garments);
		if ($actions == "model"):
			$skincolor = $skincolorObj->fetchAll();
			$result->skincolor = $skincolor;
		endif;
		$this->view->dstudio = $result;
		$this->view->size_html = $this->view->Common()->sizeHtml();

		//$img2 = $modelId . '.png';
		$img2 = time() . str_pad($modelId, 5, 0, STR_PAD_LEFT) . '.png';

		if (file_exists('/uploads/fbshare/' . $img2)) {
			$frontIMG = APPLICATION_URL . 'uploads/fbshare/' . $img2;
		} else {

			$frontmainIMG = $this->view->Common()->getDressImageByDressId($modelId, 'front', 'front', 'image/png', $issharemode);
			$arr = explode("/", $frontmainIMG);
			$img = array_pop($arr);
			$src = PROJECT_ROOT_PATH . '/uploads/dresses/' . $img;
			$dest = PROJECT_ROOT_PATH . '/uploads/fbshare/' . $img2;
			$newWidth = 704;
			$newHeight = 1056;
			$newImg = $this->view->Common()->ansResizeImg($src, $dest, $newWidth, $newHeight);
			$frontIMG = APPLICATION_URL . 'uploads/fbshare/' . $img2;

		}
		$this->view->ogimg = $frontIMG;
		$this->view->issharemode = $issharemode;
		$this->view->actions = $actions;
		//prd($this->view);
		//$this->view->inspallrow = $inspAllrow;
	}
	public function getmannequinAction() {
		$this->_helper->layout->disableLayout();
		$garmentsObj = new Chez_Model_DbTable_GarmentType();

		$gid = $this->_getParam('gid', '0');

		if ($gid != '0') {
			$garment = $garmentsObj->fetchRow($garmentsObj->select()
					->setIntegrityCheck(false)
					->from(array('gt' => DATABASE_PREFIX . "garment_type"))
					->joinLeft(array('m' => DATABASE_PREFIX . "mannequin"), 'gt.mannequin_id=m.id', array('front_image_name', 'back_image_name'))
					->where('gt.id=' . $gid)); //prd($garment);

			/*if($garment->front_image_name!='')
							{
								$this->view->frontbodyimage =  $garment->front_image_name; //prd($this->view->frontbodyimage);  // 'mannequin-face.png';
				            }
							if($garment->back_image_name!='')
							{
								$this->view->backbodyimage = $garment->back_image_name;
			*/

			$arr = ['frontImg' => $garment->front_image_name, 'backImg' => $garment->back_image_name];
			$json = json_encode($arr);
			echo 'SUCCESS||' . $json;
			exit;
		}
	}

	public function getwithoutassociateimageAction() {
		$dressObj = new Chez_Model_DbTable_Dress();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$mainid = $this->_request->getParam("mainid");
				$modelid = $this->_request->getParam("modelid");
				$type = $this->_request->getParam("type");
				$dressRowall = $dressObj->fetchRow($dressObj->select()
						->setIntegrityCheck(false)
						->from(array('v' => DATABASE_PREFIX . "ds_dress"))
						->where("id='$mainid'"));
			}
		}

		if (sizeof($dressRowall) > 0) {
			$topfront = $dressRowall->top_front_id;
			$topback = $dressRowall->top_back_id;
			$bottomfront = $dressRowall->bottom_front_id;
			$bottomback = $dressRowall->bottom_back_id;
			$leftsleeve = $dressRowall->left_sleeve_front_id;
			$leftbacksleeve = $dressRowall->left_sleeve_back_id;
			$rightsleeve = $dressRowall->right_sleeve_front_id;
			$rightbacksleeve = $dressRowall->right_sleeve_back_id;

			switch ($type):
		case "topFrnt":
			$html = $this->gettopfrontHtml($topfront, $modeldata->top_front_id);
			break;
		case "botfrnt":
			$html .= $this->getbottomfrontHtml($bottomfront, $modeldata->bottom_front_id);
			break;
		case "topback":
			$html .= $this->gettopbackHtml($topback, $modeldata->top_back_id);
			break;
		case "botback":
			$html .= $this->getbottombackHtml($bottomback, $modeldata->bottom_back_id);
			break;
		default:
			$html = '';
			break;
			endswitch;
		}
		echo json_encode($html);
		exit;
	}

	public function getsleevesimageAction() {
		$dressObj = new Chez_Model_DbTable_DressPiece();
		$response = array();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$garmentid = $this->_request->getParam("garmentid");
				$occaionid = $this->_request->getParam("occaionid");
				$bodytypeid = $this->_request->getParam("bodytypeid");
				$paired_id = $this->_request->getParam("pairedid");
				$type = $this->_request->getParam("type");
				switch ($type):
			case "leftfrontsleeve":
				$dresspiece_id = 8; //for left front sleeves
				break;
			case "leftbacksleeve":
				$dresspiece_id = 9; //for left back sleeves
				break;
			case "rightfrontsleeve":
				$dresspiece_id = 10; //for right front sleeves
				break;
			case "rightbacksleeve":
				$dresspiece_id = 11; //for right back sleeves
				break;
			default:
				$dresspiece_id = 0;
				break;
				endswitch;
				$dressSelect = $dressObj->select()
					->setIntegrityCheck(false)
					->from(array('v' => DATABASE_PREFIX . "dresspiece"), array("id", "dresspiece_id", "image_name"))
					->where("garment_type_id='$garmentid' AND occasion_id LIKE '%$occaionid%' AND body_type_id='$bodytypeid'");

				if ($paired_id > 0):
					$dressSelect->where("paired_id='$paired_id'");
					$dressrel = $dressObj->fetchAll($dressSelect);
					if (count($dressrel) > 0):
						foreach ($dressrel as $dress):
							if ($dress->dresspiece_id == 8):
								$key = 'leftfrontsleeve';
							endif;
							if ($dress->dresspiece_id == 9):
								$key = 'leftbacksleeve';
							endif;
							if ($dress->dresspiece_id == 10):
								$key = 'rightfrontsleeve';
							endif;
							if ($dress->dresspiece_id == 11):
								$key = 'rightbacksleeve';
							endif;
							$response[$key]['id'] = $dress->id;
							$response[$key]['image'] = $dress->image_name;
						endforeach;
					endif;
				else:
					$dressSelect->where("dresspiece_id ='$dresspiece_id'");
					$dressSelect->where("paired_id='$paired_id'");
					$dressrel = $dressObj->fetchRow($dressSelect);
					if (count($dressrel) > 0):
						$response['id'] = $dressrel->id;
						$response['image'] = $dressrel->image_name;
					endif;
				endif;
			}
		}
		echo json_encode($response);
		exit;
	}

	public function getsleevesnameAction($id) {
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$params = $this->_request->getParams();
		$image = array();
		foreach ($params as $key => $id):
			if ($key != "controller" && $key != "action" && $key != "module"):
				$imageobj = $dresspieceObj->fetchRow($dresspieceObj->select()
						->setIntegrityCheck(false)
						->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('image_type', 'image_name'))
						->where('id = ?', $id));
			endif;
			if (count($imageobj)):
				$image[$key] = $imageobj->image_name;
			endif;
		endforeach;
		echo json_encode($image);
		exit;
	}

	public function getfabricnoteAction() {
		$dressObj = new Chez_Model_DbTable_Dress();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$dressstyleid = $this->_request->getParam("dressstyleid");
				$fabrictext = $dressObj->fetchRow($dressObj->select()
						->setIntegrityCheck(false)
						->from(array('v' => DATABASE_PREFIX . "ds_dress"), array('dress_text'))
						->where("id='$dressstyleid'"));
			}
		}
		$response = array();
		$response["dress_fabric"] = $fabrictext->dress_text;
		echo json_encode($response);
		exit;
	}

	public function getdress_oldAction() // 29.01.2021
	{
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		/*
			        if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "")
			            $this->_redirect("/login");
		*/

		$dressObj = new Chez_Model_DbTable_Dress();
		$modelObj = new Chez_Model_DbTable_DsModel();
		$garmentsObj = new Chez_Model_DbTable_GarmentType();

		$color_palette_id = '';
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$mainid = $this->_request->getParam("mainid");
				//$modelid = $this->_request->getParam("modelid");
				$modelid = $this->_getParam('modelid', 0);
				//$garmentid = $this->_request->getParam("garmentid");
				$garmentid = $this->_getParam('garmentid', 0);
				$occasionid = $this->_request->getParam("occasionid");
				$bodytypeid = $this->_request->getParam("bodytype");
				if ((!isset($authUserNamespace->userid) || $authUserNamespace->userrole != 'admin') && $modelid == '') {
					$where = "id='$mainid' AND visible_to = 1 ";
				} else {
					$where = "id='$mainid'";
				}
				$dressRowall = $dressObj->fetchRow($dressObj->select()
						->setIntegrityCheck(false)
						->from(array('v' => DATABASE_PREFIX . "ds_dress"))
						->where($where));

				if (sizeof($dressRowall) > 0) {
					//prd('$modelid:'.$modelid);
					$label_back_btn = 'Back';
					$htmlBtn = '<button id ="openFront" onClick="openTab(\'Front\');" class="des_activebtn">front</button>
					<button id = "openBack" onClick="openTab(\'Back\');">' . $label_back_btn . '</button>
					<button id = "openSleeve" onClick="openTab(\'Sleeve\');">sleeve</button>';

					if ($modelid != '0') {
						$model = $modelObj->fetchRow($modelObj->select()
								->setIntegrityCheck(false)
								->from(array('dm' => DATABASE_PREFIX . "ds_model"))
								->joinLeft(array('gt' => DATABASE_PREFIX . "garment_type"), 'dm.category_id=gt.id', array('mannequin_id'))
								->where('dm.id=' . $modelid)); //prd($garment);

						if ($model->mannequin_id != NULL) {
							$label_back_btn = 'Side';
							$htmlBtn = '<button id ="openFront" onClick="openTab(\'Front\');" class="des_activebtn">front</button>
								<button id = "openBack" onClick="openTab(\'Back\');">' . $label_back_btn . '</button>';
						}
					}
					if ($garmentid != '0') {
						$garment = $garmentsObj->fetchRow($garmentsObj->select()
								->setIntegrityCheck(false)
								->from(array('gt' => DATABASE_PREFIX . "garment_type"))
								->joinLeft(array('m' => DATABASE_PREFIX . "mannequin"), 'gt.mannequin_id=m.id', array('front_image_name', 'back_image_name'))
								->where('gt.id=' . $garmentid)); //prd($garment);

						if ($garment->mannequin_id != NULL) {
							$label_back_btn = 'Side';
							$htmlBtn = '<button id ="openFront" onClick="openTab(\'Front\');" class="des_activebtn">front</button>
								<button id = "openBack" onClick="openTab(\'Back\');">' . $label_back_btn . '</button>';
						}
					}

					$topfront = $dressRowall->top_front_id;
					$topback = $dressRowall->top_back_id;
					$bottomfront = $dressRowall->bottom_front_id;
					$bottomback = $dressRowall->bottom_back_id;
					$leftsleeve = $dressRowall->left_sleeve_front_id;
					$leftbacksleeve = $dressRowall->left_sleeve_back_id;
					$rightsleeve = $dressRowall->right_sleeve_front_id;
					$rightbacksleeve = $dressRowall->right_sleeve_back_id;
					$topfront_order = $dressRowall->topfront_order;
					$topback_order = $dressRowall->topback_order;
					$bottomfront_order = $dressRowall->frontbottom_order;
					$bottomback_order = $dressRowall->backbottom_order;
					$leftsleeve_order = $dressRowall->leftfrontsleeve_order;
					$rightsleeve_order = $dressRowall->rightfrontsleeve_order;

					if ($modelid):
						$modeldata = $modelObj->fetchRow("id='$modelid'");
						$color_palette_id = $modeldata->color_palette_id;
					endif;
					$html = '';
					$html .= '<div class="active">';
					$html .= '<div id="customization" class="ds_content dotted-bdr-top mt-0 clearfix mob-mTB0">';
					$html .= '<div class="cntrlHolder" id="before">';
					$html .= '<div class="cntrlHolderrowtop" id="chrt">';
					/*$html .= '<button id ="openFront" onClick="openTab(\'Front\');" class="des_activebtn">front '.$modelid.'</button>';
						                    $html .= '<button id = "openBack" onClick="openTab(\'Back\');">'.$label_back_btn .'</button>';
					*/
					$html .= $htmlBtn;
					$html .= '</div>';
					$html .= '<div class="cntrlHolderrowmid" id="chrm">';
					$html .= '<div class="hoderinline" id="mymodel2">';

					// Silhouette starts
					//-------------Start: Top Front Html -------------//
					$html .= '<div class="clearfix"></div><div class="holderbox" id="frontside">'; //front main div.
					$html .= $this->gettopfrontHtml($topfront, $modelid, $bodytypeid, $topfront_order);
					if (isset($topfront) && $topfront != null && !isset($bottomfront) && $bottomfront == null) {
						$html .= $this->getdisptogetherbottomfrontHtml($garmentid, $occasionid, $bodytypeid, $modelid);
					}
					//-------------End: Top Front Html -------------//
					//-------------Start: Bottom Front Html -------------//
					$html .= $this->getbottomfrontHtml($bottomfront, $modelid, $bodytypeid, $bottomfront_order);
					if (isset($bottomfront) && $bottomfront != null && !isset($topfront) && $topfront == null) {
						$html .= $this->getdisptogethertopfrontHtml($garmentid, $occasionid, $bodytypeid, $modelid);
					}
					$html .= '</div>'; //front main div
					$html .= '<div class="clear:both"></div>';
					//-------------End: Bottom Front Html -------------//
					//-------------Start: Top Back Html -------------//
					$html .= '<div class="clearfix"></div><div class="holderbox none" id="backside">'; //start main div.
					$html .= $this->gettopbackHtml($topback, $modelid, $bodytypeid, $topback_order);
					if (isset($topback) && $topback != null && !isset($bottomback) && $bottomback == null) {
						$html .= $this->getdisptogetherbottombackHtml($garmentid, $occasionid, $bodytypeid, $modelid);
					}
					//-------------End: Top Back Html -------------//
					//-------------Start: Bottom Back Html -------------//
					$html .= $this->getbottombackHtml($bottomback, $modelid, $bodytypeid, $bottomback_order);
					if (isset($bottomback) && $bottomback != null && !isset($topback) && $topback == null) {
						$html .= $this->getdisptogethertopbackHtml($garmentid, $occasionid, $bodytypeid, $modelid);
					}
					$html .= '</div>'; //close main div.
					$html .= '<div class="clear:both"></div>';
					//-------------End: Bottom Back Html -------------//
					//-------------Start: Left Sleeves Html -------------//
					$html .= '<div class="clearfix"></div><div class="holderbox mytopF none" id="sleeve">'; //start main div.
					$html .= '<div id="rightsleevecontainer">';
					$html .= $this->getrightsleeveHtml($rightsleeve, $modelid, $bodytypeid, $leftsleeve, $occasionid, $rightsleeve_order, $leftsleeve_order);
					$html .= '</div>'; //close rightsleevecontainer div.
					$html .= '</div>'; //close main sleeve div.
					//-------------End: Right Sleeves Html -------------//

					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '<style>
                    @media screen and (max-width: 767px){
                        #header{
                            display: none;
                        }
                        #header.active{
                            display: block;
                        }
                        #headercontroller{
                            display: block;
                            position: fixed;
                            left: 0px;
                            top: 0;
                            z-index: 1;
                        }
                        #headercontroller span{
                            display: block;
                            width: 35px;
                            height: 30px;
                            background: transparent url("https://modamia.com/images/caret-down.svg") no-repeat center center;
                        }
                        #headercontroller.active{
                            top: 25px;
                            transform: rotate(180deg);
                        }
                        #designstudiostylemanique {
                            padding-top: 5px;
                        }
                    }
                    </style>
                    <script>
                        $( document ).ready(function() {
                            $("#headercontroller").on("click", function(){
                                $("#headercontroller").toggleClass("active");
                                $("#header").toggleClass("active");
                            });
                        });
                    </script>
                    ';

					///$html .= $this->getdisplaytogetherhtml($garmentid, $occasionid, $bodytypeid);
					// Color starts
					$colors = $this->getcolorshtml($dressRowall->color_palette_id, $dressRowall->color_palette_order, $color_palette_id, $dressRowall->color_palette_spec);
					if (count($colors)):
						$html .= $colors['html'];
					endif;
					// Color ends
					// Print starts
					$html .= $this->getprintshtml($dressRowall->print_palette_id, $dressRowall->print_palette_spec);
					// Print ends

					//-----------Start:Main Html for Silhouette------------//
				} else {
					if ($modelid):
						$modeldata = $modelObj->fetchRow("id='$modelid'");
						$color_palette_id = $modeldata->color_palette_id;
						$dressRowall = $dressObj->fetchRow($dressObj->select()
								->setIntegrityCheck(false)
								->from(array('v' => DATABASE_PREFIX . "ds_dress"), array('color_palette_id', 'color_palette_order', 'print_palette_id'))
								->where("id='$mainid'"));
						$html .= $this->getcolorshtml($dressRowall->color_palette_id, $dressRowall->color_palette_order, $color_palette_id, $dressRowall->color_palette_spec);
						$html .= $this->getprintshtml($dressRowall->print_palette_id, $dressRowall->print_palette_spec);
					endif;
				}
			}
		}
		$response = array('html' => $html, 'palette' => $colors['palette']);
		echo json_encode($response);
		exit;
	}
	public function getdressAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		/*
			        if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "")
			            $this->_redirect("/login");
		*/

		$dressObj = new Chez_Model_DbTable_Dress();
		if (!empty($this->_request->getParam("issharemode"))) {
			$issharemode = 1;
			$modelObj = new Chez_Model_DbTable_DsModelShare();
		} else {
			$issharemode = 0;
			$modelObj = new Chez_Model_DbTable_DsModel();
		}
		$garmentsObj = new Chez_Model_DbTable_GarmentType();

		$color_palette_id = '';
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$mainid = $this->_request->getParam("mainid");
				//$modelid = $this->_request->getParam("modelid");
				$modelid = $this->_getParam('modelid', 0);
				//$garmentid = $this->_request->getParam("garmentid");
				$garmentid = $this->_getParam('garmentid', 0);
				$occasionid = $this->_request->getParam("occasionid");
				$bodytypeid = $this->_request->getParam("bodytype");
				if ((!isset($authUserNamespace->userid) || $authUserNamespace->userrole != 'admin') && $modelid == '') {
					$where = "id='$mainid' AND visible_to = 1 ";
				} else {
					$where = "id='$mainid'";
				}
				$dressRowall = $dressObj->fetchRow($dressObj->select()
						->setIntegrityCheck(false)
						->from(array('v' => DATABASE_PREFIX . "ds_dress"))
						->where($where));

				if (sizeof($dressRowall) > 0) {
					//prd('$modelid:'.$modelid);
					$label_back_btn = 'Back';
					$htmlBtn = '<button id ="openFront" onClick="openTab(\'Front\');" class="des_activebtn">front</button>
					<button id = "openBack" onClick="openTab(\'Back\');">' . $label_back_btn . '</button>
					<button id = "openSleeve" onClick="openTab(\'Sleeve\');">sleeve</button>';

					if ($modelid != '0') {
						if ($issharemode == 1) {
							$model = $modelObj->fetchRow($modelObj->select()
									->setIntegrityCheck(false)
									->from(array('dm' => DATABASE_PREFIX . "ds_model_share"))
									->joinLeft(array('gt' => DATABASE_PREFIX . "garment_type"), 'dm.category_id=gt.id', array('mannequin_id'))
									->where('dm.id=' . $modelid)); //prd($garment);
						} else {
							$model = $modelObj->fetchRow($modelObj->select()
									->setIntegrityCheck(false)
									->from(array('dm' => DATABASE_PREFIX . "ds_model"))
									->joinLeft(array('gt' => DATABASE_PREFIX . "garment_type"), 'dm.category_id=gt.id', array('mannequin_id'))
									->where('dm.id=' . $modelid)); //prd($garment);
						}

						if ($model->mannequin_id != NULL) {
							$label_back_btn = 'Side';
							$htmlBtn = '<button id ="openFront" onClick="openTab(\'Front\');" class="des_activebtn">front</button>
								<button id = "openBack" onClick="openTab(\'Back\');">' . $label_back_btn . '</button>';
						}
					}
					if ($garmentid != '0') {
						$garment = $garmentsObj->fetchRow($garmentsObj->select()
								->setIntegrityCheck(false)
								->from(array('gt' => DATABASE_PREFIX . "garment_type"))
								->joinLeft(array('m' => DATABASE_PREFIX . "mannequin"), 'gt.mannequin_id=m.id', array('front_image_name', 'back_image_name'))
								->where('gt.id=' . $garmentid)); //prd($garment);

						if ($garment->mannequin_id != NULL) {
							$label_back_btn = 'Side';
							$htmlBtn = '<button id ="openFront" onClick="openTab(\'Front\');" class="des_activebtn">front</button>
								<button id = "openBack" onClick="openTab(\'Back\');">' . $label_back_btn . '</button>';
						}
					}

					$topfront = $dressRowall->top_front_id;
					$topback = $dressRowall->top_back_id;
					$bottomfront = $dressRowall->bottom_front_id;
					$bottomback = $dressRowall->bottom_back_id;
					$leftsleeve = $dressRowall->left_sleeve_front_id;
					$leftbacksleeve = $dressRowall->left_sleeve_back_id;
					$rightsleeve = $dressRowall->right_sleeve_front_id;
					$rightbacksleeve = $dressRowall->right_sleeve_back_id;
					$topfront_order = $dressRowall->topfront_order;
					$topback_order = $dressRowall->topback_order;
					$bottomfront_order = $dressRowall->frontbottom_order;
					$bottomback_order = $dressRowall->backbottom_order;
					$leftsleeve_order = $dressRowall->leftfrontsleeve_order;
					$rightsleeve_order = $dressRowall->rightfrontsleeve_order;

					if ($modelid):
						$modeldata = $modelObj->fetchRow("id='$modelid'");
						$color_palette_id = $modeldata->color_palette_id;
					endif;
					$html = '';
					$html .= '<div class="active">';
					$html .= '<div id="customization" class="ds_content dotted-bdr-top mt-0 clearfix mob-mTB0">';
					$html .= '<div class="cntrlHolder" id="before">';
					$html .= '<div class="cntrlHolderrowtop" id="chrt">';
					/*$html .= '<button id ="openFront" onClick="openTab(\'Front\');" class="des_activebtn">front '.$modelid.'</button>';
						                    $html .= '<button id = "openBack" onClick="openTab(\'Back\');">'.$label_back_btn .'</button>';
					*/
					$html .= $htmlBtn;
					$html .= '</div>';
					$html .= '<div class="cntrlHolderrowmid" id="chrm">';
					$html .= '<div class="hoderinline" id="mymodel2">';

					// Silhouette starts
					//-------------Start: Top Front Html -------------//
					$html .= '<div class="clearfix"></div><div class="holderbox" id="frontside">'; //front main div.
					$html .= $this->gettopfrontHtml($topfront, $modelid, $bodytypeid, $topfront_order);
					if (isset($topfront) && $topfront != null && !isset($bottomfront) && $bottomfront == null) {
						$html .= $this->getdisptogetherbottomfrontHtml($garmentid, $occasionid, $bodytypeid, $modelid);
					}
					//-------------End: Top Front Html -------------//
					//-------------Start: Bottom Front Html -------------//
					$html .= $this->getbottomfrontHtml($bottomfront, $modelid, $bodytypeid, $bottomfront_order);
					if (isset($bottomfront) && $bottomfront != null && !isset($topfront) && $topfront == null) {
						$html .= $this->getdisptogethertopfrontHtml($garmentid, $occasionid, $bodytypeid, $modelid);
					}
					$html .= '</div>'; //front main div
					$html .= '<div class="clear:both"></div>';
					//-------------End: Bottom Front Html -------------//
					//-------------Start: Top Back Html -------------//
					$html .= '<div class="clearfix"></div><div class="holderbox none" id="backside">'; //start main div.
					$html .= $this->gettopbackHtml($topback, $modelid, $bodytypeid, $topback_order);
					if (isset($topback) && $topback != null && !isset($bottomback) && $bottomback == null) {
						$html .= $this->getdisptogetherbottombackHtml($garmentid, $occasionid, $bodytypeid, $modelid);
					}
					//-------------End: Top Back Html -------------//
					//-------------Start: Bottom Back Html -------------//
					$html .= $this->getbottombackHtml($bottomback, $modelid, $bodytypeid, $bottomback_order);
					if (isset($bottomback) && $bottomback != null && !isset($topback) && $topback == null) {
						$html .= $this->getdisptogethertopbackHtml($garmentid, $occasionid, $bodytypeid, $modelid);
					}
					$html .= '</div>'; //close main div.
					$html .= '<div class="clear:both"></div>';
					//-------------End: Bottom Back Html -------------//
					//-------------Start: Left Sleeves Html -------------//
					$html .= '<div class="clearfix"></div><div class="holderbox mytopF none" id="sleeve">'; //start main div.
					$html .= '<div id="rightsleevecontainer">';
					$html .= $this->getrightsleeveHtml($rightsleeve, $modelid, $bodytypeid, $leftsleeve, $occasionid, $rightsleeve_order, $leftsleeve_order);
					$html .= '</div>'; //close rightsleevecontainer div.
					$html .= '</div>'; //close main sleeve div.
					//-------------End: Right Sleeves Html -------------//

					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '<style>
                    @media screen and (max-width: 767px){
                        #header{
                            display: none;
                        }
                        #header.active{
                            display: block;
                        }
                        #headercontroller{
                            display: block;
                            position: fixed;
                            left: 0px;
                            top: 0;
                            z-index: 1;
                        }
                        #headercontroller span{
                            display: block;
                            width: 35px;
                            height: 30px;
                            background: transparent url("https://modamia.com/images/caret-down.svg") no-repeat center center;
                        }
                        #headercontroller.active{
                            top: 25px;
                            transform: rotate(180deg);
                        }
                        #designstudiostylemanique {
                            padding-top: 5px;
                        }
                    }
                    </style>
                    <script>
                        $( document ).ready(function() {
                            $("#headercontroller").on("click", function(){
                                $("#headercontroller").toggleClass("active");
                                $("#header").toggleClass("active");
                            });
                        });
                    </script>
                    ';

					///$html .= $this->getdisplaytogetherhtml($garmentid, $occasionid, $bodytypeid);
					// Color starts
					$colors = $this->getcolorshtml($dressRowall->color_palette_id, $dressRowall->color_palette_order, $color_palette_id, $dressRowall->color_palette_spec);
					if (count($colors)):
						$html .= $colors['html'];
					endif;
					// Color ends
					// Print starts
					$html .= $this->getprintshtml($dressRowall->print_palette_id, $dressRowall->print_palette_spec);
					// Print ends

					// Print2 starts
					//$html .= $this->getprints2html($dressRowall->print_palette_id, $dressRowall->print_palette_spec);
					// Print ends

					//-----------Start:Main Html for Silhouette------------//
				} else {
					if ($modelid):
						$modeldata = $modelObj->fetchRow("id='$modelid'");
						$color_palette_id = $modeldata->color_palette_id;
						$dressRowall = $dressObj->fetchRow($dressObj->select()
								->setIntegrityCheck(false)
								->from(array('v' => DATABASE_PREFIX . "ds_dress"), array('color_palette_id', 'color_palette_order', 'print_palette_id'))
								->where("id='$mainid'"));
						$html .= $this->getcolorshtml($dressRowall->color_palette_id, $dressRowall->color_palette_order, $color_palette_id, $dressRowall->color_palette_spec);
						$html .= $this->getprintshtml($dressRowall->print_palette_id, $dressRowall->print_palette_spec);
					endif;
				}
			}
		}
		$response = array('html' => $html, 'palette' => $colors['palette']);
		echo json_encode($response);
		exit;
	}

	public function getcolorshtml($ids_string, $ids_sequ, $color_palette_id, $color_palette_spec) 
	{
		$colorObj = new Chez_Model_DbTable_Color();
		$colorpaletteObj = new Chez_Model_DbTable_ColorPalette();
		$ids = explode(',', $ids_string);
		$sequence = explode(',', $ids_sequ);
		$color_palette_spec = explode(',', $color_palette_spec);
		if (count($color_palette_spec) == 1 && in_array('all_over', $color_palette_spec)):
			$is_allcolortabs = false;
		else:
			$is_allcolortabs = true;
		endif;
		foreach ($sequence as $seq) {
			$reduce[] = $seq - 1;
		}
		$combine = array_combine($reduce, $ids);
		ksort($combine);
		$p_html = '';

		$html .= '<div id="colorCarousel" class="m0 clearfix none">';
		$p_html .= '<select id="color_palette" name="color_palette" class="font12 text-capitalize float-right inputtxt mr-2" errortag="Color palette" onchange="getcolorpalette(this.value);">';
		foreach ($combine as $key => $val) {
			$palette_names = $colorpaletteObj->fetchRow("color_palette_id='$val'");
			if ($palette_names->color_palette_id != '') {
				$final_array[] = $val;
				$p_html .= '<option value="' . $palette_names->color_palette_id . '"';
				if ($palette_names->color_palette_id == $color_palette_id) {
					$p_html .= 'selected=selected';
				}
				$p_html .= '>' . $palette_names->color_palette_name . '</option>';
			}
		}
		$p_html .= '</select>';
		$html .= '<div class="ds_content dotted-bdr-top clearfix mob-mTB0">';
		$html .= '<div class="cntrlHolder" id="after">';
		if ($is_allcolortabs):
			$html .= '<div class="cntrlHolderrowtop mob-mTB0"><button id="allover" onClick="setcoloralloveronly(this.id);" class="des_activebtn">All Over</button><button id="topcolortoponly" onClick="setcolortoponly(this.id);">top</button><button id="topcolorbottomonly" onClick="setcolorbottomonly(this.id);">bottom</button></div>';
		else:
			$html .= '<div class="cntrlHolderrowtop"><button id="allover" onClick="setcoloralloveronly(this.id);" class="des_activebtn">All Over</button></div>';
		endif;
		$html .= '<div class="clearfix"></div>';
		$html .= '<div id="dresscolor" class="color-scroll-panel">';
		$html .= '<div id="coloritems" role="listbox" class="box-wrapper">';
		//$html .= '<div >';
		if ($color_palette_id > 0) {
			$id = $color_palette_id;
		} else {
			$id = $final_array[0];
		}
		$colors = $colorObj->fetchAll($colorObj->select()
				->setIntegrityCheck(false)
				->from(array('d' => DATABASE_PREFIX . "color_palettecolor"), array('color_id'))
				->where("palette_id='$id'")
				->order("color_order_number ASC"));
		if (count($colors) > 0):
			foreach ($colors as $colorr):
				$color = $colorObj->fetchRow("id='$colorr->color_id'");
				if (count($color) > 0):
					// inner color box
					$html .= '<div class="item">';
					//$html .='<div class="d-block col-4 img-fluid pull-left">';
					$html .= '<div class="product-image">';
					$html .= '<div class="Colorbox_new w-100" id="dress_' . $color->id . '" onClick="changeColor(' . $color->id . ',\'' . $color->name . '\',\'' . $color->code . '\',' . $color->brightnesslevel . ');">';
					$html .= '<div class="w-100" style="min-height:100px;background-color:' . $color->code . '"></div>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '<div class="product-name">' . $color->name . '</div>';
					$html .= '</div>';
					//$html .='</div>';

					// $html .='<div class="Colorbox_wom pl-2 pr-2 mb-1 mt-1"><div class="Colorbox_new w-100" id="dress_' . $color->id . '" onClick="changeColor(' . $color->id . ',\'' . $color->name . '\',\'' . $color->code . '\',' . $color->brightnesslevel . ');"><div class="w-100" style="height:94px;background-color:'.$color->code . '"></div></div><span class="clrnme1 text-capitalize w-100">' . $color->name . '</span></div>';
				endif;
			endforeach;
		endif;
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		return array('html' => $html, 'palette' => $p_html);
		exit;
	}

	public function getpalettecolorshtmlAction() {
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$palette_id = $this->_request->getParam("id");
				$colorObj = new Chez_Model_DbTable_Color();
				$colors = $colorObj->fetchAll($colorObj->select()
						->setIntegrityCheck(false)
						->from(array('d' => DATABASE_PREFIX . "color_palettecolor"), array('color_id'))
						->where("palette_id='$palette_id'")
						->order("color_order_number ASC"));
				if (count($colors) > 0):
					foreach ($colors as $colorr):
						$color = $colorObj->fetchRow("id='$colorr->color_id'");
						if (count($color) > 0):
							$html .= '<div class="item">';
							$html .= '<div class="product-image">';
							$html .= '<div class="Colorbox_new w-100" id="dress_' . $color->id . '" onClick="changeColor(' . $color->id . ',\'' . $color->name . '\',\'' . $color->code . '\',' . $color->brightnesslevel . ');">';
							$html .= '<div class="w-100" style="min-height:94px;background-color:' . $color->code . '"></div>';
							$html .= '</div>';
							$html .= '<div class="product-name">' . $color->name . '</div>';
							$html .= '</div>';
							$html .= '</div>';
						endif;
					endforeach;
				endif;
			}
		}
		echo json_encode($html);
		exit;
	}

	public function getprintshtml($printid, $print_palette_spec) 
	{
		$print_palette_arr = explode(',', $print_palette_spec);
		if (count($print_palette_arr) == 1 && in_array('all_over', $print_palette_arr)):
			$is_allprinttabs = false;
		else:
			$is_allprinttabs = true;
		endif;

		$printObj = new Chez_Model_DbTable_Print();
		$prints = $printObj->fetchAll($printObj->select()
				->setIntegrityCheck(false)
				->from(array('p' => DATABASE_PREFIX . "print"), array('print_id', 'print_name', 'user_print_image', 'top_print_image', 'bottom_print_image', 'allover_top_print_image', 'allover_bottom_print_image', 'print_price', 'brightnesslevel'))
				->joinInner(array('pp' => DATABASE_PREFIX . "print_paletteprint"), 'pp.print_id=p.print_id', array('print_order_number'))
				->where("pp.print_palette_id='$printid'")
			//->order("p.print_id ASC"));
				->order(array("pp.print_order_number asc")));

		$html .= '<div id="printCarousel" class="clearfix none">';
		$html .= '<div class="ds_content dotted-bdr-top clearfix">';
		$html .= '<div class="cntrlHolder " id="newafter">';
		if ($is_allprinttabs):
			$html .= '<div class="cntrlHolderrowtop mob-mTB0" id="printallbtn">';
			$html .= '<button class="des_activebtn" id="alloverprint" onClick="setprint(this.id,\'printallover\');">All Over</button>';
			$html .= '<button id="topprinttoponly" onClick="setprint(this.id,\'printtoponly\');">top</button>';
			$html .= '<button id="printbottomonly" onClick="setprint(this.id,\'printbottomonly\');">bottom</button>';
			$html .= '</div>';
		else:
			$html .= '<div class="cntrlHolderrowtop mob-mTB0" id="printallbtn">';
			$html .= '<button class="des_activebtn" id="alloverprint" onClick="setprint(this.id,\'printallover\');">All Over</button>';
			$html .= '</div>';
		endif;
		$html .= '<div class="clearfix"></div>';
		$html .= '<div id="printalloverCarousel" class="print-scroll-panel">';
		$html .= '<div id="printitems" role="listbox" class="box-wrapper">';
		if (count($prints) > 0):
			foreach ($prints as $print):
				$html .= '<div class="item">';
				$html .= '<div class="text-center image-box">';
				$html .= '<img style="max-width: 100%; height:auto;" src="' . SILHOUETTEGETORIGINALPRINTS . $print->user_print_image . '" name="userprint-' . $print->user_print_image . ',topprint-' . $print->top_print_image . ',bottomprint-' . $print->bottom_print_image . ',allovertopprint-' . $print->allover_top_print_image . ',alloverbottomprint-' . $print->allover_bottom_print_image . '" pname="' . $print->print_name . '" id="printpattern-' . $print->print_id . '" onClick="selectsingleitem(this.id,' . $print->print_id . ',\'\',\'\',' . $print->brightnesslevel . ');"/>';
				$html .= '</div>';
				$html .= '<div class="product-name">' . $print->print_name . '</div>';
				$html .= '</div>';
			endforeach;
		endif;
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
		exit;
	}
	
	public function getpaletteprinthtmlAction() {
		
		$html = '';
		
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$printCategory = $this->_request->getParam("id");
				$mainid = $this->_request->getParam("mainid");
				
				$dressObj = new Chez_Model_DbTable_Dress();
				$printObj = new Chez_Model_DbTable_Print();
				
				$where = "id='$mainid'";
				$dressRowall = $dressObj->fetchRow($dressObj->select()
					->setIntegrityCheck(false)
					->from(array('v' => DATABASE_PREFIX . "ds_dress"))
					->where($where));
				$printid = $dressRowall->print_palette_id;
				
				//
				
				$select = $printObj->select()
					->setIntegrityCheck(false)
					->from(array('p' => DATABASE_PREFIX . "print"), array('print_id', 'print_name', 'user_print_image', 'top_print_image', 'bottom_print_image', 'allover_top_print_image', 'allover_bottom_print_image', 'print_price', 'brightnesslevel'))
					->joinInner(array('pp' => DATABASE_PREFIX . "print_paletteprint"), 'pp.print_id=p.print_id', array('print_order_number'))
					->where("pp.print_palette_id='$printid'")
					//->where("p.style like '%$printCategory%'")
					//->order("p.print_id ASC"));
				->order(array("pp.print_order_number asc"));
				if($printCategory!="0")
				$select->where("p.style like '%$printCategory%'");
				
				
				$prints = $printObj->fetchAll($select);
				
				
				//
				
				if (count($prints) > 0):
					foreach ($prints as $print):
						$html .= '<div class="item">';
						$html .= '<div class="text-center image-box">';
						$html .= '<img style="max-width: 100%; height:auto;" src="' . SILHOUETTEGETORIGINALPRINTS . $print->user_print_image . '" name="userprint-' . $print->user_print_image . ',topprint-' . $print->top_print_image . ',bottomprint-' . $print->bottom_print_image . ',allovertopprint-' . $print->allover_top_print_image . ',alloverbottomprint-' . $print->allover_bottom_print_image . '" pname="' . $print->print_name . '" id="printpattern-' . $print->print_id . '" onClick="selectsingleitem(this.id,' . $print->print_id . ',\'\',\'\',' . $print->brightnesslevel . ');"/>';
						$html .= '</div>';
						$html .= '<div class="product-name">' . $print->print_name . '</div>';
						$html .= '</div>';
					endforeach;
				endif;
			}
		}
		echo json_encode($html);
		exit;
	}
	
	// new layer added, AMD, 29.01.2021
	public function getprints2html($printid, $print_palette_spec) {
		$print_palette_arr = explode(',', $print_palette_spec);
		if (count($print_palette_arr) == 1 && in_array('all_over', $print_palette_arr)):
			$is_allprinttabs = false;
		else:
			$is_allprinttabs = true;
		endif;

		$printObj = new Chez_Model_DbTable_Print();
		$prints = $printObj->fetchAll($printObj->select()
				->setIntegrityCheck(false)
				->from(array('p' => DATABASE_PREFIX . "print"), array('print_id', 'print_name', 'user_print_image', 'top_print_image', 'bottom_print_image', 'allover_top_print_image', 'allover_bottom_print_image', 'print_price', 'brightnesslevel'))
				->joinInner(array('pp' => DATABASE_PREFIX . "print_paletteprint"), 'pp.print_id=p.print_id', array('print_order_number'))
				->where("pp.print_palette_id='$printid'")
			//->order("p.print_id ASC"));
				->order(array("pp.print_order_number asc")));

		$html .= '<div id="printCarousel2" class="clearfix none">';
		$html .= '<div class="ds_content dotted-bdr-top clearfix">';
		$html .= '<div class="cntrlHolder " id="newafter">';
		if ($is_allprinttabs):
			$html .= '<div class="cntrlHolderrowtop mob-mTB0" id="printallbtn2">';
			$html .= '<button class="des_activebtn" id="alloverprint2" onClick="setprint2(this.id,\'printallover\');">All Over</button>';
			$html .= '<button id="topprinttoponly2" onClick="setprint2(this.id,\'printtoponly\');">top</button>';
			$html .= '<button id="printbottomonly2" onClick="setprint2(this.id,\'printbottomonly\');">bottom</button>';
			$html .= '</div>';
		else:
			$html .= '<div class="cntrlHolderrowtop mob-mTB0" id="printallbtn">';
			$html .= '<button class="des_activebtn" id="alloverprint2" onClick="setprint2(this.id,\'printallover\');">All Over</button>';
			$html .= '</div>';
		endif;
		$html .= '<div class="clearfix"></div>';
		$html .= '<div id="printalloverCarousel" class="print-scroll-panel">';
		$html .= '<div id="printitems" role="listbox" class="box-wrapper">';
		if (count($prints) > 0):
			/*foreach ($prints as $print):
				                $html .= '<div class="item">';
				                $html .= '<div class="text-center image-box">';
				                $html .= '<img style="max-width: 100%; height:auto;" src="' . SILHOUETTEGETORIGINALPRINTS . $print->user_print_image . '" name="userprint-' . $print->user_print_image . ',topprint-' . $print->top_print_image . ',bottomprint-' . $print->bottom_print_image . ',allovertopprint-' . $print->allover_top_print_image . ',alloverbottomprint-' . $print->allover_bottom_print_image . '" pname="' . $print->print_name . '" id="printpattern-' . $print->print_id . '" onClick="selectsingleitem(this.id,' . $print->print_id . ',\'\',\'\',' . $print->brightnesslevel . ');"/>';
				                $html .= '</div>';
				                $html .= '<div class="product-name">' . $print->print_name . '</div>';
				                $html .= '</div>';
			*/
			/*
				<div class="item"><div class="text-center image-box selectedcolor"><img style="max-width: 100%; height:auto;" src="http://localhost/modamia/uploads/prints/20200512030318158927599832102897.png" name="userprint-20200512030318158927599832102897.png,topprint-2020050207003615884262361195802069.png,bottomprint-2020050207003615884262361714314944.png,allovertopprint-2020050207003615884262361158193679.png,alloverbottomprint-2020050207003615884262361899291838.png" pname="print 1010" id="printpattern-43" onclick="selectsingleitem(this.id,43,'','',1);"></div><div class="product-name">print 1010</div></div>
			*/
			$html .= '<div class="item"><div class="text-center image-box selectedcolor"><img style="max-width: 100%; height:auto;" src="https://answebtechnologies.in/modamia/uploads/prints/a1.png" name="userprint-a1.png,topprint-a1.png,bottomprint-a1.png,allovertopprint-a1.png,alloverbottomprint-a1.png" pname="print2" id="printpattern-78" onclick="selectsingleitem(this.id,78,\'\',\'\',1);"></div><div class="product-name">Print2</div></div>';
		endif;
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
		exit;
	}

	function getmodeldressimages($id, $bodytypeid = NULL, $occasionid = NULL) {
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$imageobj = $dresspieceObj->fetchRow($dresspieceObj->select()
				->setIntegrityCheck(false)
				->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('dresspiece_name', 'dresspiece_id'))
//                        ->where('id = ?', $id));
				->where("id='$id' AND occasion_id LIKE '%$occasionid%'"));

		$resultobj = $dresspieceObj->fetchRow($dresspieceObj->select()
				->setIntegrityCheck(false)
				->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('image_type', 'image_name', 'paired_id', 'garment_type_id'))
				->joinLeft(array('viwslv' => DATABASE_PREFIX . "previewsleeve"), 'dss.paired_id=viwslv.paired_id', array('view_sleeve_image'))
				->where("dss.dresspiece_name='$imageobj->dresspiece_name' && dss.dresspiece_id='$imageobj->dresspiece_id' && dss.body_type_id='$bodytypeid'"));
		return $resultobj;
	}

	private function gettopfrontHtml($topfront, $modelid = null, $bodytypeid, $topfront_order) {
		$html = '';
		if (isset($topfront) && $topfront != ""):
			$topfrontids = explode(",", trim($topfront, ","));
			$topfrontids = array_unique($topfrontids);
			if ($topfront_order != null):
				$order = explode(',', $topfront_order);
				foreach ($order as $ord):
					$reduce[] = $ord - 1;
				endforeach;
				$topfrontids = array_combine($reduce, $topfrontids);
				ksort($topfrontids);
			endif;
			$html .= '<div class="clearfix"></div>';
			$html .= '<div id="mytopF" class="mytopF">';
			$html .= '<div class="owl-carousel" id="topfrontdressimg">';
			$i = 1;
			foreach ($topfrontids as $topfrontid) {
				if ($modelid != null):
					$class = ($topfrontid == $modelid ? "dressbox selectedbox" : "dressbox");
					$resultobj = $this->getmodeldressimages($topfrontid, $bodytypeid);
				else:
					$class = ($i == 1 ? "dressbox selectedbox" : "dressbox");
					$resultobj = $this->getdressimages($topfrontid);
				endif;
				if ($resultobj->image_name):
					$html .= '<div class="item">';
					$html .= '<div class="' . $class . '">';
					$html .= '<img src="' . SILHOUETTEGETORIGINAL . 'top-placeholder.png" alt="_blank-img" class="blank-box">';
					$html .= '<img class="lazyOwl" style="max-width: 100%; height:auto;" src="' . SILHOUETTEGETTHUMB . $resultobj->image_name . '" id="topFrnt-' . $topfrontid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ',\'topfrontdressimg\',\'topbackdressimg\');" />';
					$html .= '</div></div>';
				endif;
				$i++;
			}
			$html .= '</div></div>';
		endif;
		return $html;
	}

	private function getbottomfrontHtml($bottomfront, $modelid = null, $bodytypeid, $bottomfront_order) {
		$html = '';
		if (isset($bottomfront) && $bottomfront != ""):
			$i = 1;
			$bottomfrontids = explode(",", trim($bottomfront, ","));
			$bottomfrontids = array_unique($bottomfrontids);
			if ($bottomfront_order != null):
				$order = explode(',', $bottomfront_order);
				foreach ($order as $ord) {
					$reduce[] = $ord - 1;
				}
				$bottomfrontids = array_combine($reduce, $bottomfrontids);
				ksort($bottomfrontids);
			endif;
			$html .= '<div class="clearfix"></div><div id="mybotF" class="testeteteetetetetetetetet">';
			$html .= '<div class="owl-carousel" id="bottomfrontdressimg">';
			foreach ($bottomfrontids as $bottomfrontid) {
				if ($modelid != null):
					$class = ($bottomfrontid == $modelid ? "dressbox selectedbox" : "dressbox");
					$resultobj = $this->getmodeldressimages($bottomfrontid, $bodytypeid);
				else:
					$class = ($i == 1 ? "dressbox selectedbox" : "dressbox");
					$resultobj = $this->getdressimages($bottomfrontid);
				endif;
				if ($resultobj->image_name):
					$html .= '<div class="item">';
					$html .= '<div class="' . $class . '">';
					$html .= '<img src="' . SILHOUETTEGETORIGINAL . 'bottom-placeholder.png" alt="_blank-img" class="blank-box">';
					$html .= '<img class="lazyOwl" style="max-width: 100%; height:auto;" src="' . SILHOUETTEGETTHUMB . $resultobj->image_name . '" id="botfrnt-' . $bottomfrontid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ',\'bottomfrontdressimg\',\'bottombackdressimg\');"  class="bottom_img" />';
					$html .= '</div></div>';
				endif;
				$i++;
			}
			$html .= '</div></div>';
		endif;
		return $html;
	}

	private function gettopbackHtml($topback, $modelid = null, $bodytypeid, $topback_order) {
		$html = '';
		if (isset($topback) && $topback != ""):
			$i = 1;
			$topbackids = explode(",", trim($topback, ","));
			$topbackids = array_unique($topbackids);
			if ($topback_order != null):
				$order = explode(',', $topback_order);
				foreach ($order as $ord) {
					$reduce[] = $ord - 1;
				}
				$topbackids = array_combine($reduce, $topbackids);
				ksort($topbackids);
			endif;
			$html .= '<div class="clearfix"></div><div id="mytopB">';
			$html .= '<div class="owl-carousel" id="topbackdressimg">';
			foreach ($topbackids as $topbackid) {
				if ($modelid != null):
					$class = ($topbackid == $modelid ? "dressbox selectedbox" : "dressbox");
					$resultobj = $this->getmodeldressimages($topbackid, $bodytypeid);
				else:
					$class = ($i == 1 ? "dressbox selectedbox" : "dressbox");
					$resultobj = $this->getdressimages($topbackid);
				endif;
				if ($resultobj->image_name):
					$html .= '<div class="item">';
					$html .= '<div class="' . $class . '">';
					$html .= '<img src="' . SILHOUETTEGETORIGINAL . 'top-placeholder.png" alt="_blank-img" class="blank-box">';
					$html .= '<img class="lazyOwl" src="' . SILHOUETTEGETTHUMB . $resultobj->image_name . '" id="topback-' . $topbackid . '" name ="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ',\'topbackdressimg\',\'topfrontdressimg\');" />';
					$html .= '</div></div>';
				endif;
				$i++;
			}
			$html .= '</div></div>';
		endif;
		return $html;
	}

	private function getbottombackHtml($bottomback, $modelid = null, $bodytypeid, $bottomback_order) {
		$html = '';
		if (isset($bottomback) && $bottomback != ""):
			$i = 1;
			$bottombackids = explode(",", trim($bottomback, ","));
			$bottombackids = array_unique($bottombackids);
			if ($bottomback_order != null):
				$order = explode(',', $bottomback_order);
				foreach ($order as $ord) {
					$reduce[] = $ord - 1;
				}
				$bottombackids = array_combine($reduce, $bottombackids);
				ksort($bottombackids);
			endif;
			$html .= '<div class="clearfix"></div><div id="mybotB">';
			$html .= '<div class="owl-carousel" id="bottombackdressimg">';
			foreach ($bottombackids as $bottombackid):
				if ($modelid != null):
					$class = ($bottombackid == $modelid ? "dressbox selectedbox" : "dressbox");
					$resultobj = $this->getmodeldressimages($bottombackid, $bodytypeid);
				else:
					$class = ($i == 1 ? "dressbox selectedbox" : "dressbox");
					$resultobj = $this->getdressimages($bottombackid);
				endif;
				if ($resultobj->image_name):
					$html .= '<div class="item">';
					$html .= '<div class="' . $class . '">';
					$html .= '<img src="' . SILHOUETTEGETORIGINAL . 'bottom-placeholder.png" alt="_blank-img" class="blank-box">';
					$html .= '<img class="lazyOwl" src="' . SILHOUETTEGETTHUMB . $resultobj->image_name . '" id="botback-' . $bottombackid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ',\'bottombackdressimg\',\'bottomfrontdressimg\');" class="bottom_img" />';
					$html .= '</div></div>';
				endif;
				$i++;
			endforeach;
			$html .= '</div></div>';
		endif;
		return $html;
	}

	private function getleftsleeveHtml($leftsleeve, $modelid = null, $bodytypeid, $occasionid, $rightpaired_ids, $leftsleeve_order) {
		$html = '';
		//$html .='<div id="leftfrontsleeve" class="ca-container">';
		//$html .='<div class="ca-wrapper itemboxholder" id="leftsleevedressimg">';
		//$html .='<div class="item dressbox" onclick="removeleftsleeve(\'sleeveleft\',\'sleeveleftback\');" id="sleeveleft"><span class="nosleeve"><img src="' . BASEPATH . '/images/nosleeve.jpg" /></span></div>';
		if ($leftsleeve > 0):
			$leftsleeveids = explode(",", trim($leftsleeve, ","));
			$leftsleeveids = array_unique($leftsleeveids);
			if ($leftsleeve_order != null):
				$order = explode(',', $leftsleeve_order);
				foreach ($order as $ord) {
					$reduce[] = $ord - 1;
				}
				$leftsleeveids = array_combine($reduce, $leftsleeveids);
				ksort($leftsleeveids);
			endif;
			if (count($leftsleeveids) > 0):
				$i = 1;
				foreach ($leftsleeveids as $leftsleeveid):
					if ($leftsleeveid > 0):
						if ($modelid != null):
							$class = ($leftsleeveid == $modelid ? "dressbox selectedbox" : "dressbox");
							$resultobj = $this->getmodeldressimages($leftsleeveid, $bodytypeid, $occasionid);
						else:
//                            $class = ($i == 1 ? "dressbox selectedbox" : "dressbox");
							$class = ($i == 1 ? "dressbox" : "dressbox");
							$resultobj = $this->getdressimages($leftsleeveid, $occasionid);

						endif;
						if (!in_array($resultobj->paired_id, $rightpaired_ids)):
							//SILHOUETTEGETTHUMB
							$html .= '<div class="item"><div class="' . $class . '"><img class="leftsleeve" src="' . SILHOUETTEGETORIGINAL . $resultobj->image_name . '" id="slvleft-' . $leftsleeveid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ');" /></div></div>';
						endif;
						$i++;
					endif;
				endforeach;
			endif;
		endif;
		//$html .='</div></div>';
		return $html;
	}

	private function getleftbacksleeveHtml($leftbacksleeve, $modelid = null, $bodytypeid) {
		$leftbacksleeveids = explode(",", trim($leftbacksleeve, ","));
		$leftbacksleeveids = array_unique($leftbacksleeveids);
		$html .= '<div id="leftbacktsleeve" class="ca-container">';
		$html .= '<div class="ca-wrapper itemboxholder" id="leftbacksleevedressimg">';
		$html .= '<div class="item"><div class="dressbox" onclick="removeleftsleeve(\'sleeveleft\',\'sleeveleftback\');" id="sleeveleftback"><span class="nosleeve"><img src="' . BASEPATH . '/images/nosleeve.jpg" /></span></div></div>';
		if (count($leftbacksleeveids) > 0):
			$i = 1;
			foreach ($leftbacksleeveids as $leftbacksleeveid):
				if ($leftbacksleeveid > 0):
					if ($modelid != null):
						$class = ($leftbacksleeveid == $modelid ? "dressbox selectedbox" : "dressbox");
						$resultobj = $this->getmodeldressimages($leftbacksleeveid, $bodytypeid);
					else:
						$class = ($i == 1 ? "dressbox selectedbox" : "dressbox");
						$resultobj = $this->getdressimages($leftbacksleeveid);
					endif;
					if ($resultobj->image_name):
						$html .= '<div class="item"><div class="' . $class . '"><img src="' . SILHOUETTEGETTHUMB . $resultobj->image_name . '" id="slvleftback-' . $leftbacksleeveid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ');" /></div></div>';
					endif;
					$i++;
				endif;
			endforeach;
		endif;
		$html .= '</div></div>';
		return $html;
	}

	private function getrightsleeveHtml($rightsleeve, $modelid = null, $bodytypeid, $leftsleeve, $occasionid, $rightsleeve_order, $leftsleeve_order) {
		$html .= '<div id="rightfrontsleeve">';
		$html .= '<div class="owl-carousel" id="rightsleevedressimg">';
		// $html .='<div class="item"><div class="dressbox" onclick="removesleeves(\'sleeveright\',\'sleeverightback\');" id="sleeveright"><span class="nosleeve"><img src="' . BASEPATH . '/images/nosleeve.jpg" /></span></div></div>';
		$rightpaired_ids = array();
		if ($rightsleeve > 0):
			$rightsleeveids = explode(",", trim($rightsleeve, ","));
			$rightsleeveids = array_unique($rightsleeveids);
			if ($rightsleeve_order != null):
				$order = explode(',', $rightsleeve_order);
				foreach ($order as $ord) {
					$reduce[] = $ord - 1;
				}
				$rightsleeveids = array_combine($reduce, $rightsleeveids);
				ksort($rightsleeveids);
			endif;
			if (count($rightsleeveids) > 0):
				$i = 1;
				foreach ($rightsleeveids as $rightsleeveid):
					if ($rightsleeveid > 0):
						if ($modelid != null):
							$resultobj = $this->getmodeldressimages($rightsleeveid, $bodytypeid, $occasionid);
							$class = ($rightsleeveid == $modelid ? "dressbox selectedbox" : "dressbox");
							$paired_ids[] = $resultobj->paired_id;
						else:
							$resultobj = $this->getdressimages($rightsleeveid, $occasionid);
							$class = ($i == 1 ? "dressbox" : "dressbox");
							$rightpaired_ids[] = $resultobj->paired_id;
						endif;
//                        if ($resultobj->image_name):
						//                            $html .='<div class="item"><div class="' . $class . ' "><img class="rightsleeve" src="' . SILHOUETTEGETORIGINAL . '/' . $resultobj->image_name . '" id="slvrght-' . $rightsleeveid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ');" /></div></div>';
						//                        endif;
						if ($resultobj->view_sleeve_image):
							$html .= '<div class="item">';
							$html .= '<div class="' . $class . ' ">';
							$html .= '<img class="rightsleeve" src="' . SILHOUETTEGETORIGINAL . $resultobj->view_sleeve_image . '" id="slvrght-' . $rightsleeveid . '" name="' . $resultobj->view_sleeve_image . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ');" />';
							$html .= '</div></div>';
						elseif ($resultobj->image_name):
							$html .= '<div class="item">';
							$html .= '<div class="' . $class . ' ">';
							$html .= '<img class="rightsleeve" src="' . SILHOUETTEGETTHUMB . $resultobj->image_name . '" id="slvrght-' . $rightsleeveid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ');" />';
							$html .= '</div></div>';
						endif;
						$i++;
					endif;
				endforeach;
			endif;
		endif;
		$html .= $this->getleftsleeveHtml($leftsleeve, $modelid, $bodytypeid, $occasionid, $rightpaired_ids, $leftsleeve_order);
		$html .= '</div></div>';
		return $html;
	}

	private function getrightbacksleeveHtml($rightbacksleeve, $modelid = null, $bodytypeid) {
		$rightbacksleeveids = explode(",", trim($rightbacksleeve, ","));
		$rightbacksleeveids = array_unique($rightbacksleeveids);
		$html .= '<div id="rightbacktsleeve" class="ca-container">';
		$html .= '<div class="ca-wrapper itemboxholder" id="rightbacksleevedressimg">';
		$html .= '<div class="item"><div class="dressbox" onclick="removerightsleeve(\'sleeveright\',\'sleeverightback\');" id="sleeverightback"><span class="nosleeve"><img src="' . BASEPATH . '/images/nosleeve.jpg" /></span></div></div>';
		if (count($rightbacksleeveids) > 0):
			$i = 1;
			foreach ($rightbacksleeveids as $rightbacksleeveid):
				if ($rightbacksleeveid > 0):
					if ($modelid != null):
						$resultobj = $this->getmodeldressimages($rightbacksleeveid, $bodytypeid);
						$class = ($rightbacksleeveid == $modelid ? "dressbox selectedbox" : "dressbox");
					else:
						$resultobj = $this->getdressimages($rightbacksleeveid);
						$class = ($i == 1 ? "dressbox" : "dressbox");
					endif;
					if ($resultobj->image_name):
						$html .= '<div class="item"><div class="' . $class . '"><img src="' . SILHOUETTEGETTHUMB . $resultobj->image_name . '" id="slvrghtback-' . $rightbacksleeveid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ');" /></div>';
					endif;
					$i++;
				endif;
			endforeach;
		endif;
		$html .= '</div></div>';
		return $html;
	}

	public function getdisplaytogetherhtml($garmentid, $occasionid, $bodytypeid) {
		$html = '';
		$dressObj = new Chez_Model_DbTable_Dress();
		$disptogethers = $dressObj->fetchAll($dressObj->select()
				->setIntegrityCheck(false)
				->from(array("d" => DATABASE_PREFIX . 'dresspiece'), array('id', 'silhouette_type_id', 'dresspiece_id', 'paired_id', 'image_name', 'price'))
				->joinInner(array('g' => DATABASE_PREFIX . "garment_type_together"), 'g.together_id=d.garment_type_id', array(''))
				->where("g.garment_type_id='$garmentid' AND d.occasion_id='$occasionid' AND d.body_type_id='$bodytypeid'"));

		if (count($disptogethers) > 0):
			$html .= '<li class="dssteps1" style="margin-left:20px;">';
			$html .= '<h3><a href="#"><span class="silhouette_right_title" style="margin-top:2px !important">you may also like</span><div>&nbsp;</div></a></h3>';
			$html .= '<ul style="display: none;"><li style="background: none">';
			$html .= '<div class="cntrlHolderrowmid" id="togethercontents">';
			$html .= '<div class="cntrlHolderrowtop">';
			$html .= '<button id ="togetherfront" onClick="openTab(\'togfront\');" class="des_activebtn">front</button>';
			$html .= '<button id = "togetherback" onClick="openTab(\'togback\');">back</button>';
			//$html .= '<button id = "openSleeve" onClick="openTab(\'Sleeve\');">sleeve</button>';
			$html .= '</div>';
			$html .= '<div id="togetherfrontside" class="holderbox">';
			$html .= $this->getdisptogethertopfrontHtml($disptogethers);
			$html .= $this->getdisptogetherbottomfrontHtml($disptogethers);
			$html .= '</div>';
			$html .= '<div class="clear:both"></div>';
			$html .= '<div id="togetherbackside" class="holderbox none">';
			$html .= $this->getdisptogethertopbackHtml($disptogethers);
			$html .= $this->getdisptogetherbottombackHtml($disptogethers);
			$html .= '</div>';
			//$html .= '<div class="clear:both"></div>';
			$html .= '</div>';
			$html .= ' </li>';
			$html .= '</ul>';
			$html .= '</li>';
		endif;
		return $html;
		exit;
	}

	public function getdisptogethertopsleevehtmlAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$dressObj = new Chez_Model_DbTable_Dress();
		$bodytypeid = $this->_request->getParam("hiddenbodytype");
		$occasionid = $this->_request->getParam("occation_id");
		$mainid = $this->_request->getParam("mainid");
		$modelid = null;
		$html = '';
		$dressRowall = $dressObj->fetchRow($dressObj->select()
				->setIntegrityCheck(false)
				->from(array('v' => DATABASE_PREFIX . "ds_dress"))
				->where("id='$mainid'"));
		if (sizeof($dressRowall) > 0) {
			$leftsleeve = $dressRowall->left_sleeve_front_id;
			$rightsleeve = $dressRowall->right_sleeve_front_id;
			$leftsleeve_order = $dressRowall->leftfrontsleeve_order;
			$rightsleeve_order = $dressRowall->rightfrontsleeve_order;
			$html .= $this->getdistogrightsleeveHtml($rightsleeve, $modelid, $bodytypeid, $leftsleeve, $occasionid, $rightsleeve_order, $leftsleeve_order);
		}
		echo json_encode($html);
		exit;
	}

	private function getdistogrightsleeveHtml($rightsleeve, $modelid = null, $bodytypeid, $leftsleeve, $occasionid, $rightsleeve_order, $leftsleeve_order) {
		$html .= '<div id="rightfrontsleeve" class="ca-container">';
		$html .= '<div class="ca-wrapper itemboxholder" id="rightsleevedressimg">';
		$html .= '<div class="item"><div class="dressbox" onclick="removesleeves(\'sleeveright\',\'sleeverightback\');" id="sleeveright"><span class="nosleeve"><img src="' . BASEPATH . '/images/nosleeve.jpg" /></span></div></div>';
		$rightpaired_ids = array();
		if ($rightsleeve > 0):
			$rightsleeveids = explode(",", trim($rightsleeve, ","));
			$rightsleeveids = array_unique($rightsleeveids);
			if ($rightsleeve_order != null):
				$order = explode(',', $rightsleeve_order);
				foreach ($order as $ord) {
					$reduce[] = $ord - 1;
				}
				$rightsleeveids = array_combine($reduce, $rightsleeveids);
				ksort($rightsleeveids);
			endif;
			if (count($rightsleeveids) > 0):
				$i = 1;
				foreach ($rightsleeveids as $rightsleeveid):
					if ($rightsleeveid > 0):
						if ($modelid != null):
							$resultobj = $this->getmodeldressimages($rightsleeveid, $bodytypeid, $occasionid);
							$class = ($rightsleeveid == $modelid ? "dressbox selectedbox" : "dressbox");
							$paired_ids[] = $resultobj->paired_id;
						else:
							$resultobj = $this->getdressimages($rightsleeveid, $occasionid);
							$class = ($i == 1 ? "dressbox" : "dressbox");
							$rightpaired_ids[] = $resultobj->paired_id;
						endif;
//                        if ($resultobj->image_name):
						//                            $html .='<div class="item"><div class="' . $class . ' "><img class="rightsleeve" src="' . SILHOUETTEGETORIGINAL . '/' . $resultobj->image_name . '" id="slvrght-' . $rightsleeveid . '" name="' . $resultobj->image_name . '" onClick="selectsingleitem(this.id,' . $resultobj->paired_id . ');" /></div></div>';
						//                        endif;
						if ($resultobj->view_sleeve_image):
							$html .= '<div class="item"><div class="' . $class . ' "><img class="rightsleeve" src="' . SILHOUETTEGETORIGINAL . '/' . $resultobj->view_sleeve_image . '" id="slvrght-' . $rightsleeveid . '" name="' . $resultobj->view_sleeve_image . '" onClick="selectdistogsleeve(this.id,' . $resultobj->paired_id . ',' . $resultobj->garment_type_id . ');" /></div></div>';
						elseif ($resultobj->image_name):
							$html .= '<div class="item"><div class="' . $class . ' "><img class="rightsleeve" src="' . SILHOUETTEGETORIGINAL . '/' . $resultobj->image_name . '" id="slvrght-' . $rightsleeveid . '" name="' . $resultobj->image_name . '" onClick="selectdistogsleeve(this.id,' . $resultobj->paired_id . ',' . $resultobj->garment_type_id . ');" /></div></div>';
						endif;
						$i++;
					endif;
				endforeach;
			endif;
		endif;
		$html .= $this->getdistogleftsleeveHtml($leftsleeve, $modelid, $bodytypeid, $occasionid, $rightpaired_ids, $leftsleeve_order);
		$html .= '</div></div>';
		return $html;
	}

	private function getdistogleftsleeveHtml($leftsleeve, $modelid = null, $bodytypeid, $occasionid, $rightpaired_ids, $leftsleeve_order) {
		$html .= '';
		if ($leftsleeve > 0):
			$leftsleeveids = explode(",", trim($leftsleeve, ","));
			$leftsleeveids = array_unique($leftsleeveids);
			if ($leftsleeve_order != null):
				$order = explode(',', $leftsleeve_order);
				foreach ($order as $ord) {
					$reduce[] = $ord - 1;
				}
				$leftsleeveids = array_combine($reduce, $leftsleeveids);
				ksort($leftsleeveids);
			endif;
			if (count($leftsleeveids) > 0):
				$i = 1;
				foreach ($leftsleeveids as $leftsleeveid):
					if ($leftsleeveid > 0):
						if ($modelid != null):
							$class = ($leftsleeveid == $modelid ? "dressbox selectedbox" : "dressbox");
							$resultobj = $this->getmodeldressimages($leftsleeveid, $bodytypeid, $occasionid);
						else:
//                            $class = ($i == 1 ? "dressbox selectedbox" : "dressbox");
							$class = ($i == 1 ? "dressbox" : "dressbox");
							$resultobj = $this->getdressimages($leftsleeveid, $occasionid);

						endif;
						if (!in_array($resultobj->paired_id, $rightpaired_ids)):
							$html .= '<div class="item"><div class="' . $class . '"><img class="leftsleeve" src="' . SILHOUETTEGETORIGINAL . '/' . $resultobj->image_name . '" id="slvleft-' . $leftsleeveid . '" name="' . $resultobj->image_name . '" onClick="selectdistogsleeve(this.id,' . $resultobj->paired_id . ',' . $resultobj->garment_type_id . ');" /></div></div>';
						endif;
						$i++;
					endif;
				endforeach;
			endif;
		endif;
		//$html .='</div></div>';
		return $html;
	}

	public function getdisptogethertopfrontHtml($garmentid, $occasionid, $bodytypeid, $modelid) {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if ($garmentid != null && $occasionid != null && $bodytypeid != null) {
			$dressObj = new Chez_Model_DbTable_Dress();
			if ((!isset($authUserNamespace->userid) || $authUserNamespace->userrole != 'admin') && $modelid == '') {
				$where = "g.garment_type_id in ($garmentid) AND ds.occasion_id in ($occasionid) AND ds.body_type_id in ($bodytypeid) AND ds.visible_to = 1";
			} else {
				$where = "g.garment_type_id in ($garmentid) AND ds.occasion_id in ($occasionid) AND ds.body_type_id in ($bodytypeid)";
			}
			$disptogethers = $dressObj->fetchAll($dressObj->select()
					->setIntegrityCheck(false)
					->from(array("ds" => DATABASE_PREFIX . 'ds_dress'), array('id as mainid', 'garment_type_id', 'top_front_id'))
					->joinInner(array('g' => DATABASE_PREFIX . "garment_type_together"), 'g.together_id=ds.garment_type_id', array(''))
					->joinInner(array('d' => DATABASE_PREFIX . "dresspiece"), 'd.id=ds.top_front_id', array('id', 'silhouette_type_id', 'dresspiece_id', 'paired_id', 'image_name', 'price'))
					->where($where)
					->order(array("ds.id DESC")));
//            if (isset($garments) && count($garments) > 0) {
			//                $ds_ids = array();
			//                foreach ($garments as $dress):
			//                    $ds_ids[] = $dress->top_front_id;
			//                endforeach;
			//                $final_ids = implode(',', array_unique($ds_ids));
			//                $disptogethers = $dressObj->fetchAll($dressObj->select()
			//                            ->setIntegrityCheck(false)
			//                            ->from(array("d" => DATABASE_PREFIX . 'dresspiece'), array('id', 'silhouette_type_id', 'dresspiece_id', 'paired_id', 'image_name', 'price'))
			//                            ->where("d.id in ($final_ids)")
			//                            ->order(array("d.id DESC")));
			if (isset($disptogethers) && count($disptogethers) > 0) {
				$usedVals = array();
				$outArray = array();
				foreach ($disptogethers as $arrayItem) {
					if (!in_array($arrayItem['top_front_id'], $usedVals)) {
						$outArray[] = $arrayItem;
						$usedVals[] = $arrayItem['top_front_id'];
					}
				}
				$html .= '<div class="ca-container" id="displaytopfront">';
				$html .= '<span class="likealso" style="font-weight: normal; color: #b4b4b8; margin-top: -13px; margin-bottom: 6px; display: block;">you may also like</span>';
				$html .= '<img id="rmvetop_image" height="12px" style="float: left;font-size: 2px;margin-left: 5px;margin-top: -7px;width: 12px;display: none;"/>';
				$html .= '<div class="ca-wrapper itemboxholder">';
				foreach ($outArray as $result):
					if ($result->dresspiece_id == 4):
						$srcid = 'topFrnt-' . $result->id;
						$html .= '<div class="item"><div class="dressbox"><img src="' . SILHOUETTEGETORIGINAL . $result->image_name . '" id="' . $srcid . '" name="' . $result->image_name . '" onClick="selectsingleitem(this.id,' . $result->paired_id . ',\'displaytopfront\',\'displaybacktop\',\'\',\'top\',\'dsplytogtop\',' . $result->mainid . ');" /></div></div>';
					endif;
				endforeach;
				$html .= '</div></div>';
				return $html;
				exit;
			}
			//}
		}
	}

	public function getdisptogetherbottomfrontHtml($garmentid, $occasionid, $bodytypeid, $modelid) {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$dressObj = new Chez_Model_DbTable_Dress;
		if ($garmentid != null && $occasionid != null && $bodytypeid != null) {
			if ((!isset($authUserNamespace->userid) || $authUserNamespace->userrole != 'admin') && $modelid == '') {
				$where = "g.garment_type_id in ($garmentid) AND ds.occasion_id in ($occasionid) AND ds.body_type_id in ($bodytypeid) AND ds.visible_to = 1";
			} else {
				$where = "g.garment_type_id in ($garmentid) AND ds.occasion_id in ($occasionid) AND ds.body_type_id in ($bodytypeid)";
			}
			$garments = $dressObj->fetchAll($dressObj->select()
					->setIntegrityCheck(false)
					->from(array("ds" => DATABASE_PREFIX . 'ds_dress'), array('garment_type_id', 'bottom_front_id', 'visible_to'))
					->joinInner(array('g' => DATABASE_PREFIX . "garment_type_together"), 'g.together_id=ds.garment_type_id', array(''))
					->where($where)
					->order(array("ds.id DESC")));
			if (isset($garments) && count($garments) > 0) {
				$ds_ids = array();
				foreach ($garments as $dress):
					$ds_ids[] = $dress->bottom_front_id;
				endforeach;
				$final_ids = implode(',', array_unique($ds_ids));
				$disptogethers = $dressObj->fetchAll($dressObj->select()
						->setIntegrityCheck(false)
						->from(array("d" => DATABASE_PREFIX . 'dresspiece'), array('id', 'silhouette_type_id', 'dresspiece_id', 'paired_id', 'image_name', 'price'))
						->where("d.id in ($final_ids)")
						->order(array("d.id DESC")));
				if (isset($disptogethers) && count($disptogethers) > 0) {
					$html .= '<div class="ca-container" id="displayfrontbottom">';
					$html .= '<span class="likealso" style="font-weight: normal; color: #b4b4b8; margin-top: -13px; margin-bottom: 6px; display: block;">you may also like</span>';
					$html .= '<img id="rmvebttm_image"  height="12px" style="float: left;font-size: 2px;margin-left: 5px;margin-top: -7px;width: 12px;display: none;"/>';
					$html .= '<div class="ca-wrapper itemboxholder owl-carousel owl-theme" id="displayfrontbottomcarousel">';
					foreach ($disptogethers as $result):
						if ($result->dresspiece_id == 6):
							$srcid = 'botfrnt-' . $result->id;
							$html .= '<div class="item"><div class="dressbox"><img src="' . SILHOUETTEGETORIGINAL . $result->image_name . '" id="' . $srcid . '" name="' . $result->image_name . '" onClick="selectsingleitem(this.id,' . $result->paired_id . ',\'displayfrontbottom\',\'displaybackbottom\',\'\',\'bottom\',\'dsplytogbottom\');" /></div></div>';
						endif;
					endforeach;
					$html .= '</div></div><script>
                    $("#displayfrontbottomcarousel").owlCarousel({
                        loop:true,
                        margin:10,
                        nav:true,
                        items:3,
                        responsive:{
                            0:{
                                margin:10,
                            },
                            767:{
                                margin:23,
                            }
                        }
                    })
                    </script>';
					return $html;
					exit;
				}
			}
		}
	}

	public function getdisptogethertopbackHtml($garmentid, $occasionid, $bodytypeid, $modelid) {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$dressObj = new Chez_Model_DbTable_Dress();
		if ($garmentid != null && $occasionid != null && $bodytypeid != null) {
			if ((!isset($authUserNamespace->userid) || $authUserNamespace->userrole != 'admin') && $modelid == '') {
				$where = "g.garment_type_id in ($garmentid) AND ds.occasion_id in ($occasionid) AND ds.body_type_id in ($bodytypeid) AND ds.visible_to =1";
			} else {
				$where = "g.garment_type_id in ($garmentid) AND ds.occasion_id in ($occasionid) AND ds.body_type_id in ($bodytypeid)";
			}
			$disptogethers = $dressObj->fetchAll($dressObj->select()
					->setIntegrityCheck(false)
					->from(array("ds" => DATABASE_PREFIX . 'ds_dress'), array('id as mainid', 'garment_type_id', 'top_back_id'))
					->joinInner(array('g' => DATABASE_PREFIX . "garment_type_together"), 'g.together_id=ds.garment_type_id', array(''))
					->joinInner(array('d' => DATABASE_PREFIX . "dresspiece"), 'd.id=ds.top_back_id', array('id', 'silhouette_type_id', 'dresspiece_id', 'paired_id', 'image_name', 'price'))
					->where($where)
					->order(array("ds.id DESC")));

//            $garments = $dressObj->fetchAll($dressObj->select()
			//                            ->setIntegrityCheck(false)
			//                            ->from(array("ds" => DATABASE_PREFIX . 'ds_dress'), array('garment_type_id', 'top_back_id', 'visible_to'))
			//                            ->joinInner(array('g' => DATABASE_PREFIX . "garment_type_together"), 'g.together_id=ds.garment_type_id', array(''))
			//                            ->where($where)
			//                            ->order(array("ds.id DESC")));
			//            if (isset($garments) && count($garments) > 0) {
			//                $ds_ids = array();
			//                foreach ($garments as $dress):
			//                    $ds_ids[] = $dress->top_back_id;
			//                endforeach;
			//                $final_ids = implode(',', array_unique($ds_ids));
			//                $disptogethers = $dressObj->fetchAll($dressObj->select()
			//                            ->setIntegrityCheck(false)
			//                            ->from(array("d" => DATABASE_PREFIX . 'dresspiece'), array('id', 'silhouette_type_id', 'dresspiece_id', 'paired_id', 'image_name', 'price'))
			//                            ->where("d.id in ($final_ids)")
			//                            ->order(array("d.id DESC")));

			if (isset($disptogethers) && count($disptogethers) > 0) {
				$usedVals = array();
				$outArray = array();
				foreach ($disptogethers as $arrayItem) {
					if (!in_array($arrayItem['top_back_id'], $usedVals)) {
						$outArray[] = $arrayItem;
						$usedVals[] = $arrayItem['top_back_id'];
					}
				}
				$html .= '<div class="ca-container" id="displaybacktop">';
				$html .= '<span class="likealso" style="font-weight: normal; color: #b4b4b8; margin-top: -13px; margin-bottom: 6px; display: block;">you may also like</span>';
				$html .= '<img id="rmvetop_image_back" height="12px" style="float: left;font-size: 2px;margin-left: 5px;margin-top: -7px;width: 12px;display: none;"/>';
				$html .= '<div class="ca-wrapper itemboxholder owl-carousel owl-theme" id="displaybacktopcarousel">';
				foreach ($outArray as $result):
					if ($result->dresspiece_id == 5):
						$srcid = 'topback-' . $result->id;
						$html .= '<div class="item"><div class="dressbox"><img src="' . SILHOUETTEGETORIGINAL . $result->image_name . '" id="' . $srcid . '" name="' . $result->image_name . '" onClick="selectsingleitem(this.id,' . $result->paired_id . ',\'displaybacktop\',\'displayfronttop \',\'\',\'top\',\'dsplytogtop\',' . $result->mainid . ');" /></div></div>';
					endif;
				endforeach;
				$html .= '</div></div>
                <script>
                $("#displaybacktopcarousel").owlCarousel({
                    loop:true,
                    margin:10,
                    nav:true,
                    items:3,
                    responsive:{
                        0:{
                            margin:10,
                        },
                        767:{
                            margin:23,
                        }
                    }
                })
                </script>';
				return $html;
				exit;
			}
		}
	}

	public function getdisptogetherbottombackHtml($garmentid, $occasionid, $bodytypeid, $modelid) {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$dressObj = new Chez_Model_DbTable_Dress();
		if ($garmentid != null && $occasionid != null && $bodytypeid != null) {
			if ((!isset($authUserNamespace->userid) || $authUserNamespace->userrole != 'admin') && $modelid == '') {
				$where = "g.garment_type_id in ($garmentid) AND ds.occasion_id in ($occasionid) AND ds.body_type_id in ($bodytypeid) AND ds.visible_to =1";
			} else {
				$where = "g.garment_type_id in ($garmentid) AND ds.occasion_id in ($occasionid) AND ds.body_type_id in ($bodytypeid)";
			}
			$garments = $dressObj->fetchAll($dressObj->select()
					->setIntegrityCheck(false)
					->from(array("ds" => DATABASE_PREFIX . 'ds_dress'), array('garment_type_id', 'bottom_back_id', 'visible_to'))
					->joinInner(array('g' => DATABASE_PREFIX . "garment_type_together"), 'g.together_id=ds.garment_type_id', array(''))
					->where($where)
					->order(array("ds.id DESC")));
			if (isset($garments) && count($garments) > 0) {
				$ds_ids = array();
				foreach ($garments as $dress):
					$ds_ids[] = $dress->bottom_back_id;
				endforeach;
				$final_ids = implode(',', array_unique($ds_ids));
				$disptogethers = $dressObj->fetchAll($dressObj->select()
						->setIntegrityCheck(false)
						->from(array("d" => DATABASE_PREFIX . 'dresspiece'), array('id', 'silhouette_type_id', 'dresspiece_id', 'paired_id', 'image_name', 'price'))
						->where("d.id in ($final_ids)")
						->order(array("d.id DESC")));
				if (isset($disptogethers) && count($disptogethers) > 0) {
					$html .= '<div class="ca-container" id="displaybackbottom" style="margin-top: 10px;">';
					$html .= '<span class="likealso" style="font-weight: normal; color: #b4b4b8; margin-top: -13px; margin-bottom: 6px; display: block;">you may also like</span>';
					$html .= '<img id="rmvebttm_image_back"  height="12px" style="float: left;font-size: 2px;margin-left: 5px;margin-top: -7px;width: 12px;display: none;"/>';
					$html .= '<div class="ca-wrapper itemboxholder owl-carousel owl-theme" id="displaybackbottomcarousel">';
					foreach ($disptogethers as $result):
						if ($result->dresspiece_id == 7):
							$srcid = 'botback-' . $result->id;
							$html .= '<div class="item"><div class="dressbox"><img src="' . SILHOUETTEGETORIGINAL . $result->image_name . '" id="' . $srcid . '" name="' . $result->image_name . '" onClick="selectsingleitem(this.id,' . $result->paired_id . ',\'displaybackbottom\',\'displayfrontbottom \',\'\',\'bottom\',\'dsplytogbottom\');" /></div></div>';
						endif;
					endforeach;
					$html .= '</div></div>
                    <script>
                    $("#displaybackbottomcarousel").owlCarousel({
                        loop:true,
                        margin:10,
                        nav:true,
                        items:3,
                        responsive:{
                            0:{
                                margin:10,
                            },
                            767:{
                                margin:23,
                            }
                        }
                    })
                    </script>';
					return $html;
					exit;
				}
			}
		}
	}

	public function viewfulldressAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$this->_helper->layout()->disableLayout();
		$colorObj = new Chez_Model_DbTable_Color();
		$topfront = ($this->_request->getParam("topfront")) ? $this->_request->getParam("topfront") : 0;
		$topback = ($this->_request->getParam("topback")) ? $this->_request->getParam("topback") : 0;
		$bottomfront = ($this->_request->getParam("bottomfront")) ? $this->_request->getParam("bottomfront") : 0;
		$bottomback = ($this->_request->getParam("bottomback")) ? $this->_request->getParam("bottomback") : 0;
		$leftsleeve = ($this->_request->getParam("leftsleeve")) ? $this->_request->getParam("leftsleeve") : 0;
		$rightsleeve = ($this->_request->getParam("rightsleeve")) ? $this->_request->getParam("rightsleeve") : 0;
		$topfrontcolor = ($this->_request->getParam("topfrontcolor")) ? $this->_request->getParam("topfrontcolor") : 0;
		$topbackcolor = ($this->_request->getParam("topbackcolor")) ? $this->_request->getParam("topbackcolor") : 0;
		$bottomfrontcolor = ($this->_request->getParam("bottomfrontcolor")) ? $this->_request->getParam("bottomfrontcolor") : 0;
		$bottombackcolor = ($this->_request->getParam("bottombackcolor")) ? $this->_request->getParam("bottombackcolor") : 0;
		$leftsleevecolor = ($this->_request->getParam("leftsleevecolor")) ? $this->_request->getParam("leftsleevecolor") : 0;
		$rightsleevecolor = ($this->_request->getParam("rightsleevecolor")) ? $this->_request->getParam("rightsleevecolor") : 0;
		$skincolor = $this->_request->getParam("skincolor");
		$bodytype = $this->_request->getParam("bodytype");
		$this->view->bodytype = $bodytype;
		$this->view->topfront = $topfront;
		$this->view->topback = $topback;
		$this->view->bottomfront = $bottomfront;
		$this->view->bottomback = $bottomback;
		$this->view->leftsleeve = $leftsleeve;
		$this->view->rightsleeve = $rightsleeve;
		$topfrontcolorRow = $colorObj->fetchRow("id='$topfrontcolor'");
		if (sizeof($topfrontcolorRow) > 0) {
			$this->view->topfrontcolor = $topfrontcolorRow->code;
		}
		$topbackcolorRow = $colorObj->fetchRow("id='$topbackcolor'");
		if (sizeof($topbackcolorRow) > 0) {
			$this->view->topbackcolor = $topbackcolorRow->code;
		}
		$bottomfrontcolorRow = $colorObj->fetchRow("id='$bottomfrontcolor'");
		if (sizeof($bottomfrontcolorRow) > 0) {
			$this->view->bottomfrontcolor = $bottomfrontcolorRow->code;
		}
		$bottombackcolorRow = $colorObj->fetchRow("id='$bottombackcolor'");
		if (sizeof($bottombackcolorRow) > 0) {
			$this->view->bottombackcolor = $bottombackcolorRow->code;
		}
		$leftsleeveRow = $colorObj->fetchRow("id='$leftsleevecolor'");
		if (sizeof($leftsleeveRow) > 0) {
			$this->view->leftsleevecolor = $leftsleeveRow->code;
		}
		$rightsleeveRow = $colorObj->fetchRow("id='$rightsleevecolor'");
		if (sizeof($rightsleeveRow) > 0) {
			$this->view->rightsleevecolor = $rightsleeveRow->code;
		}
		$skincolorRow = $colorObj->fetchRow("id='$skincolor'");
		if (sizeof($skincolorRow) > 0) {
			$this->view->skincolor = $skincolorRow->code;
		}
	}

	public function editimageAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$inspirationImagesObj = new Chez_Model_DbTable_InspirationImages();
		$inspimgId = $this->_request->getParam("idimg");
		$inspimgRow = $inspirationImagesObj->fetchAll("chez_inspiration_id='$inspimgId'");
		$this->view->inspimgRow = $inspimgRow;
		$fashionwallimg = $this->_request->getParam("hiddenVal");
		if ($this->_request->isPost()) {
			$pict = "";
			$pic = $_FILES['addpicsFile'];
			$i = 0;
			foreach ($pic['name'] as $p) {
				$image[$i]['name'] = $p;
				$i++;
			}
			$i = 0;
			foreach ($pic['type'] as $p) {
				$image[$i]['type'] = $p;
				$i++;
			}
			$i = 0;
			foreach ($pic['tmp_name'] as $p) {
				$image[$i]['tmp_name'] = $p;
				$i++;
			}
			$i = 0;
			foreach ($pic['size'] as $p) {
				$image[$i]['size'] = $p;
				$i++;
			}
			$lastupdatedate = date("Y-m-d H:i:s");
			//$data = array("category_id"=>$category,"occasion_id"=>$occasion,"title"=>$title,"description"=>$description,"price"=>$price,"lastupdatedate"=>$lastupdatedate);
			//$inspirationObj->insert($data);
			//$id = $inspirationObj->getAdapter()->lastInsertId();

			foreach ($image as $r) {
				if (($r['type'] == "image/gif" || $r['type'] == "image/jpeg" || $r['type'] == "image/jpg" || $r['type'] == "image/pjpeg")) {
					//$userid = $authUserNamespace->userid;
					$img_type = $r['type'];
					$temp = $r['tmp_name'];
					$fd = fopen($temp, "rb");
					$img_content = fread($fd, $r['size']);

					//the resizing is going on here!
					$data2 = array("chez_inspiration_id" => $inspimgId, "image_type" => $img_type, "img_content" => $img_content, "lastupdatedate" => $lastupdatedate);
					$inspirationImagesObj->insert($data2);
				}
			}
			$fashionwallObj = new Chez_Model_DbTable_Fashionwall();
			$fashionwallAll = $fashionwallObj->fetchAll();
			$fashionwallArray = explode(",", $fashionwallimg);
			for ($i = 0; $i < sizeOf($fashionwallArray); $i++) {
				if ($fashionwallArray[$i] != "") {
					$fashionImgs = $fashionwallObj->fetchRow("id='$fashionwallArray[$i]'");
					$fashionwallimgtype = $fashionImgs->image_type;
					$fashionwallimgcontent = $fashionImgs->img_content;
					$data4 = array("chez_inspiration_id" => $inspimgId, "image_type" => $fashionwallimgtype, "img_content" => $fashionImgs->img_content, "lastupdatedate" => $lastupdatedate);
					$inspirationImagesObj->insert($data4);
					//$this->_redirect('/admininspiration/index');
				}
			}
			$authUserNamespace->status_message_inspiration = "Image Added Successfully";
			$this->_redirect('/admininspiration/editimage/idimg/' . $inspimgId);
		}
	}

	public function addinspirationAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$inspirationImagesObj = new Chez_Model_DbTable_InspirationImages();
		$lovObj = new Chez_Model_DbTable_Lov();
		$OccasionCategoryObj = new Chez_Model_DbTable_OccasionCategory();
		$bodyTypeObj = new Chez_Model_DbTable_BodyType();
		$dressObj = new Chez_Model_DbTable_Dress();
		//$this->_helper->layout()->disableLayout();
		$category_rows = $lovObj->fetchAll($lovObj->select()
				->from(array("l" => DATABASE_PREFIX . 'lov'), array('id', 'value'))
				->where("type='occasion'")
		);
		$this->view->occasion = $category_rows;
		$size_rows = $lovObj->fetchAll($lovObj->select()
				->from(array("l" => DATABASE_PREFIX . 'lov'), array('id', 'value'))
				->where("type='inspiration_size'")
		);
		$this->view->size = $size_rows;
		$occasion_rows = $OccasionCategoryObj->fetchAll();
		$this->view->category = $occasion_rows;
		$bodytype_rows = $bodyTypeObj->fetchAll();
		$this->view->bodytype = $bodytype_rows;
		if ($this->_request->isPost()) {
			$pageId = $this->_request->getParam("id");
			$dressimg = $this->_request->getParam("dressimg");
			$category = $this->_request->getParam("category");
			$occasion = $this->_request->getParam("occasion");
			$bodytype = $this->_request->getParam("bodytype");
			$title = $this->_request->getParam("title");
			$description = $this->_request->getParam("description");
			$sizes = $this->_request->getParam("size");
			$price = $this->_request->getParam("price");
			$fashionwallimg = $this->_request->getParam("hiddenVal");
			if ($this->_request->isXmlHttpRequest()) {
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender(true);
				$response = array();
				$filecheck = basename($dressimg);
				$ext = substr($filecheck, strrpos($filecheck, '.') + 1);
				$ext = strtolower($ext);
				if ($category == "") {
					$response["data"]["category"] = "null";
				} else {
					$response["data"]["category"] = "valid";
				}

				if ($occasion == "") {
					$response["data"]["occasion"] = "null";
				} else {
					$response["data"]["occasion"] = "valid";
				}

				if ($bodytype == "") {
					$response["data"]["bodytype"] = "null";
				} else {
					$response["data"]["bodytype"] = "valid";
				}

				if (!in_array('null', $response['data']) && !in_array('invalid', $response['data']) && !in_array('duplicate_combination', $response['data']) && !in_array('duplicate', $response['data'])) {
					$response['returnvalue'] = "success";
				} else {
					$response['returnvalue'] = "validation";
				}
				echo json_encode($response);
			} else {
				$dressRowall = $dressObj->fetchAll("category_id='$category' && occasion_id='$occasion' && body_type_id ='$bodytype'");
				$this->view->allrow = $dressRowall;
				$this->view->categoryIDs = $category;
				$this->view->occasionIDs = $occasion;
				$this->view->bodytypeIDs = $bodytype;
				if (sizeof($dressRowall) > 0) {
					$k = 0;
					foreach ($dressRowall as $dressrows) {
						$topfront[$k] = $dressrows->top_front_id;
						$topback[$k] = $dressrows->top_back_id;
						$bottomfront[$k] = $dressrows->bottom_front_id;
						$bottomback[$k] = $dressrows->bottom_back_id;
						$leftsleeve[$k] = $dressrows->left_sleeve_id;
						$rightsleeve[$k] = $dressrows->right_sleeve_id;
						$colors[$k] = $dressrows->color_id;
						$k++;
					}
					$this->view->topfront_id = $topfront;
					$this->view->topback_id = $topback;
					$this->view->bottomfront_id = $bottomfront;
					$this->view->bottomback_id = $bottomback;
					$this->view->leftsleeve_id = $leftsleeve;
					$this->view->rightsleeve_id = $rightsleeve;
					$this->view->colors_id = $colors;
					//$this->_redirect('/admininspiration/addinspiration');
				}
			}
		}
	}

	public function addfinalinspirationAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$inspirationImagesObj = new Chez_Model_DbTable_InspirationImages();
		$lovObj = new Chez_Model_DbTable_Lov();
		$OccasionCategoryObj = new Chez_Model_DbTable_OccasionCategory();
		$bodyTypeObj = new Chez_Model_DbTable_BodyType();
		$dressObj = new Chez_Model_DbTable_Dress();

		if ($this->_request->isPost()) {
			$pageId = $this->_request->getParam("id");
			$dressimg = $this->_request->getParam("dressimg");
			$category = $this->_request->getParam("hiddenValcategory");
			$occasion = $this->_request->getParam("hiddenValoccasion");
			$bodytype = $this->_request->getParam("hiddenValbodytype");
			$title = $this->_request->getParam("title");
			$description = $this->_request->getParam("description");
			$sizes = $this->_request->getParam("size");
			$price = $this->_request->getParam("price");
			$hmpimg = $this->_request->getParam("hmpimg");
			$order = $this->_request->getParam("order");

			$topfront = ($this->_request->getParam("hiddenValtopfront")) ? $this->_request->getParam("hiddenValtopfront") : 0;
			$topfrontcolor = ($this->_request->getParam("hiddenValtopfrontcolors")) ? $this->_request->getParam("hiddenValtopfrontcolors") : 0;
			$topback = ($this->_request->getParam("hiddenValtopback")) ? $this->_request->getParam("hiddenValtopback") : 0;
			$topbackcolor = ($this->_request->getParam("hiddenValtopbackcolors")) ? $this->_request->getParam("hiddenValtopbackcolors") : 0;
			$bottomfront = ($this->_request->getParam("hiddenValbottomfront")) ? $this->_request->getParam("hiddenValbottomfront") : 0;
			$bottomfrontcolor = ($this->_request->getParam("hiddenValbottomfrontcolors")) ? $this->_request->getParam("hiddenValbottomfrontcolors") : 0;
			$bottomback = ($this->_request->getParam("hiddenValbottomback")) ? $this->_request->getParam("hiddenValbottomback") : 0;
			$bottombackcolor = ($this->_request->getParam("hiddenValbottombackcolors")) ? $this->_request->getParam("hiddenValbottombackcolors") : 0;
			$leftsleeve = ($this->_request->getParam("hiddenValleftsleeve")) ? $this->_request->getParam("hiddenValleftsleeve") : 0;
			$leftsleevecolor = $this->_request->getParam("hiddenValleftsleevecolors");
			$rightsleeve = $this->_request->getParam("hiddenValrightsleeve");
			$rightsleevecolor = $this->_request->getParam("hiddenValrightsleevecolors");
			$hiddenValskincolors = $this->_request->getParam("hiddenValskincolors");
			$hiddenValfashionwall = $this->_request->getParam("hiddenValfashionwall");

			if ($this->_request->isXmlHttpRequest()) {
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender(true);
				$response = array();
				$filecheck = basename($dressimg);
				$ext = substr($filecheck, strrpos($filecheck, '.') + 1);
				$ext = strtolower($ext);
//              if($category == "")$response["data"]["category"] = "null";
				//              else $response["data"]["category"] = "valid";
				//
				//              if($occasion == "")$response["data"]["occasion"] = "null";
				//              else $response["data"]["occasion"] = "valid";
				//
				//              if($bodytype == "")$response["data"]["bodytype"] = "null";
				//              else $response["data"]["bodytype"] = "valid";
				if ($title == "") {
					$response["data"]["title"] = "null";
				} else {
					$response["data"]["title"] = "valid";
				}

				if ($description == "") {
					$response["data"]["description"] = "null";
				} else {
					$response["data"]["description"] = "valid";
				}

				if ($price == "") {
					$response["data"]["price"] = "null";
				} else {
					$response["data"]["price"] = "valid";
				}

				if ($order == "") {
					$response["data"]["order"] = "null";
				} else {
					$response["data"]["order"] = "valid";
				}

				if ($topfront == "") {
					$response["data"]["topfrontimg"] = "null";
				} else {
					$response["data"]["topfrontimg"] = "valid";
				}

				if ($topfrontcolor == "") {
					$response["data"]["topfrontcolor"] = "null";
				} else {
					$response["data"]["topfrontcolor"] = "valid";
				}

				if ($topback == "") {
					$response["data"]["topbackimg"] = "null";
				} else {
					$response["data"]["topbackimg"] = "valid";
				}

				if ($topbackcolor == "") {
					$response["data"]["topbackcolor"] = "null";
				} else {
					$response["data"]["topbackcolor"] = "valid";
				}

				if ($bottomfront == "") {
					$response["data"]["bottomfrontimg"] = "null";
				} else {
					$response["data"]["bottomfrontimg"] = "valid";
				}

				if ($bottomfrontcolor == "") {
					$response["data"]["bottomfrontcolor"] = "null";
				} else {
					$response["data"]["bottomfrontcolor"] = "valid";
				}

				if ($bottomback == "") {
					$response["data"]["bottombackimg"] = "null";
				} else {
					$response["data"]["bottombackimg"] = "valid";
				}

				if ($bottombackcolor == "") {
					$response["data"]["bottombackcolor"] = "null";
				} else {
					$response["data"]["bottombackcolor"] = "valid";
				}

				if ($leftsleeve == "") {
					$response["data"]["leftsleeveimg"] = "null";
				} else {
					$response["data"]["leftsleeveimg"] = "valid";
				}

				if ($leftsleevecolor == "") {
					$response["data"]["leftsleevecolor"] = "null";
				} else {
					$response["data"]["leftsleevecolor"] = "valid";
				}

				if ($rightsleeve == "") {
					$response["data"]["rightsleeveimg"] = "null";
				} else {
					$response["data"]["rightsleeveimg"] = "valid";
				}

				if ($rightsleevecolor == "") {
					$response["data"]["rightsleevecolor"] = "null";
				} else {
					$response["data"]["rightsleevecolor"] = "valid";
				}

				if ($hiddenValskincolors == "") {
					$response["data"]["skincolor"] = "null";
				} else {
					$response["data"]["skincolor"] = "valid";
				}

				if ($hiddenValfashionwall == "") {
					$response["data"]["fashionwallimg"] = "null";
				} else {
					$response["data"]["fashionwallimg"] = "valid";
				}

				if (!in_array('null', $response['data']) && !in_array('invalid', $response['data']) && !in_array('duplicate_combination', $response['data']) && !in_array('duplicate', $response['data'])) {
					$response['returnvalue'] = "success";
				} else {
					$response['returnvalue'] = "validation";
				}
				echo json_encode($response);
			} else {
				$lastupdatedate = date("Y-m-d H:i:s");
				if ($hmpimg == "on") {
					$hmpimg = "y";
				} else {
					$hmpimg = "n";
				}

				$hostName = $_SERVER['HTTP_HOST'];
				//$imgext = explode("/",$img_type1);
				$target_path1 = "docs/finaldress/dress0.png";
				$target_path2 = "docs/finaldress/dress1.png";
				$newpathtarget1 = $hostName . "/" . $target_path1;
				$newpathtarget2 = $hostName . "/" . $target_path2;
				//imagepng( $img,$target_path1 );
				$filecheck = basename($newpathtarget1);
				$filecheck1 = basename($newpathtarget2);
				$ext = substr($filecheck, strrpos($filecheck, '.') + 1);
				$ext = strtolower($ext);
				if ($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "pjpeg" || $ext == "png") {
					$image_type = "image/" . $ext;
				}
				$ext1 = substr($filecheck1, strrpos($filecheck1, '.') + 1);
				$ext1 = strtolower($ext1);
				if ($ext1 == "jpg" || $ext1 == "jpeg" || $ext1 == "gif" || $ext1 == "pjpeg" || $ext1 == "png") {
					$image_type1 = "image/" . $ext;
				}
				$imagecontent = file_get_contents("http://" . $newpathtarget1);
				$imagecontent1 = file_get_contents("http://" . $newpathtarget2);
				$jpeg_quality = 90;
				$ThumbWidth = 240;
				$ThumbHeight = 280;
				//$src = file_get_contents($temp1);
				$img_r = imagecreatefromstring($imagecontent);
				list($width, $height) = getimagesize("http://" . $newpathtarget1);
				$img_r_b = imagecreatefromstring($imagecontent1);
				list($widthB, $heightB) = getimagesize("http://" . $newpathtarget2);
				//calculate the image ratio
				$imgratio = $width / $height;
				$newheight = $ThumbHeight;
				$newwidth = $ThumbWidth;

				// create a new temporary image
				//$tmp_img = imagecreatetruecolor( $newwidth, $newheight );
				$width = imagesx($img_r);
				$height = imagesy($img_r);
				$width_b = imagesx($img_r_b);
				$height_b = imagesy($img_r_b);
				$img = imagecreatetruecolor($newwidth, $newheight);
				// enable alpha blending on the destination image.
				imagealphablending($img, true);
				// Allocate a transparent color and fill the new image with it.
				// Without this the image will have a black background instead of being transparent.
				$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
				imagefill($img, 0, 0, $transparent);
				// copy the frame into the output image (layered on top of the thumbnail)
				imagecopyresampled($img, $img_r, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				imagecopyresampled($img, $img_r_b, 0, 0, 0, 0, $newwidth, $newheight, $width_b, $height_b);
				imagealphablending($img, false);
				// save the alpha
				imagesavealpha($img, true);
				$hostName = $_SERVER['HTTP_HOST'];
				$imgext = explode("/", $img_type1);
				$target_path6 = "docs/finaldress/dress0_thumb.png";
				$target_path8 = "docs/finaldress/dress1_thumb.png";
				$newpathtarget6 = $hostName . "/" . $target_path6;
				$newpathtarget8 = $hostName . "/" . $target_path8;
				imagepng($img, $target_path6);
				imagepng($img, $target_path8);

				$data4 = array("category_id" => $category, "occasion_id" => $occasion, "body_type_id" => $bodytype, "skin_color" => $hiddenValskincolors, "fashionwall_id" => $hiddenValfashionwall, "top_front_id" => $topfront, "top_back_id" => $topback, "bottom_front_id" => $bottomfront, "bottom_back_id" => $bottomback, "left_sleeve_id" => intval($leftsleeve), "right_sleeve_id" => $rightsleeve, "top_front_color_id" => $topfrontcolor, "top_back_color_id" => $topbackcolor, "bottom_front_color_id" => $bottomfrontcolor, "bottom_back_color_id" => $bottombackcolor, "left_sleeve_color_id" => $leftsleevecolor, "right_sleeve_color_id" => $rightsleevecolor, "title" => $title, "description" => $description, "price" => $price, "home_page_image_flag" => $hmpimg, "home_page_image_order" => $order, "ds_image_type" => $image_type, "lastupdatedate" => $lastupdatedate);
				$inspirationObj->insert($data4);
				$this->_redirect('/admininspiration/index');
				//$dressRowall = $inspirationObj->fetchAll("category_id='$category' && occasion_id='$occasion' && body_type_id ='$bodytype'");
			}
		}
	}

	public function addcategoryAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$this->_helper->layout()->setLayout("admin");
		$authUserNamespace->admin_page_title = "Add Category";
		$occasioncatObj = new Chez_Model_DbTable_OccasionCategory();
		if ($this->_request->isPost()) {
			$category = $this->_request->getParam('category');
			$response = array();
			if ($this->_request->isXmlHttpRequest()) {
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender(true);

				if ($category == "") {
					$response["data"]["category"] = "null";
				} else {
					$response["data"]["category"] = "valid";
				}

				if (!in_array('null', $response['data']) && !in_array('invalid', $response['data']) && !in_array('notmatch', $response['data']) && !in_array('duplicate', $response['data'])) {
					$response['returnvalue'] = "success";
				} else {
					$response['returnvalue'] = "validation";
				}

				echo json_encode($response);
			} else {
				$data = array("name" => $category);
				$occasioncatObj->insert($data);
				$authUserNamespace->status_message_category = "Data Added Successfully";
				$this->_redirect('/admininspiration/categorylist');
			}
		}
	}

	public function categorylistAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$authUserNamespace->admin_page_title = "Manage Category";
		$occasioncatObj = new Chez_Model_DbTable_OccasionCategory();
		$records_per_page = $this->_request->getParam('shown');
		$this->view->records_per_page = $records_per_page;
		$searchText = addslashes($this->_request->getParam('searchtext'));
		$this->view->search_val = stripcslashes($searchText);
		if ($records_per_page == "") {
			$records_per_page = $this->_request->getParam('getPageValue');
			$this->view->records_per_page = $records_per_page;
		}
		if ($searchText != "") {
			$categoryrowResult = $occasioncatObj->fetchAll($occasioncatObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "occasion_category"))
					->where("c.name like '%" . $searchText . "%'"));
		} else {
			$categoryrowResult = $occasioncatObj->fetchAll($occasioncatObj->select());
		}
		if (isset($categoryrowResult) && $categoryrowResult != "") {
			$this->view->categoryrowResult = $categoryrowResult;
		}
		/* pagination code */
		$page = $this->_request->getParam('page', 1);
		//$this->view->page = $page;
		if ($records_per_page == "") {
			$records_per_page = 10;
		}

		$record_count = sizeof($categoryrowResult);
		$paginator = Zend_Paginator::factory($categoryrowResult);
		$paginator->setItemCountPerPage($records_per_page);
		$paginator->setCurrentPageNumber($page);
		$this->view->pagination_config = array('total_items' => $record_count, 'items_per_page' => $records_per_page, 'style' => 'digg');
		$this->view->categoryrowResult = $paginator;
		$page_number = $record_count / 1;
		$page_number_last = floor($page_number);
	}

	public function editcategoryAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$authUserNamespace->admin_page_title = "Edit Category";
		$OccasionCategoryObj = new Chez_Model_DbTable_OccasionCategory();
		$id = $this->_request->getParam('id');
		if (isset($id)) {
			$selectedCategory = $OccasionCategoryObj->fetchRow($OccasionCategoryObj->select()
					->where("id='$id'"));
			$selectedCatName = $selectedCategory->name;
			$this->view->selectedCatName = $selectedCatName;
		}
		if ($this->_request->isPost()) {
			$category = $this->_request->getParam("category");
			if ($this->_request->isXmlHttpRequest()) {
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender(true);
				$response = array();
				if ($category == "") {
					$response["data"]["category"] = "null";
				} else {
					$response["data"]["category"] = "valid";
				}

				if (!in_array('null', $response['data']) && !in_array('invalid', $response['data']) && !in_array('duplicate_combination', $response['data']) && !in_array('duplicate', $response['data'])) {
					$response['returnvalue'] = "success";
				} else {
					$response['returnvalue'] = "validation";
				}
				echo json_encode($response);
			} else {
				$data = array("name" => $category);
				$OccasionCategoryObj->update($data, "id='$id'");
				$authUserNamespace->status_message_category = "Data Updated Successfully";
				$this->_redirect('/admininspiration/categorylist');
			}
		}
	}

	public function deletecategoryAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$occasioncatObj = new Chez_Model_DbTable_OccasionCategory();
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$id = $this->_request->getParam("id");
		$occasioncatObj->delete("id='$id'");
		$authUserNamespace->status_message_category = "Data Deleted Successfully";
		$this->_redirect('/admininspiration/categorylist');
	}

	public function saveimageAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (isset($authUserNamespace->userid) && $authUserNamespace->userid != "") {
			$userid = $authUserNamespace->userid;
		} else {
			// if user not logged in
			$userid = 0;
		}

		$imagepreid = $authUserNamespace->ds_image_pre_id;
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$params = $this->_request->getParams();
				foreach ($params as $key => $data) {
					if ($key != "controller" && $key != "action" && $key != "module" && $key != "rfr") {
						$this->saveimagecreater($key, $data, $userid, $imagepreid);
					}
				}
			}
		}
		/*added*/

		echo json_encode('succeess');
		exit;
	}

	public function saveimagecreater($name, $tmp_data, $userid, $imagepreid) {
		$image_data = urldecode($tmp_data);
		$image_data = str_replace(' ', '+', $image_data);
		$arr = explode(",", $image_data);
		$data = base64_decode($arr[1]);
		$im = imagecreatefromstring($data);
		$width = imagesx($im);
		$height = imagesy($im);
		$img = imagecreatetruecolor($width, $height);
		// enable alpha blending on the destination image.
		imagealphablending($img, true);
		// Allocate a transparent color and fill the new image with it.
		// Without this the image will have a black background instead of being transparent.
		$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
		imagefill($img, 0, 0, $transparent);
		// copy the frame into the output image (layered on top of the thumbnail)
		imagecopyresampled($img, $im, 0, 0, 0, 0, $width, $height, $width, $height);
		imagealphablending($img, false);
		// save the alpha
		imagesavealpha($img, true);
		// emit the image
		if ($name === 'finalfront') {
			$name = "finaldress-front";
			//========== Sunil : Start Resize Images ==============//
			$this->createfinalthumbimage($data, $userid, $imagepreid, $name);
			//========== Sunil : End Resize Images ==============//
		}
		if ($name === 'finalback') {
			$name = "finaldress-back";
			//========== Sunil : Start Resize Images ==============//
			$this->createfinalthumbimage($data, $userid, $imagepreid, $name);
			//========== Sunil : End Resize Images ==============//
		}

		// $dress_upload_path = "uploads/dresses/" . $imagepreid . "-" . $userid . "-" . $name . ".png";
		$dress_upload_path = "uploads/dresses/" . $imagepreid . "-" . $name . ".png";
		imagepng($img, $dress_upload_path);
		@chmod($dress_upload_path, 0755);
		return true;
	}

	public function createfinalthumbimage($data, $userid, $imagepreid, $name) {
		$im = imagecreatefromstring($data);
		$width = imagesx($im);
		$height = imagesy($im);

		$img = imagecreatetruecolor(117, 255);
		imagealphablending($img, true);
		$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
		imagefill($img, 0, 0, $transparent);
		imagecopyresampled($img, $im, 0, 0, 0, 0, 117, 255, $width, $height);

		imagealphablending($img, false);
		// save the alpha
		imagesavealpha($img, true);
		// $dress_upload_path = "uploads/dresses/" . $imagepreid . "-" . $userid . "-" . $name . "-thumb.png";
		$dress_upload_path = "uploads/dresses/" . $imagepreid . "-" . $name . "-thumb.png";
		imagepng($img, $dress_upload_path);
		@chmod($dress_upload_path, 0755);
		return true;
	}

	public function getdresspriceAction() {
		/*
			        $authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
			        if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "")
			            $this->_redirect("/login");
		*/
		$this->_helper->layout()->disableLayout();
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$garmenttypeObj = new Chez_Model_DbTable_GarmentTypePieces();
		$printpieceObj = new Chez_Model_DbTable_Print();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$topfrontpr = $this->_request->getParam("topfrontpr");
				$topfrontprRow = $dresspieceObj->fetchRow("id='$topfrontpr'");
				$topbackpr = $this->_request->getParam("topbackpr");
				$topbackprRow = $dresspieceObj->fetchRow("id='$topbackpr'");
				$bottomfrontpr = $this->_request->getParam("bottomfrontpr");
				$bottomfrontprRow = $dresspieceObj->fetchRow("id='$bottomfrontpr'");
				$bottombackpr = $this->_request->getParam("bottombackpr");
				$bottombackprRow = $dresspieceObj->fetchRow("id='$bottombackpr'");
				$leftsleevepr = $this->_request->getParam("leftsleevepr");
				$leftsleeveprRow = $dresspieceObj->fetchRow("id='$leftsleevepr'");
				$leftbacksleevepr = $this->_request->getParam("leftbacksleevepr");
				$leftbacksleeveprRow = $dresspieceObj->fetchRow("id='$leftbacksleevepr'");
				$rightsleevepr = $this->_request->getParam("rightsleevepr");
				$rightsleeveprRow = $dresspieceObj->fetchRow("id='$rightsleevepr'");
				$rightbacksleevepr = $this->_request->getParam("rightbacksleevepr");
				$rightbacksleeveprRow = $dresspieceObj->fetchRow("id='$rightbacksleevepr'");
				$topprintid = $this->_request->getParam("topprint");
				$bottomprintid = $this->_request->getParam("bottomprint");
				$dsplytogtext = $this->_request->getParam("displytogdrss");
				$garmentid = $this->_request->getParam("garmentid");
				$fabric = $this->_request->getParam("fabric");
				if ($fabric == 'premium') {
					$fabricprice = 25;
				}
				$dresspieces = $garmenttypeObj->fetchAll($garmenttypeObj->select()
						->from(array('g' => DATABASE_PREFIX . "garment_type_pieces"), array('dresspiece_id'))
						->where("garment_type_id in ('$garmentid')"));
				$dresspiece_ids = $dresspieces->toarray();
				$garmntassoc_id = array();
				foreach ($dresspiece_ids as $dress_id) {
					$garmntassoc_id[] = $dress_id['dresspiece_id'];
				}

				$pr1 = 0;
				$pr2 = 0;
				$pr3 = 0;
				$pr4 = 0;
				$pr5 = 0;
				$pr6 = 0;
				$pr7 = 0;
				$pr8 = 0;
				$pr9 = 0;
				$pr10 = 0;

				if (sizeof($topfrontprRow) > 0) {
					$pr1 = $topfrontprRow->price;
				}
				if (sizeof($topbackprRow) > 0) {
					$pr2 = $topbackprRow->price;
				}
				if (sizeof($bottomfrontprRow) > 0) {
					$pr3 = $bottomfrontprRow->price;
				}
				if (sizeof($bottombackprRow) > 0) {
					$pr4 = $bottombackprRow->price;
				}
				if (sizeof($leftsleeveprRow) > 0) {
					$pr5 = $leftsleeveprRow->price;
				}
				if (sizeof($leftbacksleeveprRow) > 0) {
					$pr7 = $leftbacksleeveprRow->price;
				}
				if (sizeof($rightsleeveprRow) > 0) {
					$pr6 = $rightsleeveprRow->price;
				}
				if (sizeof($rightbacksleeveprRow) > 0) {
					$pr8 = $rightbacksleeveprRow->price;
				}
				if ($topprintid > 0 && $bottomprintid > 0 && $topprintid != $bottomprintid) {
					$topprintRow = $printpieceObj->fetchRow("print_id='$topprintid'");
					$bottomprintRow = $printpieceObj->fetchRow("print_id='$bottomprintid'");
					$pr9 = $topprintRow->print_price;
					$pr10 = $bottomprintRow->print_price;
				} else if ($topprintid > 0 && $bottomprintid > 0 && $topprintid == $bottomprintid) {
					$topprintRow = $printpieceObj->fetchRow("print_id='$topprintid'");
					$pr9 = $topprintRow->print_price;
					$pr10 = $topprintRow->print_price;
				} else if ($topprintid > 0 && empty($bottomprintid)) {
					$topprintRow = $printpieceObj->fetchRow("print_id='$topprintid'");
					$pr9 = $topprintRow->print_price;
				} else if ($bottomprintid > 0 && empty($topprintid)) {
					$bottomprintRow = $printpieceObj->fetchRow("print_id='$bottomprintid'");
					$pr10 = $bottomprintRow->print_price;
				}
				$topprice = $pr1 + $pr2 + $pr5 + $pr6 + $pr7 + $pr8 + $pr9 + $fabricprice;
				$bottmprice = $pr3 + $pr4 + $pr10 + $fabricprice;
				$price = $topprice + $bottmprice;
				$response = array();
				if (isset($dsplytogtext) && $dsplytogtext == "dsplytogbottom") {
					$response["bottmprice"] = (int) $bottmprice;
					$response["rmvebottm"] = 'removebottom';
				} else if (isset($dsplytogtext) && $dsplytogtext == "dsplytogtop") {
					$response["topprice"] = (int) $topprice;
					$response["rmvetop"] = 'removetop';
				} else if (in_array('1', $garmntassoc_id) && in_array('2', $garmntassoc_id)) {
					$response["price"] = $price;
				} else {
					$response["topprice"] = (int) $topprice;
					$response["bottmprice"] = (int) $bottmprice;
				}
				echo json_encode($response);
				exit;
			}
		}
	}

	public function viewimagemainAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/login");
		}

		$dresspiceObj = new Chez_Model_DbTable_DressPiece();
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$image_content = $this->_request->getParam("image_content");
		$view_img = $dresspiceObj->fetchRow("id='$img_id'");
		$content = $view_img->image_content;
		$img_type = $view_img->image_type;

		if (isset($content)) {
			print $content;
		}

	}

	public function getstyleAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$this->_helper->layout()->disableLayout();
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$userbodyObj = new Chez_Model_DbTable_UserModel();
		$ds_dressObj = new Chez_Model_DbTable_Dress();
		$garmentid = $this->_request->getParam("garmentid");
		$occasion_id = $this->_request->getParam("occasion_id");
		$bodytype = $this->_request->getParam("bodytype");
		$jass_style = '';

		if (!isset($authUserNamespace->userid) || $authUserNamespace->userrole != 'admin') {
			$where = "garment_type_id='$garmentid' AND occasion_id='$occasion_id' AND body_type_id='$bodytype' AND visible_to = 1";
		} else {
			$where = "garment_type_id='$garmentid' AND occasion_id='$occasion_id' AND body_type_id='$bodytype'";
		}
		//prd($where);
		$ds_dressObjResult = $ds_dressObj->fetchAll($ds_dressObj->select()
				->from(array('c' => DATABASE_PREFIX . "ds_dress"))
				->where($where)
				->order(array("lastupdatedate DESC")));
		$jass_style .= '<div id="ca-wrapper" class="owl-carousel">';
		foreach ($ds_dressObjResult as $styleResult) {
			if ($styleResult->top_front_id == null && $styleResult->top_back_id == null) {
				continue;
			}

			$topfrontIds = $this->serializeDressPieces($styleResult->top_front_id, $styleResult->topfront_order);
			$topbackIds = $this->serializeDressPieces($styleResult->top_back_id, $styleResult->topback_order);
			$bottomfrontids = $this->serializeDressPieces($styleResult->bottom_front_id, $styleResult->frontbottom_order);
			$bottombackids = $this->serializeDressPieces($styleResult->bottom_back_id, $styleResult->backbottom_order);
			$topfrontId = $topfrontIds[0];
			$topbackId = $topbackIds[0];
			$bottomfrontid = $bottomfrontids[0];
			$bottombackid = $bottombackids[0];
			$search_occasion = implode('-', array_filter(explode(',', $styleResult->search_occasion)));
			$special_events = implode('-', array_filter(explode(',', $styleResult->special_events)));
			$global_inspiration = implode('-', array_filter(explode(',', $styleResult->global_inspiration)));

			/*
				            if ($topfrontId != ''):
				                $resultobjt = $this->getdressimages($topfrontId);
				                $img1 = '<span class="img1"><img src="' . SILHOUETTEGETORIGINAL . '/' . $resultobjt->image_name . '"></span>';
				            endif;
				            if ($bottomfrontid != ''):
				                $resultobjb = $this->getdressimages($bottomfrontid);
				                $img2 = '<span class="img2"><img src="' . SILHOUETTEGETORIGINAL . '/' . $resultobjb->image_name . '"></span>';
				            endif;
			*/

			//manage the image positions in each conditions.
			if ($topfrontId != '' && $bottomfrontid != ''):
				$resultobjt = $this->getdressimages($topfrontId);
				$resultobjb = $this->getdressimages($bottomfrontid);
				$img1 = '<span class="img1"><img class="lazyOwl" src="' . SILHOUETTEGETORIGINAL . $resultobjt->image_name . '"></span>';
				$img2 = '<span class="img2"><img class="lazyOwl" src="' . SILHOUETTEGETORIGINAL . $resultobjb->image_name . '"></span>';
			elseif ($topfrontId != '' && $bottomfrontid == ''):
				$resultobjt = $this->getdressimages($topfrontId);
				$img1 = '<span class="img1"><img class="lazyOwl" src="' . SILHOUETTEGETORIGINAL . $resultobjt->image_name . '"></span>';
			elseif ($topfrontId == '' && $bottomfrontid != ''):
				$resultobjb = $this->getdressimages($bottomfrontid);
				$img2 = '<span class="img3"><img class="lazyOwl" src="' . SILHOUETTEGETORIGINAL . $resultobjb->image_name . '"></span>';
			endif;

			$jass_style .= '<div class="item" id="' . $styleResult->id . '_ca-item-all"><img src="' . APPLICATION_URL . 'uploads/silhouette/placeholder-713x1056.png" alt="placeholder-713x1056"/><a id="' . $styleResult->id . '_ca-item-all" onclick=stylechnage(\'' . $styleResult->id . '_ca-item-all_topFrnt-' . $topfrontId . '_botfrnt-' . $bottomfrontid . '_topback-' . $topbackId . '_botback-' . $bottombackid . '\',\'' . $search_occasion . '\',\'' . $special_events . '\',\'' . $global_inspiration . '\')>' . $img1 . $img2 . '</a></div>';
		}
		$jass_style .= '</div>';
		echo json_encode($jass_style);
		exit;
	}

	private function serializeDressPieces($dressesstr, $ordersstr) {
		$results = [];
		if (isset($dressesstr) && $dressesstr != ""):
			$dresspiecesids = explode(",", trim($dressesstr, ","));
			$dresspiecesids = array_unique($dresspiecesids);
			if ($ordersstr != null):
				$orders = explode(',', $ordersstr);
				foreach ($orders as $order):
					$reduce[] = $order - 1;
				endforeach;
				$results = array_combine($reduce, $dresspiecesids);
				ksort($results);
			endif;
		endif;
		return $results;
	}

	private function getdressimages($id, $occasionid = NULL) {
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$result = '';
		if ($id != '') {
			$pieceobj = $dresspieceObj->fetchRow($dresspieceObj->select()
					->setIntegrityCheck(false)
					->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('image_type', 'image_name', 'paired_id', 'garment_type_id'))
					->joinLeft(array('viwslv' => DATABASE_PREFIX . "previewsleeve"), 'dss.paired_id=viwslv.paired_id', array('view_sleeve_image'))
					->where("dss.id='$id' AND dss.occasion_id LIKE '%$occasionid%'"));
			if (count($pieceobj) > 0):
				//$imgagename = $pieceobj->image_name;
				$result = $pieceobj;
			else:
				$result = '';
			endif;
		}
		return $result;
	}

	public function getimagebyajaxAction($id) {
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$id = $this->_request->getParam("id");
		$fronttopdata = $dresspieceObj->fetchRow($dresspieceObj->select()
				->setIntegrityCheck(false)
				->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('image_type', 'image_name'))
				->where('id = ?', $id));

		if (count($fronttopdata) > 0):
			$imgagename = $fronttopdata->image_name;
		else:
			$imgagename = '';
		endif;
		echo $imgagename;
		exit;
	}

	public function getwithassociateimageAction() {
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$id = $this->_request->getParam("id");
		$paired_id = $this->_request->getParam("paired_id");
		$type = $this->_request->getParam("type");

		$pieceobj = $dresspieceObj->fetchRow($dresspieceObj->select()
				->setIntegrityCheck(false)
				->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('id', 'image_type', 'image_name', 'paired_id'))
				->where('id != ?', $id)
				->where('paired_id = ?', $paired_id));

		$html = '';
		$imagename = '';
		if (count($pieceobj) > 0):
			$id = $pieceobj->id;
			$imagename = $pieceobj->image_name;
			$html .= '<div class="dressbox selectedbox">
													<img src="' . SILHOUETTEGETORIGINAL . '/' . $pieceobj->image_name . '" id="' . $type . '-' . $pieceobj->id . '" name ="' . $pieceobj->image_name . '" onClick="selectsingleitem(this.id,' . $pieceobj->paired_id . ');" /></div>';
		endif;
		$response = array();
		$response["id"] = $id;
		$response["image"] = $imagename;
		$response["html"] = $html;
		echo json_encode($response);
		exit;
	}

	public function getdressimagesajaxAction($id = NULL) {
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$params = $this->_request->getParams();
		$image = array();
		foreach ($params as $key => $id):
			if ($key != "controller" && $key != "action" && $key != "module"):
				$imageobj = $dresspieceObj->fetchRow($dresspieceObj->select()
						->setIntegrityCheck(false)
						->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('image_name'))
						->where('id = ?', $id));
				if (count($imageobj)):
					$image[$key] = $imageobj->image_name;
				endif;
			endif;
		endforeach;
		echo json_encode($image);
		exit;
	}

	public function getmodeldressesajaxAction($id = NULL) {
		$result = array();
		if (!empty($this->_request->getParam('issharemode'))) {
			$modelObj = new Chez_Model_DbTable_DsModelShare();
		} else {
			$modelObj = new Chez_Model_DbTable_DsModel();
		}
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$modelid = $this->_request->getParam('modelid');
		$bodytype = $this->_request->getParam('bodytype');

		$model = $modelObj->getModelDress($modelid);

		$params = array('topfrnt' => $model->top_front_id, 'topback' => $model->top_back_id, 'botfrnt' => $model->bottom_front_id, 'botback' => $model->bottom_back_id, 'leftfrontsleeve' => $model->left_sleeve_id, 'leftbacksleeve' => $model->left_back_sleeve_id, 'rightfrontsleeve' => $model->right_sleeve_id, 'rightbacksleeve' => $model->right_back_sleeve_id);

		foreach ($params as $key => $id):
			if ($id > 0):
				$result['image'][$key] = $dresspieceObj->getModelDressesImage($id, $bodytype);
			endif;
		endforeach;
		$result['attrs'] = $this->modelColorPrintAttrs($model);
		echo json_encode($result);
		exit;
	}

	private function modelColorPrintAttrs($model) {
		$result = array('color' => array(), 'print' => array());
		$colorObj = new Chez_Model_DbTable_Color();
		$printObj = new Chez_Model_DbTable_Print();
		if ($model->top_front_color_id > 0) {
			$color = $colorObj->getModelColor($model->top_front_color_id);
			$result['color']['top'] = array('id' => $color->id, 'name' => $color->name, 'code' => $color->code);
			if ($model->top_front_color_id == $model->bottom_front_color_id):
				$result['color']['bottom'] = array('id' => $color->id, 'name' => $color->name, 'code' => $color->code);
			endif;
		} else {
			//var_dump($model);die();

			//var_dump($model->top_print_id);die();
			//$prints = $printObj->getModelPrints($model->top_print_id);
			$prints = $printObj->getModelPrints($model->top_print_id);

			if ($prints->top_print_image != ''):
				$top_print = $prints->top_print_image;
			else:
				$top_print = $prints->user_print_image;
			endif;
			if ($prints->allover_top_print_image != ''):
				$allover_top_print = $prints->allover_top_print_image;
			else:
				$allover_top_print = $prints->user_print_image;
			endif;
			if ($prints->allover_bottom_print_image != ''):
				$allover_bottom_print = $prints->allover_bottom_print_image;
			else:
				$allover_bottom_print = $prints->user_print_image;
			endif;

			if ($model->top_print_id === $model->bottom_print_id):
				$result['print']['top'] = array('id' => $prints->print_id, 'name' => $prints->print_name, 'image' => $allover_top_print);
				$result['print']['bottom'] = array('id' => $prints->print_id, 'name' => $prints->print_name, 'image' => $allover_bottom_print);
			else:
				$result['print']['top'] = array('id' => $prints->print_id, 'name' => $prints->print_name, 'image' => $top_print);
			endif;
		}

		if ($model->bottom_front_color_id > 0) {
			if ($model->top_front_color_id !== $model->bottom_front_color_id):
				$color = $colorObj->getModelColor($model->bottom_front_color_id);
				$result['color']['bottom'] = array('id' => $color->id, 'name' => $color->name, 'code' => $color->code);
			endif;
		} else {
			if ($model->top_print_id !== $model->bottom_print_id):
				$prints = $printObj->getModelPrints($model->bottom_print_id);
				if ($prints->bottom_print_image != ''):
					$image = $prints->bottom_print_image;
				else:
					$image = $prints->user_print_image;
				endif;
				$result['print']['bottom'] = array('id' => $prints->print_id, 'name' => $prints->print_name, 'image' => $image);
			endif;
		}
		return $result;
	}

	public function getmodeldressesajaxAction_main($id = NULL) {
		$dresspieceObj = new Chez_Model_DbTable_DressPiece();
		$params = $this->_request->getParams();
		$body_type = $this->_request->getParam('body_type');
		$image = array();
		foreach ($params as $key => $id):
			if ($key != "controller" && $key != "action" && $key != "module" && $id !== ''):
				if ($key === "body_type") {
					continue;
				}
				if ($id > 0) {
					$imageobj = $dresspieceObj->fetchRow($dresspieceObj->select()
							->setIntegrityCheck(false)
							->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('dresspiece_name', 'dresspiece_id'))
							->where('id = ?', $id));
					$viewall = $dresspieceObj->fetchRow($dresspieceObj->select()
							->setIntegrityCheck(false)
							->from(array("dss" => DATABASE_PREFIX . 'dresspiece'), array('image_name'))
							->where("dresspiece_name='$imageobj->dresspiece_name' && dresspiece_id='$imageobj->dresspiece_id' && body_type_id='$body_type'"));
					$image[$key] = $viewall->image_name;
				}
			endif;
		endforeach;
		echo json_encode($image);
		exit;
	}

	public function getcheckedflagAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$this->_helper->layout()->disableLayout();
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$dressid = $this->_request->getParam("dressid");
				$inspirationRow = $inspirationObj->fetchAll("home_page_image_flag='y'");
				$dataArray = sizeof($inspirationRow);
				echo json_encode($dataArray);
				exit;
			}
		}
	}

	public function geteditcheckedflagAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$this->_helper->layout()->disableLayout();
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$checked = $this->_request->getParam("checked");
				$inspID = $this->_request->getParam("inspID");
				$inspirationAllRow = $inspirationObj->fetchAll("home_page_image_flag='y'");
				if (sizeof($inspirationAllRow) == 3) {
					$inspirationRow = $inspirationObj->fetchRow("id='$inspID'");
					$hmpflag = $inspirationRow->home_page_image_flag;
					$hmporder = $inspirationRow->home_page_image_order;
					if ($hmpflag == 'y') {
						$dataArray = 'exists';
					} else {
						$dataArray = 'not exists';
					}
				}
				echo json_encode($dataArray);
				exit;
			}
		}
	}

	public function savefinalthumbimageAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$this->_helper->layout()->disableLayout();
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$tmp_data = $this->_request->getParam("img_data");
				$userId = $this->_request->getParam("userId");
				$name = $this->_request->getParam("name");
				$image_data = urldecode($tmp_data);
				$image_data = str_replace(' ', '+', $image_data);
				$arr = explode(",", $image_data);
				$data = base64_decode($arr[1]);
				$im = imagecreatefromstring($data);
				$width = imagesx($im);
				$height = imagesy($im);
				$img = imagecreatetruecolor(173, 255);
				// enable alpha blending on the destination image.
				imagealphablending($img, true);
				// Allocate a transparent color and fill the new image with it.
				// Without this the image will have a black background instead of being transparent.
				$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
				imagefill($img, 0, 0, $transparent);
				// copy the frame into the output image (layered on top of the thumbnail)
				imagecopyresampled($img, $im, 0, 0, 0, 0, 173, 255, $width, $height);
				imagealphablending($img, false);
				// save the alpha
				imagesavealpha($img, true);
				$hostName = $_SERVER['HTTP_HOST'];
				$target_path1 = "docs/designstudio/finaldesigndress/finaldress-0-thumb-" . $userId . ".png";
				$newpathtarget = $hostName . "/" . $target_path1;
				imagepng($img, $target_path1);
				/* Anil => Save image in directory */
				// $dress_upload_path = "uploads/dresses/" . $authUserNamespace->ds_image_pre_id . "-" . $authUserNamespace->userid . "-" . $name . "-front-thumb.png";
				$dress_upload_path = "uploads/dresses/" . $authUserNamespace->ds_image_pre_id . "-" . $name . "-front-thumb.png";
				imagepng($img, $dress_upload_path);

				$dataArray = $name . $userId . "_first";
				echo json_encode($dataArray);
				exit;
			}
		}
	}

	public function saveimagefinalbackAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		//$this->_helper->layout()->disableLayout();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$tmp_data = $this->_request->getParam("img_data");
				$userId = $this->_request->getParam("userId");
				$image_data = urldecode($tmp_data);
				$image_data = str_replace(' ', '+', $image_data);
				$arr = explode(",", $image_data);
				$data = base64_decode($arr[1]);
				$im = imagecreatefromstring($data);
				$width = imagesx($im);
				$height = imagesy($im);
				$img = imagecreatetruecolor($width, $height);
				// enable alpha blending on the destination image.
				imagealphablending($img, true);
				// Allocate a transparent color and fill the new image with it.
				// Without this the image will have a black background instead of being transparent.
				$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
				imagefill($img, 0, 0, $transparent);
				// copy the frame into the output image (layered on top of the thumbnail)
				imagecopyresampled($img, $im, 0, 0, 0, 0, $width, $height, $width, $height);
				imagealphablending($img, false);
				// save the alpha
				imagesavealpha($img, true);
				//$hostName = $_SERVER['HTTP_HOST'];
				//$imgext = explode("/",$img_type1);
				//$target_path1 = "docs/designstudio/finaldesigndress/finaldress-1-" . $userId . ".png";
				//dirname(dirname(__FILE__))."/docs/designstudio/finaldress/".$name."-".$userId.".png";
				//$newpathtarget = $hostName . "/" . $target_path1;
				//imagepng($img, $target_path1);
				/* Anil => Save image in directory */
				$name = (isset($name)) ? $name : 'finaldress-back';
				// $dress_upload_path = "uploads/dresses/" . $authUserNamespace->ds_image_pre_id . "-" . $authUserNamespace->userid . "-" . $name . ".png";
				$dress_upload_path = "uploads/dresses/" . $authUserNamespace->ds_image_pre_id . "-" . $name . ".png";
				imagepng($img, $dress_upload_path);

				//========== Sunil : Start Resize Images ==============//
				$imagepreid = $authUserNamespace->ds_image_pre_id;
				$this->createfinalbackthumbimage($data, $userId, $imagepreid, $name);
				//========== Sunil : End Resize Images ==============//

				$dataArray = $name . $userId . "_first";
				echo json_encode($dataArray);
				exit;
			}
		}
	}

	public function createfinalbackthumbimage($data, $userid, $imagepreid, $name) {
		$im = imagecreatefromstring($data);
		$width = imagesx($im);
		$height = imagesy($im);
		$img = imagecreatetruecolor(173, 255);
		// enable alpha blending on the destination image.
		imagealphablending($img, true);
		// Allocate a transparent color and fill the new image with it.
		// Without this the image will have a black background instead of being transparent.
		$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
		imagefill($img, 0, 0, $transparent);
		// copy the frame into the output image (layered on top of the thumbnail)
		imagecopyresampled($img, $im, 0, 0, 0, 0, 260, 255, $width, $height);
		imagealphablending($img, false);
		// save the alpha
		imagesavealpha($img, true);
		$name = 'finaldress-back-thumb';
		// $dress_upload_path = "uploads/dresses/" . $imagepreid . "-" . $userid . "-" . $name . ".png";
		$dress_upload_path = "uploads/dresses/" . $imagepreid . "-" . $name . ".png";
		imagepng($img, $dress_upload_path);
	}

	public function saveimagefinalbackthumbAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$this->_helper->layout()->disableLayout();
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$tmp_data = $this->_request->getParam("img_data");
				$userId = $this->_request->getParam("userId");
				$image_data = urldecode($tmp_data);
				$image_data = str_replace(' ', '+', $image_data);
				$arr = explode(",", $image_data);
				$data = base64_decode($arr[1]);
				$im = imagecreatefromstring($data);
				$width = imagesx($im);
				$height = imagesy($im);
				$img = imagecreatetruecolor(260, 255);
				// enable alpha blending on the destination image.
				imagealphablending($img, true);
				// Allocate a transparent color and fill the new image with it.
				// Without this the image will have a black background instead of being transparent.
				$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
				imagefill($img, 0, 0, $transparent);
				// copy the frame into the output image (layered on top of the thumbnail)
				imagecopyresampled($img, $im, 0, 0, 0, 0, 260, 255, $width, $height);
				imagealphablending($img, false);
				// save the alpha
				imagesavealpha($img, true);
				$hostName = $_SERVER['HTTP_HOST'];
				//$imgext = explode("/",$img_type1);
				$target_path1 = "docs/designstudio/finaldesigndress/finaldress-11-thumb-" . $userId . ".png";
				$newpathtarget = $hostName . "/" . $target_path1;
				imagepng($img, $target_path1);
				/* Anil => Save image in directory */
				$name = (isset($name)) ? $name : 'finaldress-back-thumb';
				// $dress_upload_path = "uploads/dresses/" . $authUserNamespace->ds_image_pre_id . "-" . $authUserNamespace->userid . "-" . $name . ".png";
				$dress_upload_path = "uploads/dresses/" . $authUserNamespace->ds_image_pre_id . "-" . $name . ".png";
				imagepng($img, $dress_upload_path);
				$dataArray = $name . $userId . "_first";
				echo json_encode($dataArray);
				exit;
			}
		}
	}

	public function uisaveimagefinalbothAction() {

		echo json_encode('some');
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				return json_encode($_POST);
			}
		}
	}

	public function saveimagefinalbothAction() {
		//initial function

		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = 0;
		if (isset($authUserNamespace->userid) && $authUserNamespace->userid != "") {
			$userId = $authUserNamespace->userid;
		}
		$msresult = array();
		$this->_helper->layout()->disableLayout();
		if ($this->_request->getParam("istempsave") == 'true') {
			$aaa = 'ppp';
			$modelObj = new Chez_Model_DbTable_DsModelShare();
		} else {
			$aaa = 'qqq';
			$modelObj = new Chez_Model_DbTable_DsModel();
		}
		$msresult['data'] = $this->_request->getParam("istempsave");
		$msresult['aaaa'] = $aaa;
		//echo json_encode($msresult);exit;
		$dresspiceObj = new Chez_Model_DbTable_DressPiece();
		$usermodelObj = new Chez_Model_DbTable_UserModel();
		$colorObj = new Chez_Model_DbTable_Color();
		$dressObj = new Chez_Model_DbTable_Dress();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				/* Start of : get post dress data  */
				$garmentid = $this->_request->getParam("garmentid");
				$dsId = $this->_request->getParam("dsId");
				$bodytype = $this->_request->getParam("bodytype");
				$category = $this->_request->getParam("category");
				$occation = $this->_request->getParam("occation");
				$topfront = $this->_request->getParam("topfront");
				$topback = $this->_request->getParam("topback");
				$bottomfront = $this->_request->getParam("bottomfront");
				$bottomback = $this->_request->getParam("bottomback");
				$leftsleeve = $this->_request->getParam("leftsleeve");
				//added
				//end
				$leftbacksleeve = ($this->_request->getParam("leftbacksleeve")) ? intval($this->_request->getParam("leftbacksleeve")) : 0;
				//added
				//end
				$rightsleeve = ($this->_request->getParam("rightsleeve")) ? intval($this->_request->getParam("rightsleeve")) : 0;
				//added
				//end
				//$rightbacksleeve = $this->_request->getParam("rightbacksleeve");
				$rightbacksleeve = ($this->_request->getParam("rightbacksleeve")) ? intval($this->_request->getParam("rightbacksleeve")) : 0;
				//added
				//$rightbacksleeve = 3;
				//end
				//-- Sunil::Any Front will must have the same corresponding back color.
				$color_palette_id = $this->_request->getParam("color_palette_id");
				$topfrontcolor = ($this->_request->getParam("topfrontcolor")) ? intval($this->_request->getParam("topfrontcolor")) : 0;
				//added
				//$topfrontcolor = 3;
				//end
				//$topbackcolor = $this->_request->getParam("topbackcolor");

				$topbackcolor = ($this->_request->getParam("topbackcolor")) ? intval($this->_request->getParam("topbackcolor")) : 0;
				$bottomfrontcolor = ($this->_request->getParam("bottomfrontcolor")) ? intval($this->_request->getParam("bottomfrontcolor")) : 0;

				$leftsleevecolor = ($this->_request->getParam("leftsleevecolor")) ? intval($this->_request->getParam("leftsleevecolor")) : 0;

				$rightsleevecolor = ($this->_request->getParam("rightsleevecolor")) ? intval($this->_request->getParam("rightsleevecolor")) : 0;

				$leftbacksleevecolor = ($this->_request->getParam("leftbacksleevecolor")) ? intval($this->_request->getParam("leftbacksleevecolor")) : 0;

				$rightbacksleevecolor = ($this->_request->getParam("rightbacksleevecolor")) ? intval($this->_request->getParam("rightbacksleevecolor")) : 0;

				//end
				$skincolor = $this->_request->getParam("skincolor");
				$topprintid = ($this->_request->getParam("topprintid")) ? intval($this->_request->getParam("topprintid")) : 0;
				//added
				//end
				$bottomprintid = ($this->_request->getParam("bottomprintid")) ? intval($this->_request->getParam("bottomprintid")) : 0;
				///-----Zoom and Drag
				$zoom = ($this->_request->getParam("zoom")) ? $this->_request->getParam("zoom") : '1,1,1';
				$drag = ($this->_request->getParam("drag")) ? $this->_request->getParam("drag") : '0,0,0,0';
				///-----Design is temporary or not
				$istempsave = 0;
				if ($this->_request->getParam("istempsave") == true) {
					$istempsave = 1;
				}
				$modelinsertedID = $this->_request->getParam("customized_from");

				$savedmodelid = $this->_request->getParam("savedmodelid");
				$dressNAME = $this->_request->getParam("dressNAME");

				$associateddress = $this->_request->getParam("associateddress");
				$associateId = intval($this->_request->getParam("associateId"));
				$search_occasion = $this->_request->getParam("search_occasion");
				$special_events = $this->_request->getParam("special_events");
				$global_inspiration = $this->_request->getParam("global_inspiration");

				/* End of : get post dress data  */
				//var_dump($this->_request->getParams());die();
				$dresspricewithfab = $this->_request->getParam("finalprice");
				$finaltopfabricprice = $this->_request->getParam("topfabricprice");
				$finalbottomfabricprice = $this->_request->getParam("bottomfabricprice");
				$fabrictext = $this->_request->getParam("fabrictext");
				/* -------------- seperating fabric price and dress price ---------- */
				$finalpricedress = $dresspricewithfab - ($finaltopfabricprice + $finalbottomfabricprice);

				/* --------- End ----------- */
				$fabric = $this->_request->getParam("fabric");
				$toppricedresswithfab = $this->_request->getParam("toppricevalue");
				/* -------------- seperating fabric price and dress price ---------- */
				if ($toppricedresswithfab > 0) {
					$toppricedress = $toppricedresswithfab - $finaltopfabricprice;
				} else {
					$toppricedress = $this->_request->getParam("toppricevalue");
				}

				/* --------- End ----------- */
				$bottompricedresswithfab = $this->_request->getParam("btmpricevalue");
				/* -------------- seperating fabric price and dress price ---------- */
				if ($bottompricedresswithfab > 0) {
					$bottompricedress = $bottompricedresswithfab - $finalbottomfabricprice;
				} else {
					$bottompricedress = $this->_request->getParam("btmpricevalue");
				}

				/* --------- End ----------- */
				$authUserNamespace->finaldressprice = $finalpricedress;
				$lastupdatedate = date("Y-m-d H:i:s");

				if ($dressNAME == "") {
					$monthDay = date("M j");
					$tfColor = $colorObj->fetchRow("id='$topfrontcolor'");
					$dressNAME = $tfAll->dresspiece_name . " " . $tfColor->name . " " . $monthDay;
					if (strlen($dressNAME) > 17) {
						$dressNAME = substr($dressNAME, 0, 17);
					}
				}
				//---------------Start : get and set data for search in front end @ Sunil ---------------------//

				$dresspiecesids = array($topfront, $topback, $bottomfront, $bottomback, $leftsleeve, $leftbacksleeve, $rightsleeve, $rightbacksleeve);
				$dresspiecesids = array_unique(array_filter($dresspiecesids));
				$lengthidsdata = array();
				$sleevesidsdata = array();
				$necklineidsdata = array();
				$backidsdata = array();
				$body_typeidsdata = array();
				#TODO
				// echo "<pre>";print_r($dresspiecesids); exit;
				$dresspicesdata = $dresspiceObj->fetchAll($dresspiceObj->select()
						->from(array("ds" => DATABASE_PREFIX . 'dresspiece'), array('length', 'sleeve', 'neckline', 'back', 'body_type'))
						->setIntegrityCheck(false)
						->where('id IN(?)', $dresspiecesids));
				if (count($dresspicesdata) > 0):
					foreach ($dresspicesdata as $dresspice):
						$lengthidsdata = array_unique(array_merge($lengthidsdata, explode(',', substr_replace($dresspice->length, "", -1))));
						$sleevesidsdata = array_unique(array_merge($sleevesidsdata, explode(',', substr_replace($dresspice->sleeve, "", -1))));
						$necklineidsdata = array_unique(array_merge($necklineidsdata, explode(',', substr_replace($dresspice->neckline, "", -1))));
						$backidsdata = array_unique(array_merge($backidsdata, explode(',', substr_replace($dresspice->back, "", -1))));
						$body_typeidsdata = array_unique(array_merge($body_typeidsdata, explode(',', substr_replace($dresspice->body_type, "", -1))));
					endforeach;
				endif;

				$dressdatas = $dressObj->fetchRow($dressObj->select()
						->from(array("dss" => DATABASE_PREFIX . 'ds_dress'), array('style', 'fabric'))
						->where('id = ?', $dsId));
				if (sizeof($dressdatas) > 0) {
					$styleids = $dressdatas->style;
					$fabricids = $dressdatas->fabric;
				}

				$dressviewtype = 'inspirationviewclose'; // when user/customer design dress from design studio.

				if ($userId):
					$userObject = new Chez_Model_DbTable_User();
					$admin_data = $userObject->fetchRow($userObject->select()
							->from(array('u' => DATABASE_PREFIX . "user"))
							->where('user_id = ?', $userId));
					if ($admin_data->role == 'admin'):
						$dressviewtype = 'inspirationclose'; // when admin design dress from design studio.
					endif;
				endif;
				//---------------End : get and set data for search in front end @ Sunil ---------------------//
				$modeldata = array("garment_type_id" => $garmentid, "ds_id" => $dsId, "chez_user_id" => $userId, "price" => ($finalpricedress != 0 ? $finalpricedress : ($toppricedress + $bottompricedress)), "top_price" => $toppricedress, "customized_from" => $modelinsertedID, "bottom_price" => $bottompricedress, "fabric" => $fabric, "top_fabric_price" => $finaltopfabricprice, "bottom_fabric_price" => $finalbottomfabricprice, "fabric_text" => $fabrictext, "style_id" => $styleids, "fabric_id" => $fabricids, "length_id" => implode(',', $lengthidsdata), "neckline_id" => implode(',', $necklineidsdata), "sleeve" => implode(',', $sleevesidsdata), "body_type" => implode(',', $body_typeidsdata), "back_id" => implode(',', $backidsdata), "chez_dress_name" => substr($dressNAME, 0, 25), "category_id" => $category, "occasion_id" => $occation, "body_type_id" => $bodytype, "skin_color" => $skincolor, "top_front_id" => $topfront,
					"top_back_id" => $topback, "bottom_front_id" => $bottomfront, "bottom_back_id" => $bottomback, "left_sleeve_id" => $leftsleeve, "left_back_sleeve_id" => $leftbacksleeve, "right_sleeve_id" => $rightsleeve, "right_back_sleeve_id" => $rightbacksleeve, "color_palette_id" => $color_palette_id, "top_front_color_id" => $topfrontcolor, "top_back_color_id" => $topbackcolor, "bottom_front_color_id" => $bottomfrontcolor, "bottom_back_color_id" => $bottomfrontcolor, "left_sleeve_color_id" => $leftsleevecolor, "left_back_sleeve_color_id" => $leftbacksleevecolor, "right_sleeve_color_id" => $rightsleevecolor, "right_back_sleeve_color_id" => $rightbacksleevecolor, "top_print_id" => $topprintid, "bottom_print_id" => $bottomprintid, "ds_image_code" => $authUserNamespace->ds_image_pre_id, "ds_image_type" => "image/png", "dress_view_type" => $dressviewtype,
					"lastupdatedate" => $lastupdatedate, "associateddress" => $associateddress, "associateId" => $associateId, "search_occasion" => $search_occasion, "special_events" => $special_events, "global_inspiration" => $global_inspiration, 'session_id' => Zend_Session::getId(), 'zoom' => $zoom, 'drag' => $drag, 'is_temp' => $istempsave);
				$modelObj->insert($modeldata);
				// $id = $modelObj->getAdapter()->lastInsertId("chez_user_id='$userId' && chez_dress_name='$dressNAME'");
				$id = $modelObj->getAdapter()->lastInsertId("session_id= Zend_Session::getId() && chez_dress_name='$dressNAME'");
				$authUserNamespace->modelinstIDid = $id;
				$modelrow = $usermodelObj->fetchRow("chez_user_id='$userId'");
				if (sizeof($modelrow) == 0) {
					$datamdl = array("chez_user_id" => $userId, "chez_bodytype_id" => $bodytype, "skin_color" => $skincolor, "lastupdatedate" => $lastupdatedate, 'session_id' => Zend_Session::getId());
					$usermodelObj->insert($datamdl);
				}
				$response = array();
				$response["id"] = $id;
				// $response["image"] ="$authUserNamespace->ds_image_pre_id-$userId-finaldress-front-thumb.png";
				$response["image"] = "$authUserNamespace->ds_image_pre_id-finaldress-front-thumb.png";

				$authUserNamespace->ds_image_pre_id = time(); //new session code(time) generated!
				$response["ds_image_pre_id"] = $authUserNamespace->ds_image_pre_id;
				echo json_encode($response);
				exit;
			}
		}
	}

	public function savefashinwallimageAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$id = $authUserNamespace->userid;
		if (!isset($id) || $id == "") {
			$this->_redirect("/login");
		}

		$this->_helper->layout()->disableLayout();
		$fashionwallimgObj = new Chez_Model_DbTable_Fashionwall();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$tmp_data = $this->_request->getParam("img_data");
				$finalval = $this->_request->getParam("finalval");
				$name = $this->_request->getParam("name");
				$userId = $this->_request->getParam("userId");
				$image_data = urldecode($tmp_data);
				$image_data = str_replace(' ', '+', $image_data);
				$arr = explode(",", $image_data);
				$data = base64_decode($arr[1]);
				$im = imagecreatefromstring($data);
				$width = imagesx($im);
				$height = imagesy($im);
				$img = imagecreatetruecolor($width, $height);
				// enable alpha blending on the destination image.
				imagealphablending($img, true);
				// Allocate a transparent color and fill the new image with it.
				// Without this the image will have a black background instead of being transparent.
				$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
				imagefill($img, 0, 0, $transparent);
				// copy the frame into the output image (layered on top of the thumbnail)
				imagecopyresampled($img, $im, 0, 0, 0, 0, 260, 255, $width, $height);
				imagealphablending($img, false);
				// save the alpha
				imagesavealpha($img, true);
				// emit the image
				if ($finalval == 'finalval') {
					$imgname = explode("-", $name);
					if ($imgname[1] == '0') {
						$hostName = $_SERVER['HTTP_HOST'];
						//$imgext = explode("/",$img_type1);
						$target_path1 = "docs/designstudio/finaldesigndress/fashionwall/" . $name . "-" . $userId . ".png";
						//dirname(dirname(__FILE__))."/docs/designstudio/finaldress/".$name."-".$userId.".png";
						$newpathtarget = $hostName . "/" . $target_path1;
						imagepng($img, $target_path1);
						$dataArray = $name . $userId . "_first";
					} else {
						$fashionwallimgid = $this->_request->getParam("fashionwallid");
						$hostName = $_SERVER['HTTP_HOST'];
						//$imgext = explode("/",$img_type1);
						$target_path1 = "docs/designstudio/finaldesigndress/fashionwall/" . $name . "-" . $userId . ".png";
						//dirname(dirname(__FILE__))."/docs/designstudio/finaldress/".$name."-".$userId.".png";
						$newpathtarget = $hostName . "/" . $target_path1;
						imagepng($img, $target_path1);

						$lastupdatedate = date("Y-m-d H:i:s");

						$hostName = $_SERVER['HTTP_HOST'];
						//$imgext = explode("/",$img_type1);
						$target_path1 = "docs/designstudio/finaldesigndress/fashionwall/" . $imgname[0] . "-0-" . $userId . ".png";
						$target_path2 = "docs/designstudio/finaldesigndress/fashionwall/" . $imgname[0] . "-1-" . $userId . ".png";
						$newpathtarget1 = $hostName . "/" . $target_path1;
						$newpathtarget2 = $hostName . "/" . $target_path2;
						//imagepng( $img,$target_path1 );
						$filecheck = basename($newpathtarget1);
						$filecheck1 = basename($newpathtarget2);
						$ext = substr($filecheck, strrpos($filecheck, '.') + 1);
						$ext = strtolower($ext);
						if ($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "pjpeg" || $ext == "png") {
							$image_type = "image/" . $ext;
						}
						$ext1 = substr($filecheck1, strrpos($filecheck1, '.') + 1);
						$ext1 = strtolower($ext1);
						if ($ext1 == "jpg" || $ext1 == "jpeg" || $ext1 == "gif" || $ext1 == "pjpeg" || $ext1 == "png") {
							$image_type1 = "image/" . $ext;
						}
						$imagecontent = file_get_contents("http://" . $newpathtarget1);
						$imagecontent1 = file_get_contents("http://" . $newpathtarget2);
						$jpeg_quality = 90;
						$ThumbWidth = 260;
						$ThumbHeight = 255;
						//$src = file_get_contents($temp1);
						$img_r = imagecreatefromstring($imagecontent);
						list($width, $height) = getimagesize("http://" . $newpathtarget1);
						$img_r_b = imagecreatefromstring($imagecontent1);
						list($widthB, $heightB) = getimagesize("http://" . $newpathtarget2);
						//calculate the image ratio
						$imgratio = $width / $height;
						$newheight = $ThumbHeight;
						$newwidth = $ThumbWidth;

						// create a new temporary image
						//$tmp_img = imagecreatetruecolor( $newwidth, $newheight );
						$width = imagesx($img_r);
						$height = imagesy($img_r);
						$width_b = imagesx($img_r_b);
						$height_b = imagesy($img_r_b);
						$img = imagecreatetruecolor($newwidth, $newheight);
						$img2 = imagecreatetruecolor($newwidth, $newheight);
						// enable alpha blending on the destination image.
						imagealphablending($img, true);
						imagealphablending($img2, true);
						// Allocate a transparent color and fill the new image with it.
						// Without this the image will have a black background instead of being transparent.
						$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
						imagefill($img, 0, 0, $transparent);
						$transparent1 = imagecolorallocatealpha($img2, 0, 0, 0, 127);
						imagefill($img2, 0, 0, $transparent1);
						// copy the frame into the output image (layered on top of the thumbnail)
						imagecopyresampled($img, $img_r, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
						imagecopyresampled($img2, $img_r_b, 0, 0, 0, 0, $newwidth, $newheight, $width_b, $height_b);
						imagealphablending($img, false);
						imagealphablending($img2, false);
						// save the alpha
						imagesavealpha($img, true);
						imagesavealpha($img2, true);
						$hostName = $_SERVER['HTTP_HOST'];
						$target_path6 = "docs/designstudio/finaldesigndress/fashionwall/" . $name . "0-thumb-" . $userId . ".png";
						$target_path8 = "docs/designstudio/finaldesigndress/fashionwall/" . $name . "1-thumb-" . $userId . ".png";
						$newpathtarget6 = $hostName . "/" . $target_path6;
						$newpathtarget8 = $hostName . "/" . $target_path8;
						imagepng($img, $target_path6);
						imagepng($img2, $target_path8);
						$imagethumbcontent = file_get_contents("http://" . $newpathtarget6);

						$fashionwalldata = array("grey_image_type" => $image_type, "grey_image_content" => $imagecontent, "gray_thumb_image_type" => $image_type, "gray_thumb_image_content" => $imagethumbcontent, "lastupdatedate" => $lastupdatedate);
						$fashionwallimgObj->update($fashionwalldata, "id='$fashionwallimgid'");
						$dataArray = $name . $userId . "_" . $fashionwallimgid;
					}
				} else {
					$hostName = $_SERVER['HTTP_HOST'];
					$target_path1 = "docs/designstudio/fashionwall/" . $name . "-" . $userId . ".png";
					$newpathtarget = $hostName . "/" . $target_path1;
					imagepng($img, $target_path1);
					$dataArray = $name . $userId;
				}

				echo json_encode($dataArray);
				exit;
			}
		}
	}

	public function viewfashionimagecolorAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$fashionwallimgObj = new Chez_Model_DbTable_Fashionwall();
		$view_image = $fashionwallimgObj->fetchRow($fashionwallimgObj->select()
				->setIntegrityCheck(false)
				->from(array('fw' => DATABASE_PREFIX . "fashionwall"))
				->where("id='$img_id'"));
		$content = $view_image->gray_thumb_image_content;
		$img_type = $view_image->gray_thumb_image_type;
		header("Content-type: " . $img_type);
		//header('Content-Type: image/jpeg');
		if (isset($content)) {
			print $content;
		}

		exit;
	}

	public function savemymodelcolorAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$this->_helper->layout()->disableLayout();
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$usermodelObj = new Chez_Model_DbTable_UserModel();
		$lastupdatedate = date("Y-m-d H:i:s");
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$bodytype = $this->_request->getParam("bodytype");
				$modelrow = $usermodelObj->fetchRow("chez_user_id='$authUserNamespace->userid'");
				if (sizeof($modelrow) == 0) {
					$datamdl = array("chez_user_id" => $authUserNamespace->userid, "chez_bodytype_id" => $bodytype, "lastupdatedate" => $lastupdatedate);
					$usermodelObj->insert($datamdl);
				} else {
					$datamdl = array("chez_user_id" => $authUserNamespace->userid, "chez_bodytype_id" => $bodytype, "lastupdatedate" => $lastupdatedate);
					$usermodelObj->update($datamdl, "chez_user_id='$authUserNamespace->userid'");
				}
			}
		}
		exit;
	}

	public function savemymodelskincolorAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		if (!isset($authUserNamespace->userid) || $authUserNamespace->userid == "") {
			$this->_redirect("/admin");
		}

		$this->_helper->layout()->disableLayout();
		$usermodelObj = new Chez_Model_DbTable_UserModel();
		$lastupdatedate = date("Y-m-d H:i:s");
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$skincolor = $this->_request->getParam("skincolor");
				$modelrow = $usermodelObj->fetchRow("chez_user_id = $authUserNamespace->userid ");
				if (sizeof($modelrow) == 0) {
					$datamdl = array("chez_user_id" => $authUserNamespace->userid, "skin_color" => $skincolor, "lastupdatedate" => $lastupdatedate);
					$usermodelObj->insert($datamdl);
				} else {
					$datamdl = array("chez_user_id" => $authUserNamespace->userid, "skin_color" => $skincolor, "lastupdatedate" => $lastupdatedate);
					$usermodelObj->update($datamdl, "chez_user_id='$authUserNamespace->userid'");
				}
			}
		}
		exit;
	}

	public function successAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$this->_helper->layout()->disableLayout();
		$modelObj = new Chez_Model_DbTable_DsModel();
		$id = $this->_request->getParam("modelid");
		$modelid_temp = $modelObj->fetchRow("id='$id'");
		$this->view->model_id = $modelid_temp->id;
		$this->view->modelId = $id;
	}

	public function bodytypesAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
	}

}
