<?php

class InspirationController extends Zend_Controller_Action {
	public function init() {
		$this->_helper->layout->setLayout('mainlayout_2left');
	}

	public function indexAction() {
		$dsObj = new Chez_Model_DbTable_Dress();
		$select = $dsObj->select();
		$select->setIntegrityCheck(false);
		$select->from(array('ds' => DATABASE_PREFIX . 'ds_model'))
			->joinInner(array('a' => DATABASE_PREFIX . "advice"), 'a.chez_ds_model_id=ds.id', array('a.id as advice_id'))
			->joinInner(array('u' => DATABASE_PREFIX . "user"), 'ds.chez_user_id=u.user_id', array('u.user_id', 'username'))
			->joinInner(array('g' => DATABASE_PREFIX . "garment_type"), 'ds.garment_type_id=g.id', array('g.garment_name'))
			->where('ds.dress_view_type = ?', 'inspirationclose')
		//->orWhere('ds.dress_view_type = ?', 'inspirationviewclose')
		//            ->where('a.question = ?', '')
			->where('a.is_posted = ?', true)
			->where('ds.is_deleted = ?', '0')
			->where('ds.Active = ?', 'y')
			->where('a.chez_user_id IS NOT NULL');
		if (isset($categoryid) && $categoryid != "") {
			$select->where('ds.occasion_id = ?', $categoryid);
		}

		$select->order('ds.lastupdatedate DESC');
		$select->limit(12);		
		$this->view->inspiration_data = $dsObj->fetchAll($select);
	}

	public function getdataonscrollAction() {
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$start = $this->_request->getParam("start");
				$limit = $this->_request->getParam("limit");
				$dsObj = new Chez_Model_DbTable_Dress();
				$select = $dsObj->select();
				$select->setIntegrityCheck(false);
				$select->from(array('ds' => DATABASE_PREFIX . 'ds_model'))
					->joinInner(array('a' => DATABASE_PREFIX . "advice"), 'a.chez_ds_model_id=ds.id', array('a.id as advice_id'))
					->joinInner(array('u' => DATABASE_PREFIX . "user"), 'ds.chez_user_id=u.user_id', array('u.user_id', 'username'))
					->joinInner(array('g' => DATABASE_PREFIX . "garment_type"), 'ds.garment_type_id=g.id', array('g.garment_name'))
					->where('ds.dress_view_type = ?', 'inspirationclose')
				//->orWhere('ds.dress_view_type = ?', 'inspirationviewclose')
				//            ->where('a.question = ?', '')
					->where('a.is_posted = ?', true)
					->where('ds.is_deleted = ?', '0')
					->where('ds.Active = ?', 'y')
					->where('a.chez_user_id IS NOT NULL');
				if (isset($categoryid) && $categoryid != "") {
					$select->where('ds.occasion_id = ?', $categoryid);
				}

				$select->order('ds.lastupdatedate DESC');
				$select->limit($limit, $start);
				$inspiration_data = $dsObj->fetchAll($select);
				$html = '';
				foreach ($inspiration_data as $inspiration):
		            if ($inspiration->dress_view_type == 'inspirationviewclose') {
		                $inspiration_url = BASEPATH . '/inspirationviewclose/index/id/' . $inspiration->id;
		            } else {
		                $inspiration_url = BASEPATH . '/inspirationclose/index/id/' . $inspiration->id . '/garmenttype/' . $inspiration->garment_name;
		            }

		            if (isset($authUserNamespace->userid)){
		                $class = '';
		                $favourite = $this->view->Common()->isFavouriteDress($inspiration->id, 'inspirationclose');
		                if ($favourite['isFavourite']){
		                    $class = 'active';
		                }
		            }

		            
		            $html .= '<div class="pictureholder item">';
		            $html .= '<div class="picture">'.$this->view->Common()->getMiniGridImages($inspiration->id, $inspiration_url, $inspiration->chez_dress_img);
		            $html .= '</div>';
		            $html .= '<div class="pictureinfoCommunity">';
		            $html .= '<div class="pictureinfoUsername">';
		            $html .= '<a href="#" class="custm">CUSTOMIZE</a>';
		            $html .= '</div>';
		            $html .= '<div class="pictureinfoUsername">';
		            $html .= '<a href="#"class="dress_name">'.strtolower($inspiration->chez_dress_name).'</a>';
		            $html .= '</div>';
		            $html .= '<div class="infoholderCommunity">';
		            $html .= '<div class="infoholderCommunityLike">';
		            $html .= '<a class="favourite '.$class.'" onclick="addFavouriteOnListing('.$inspiration->id.', inspirationclose, this);">';
		            $html .= '<img alt="heart"></img>';
		            $html .= '</a>';
		            $html .= '</div>';
		            $html .= '<div class="list-price">';
		            $html .= '<a href="#">';
		            if ($inspiration->top_price > 0 && $inspiration->bottom_price > 0 && $inspiration->price == '0') {
		                changeCurrency((int)($inspiration->top_price + $inspiration->bottom_price));
		            } elseif ($inspiration->price != '0') {
		                changeCurrency((int)$inspiration->price);
		            }
		            $html .= '</a></div></div></div></div>';
		        endforeach;
		    }
		}
		echo json_encode($html);
		exit;
	}

	public function viewinspirationimageAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$view_image = $inspirationObj->fetchRow("id='$img_id'");
		$content = $view_image->ds_img_content;
		if (isset($content)) {
			print $content;
		}

	}

	public function viewheaderimageAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$headlineObj = new Chez_Model_DbTable_Headlines();
		$view_image = $headlineObj->fetchRow("id='$img_id'");
		$content = $view_image->img_content;
		if (isset($content)) {
			print $content;
		}

	}

	public function oldindexAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$inspirationImagesObj = new Chez_Model_DbTable_InspirationImages();
		$inspirationRow = $inspirationObj->fetchAll($inspirationObj->select()
				->setIntegrityCheck(false)
				->from(array('c' => DATABASE_PREFIX . "inspiration"))
				->limit(6, 0));
		if (isset($inspirationRow) && $inspirationRow != "") {
			$k = 0;
			foreach ($inspirationRow as $inspRow) {
				$dressName[$k] = $inspRow->title;
				$dressPrice[$k] = $inspRow->price;
				$inspId[$k] = $inspRow->id;
				//favourite count
				$inspirationfav = new Chez_Model_DbTable_InspirationFavourite();
				$inspirationFavouriteRow = $inspirationfav->fetchAll($inspirationfav->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "inspiration_favourite"))
						->where("chez_inspiration_id = '$inspId[$k]'"));
				$numberOfFav[$k] = sizeOf($inspirationFavouriteRow);
				$k++;
			}
			$this->view->numberOfFav = $numberOfFav;
			$this->view->dressName = $dressName;
			$this->view->dressPrice = $dressPrice;
			$this->view->inspId = $inspId;
			$this->view->inspirationRow = $inspirationRow;
		}
	}

	public function ourcollectionAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$inspirationImagesObj = new Chez_Model_DbTable_InspirationImages();
		$inspirationCollectionRow = $inspirationObj->fetchAll($inspirationObj->select()
				->setIntegrityCheck(false)
				->from(array('c' => DATABASE_PREFIX . "inspiration"))
				->where("occasion_id=4")
				->order("c.lastupdatedate DESC"));
		if (isset($inspirationCollectionRow) && $inspirationCollectionRow != "") {
			$c = 0;
			foreach ($inspirationCollectionRow as $inspcolRow) {
				$dressName[$c] = $inspcolRow->title;
				$dressPrice[$c] = $inspcolRow->price;
				$inspId[$c] = $inspcolRow->id;
				$inspirationfav = new Chez_Model_DbTable_InspirationFavourite();
				$inspirationFavouriteRow = $inspirationfav->fetchAll($inspirationfav->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "inspiration_favourite"))
						->where("chez_user_id = '$userId' && chez_inspiration_id = '$inspId[$c]'")
				);
				$numberOfFav[$c] = sizeOf($inspirationFavouriteRow);
				$c++;
			}
			$this->view->numberOfFav = $numberOfFav;
			$this->view->dressName = $dressName;
			$this->view->dressPrice = $dressPrice;
			$this->view->inspId = $inspId;
			$this->view->inspirationCollectionRow = $inspirationCollectionRow;
		}
	}

	public function yourdesignAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$inspirationImagesObj = new Chez_Model_DbTable_InspirationImages();
		$inspirationYourDesignRow = $inspirationObj->fetchAll($inspirationObj->select()
				->setIntegrityCheck(false)
				->from(array('c' => DATABASE_PREFIX . "inspiration"))
				->where("occasion_id=6")
				->order("c.lastupdatedate DESC"));
		if (isset($inspirationYourDesignRow) && $inspirationYourDesignRow != "") {
			$y = 0;
			foreach ($inspirationYourDesignRow as $inspdesignRow) {
				$dressName[$y] = $inspdesignRow->title;
				$dressPrice[$y] = $inspdesignRow->price;
				$inspId[$y] = $inspdesignRow->id;
				$inspirationfav = new Chez_Model_DbTable_InspirationFavourite();
				$inspirationFavouriteRow = $inspirationfav->fetchAll($inspirationfav->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "inspiration_favourite"))
						->where("chez_user_id = '$userId' && chez_inspiration_id = '$inspId[$y]'")
				);
				$numberOfFav[$y] = sizeOf($inspirationFavouriteRow);
				$y++;
			}
			$this->view->numberOfFav = $numberOfFav;
			$this->view->dressName = $dressName;
			$this->view->dressPrice = $dressPrice;
			$this->view->inspId = $inspId;
			$this->view->inspirationYourDesignRow = $inspirationYourDesignRow;
		}
	}

	public function celebrityinspiredAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$inspirationImagesObj = new Chez_Model_DbTable_InspirationImages();
		$inspirationCelebrityRow = $inspirationObj->fetchAll($inspirationObj->select()
				->setIntegrityCheck(false)
				->from(array('c' => DATABASE_PREFIX . "inspiration"))
				->where("occasion_id=5")
				->order("c.lastupdatedate DESC"));
		if (isset($inspirationCelebrityRow) && $inspirationCelebrityRow != "") {
			$i = 0;
			foreach ($inspirationCelebrityRow as $inspcelebrityRow) {
				$dressName[$i] = $inspcelebrityRow->title;
				$dressPrice[$i] = $inspcelebrityRow->price;
				$inspId[$i] = $inspcelebrityRow->id;
				$inspirationfav = new Chez_Model_DbTable_InspirationFavourite();
				$inspirationFavouriteRow = $inspirationfav->fetchAll($inspirationfav->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "inspiration_favourite"))
						->where("chez_user_id = '$userId' && chez_inspiration_id = '$inspId[$i]'")
				);
				$numberOfFav[$i] = sizeOf($inspirationFavouriteRow);
				$i++;
			}
			$this->view->numberOfFav = $numberOfFav;
			$this->view->dressName = $dressName;
			$this->view->dressPrice = $dressPrice;
			$this->view->inspId = $inspId;
			$this->view->inspirationCelebrityRow = $inspirationCelebrityRow;
		}
	}

	public function inspirationfavouriteAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$inspirationfav = new Chez_Model_DbTable_InspirationFavourite();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$favouriteId = $this->_request->getParam("favId");
				$favouriteRow = $inspirationfav->fetchRow("chez_user_id='$userId' AND chez_inspiration_id = '$favouriteId'");
				$lastupdatedate = date("Y-m-d H:i:s");
				$data = array("chez_inspiration_id" => $favouriteId, "chez_user_id" => $userId, "lastupdatedate" => $lastupdatedate);
				if (sizeof($favouriteRow) == 1) {
					$inspirationfav->update($data, "chez_user_id='$userId' AND chez_inspiration_id = '$favouriteId' ");
				} else {
					$inspirationfav->insert($data);
				}
				$inspirationfav = new Chez_Model_DbTable_InspirationFavourite();
				$inspirationObj = new Chez_Model_DbTable_Inspiration();
				$inspirationObj->fetchAll("id='$favouriteId'");
				$inspirationFavouriteRow = $inspirationfav->fetchAll($inspirationfav->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "inspiration_favourite"))
						->where("chez_inspiration_id = '$favouriteId'"));
				$numberOfFav = sizeOf($inspirationFavouriteRow);
				echo json_encode($numberOfFav);
				exit;
			}
		}
	}

	public function insertinspfavAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$inspirationfav = new Chez_Model_DbTable_InspirationFavourite();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$favouriteId = $this->_request->getParam("inspid");
				$favouriteRow = $inspirationfav->fetchRow("chez_user_id='$userId' AND chez_inspiration_id = '$favouriteId'");
				$lastupdatedate = date("Y-m-d H:i:s");
				$data = array("chez_inspiration_id" => $favouriteId, "chez_user_id" => $userId, "lastupdatedate" => $lastupdatedate);
				if (sizeof($favouriteRow) == 1) {
					$inspirationfav->update($data, "chez_user_id='$userId' AND chez_inspiration_id = '$favouriteId' ");
				} else {
					$inspirationfav->insert($data);
				}
				$inspirationfav = new Chez_Model_DbTable_InspirationFavourite();
				$inspirationObj = new Chez_Model_DbTable_Inspiration();
				$inspirationObj->fetchAll("id='$favouriteId'");
				$inspirationFavouriteRow = $inspirationfav->fetchAll($inspirationfav->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "inspiration_favourite"))
						->where("chez_inspiration_id = '$favouriteId'"));
				$numberOfFav = sizeOf($inspirationFavouriteRow);
				echo json_encode($numberOfFav);
				exit;
			}
		}
	}

	public function insertstylewinnerfavAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$lookbookfavObj = new Chez_Model_DbTable_LookbookFavourite();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$favouriteId = $this->_request->getParam("styleid");
				$favouriteRow = $lookbookfavObj->fetchRow("chez_user_id='$userId' AND chez_lookbook_id = '$favouriteId'");
				$lastupdatedate = date("Y-m-d H:i:s");
				$data = array("chez_lookbook_id" => $favouriteId, "chez_user_id" => $userId, "lastupdatedate" => $lastupdatedate);
				if (sizeof($favouriteRow) == 1) {
					$lookbookfavObj->update($data, "chez_user_id='$userId' AND chez_lookbook_id = '$favouriteId' ");
				} else {
					$lookbookfavObj->insert($data);
				}
				$lookbookFavouriteRow = $lookbookfavObj->fetchAll($lookbookfavObj->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "lookbook_favourite"))
						->where("chez_lookbook_id = '$favouriteId'"));
				$numberOfFav = sizeOf($lookbookFavouriteRow);
				echo json_encode($numberOfFav);
				exit;
			}
		}
	}

	public function insertdsmodelfavAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$dsmodelfavObj = new Chez_Model_DbTable_Modelfavourite();
		if ($this->_request->isPost()) {
			if ($this->_request->isXmlHttpRequest()) {
				$favouriteId = $this->_request->getParam("modelid");
				$favouriteRow = $dsmodelfavObj->fetchRow("chez_user_id='$userId' AND chez_ds_model_id = '$favouriteId'");
				$lastupdatedate = date("Y-m-d H:i:s");
				$data = array("chez_ds_model_id" => $favouriteId, "chez_user_id" => $userId, "lastupdatedate" => $lastupdatedate);
				if (sizeof($favouriteRow) == 1) {
					$dsmodelfavObj->update($data, "chez_user_id='$userId' AND chez_ds_model_id = '$favouriteId' ");
				} else {
					$dsmodelfavObj->insert($data);
				}
				$dsmodelFavouriteRow = $dsmodelfavObj->fetchAll($dsmodelfavObj->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "model_favourite"))
						->where("chez_ds_model_id = '$favouriteId'"));
				$numberOfFav = sizeOf($dsmodelFavouriteRow);
				echo json_encode($numberOfFav);
				exit;
			}
		}
	}
	public function removecustomizeAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$dressId = $this->_request->getParam("dress_id");
		$dsmodelObj = new Chez_Model_DbTable_DsModel();
		////
		//$all_image = $dsmodelObj->fetchRow("id='$dressId' and chez_user_id='" . $userId . "'");
		// $dsmodelRow = $dsmodelObj->fetchRow($dsmodelObj->select()
		// 		->setIntegrityCheck(false)
		// 		->from(array('m' => DATABASE_PREFIX . "ds_model"), array('chez_user_id', 'ds_image_code', 'top_front_id', 'bottom_front_id', 'left_sleeve_id', 'right_sleeve_id', 'associateddress'))
		// 		->where("m.id='$dressId'"));
		//$row = $dsmodelObj->select('ds_image_code')->where("m.id='$dressId'");
		//prd($row->ds_image_code);
		$condition = "chez_user_id='" . $userId . "' and id='" . $dressId . "'";
		// $d = $dsmodelObj->delete($condition);
		$upd = array("is_deleted" => "1");
		$d = $dsmodelObj->update($upd, $condition);
		if ($d) {
			$result = true;
		} else {
			$result = false;
		}
		echo json_encode($result);

		exit;
	}
	public function viewmoreAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		$this->view->left_nav_active = 'my_designs';
		$ufbId = $this->_request->getParam("uid");
		if (isset($ufbId) && $ufbId != "") {
			$userId = $ufbId;
		}
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$left_nav_active = array("navigation_design_studio", "navigation_saved_dress", "navigation_my_designs");
		$this->view->left_nav_active = $left_nav_active;

		$db = Zend_Db_Table::getDefaultAdapter();
		$dsmodelObj = new Chez_Model_DbTable_DsModel();
		$select = $dsmodelObj->select();
		$select->setIntegrityCheck(false);
		$select->from(array('ds' => DATABASE_PREFIX . 'ds_model'), array('*'))
			->joinLeft(array('u' => DATABASE_PREFIX . "user"), 'ds.chez_user_id=u.user_id', array('u.user_id', 'username'))
			->joinLeft(array('g' => DATABASE_PREFIX . "garment_type"), 'ds.garment_type_id=g.id', array('garment_name'))
			->where("ds.chez_user_id = '" . $userId . "' and ds.is_deleted='0'")
			->order("ds.lastupdatedate DESC");

		//->where('ds.chez_user_id = ?', $userId)
		$viewmore_data = $dsmodelObj->fetchAll($select);

		$this->view->viewmore_data = $viewmore_data;
	}

	public function viewmoreAction_18122014() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$authUserNamespace->searchText = "";
		$dsmodelObj = new Chez_Model_DbTable_DsModel();
		$userobj = new Chez_Model_DbTable_User();
		$authUserNamespace->selectmenu = "";
		$id = $this->_request->getParam("uid");
		$designdresses = $this->_request->getParam("design");
		$this->view->designdresses = $designdresses;
		$userdata = $userobj->fetchRow("user_id='$id'");
		$this->view->username = $userdata->username;
		$searchText = $this->_request->getParam("searchtext");
		$categoryid = $this->_request->getParam("categoryid");
		if (isset($categoryid) && sizeof($categoryid) > 0) {
			$imgRow = $dsmodelObj->fetchAll($dsmodelObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "ds_model"))
					->where("chez_user_id='$id' && category_id = '$categoryid'")
					->order("c.lastupdatedate DESC"));
			$authUserNamespace->searchText = "";
		} elseif (isset($searchText) && $searchText != "" && $searchText != "SEARCH") {
			$imgRow = $dsmodelObj->fetchAll($dsmodelObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "ds_model"))
					->where("chez_dress_name like '%" . $searchText . "%'")
					->order("c.lastupdatedate DESC"));
			$authUserNamespace->searchText = $searchText;
		} else {
			$imgRow = $dsmodelObj->fetchAll($dsmodelObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "ds_model"))
					->where("chez_user_id='$id'")
					->order("c.lastupdatedate DESC"));
			$authUserNamespace->searchText = "";
		}
		$this->view->imgRow = $imgRow;
		$this->view->id = $id;
		$this->view->categoryid = $categoryid;
		if (isset($imgRow) && $imgRow != "") {
			$k = 0;
			foreach ($imgRow as $modelRow) {
				$dressName[$k] = $modelRow->chez_dress_name;
				$dressPrice[$k] = $modelRow->price;
				$modelId[$k] = $modelRow->id;
				//favourite count
				$modelfav = new Chez_Model_DbTable_Modelfavourite();
				$inspirationFavouriteRow = $modelfav->fetchAll($modelfav->select()
						->setIntegrityCheck(false)
						->from(array('f' => DATABASE_PREFIX . "model_favourite"))
						->where("chez_ds_model_id = '$modelId[$k]'"));
				$numberOfFav[$k] = sizeOf($inspirationFavouriteRow);
				$k++;
			}
			if ($k >= 1) {
				$this->view->numberOfFav = $numberOfFav;
				$this->view->dressName = $dressName;
				$this->view->dressPrice = $dressPrice;
				$this->view->modelId = $modelId;
				$this->view->modelRows = $imgRow;
			}
		}
	}

	public function viewmoreimageAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$dsmodelObj = new Chez_Model_DbTable_DsModel();
		$view_image = $dsmodelObj->fetchRow("id='$img_id'");
		$content = $view_image->ds_thumb_img_content;
		$img_type = $view_image->ds_thumb_image_type;
		print $content;
		exit;
	}

	public function viewmoreimageinspAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$modelObj = new Chez_Model_DbTable_DsModel();
		if ($img_id > 10000) {
			$view_image = $modelObj->fetchRow($modelObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "ds_model"))
					->where("id='$img_id'")
				//->limit(1,0)
			);
			$content = $view_image->ds_thumb_img_content;
			$img_type = $view_image->ds_thumb_image_type;
			print $content;
			exit;
		} else {
			$view_image = $inspirationObj->fetchRow($inspirationObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "inspiration"))
					->where("id='$img_id'")
				//->limit(1,0)
			);
			$content = $view_image->ds_thumb_img_content;
			$img_type = $view_image->ds_thumb_image_type;
			print $content;
			exit;
		}
	}

	public function viewfashionimageAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$inspirationImagesObj = new Chez_Model_DbTable_InspirationImages();
		$view_image = $inspirationImagesObj->fetchRow($inspirationImagesObj->select()
				->setIntegrityCheck(false)
				->from(array('c' => DATABASE_PREFIX . "inspiration_images"))
				->where("chez_inspiration_id='$img_id' && default_image_flag = 'y'")
			//->limit(1,0)
		);
		$content = $view_image->img_content;
		$img_type = $view_image->image_type;
		print $content;
		exit;
	}

	public function stylewinnerAction() {
		exit('Moved to new controller... delete this action!');
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		$this->view->left_nav_active = 'community';
		$ufbId = $this->_request->getParam("uid");
		if (isset($ufbId) && $ufbId != "") {
			$userId = $ufbId;
		}
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$db = Zend_Db_Table::getDefaultAdapter();

		$dsFavouriteObj = new Chez_Model_DbTable_DressFavourites();
		$select = $dsFavouriteObj->select();
		$select->setIntegrityCheck(false);
		$select->from(array('df' => DATABASE_PREFIX . 'dress_favourites'), array('df.id as stylewinner_id', 'COUNT( ds_model_id ) AS favcount', 'GROUP_CONCAT(DISTINCT closeup_type ) AS allcloseup', 'GROUP_CONCAT(DISTINCT df.user_id ) AS alluser'))
			->joinLeft(array('ds' => DATABASE_PREFIX . "ds_model"), 'ds.id=df.ds_model_id', array('*')) //'ds.id as dress_id',
			->joinLeft(array('u' => DATABASE_PREFIX . "user"), 'df.user_id=u.user_id', array('u.user_id', 'username'))
			->group('df.ds_model_id')
			->order(array('favcount DESC', 'created_on DESC'));
		$stylewinner_data = $dsFavouriteObj->fetchAll($select);
		$this->view->stylewinner_data = $stylewinner_data;
	}

	public function viewstylewinnerimageAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$modelObj = new Chez_Model_DbTable_DsModel();
		if ($img_id > 10000) {
			$view_image = $modelObj->fetchRow($modelObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "ds_model"))
					->where("id='$img_id'")
				//->limit(1,0)
			);
			$content = $view_image->ds_img_content;
			$img_type = $view_image->ds_image_type;
			print $content;
			exit;
		} else {
			$view_image = $inspirationObj->fetchRow($inspirationObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "inspiration"))
					->where("id='$img_id'")
				//->limit(1,0)
			);
			$content = $view_image->ds_img_content;
			$img_type = $view_image->ds_image_type;
			print $content;
			exit;
		}
	}

	public function viewstylewinnerbackimageAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$inspirationObj = new Chez_Model_DbTable_Inspiration();
		$modelObj = new Chez_Model_DbTable_DsModel();
		if ($img_id > 10000) {
			$view_image = $modelObj->fetchRow($modelObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "ds_model"))
					->where("id='$img_id'")
				//->limit(1,0)
			);
			$content = $view_image->ds_img_back_content;
			$img_type = $view_image->ds_image_back_type;
			print $content;
			exit;
		} else {
			$view_image = $inspirationObj->fetchRow($inspirationObj->select()
					->setIntegrityCheck(false)
					->from(array('c' => DATABASE_PREFIX . "inspiration"))
					->where("id='$img_id'")
				//->limit(1,0)
			);
			$content = $view_image->ds_img_back_content;
			$img_type = $view_image->ds_image_back_type;
			print $content;
			exit;
		}
	}

	public function stylewinnerdetailAction() {
		exit('Moved to new controller... delete this action!');
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}

		$id = $this->_request->getParam("id");
		if (!isset($id)) {
			$this->view->error = true;
			$this->view->errorMsg = 'Dress not found.';
		} else {
			$this->view->id = $id;
			$aDressSet = $this->view->Common()->getDressDetail($id);
			$this->view->prevdsmodelid = $aDressSet[0];
			$dsmodelRow = $this->view->dsmodelRow = $aDressSet[1]; //Double assignment.
			$this->view->nextdsmodelid = $aDressSet[2];
			$authUserNamespace->finaldressprice = $dsmodelRow->price;
			//4 common images
			$finaldress_image_front = $this->view->finaldress_image_front = $this->view->Common()->getDressImageByDressId($dsmodelRow->id);
			$this->view->finaldress_image_front_thumb = $this->view->Common()->getDressImageByDressId($dsmodelRow->id, false);
			$this->view->finaldress_image_back = $this->view->Common()->getDressImageByDressId($dsmodelRow->id, true, 'back');
			$this->view->finaldress_image_back_thumb = $this->view->Common()->getDressImageByDressId($dsmodelRow->id, false, 'back');
			$closeup_type = 'adviceclose';
			$this->view->size_html = $this->view->Common()->sizeHtml();

			$this->view->rating_html = $this->view->Common()->getRatingsHtml($id, $closeup_type);
			$this->view->is_favourite = $this->view->Common()->isFavouriteDress($id, $closeup_type); //double assignment
			$authUserNamespace->favoritcnt = $this->view->favorit = $this->view->Common()->getFavouriteDressCount($id, $closeup_type); //double assignment
			$this->view->customization_html = $this->view->Common()->getCloseupCustomizationHtml($id);
			$this->view->share_html = $this->view->Common()->shareHtml($id, $finaldress_image_front, $dsmodelRow->chez_dress_name);
			$adviceObj = new Chez_Model_DbTable_Advice();
			$this->view->advicecloseRow = $adviceObj->fetchRow("chez_ds_model_id='$id'");
			$userInfo = $adviceObj->fetchRow($adviceObj->select()
					->setIntegrityCheck(false)
					->from(array('a' => DATABASE_PREFIX . "advice"), array('a.chez_ds_model_id'))
					->joinLeft(array('m' => DATABASE_PREFIX . "ds_model"), 'a.chez_ds_model_id=m.id', array('m.chez_user_id', 'm.id'))
					->joinLeft(array('u' => DATABASE_PREFIX . "user"), 'u.user_id=m.chez_user_id', array('u.username', 'u.last_name', 'u.first_name'))
					->where("a.chez_ds_model_id ='$id'")
			);
			$this->view->userInfo = $userInfo;

			$this->view->favorit_users = $this->view->insfavuserId = $this->view->Common()->getFavouriteDressUsers($id, $closeup_type); //double assignment
			$this->view->favorit_dress_url = $this->view->Common()->votedFavouriteHtml($id, $closeup_type);
			$this->view->fb_comment_html = $this->view->Common()->fbCommentHtml($id, 'adviceclose/index');
		}
	}

	public function viewfashionmainthumbimageAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$fashionwallObj = new Chez_Model_DbTable_Fashionwall();
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$img_id = $this->_request->getParam("id");
		$view_image = $fashionwallObj->fetchRow("id='$img_id'");
		$content = $view_image->thumb_image_content;
		$img_type = $view_image->thumb_image_type;
		header("Content-type: " . $img_type);
		if (isset($content)) {
			print $content;
		}

	}

	public function getajaxinspirationlistAction() {
		$authUserNamespace = new Zend_Session_Namespace('Chez_Auth');
		$userId = $authUserNamespace->userid;
		if (!isset($userId) || $userId == "") {
			$this->_redirect("/login");
		}
		$this->_helper->_layout->disableLayout();
		echo $this->view->partial('inspiration/get_inspiration_list.phtml');
		exit;
	}

}