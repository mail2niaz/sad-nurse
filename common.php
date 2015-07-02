	<?php
Class Common extends CI_Model
{

public function get_money($price)
{
	$formattedAmount = number_format($price,2,",",".");
	return $formattedAmount." EURO";
}
public function get_money_cart($price)
{
	$formattedAmount = number_format($price,2,",",".");
	return $formattedAmount;
}
public function getSupplierList(){
	$this -> db -> select('id, name');
	$this -> db -> from('entities');
	$this -> db -> where('type = 3');
	$query = $this -> db -> get();
	return $val = $query->result();
}
public function getFacilityList(){
	$this -> db -> select('id, name');
	$this -> db -> from('entities');
	$this -> db -> where('type = 2');
	$query = $this -> db -> get();
	return $val = $query->result();
}
public function getAffiliateList(){
	$this -> db -> select('id, name');
	$this -> db -> from('entities');
	$this -> db -> where('type = 4');
	$query = $this -> db -> get();
	return $val = $query->result();
}
public function dateformat($value)
{
	if($value != '0000-00-00'){
		$date = date("d/m/Y", strtotime($value));
	}else{
		$date = '';
	}
return $date;
}
public function AutoIncrementUserCode($type_id)
{
		$this -> db -> select('id');
		$this -> db -> from('entities');
		$this->db->order_by("id", "desc");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		$cnt = $query -> num_rows();
		if($cnt > 0){
			$val = $query->result();
       		$id = $val[0]->id;
		}else{
			$id = '1';
		}
		if($type_id == '4'){
			$code_prefix = "A00000";
		}elseif($type_id == '3'){
			$code_prefix = "F00000";
		}
		$val = $code_prefix.($id + 1);
	return $val;
}
public function getusername($uid)
{
		$this -> db -> select('name');
		$this -> db -> from('entities');
		$this -> db -> where('id = ' . "'" . $uid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$name = $val[0]->name;
		}
		else
		{
			$name = "";
		}

	return $name;
}
public function getuseremail($uid)
{
      $this -> db -> select('entities.email');
    $this -> db -> from('users');
    $this -> db -> join('entities','users.entity_id = entities.id');
    $this -> db -> where('users.id = ' . "'" . $uid . "'");
    $this -> db -> limit(1);
    $query = $this -> db -> get();
    if($query -> num_rows() == 1)
    {
        $val = $query->result();
        $email = $val[0]->email;
    } else{
		 $email= '';
    }

    return $email;
}
public function getUserTableName($uid)
{
		$this -> db -> select('username');
		$this -> db -> from('users');
		$this -> db -> where('id = ' . "'" . $uid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$name = $val[0]->username;
		}
		else
		{
			$name = "";
		}

	return $name;
}
public function GetUserImage($uid)
{
		$this -> db -> select('logo');
		$this -> db -> from('entities');
		$this -> db -> where('id = ' . "'" . $uid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$logo = $val[0]->logo;
		}
		else
		{
			$logo = "";
		}

	return $logo;
}
public function GetVariantType($vid)
{
		$this -> db -> select('type_name');
		$this -> db -> from('variant_type');
		$this -> db -> where('type_id = ' . "'" . $vid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$type_name = $val[0]->type_name;
		}
		else
		{
			$type_name = "";
		}

	return $type_name;
}
public function pricelist_name($price_id, $aid)
{
	if($price_id != NULL){
		$this -> db -> select('pricelist_title');
		$this -> db -> from('pricelist');
		$this -> db -> where('price_id = ' . "'" . $price_id . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$pricelist_title = $val[0]->pricelist_title;
		}else{
			$pricelist_title = "";
		}
		return $pricelist_title;
	}else{
		 $session_data=$this->session->userdata('logged_in');

		$this -> db -> select('price_id,pricelist_title');
		$this -> db -> from('pricelist');
		 if($session_data['type'] != '1'){
		 	$this -> db -> where('created_by = ' . "'" . $aid . "'");
		}
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}
public function getFacilityType($id)
{
	if($id != NULL){
		$this -> db -> select('type_name');
		$this -> db -> from('facility_type');
		$this -> db -> where('id = ' . "'" . $id . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$name = $val[0]->type_name;
		}else{
			$name = "";
		}
		return $name;
	}else{
		$this -> db -> select('id,type_name,description');
		$this -> db -> from('facility_type');
		$this -> db -> where('status = 1');
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

public function order_list($oid)
{
	if($oid == NULL){
		$this -> db -> select('oid');
		$this -> db -> from('orders');
		$query = $this -> db -> get();
		return $val = $query->result();
	}else{
		$this -> db -> select('*');
		$this -> db -> from('orders');
		$this -> db -> where('oid = ' . "'" . $oid . "'");
		$query = $this -> db -> get();
		return $val = $query->result();
	}

}
public function order_product_list($oid)
{
	if($oid == NULL){
		$this -> db -> select('oid');
		$this -> db -> from('orders_items');
		$query = $this -> db -> get();
		return $val = $query->result();
	}else{
		$this -> db -> select('*');
		$this -> db -> from('orders_items');
		$this -> db -> where('oid = ' . "'" . $oid . "'");
		$query = $this -> db -> get();
		return $val = $query->result();
	}

}
public function GetTypeName($tid)
{
	if($tid != NULL){
		$this -> db -> select('type_name');
		$this -> db -> from('user_types');
		$this -> db -> where('ustid = ' . "'" . $tid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$type_name = $val[0]->type_name;
		}else{
			$type_name = "";
		}
		return $type_name;
	}else{
		$this -> db -> select('ustid,type_name');
		$this -> db -> from('user_types');
		$this -> db -> where('type_status = 1');
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}
public function GetProductName($pid,$aid)
{
	if($pid != NULL){
		$this -> db -> select('product_name');
		$this -> db -> from('products');
		$this -> db -> where('product_id = ' . "'" . $pid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$pname = $val[0]->product_name;
		}else{
			$pname = "";
		}
		return $pname;
	}else{
		$session_data=$this->session->userdata('logged_in');
		$this -> db -> select('*');
		$this -> db -> from('products');
		$this -> db -> where('pstatus = 1');
		if($session_data['type'] != '1'){
		$this -> db -> where('product_created_by = ' . "'" . $aid . "'");
		}
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

public function GetProductCategoryName($cid)
{
	if($cid != NULL){
		$this -> db -> select('category_name');
		$this -> db -> from('product_category');
		$this -> db -> where('category_id = ' . "'" . $cid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$category_name = $val[0]->category_name;
		}else{
			$category_name = "";
		}
		return $category_name;
	}else{
		$this -> db -> select('*');
		$this -> db -> from('product_category');
		$this -> db -> where('status = 1');
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

public function GetProductGroupName($gid)
{
	if($gid != NULL){
		$this -> db -> select('name');
		$this -> db -> from('product_group');
		$this -> db -> where('id = ' . "'" . $gid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$group_name = $val[0]->name;
		}else{
			$group_name = "";
		}
		return $group_name;
	}else{
		$this -> db -> select('id,name');
		$this -> db -> from('product_group');
		$this -> db -> where('status = 1');
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

public function GetVatCode($vcid)
{
	if($vcid != NULL){
		$this -> db -> select('code');
		$this -> db -> from('vat_codes');
		$this -> db -> where('id = ' . "'" . $vcid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$vat_name = $val[0]->code;
		}else{
			$vat_name = "";
		}
		return $vat_name;
	}else{
		$this -> db -> select('*');
		$this -> db -> from('vat_codes');
		$this -> db -> where('status = 1');
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

public function GetVariantSize($sid)
{
	if($sid != NULL){
		$this -> db -> select('size');
		$this -> db -> from('product_variants_size');
		$this -> db -> where('size_id = ' . "'" . $sid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$size = $val[0]->size;
		}else{
			$size = "";
		}
		return $size;
	}else{
		$this -> db -> select('size_id,description,size');
		$this -> db -> from('product_variants_size');
		$this -> db -> where('status = 1');
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

public function GetVariantColor($cid)
{
	if($cid != NULL){
		$this -> db -> select('color');
		$this -> db -> from('product_variants_color');
		$this -> db -> where('color_id = ' . "'" . $cid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$color = $val[0]->color;
		}else{
			$color = "";
		}
		return $color;
	}else{
		$this -> db -> select('color_id,description,color');
		$this -> db -> from('product_variants_color');
		$this -> db -> where('status = 1');
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

public function GetProductPictureList($pid)
{
		$links = array();
		$this -> db -> select('pict_id,picture_link');
		$this -> db -> from('product_pictures');
		$this -> db -> where('product_id = ' . "'" . $pid . "'");
		$query = $this -> db -> get();
		if($query -> num_rows() > 0)
		{
			$val = $query->result();
			foreach($val as $vals){
				$links[] = $vals;
			}
		}else{
			$links = "0";
		}
		return $links;
}

public function GetProductPDFList($pid)
{
		$links = array();
		$this -> db -> select('prd_pdf_id,pdf_link');
		$this -> db -> from('product_pdf');
		$this -> db -> where('product_id = ' . "'" . $pid . "'");
		$query = $this -> db -> get();
		//echo $query -> num_rows();
		if($query -> num_rows() > 0)
		{
			$val = $query->result();
			foreach($val as $vals){
				$links[] = $vals;
			}
		}else{
			$links = "0";
		}
		return $links;
}

public function GetProductVideoList($pid)
{
		$links = array();
		$this -> db -> select('prd_video_id,video_link');
		$this -> db -> from('product_video_reference');
		$this -> db -> where('product_id = ' . "'" . $pid . "'");
		$query = $this -> db -> get();
		if($query -> num_rows() > 0)
		{
			$val = $query->result();
			foreach($val as $vals){
				$links[] = $vals;
			}
		}else{
			$links = "0";
		}
		return $links;
}

public function datei18tran($date){
	//$date = strtotime("Nov-18, 2013");
	$month = date("M", $date);
	$year = date("Y", $date);
	$date = date("d", $date);
	switch ($month) {
		case 'Jan':
			$mon = "Gen";
			break;
		case 'Feb':
			$mon = "Feb";
			break;
		case 'Mar':
			$mon = "Mar";
			break;
		case 'Apr':
			$mon = "Apr";
			break;
		case 'May':
			$mon = "Mag";
			break;
		case 'Jun':
			$mon = "giu";
			break;
		case 'Jul':
			$mon = "Lug";
			break;
		case 'Aug':
			$mon = "ago";
			break;
		case 'Sep':
			$mon = "set";
			break;
		case 'Oct':
			$mon = "Ott";
			break;
		case 'Nov':
			$mon = "nov";
			break;
		case 'Dec':
			$mon = "dic";
			break;
	}
	return $mon."-".$date.",".$year;
}


    public function GetVariantValue($vid)
    {
        //echo $vid;
        $this -> db -> select('*');
        $this -> db -> from('variant_values');
        $this -> db -> where('variant_type_id = ' . "'" . $vid . "'");
        $query = $this -> db -> get();
        return $query->result_array();
    }
	    function check_cart($id){
        $exists = 0;
        foreach($this->cart->contents() as $cart){
            if($cart['id'] == $id){
                $exists = 1;
            }
        }
        if($exists == 1){
            return true;
        } else {
            return false;
        }
    }


        public function GetImage($vid)
    {
        $this -> db -> select('picture_link');
        $this -> db -> from('product_pictures');
        $this -> db -> where('product_id = ' . "'" . $vid . "'");
        $query = $this -> db -> get();
        return $query->result_array();
    }

    public function GetVideo($vid)
    {
        $this -> db -> select('video_link');
        $this -> db -> from('product_video_reference');
        $this -> db -> where('product_id = ' . "'" . $vid . "'");
        $query = $this -> db -> get();
        return $query->result_array();
    }
    public function GetPdf($vid)
    {
        $this -> db -> select('pdf_link');
        $this -> db -> from('product_pdf');
        $this -> db -> where('product_id = ' . "'" . $vid . "'");
        $query = $this -> db -> get();
        return $query->result_array();
    }
	public function GetProductGroupId($gname)
    {
        if($gname != NULL){
            $this -> db -> select('id');
            $this -> db -> from('product_group');
            $this -> db -> where('name = ' . "'" . $gname . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $group_name = $val[0]->id;
            }else{
                $group_name = "";
            }
            return $group_name;
        }
    }
    public function GetVatId($vcode)
    {
        if($vcode != NULL){
            $this -> db -> select('id');
            $this -> db -> from('vat_codes');
            $this -> db -> where('code = ' . "'" . $vcode . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $vat_name = $val[0]->id;
            }else{
                $vat_name = "";
            }
            return $vat_name;
        }
    }
    public function GetVariantValueName($vid)
    {
        $this -> db -> select('value');
        $this -> db -> from('variant_values');
        $this -> db -> where('value_id = ' . "'" . $vid . "'");
        $this -> db -> limit(1);
        $query = $this -> db -> get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $type_name = $val[0]->value;
        }
        else
        {
            $type_name = "";
        }
        return $type_name;
    }

    public function GetVariantValueId($value,$type){
        $this -> db -> select('value_id');
        $this -> db -> from('variant_values');
        $this -> db -> where('value = ' . "'" . $value . "'");
        $this -> db -> where('variant_type_id = ' . "'" . $type . "'");
        $this -> db -> limit(1);
        $query = $this -> db -> get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $value_id = $val[0]->value_id;
        }
        return $value_id;
    }
	    public function GetVariantTypeId($vname)
    {
        $this -> db -> select('type_id');
        $this -> db -> from('variant_type');
        $this -> db -> where('type_name = ' . "'" . $vname . "'");
        $this -> db -> limit(1);
        $query = $this -> db -> get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $type_name = $val[0]->type_id;
        }
        else
        {
            $type_name = "";
        }

        return $type_name;
    }
	    public function GetProductCategoryId($cname)
    {
        if($cname != NULL){
            $this -> db -> select('category_id');
            $this -> db -> from('product_category');
            $this -> db -> where('category_name = ' . "'" . $cname . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $category_name = $val[0]->category_id;
            }else{
                $category_name = "";
            }
            return $category_name;
        }
    }

	    public function GetProductSubCategoryId($cname)
    {
        if($cname != NULL){
            $this -> db -> select('sub_category_id');
            $this -> db -> from('product_sub_category');
            $this -> db -> where('sub_category_name = ' . "'" . $cname . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $category_name = $val[0]->sub_category_id;
            }else{
                $category_name = "";
            }
            return $category_name;
        }
    }

    public function GetFacuilityId($value){
        $this -> db -> select('id');
        $this -> db -> from('facility_type');
        $this -> db -> where('type_name = ' . "'" . $value . "'");
        $this -> db -> limit(1);
        $query = $this -> db -> get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $id = $val[0]->id;
        }else{
        	$id = '';
        }
        return $id;
    }
	    /* Get Affilate Code */
        public function get_affilate_code($aid){
            $this -> db -> select('entities.code');
            $this -> db -> from('users');
            $this -> db -> join('entities','users.entity_id = entities.id');
            $this -> db -> where('entities.id = ' . "'" . $aid . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $aid = $val[0]->code;
            } else{
				 $aid= '';
            }

            return $aid;
        }

		  public function get_user_id($eid){
            $this -> db -> select('id');
            $this -> db -> from('users');
            $this -> db -> where('entity_id = ' . "'" . $eid . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $acode = $val[0]->id;

            }
            return $acode;
        }

        public function GetAffiliateCode($acode){
            $this -> db -> select('entities.id');
            $this -> db -> from('entities');
            $this -> db -> where('entities.code = ' . "'" . $acode . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $aid = $val[0]->id;
            } else{
				 $aid= '';
            }

            return $aid;
        }

        public function GetFacitityName($fac){
            $this -> db -> select('id');
            $this -> db -> from('facility_type');
            $this -> db -> where('type_name = ' . "'" . $fac . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $acode = $val[0]->id;
            }
            return $acode;
        }
		  public function GetProductCode($pid,$aid)
    {
        if($pid != NULL){
            $this -> db -> select('code');
            $this -> db -> from('products');
            $this -> db -> where('product_id = ' . "'" . $pid . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $pname = $val[0]->code;
            }else{
                $pname = "";
            }
            return $pname;
        }
    }

    public function GetPriceName($pricename){

        if($pricename != NULL){

            $this -> db -> select('price_id');
            $this -> db -> from('pricelist');
            $this -> db -> where('pricelist_title = ' . "'" . $pricename . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
               $pname = $val[0]->price_id;
            }else{
                $pname = "";
            }
            return $pname;
        }
    }
    public function GetProductNameCode($code){

        $this -> db -> select('product_id');
        $this -> db -> from('products');
        $this -> db -> where('code = ' . "'" . $code . "'");
        $this -> db -> limit(1);
        $query = $this -> db -> get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $product_id = $val[0]->product_id;
        } else{
            $product_id = '';
        }
        return $product_id;
    }

    public function GetPricelistID($list,$product,$aid){

        $this -> db -> select('id');
        $this -> db -> from('list_product_prices');
        $this -> db -> where('pricelist_id = ' . "'" . $list . "'");
        $this -> db -> where('product_id = ' . "'" . $product . "'");
        $this -> db -> where('created_by = ' . "'" . $aid . "'");
        $this -> db -> limit(1);
        $query = $this -> db -> get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $product_id = $val[0]->id;
        } else{
            $product_id = '';
        }
        return $product_id;
    }

public function OrderStatus($id,$recieved,$stype,$delete_status){
	if($id == '1'){
		if($stype == '2' || $stype == '4' || $stype == '3'){
			if($recieved == 1){
				$status = lang1("ORDER::recieved");
			} else{
				$status = lang1("ORDER::inserted");
			}
		} else{
				$status = lang1("ORDER::inserted");
		}
		return $status;
	}elseif($id == '2'){
		return lang1("ORDER::processing");
	}elseif($id == '3'){
		return lang1("ORDER::shipped");
	}elseif($id == '4'){
		return lang1("ORDER::received");
	}elseif($id == '5'){
		if($delete_status == 1){
			return lang1("ORDER::archive");
		} else{
			return lang1("ORDER::cancelled");
		}

	}elseif($id == '6'){
		if($stype == '2' || $stype == '4'){
		return lang1("ORDER::need_confirm");
		} else{
			return lang1("ORDER::processing");
		}
	}elseif($id == '7' || $id == '9'){
		if($stype == '2' || $stype == '4'){
		return lang1("ORDER::partial_confirm");
		} else{
			return lang1("ORDER::wait_for_facility");
		}
	}elseif($id == '8'){
		if($stype == '2' || $stype == '4'){
			return lang1("ORDER::confirm");
		} else{
			return lang1("ORDER::wait_for_facility");
		}
		return lang1("ORDER::confirm");
	}elseif ($id == '10') {
		return lang1("ORDER::paid");
	}
}
public function NextOrderStatus($status,$stype,$oid){
	if($stype == '3'){

		if($status == '1'){
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::processing").'>&nbsp;&nbsp;');
		}elseif($status == '2'){
			//return anchor($this->i18n.'order_management/editorder/'.$oid,'<button value='.lang1("ORDER::confirm").'>'.lang1("ORDER::confirm").'</button>&nbsp;&nbsp;');
		}elseif ($status == '10') {
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::shipped").'>&nbsp;&nbsp;');
		}
	}elseif($stype == '4'){
		if($status == '1'){
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::cancelled").'>&nbsp;&nbsp;');
		}elseif($status == '3'){
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::received").'>&nbsp;&nbsp;');
		} elseif ($status == '6') {
			//return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<button value='.lang1("ORDER::fac_confirm").'>'.lang1("ORDER::fac_confirm").'</button>&nbsp;&nbsp;');
		} elseif ($status == '7') {
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::confirm").'> &nbsp;&nbsp;');
		} elseif ($status == '8' || $status == '9') {
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::pay_confirm").'> &nbsp;&nbsp;');
		}
	}elseif($stype == '2'){
		if($status == '1'){
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::cancelled").'> &nbsp;&nbsp;');
		}elseif($status == '3'){
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::received").'> &nbsp;&nbsp;');
		}elseif ($status == '7') {
			return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::confirm").'> &nbsp;&nbsp;');
		}
	}elseif($stype == '1'){
		return anchor($this->i18n.'order_management/change_order_status/'.$oid.'/'.$this->common->NextOrderStatusVal($status,$stype),'<input class="btn btn-rounded btn-primary btn-submit" type="button" value='.lang1("ORDER::cancelled").'> &nbsp;&nbsp;');
	}
}
    public function NextOrderStatusVal($status,$stype){
        if($stype == '3'){
            if($status == '1'){
                return '2';
            }elseif($status == '10'){
                return '3';
            }
        }elseif($stype == '4'){
            if($status == '1'){
                return '5';
            }elseif($status == '3'){
                return '4';
            }elseif($status == '6'){
            	return '1';
            }elseif ($status == '7') {
                return '9';
            } elseif ($status == '8' || $status == '9' ) {
                return '10';
            }
        }elseif($stype == '2'){
            if($status == '1'){
                return '5';
            }elseif($status == '3'){
                return '4';
            }elseif ($status == '7') {
                return '9';
            }
        }elseif($stype == '1'){
            if($status == '1'){
                return '5';
            }
        }
    }

    public function GetSupplierName($uid){
        $this->db->select('entities.name');
        $this->db->from('entities');
        $this->db->where('entities.id',$uid);
        $query=$this->db->get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $suppliername = $val[0]->name;
        } else {
            $suppliername = '';
        }
        return $suppliername;
    }

	public function GetAffilateName($uid){
        $this->db->select('entities.name');
        $this->db->from('users');
		$this->db->join('entities','entities.id = users.entity_id');
        $this->db->where('users.id',$uid);
        $query=$this->db->get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $suppliername = $val[0]->name;
        } else {
            $suppliername = '';
        }
        return $suppliername;
    }

	public function eid($uid){
        $this->db->select('entities.id');
        $this->db->from('users');
		$this->db->join('entities','entities.id = users.entity_id');
        $this->db->where('users.id',$uid);
        $query=$this->db->get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $suppliername = $val[0]->id;
        } else {
            $suppliername = '';
        }
        return $suppliername;
    }

    public function CheckVariantType($type,$tid){
        $this->db->select('type_name');
        $this->db->from('variant_type');
		$this -> db -> where('type_name = ' . "'" . $type . "'");
		if($tid != ''){
			$this -> db -> where('type_id = ' . "'" . $tid . "'");
		}
        $query=$this->db->get();
        if($query -> num_rows() > 0)
        {
            $val = $query -> num_rows();
        } else {
            $val = '0';
        }
        return $val;
    }
	    public function CheckVariantValue($value,$tid){
        $this->db->select('value');
        $this->db->from('variant_values');
		$this -> db -> where('variant_type_id = ' . "'" . $tid . "'");
		$this -> db -> where('value = ' . "'" . $value . "'");
        $query=$this->db->get();
        if($query -> num_rows() > 0)
        {
            $val = $query -> num_rows();
        } else {
            $val = '0';
        }
        return $val;
    }

	public function itemname($id)
	{
		$query=$this->db->get_where('orders_items',array('oid'=>$id));
		foreach ($query->result() as $item) {
			$items[] = $this->GetProductName($item->product_id);
		}
		return $items;
	}

		public function ritemname($id)
	{
		$query=$this->db->get_where('resi_order_items',array('resi_id'=>$id));
		foreach ($query->result() as $item) {
			$items[] = $this->GetProductName($item->product_id);
		}
		return $items;
	}

public function get_affilate_code_User_CRUD($aid){
            $this -> db -> select('code');
            $this -> db -> from('entities');
            $this -> db -> where('id = ' . "'" . $aid . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $aid = $val[0]->code;
            } else{
				 $aid= '';
            }

            return $aid;
        }
public function getfacility_affiliatocode($affiliato_id,$aff_code)
{
		$this -> db -> select('id');
		$this -> db -> from('entities');
		$this->db->order_by("id", "desc");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		$cnt = $query -> num_rows();
		if($cnt > 0){
			$val = $query->result();
       		$id = $val[0]->id;
		}else{
			$id = '1';
		}
		$code_facility = $aff_code."_C00000".($id + 1);
		return $code_facility;
}
	public function AutoIncrementfacilitycode($entity_id){
		$aff_code = $this->get_affilate_code_User_CRUD($entity_id);
		$code_val = $this->getfacility_affiliatocode($entity_id,$aff_code);
		return $code_val;

	}

	public function get_facility_affiliato_id($uid)
{
		$this -> db -> select('affiliate_id');
		$this -> db -> from('entities');
		$this -> db -> where('id = ' . "'" . $uid . "'");
		$query = $this -> db -> get();
		$cnt = $query -> num_rows();
		$val = $query->result();
       $affiliate_id = $val[0]->affiliate_id;
		return $affiliate_id;
}
        public function GetSupplierCode($id){
            $this -> db -> select('entities.code');
            $this -> db -> from('entities');
            $this -> db -> where('entities.id = ' . "'" . $id . "'");
            $this -> db -> limit(1);
            $query = $this -> db -> get();
            if($query -> num_rows() == 1)
            {
                $val = $query->result();
                $aid = $val[0]->code;
            } else{
				 $aid= '';
            }

            return $aid;
        }

		public function GetpaymentOption($value)
		{
			if($value == '1'){
				$val = lang1("CHECKOUT::wired_transfer");
			}elseif($value == '2'){
				$val = lang1("CHECKOUT::bank_guarantee");
			}elseif($value == '3'){
				$val = lang1("CHECKOUT::financing");
			}
			return $val;
		}

	public function SendOrderEmail($supplier_email,$supplier_id,$user,$temp_code,$link,$oid,$date_entered)
	{
		$supplier_name = $this->GetSupplierName($supplier_id);
		$username_name = $this->GetSupplierName($user);
		$this -> db -> select('*');
	    $this -> db -> from('email_templates');
	    $this -> db -> where('code = ' . "'" . $temp_code . "'");
	    $this -> db -> limit(1);
	    $query = $this -> db -> get();
			$val = $query->result();
			if($temp_code == "ORDER_CREATED_SUPPLIER"){
				if($val[0]->body != ''){
					$subject = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->subject)))));
				}else{
					$body = '';
				}
				if($val[0]->subject != ''){
					$subject = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->subject)))));
				}else{
					$subject = '';
				}

			}elseif($temp_code == "FACILITY_CANCEL_ORDER"){
				if($val[0]->body != ''){
$body = str_replace("{order_date}", $date_entered, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->body))));
				}else{
					$body = '';
				}
				if($val[0]->subject != ''){
						$subject = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->subject)))));
				}else{
					$subject = '';
				}

			}elseif($temp_code == "SUPPLIER_START_PROCESS_ORDER"){
				if($val[0]->body != ''){
$body = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->body)))));
				}else{
					$body = '';
				}
				if($val[0]->subject != ''){
					$subject = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->subject)))));
				}else{
					$subject = '';
				}

			}elseif($temp_code == "SUPPLIER_DELIVERY_ORDER"){
				if($val[0]->body != ''){
$body = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->body)))));
				}else{
					$body = '';
				}
				if($val[0]->subject != ''){
					$subject = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->subject)))));
				}else{
					$subject = '';
				}
			}elseif($temp_code == "FACILITY_RECEIVE_ORDER"){
				if($val[0]->body != ''){
$body = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->body)))));
				}else{
					$body = '';
				}
				if($val[0]->subject != ''){
					$subject = str_replace("{order_date}", $date_entered, str_replace("{link}", $link, str_replace("{order_no}", $oid, str_replace("{user_name}", $username_name, str_replace("{supplier_name}", $supplier_name, $val[0]->subject)))));
				}else{
					$subject = '';
				}

			}
		$this->SendMail($supplier_email,$subject,$body);

	}

	public function SendMail($to,$subject,$body)
	{
       	$this->load->library('email');
       $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
				   $html = '<!DOCTYPE html>
<html>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table">
    <tbody><tr>
        <td align="center" bgcolor="#ececec">
            <table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr><td class="w640" width="640" height="20"></td></tr>

                <tr>
                    <td class="w640" width="640">
                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#017B40">
                            <tbody><tr>
                                <td class="w15" width="15"></td>
                                <td class="w325" width="350" valign="middle" align="left">
                                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                                        <tbody><tr><td class="w325" width="350" height="8"></td></tr>
                                        </tbody></table>

                                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                                        <tbody><tr><td class="w325" width="350" height="8"></td></tr>
                                        </tbody></table>
                                </td>
                                <td class="w30" width="30"></td>
                                <td class="w255" width="255" valign="middle" align="right">
                                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                                        <tbody><tr><td class="w255" width="255" height="8"></td></tr>
                                        </tbody></table>
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                        </tbody></table>
                                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                                        <tbody><tr><td class="w255" width="255" height="8"></td></tr>
                                        </tbody></table>
                                </td>
                                <td class="w15" width="15"></td>
                            </tr>
                            </tbody></table>

                    </td>
                </tr>
                <tr>
                    <td id="header" class="w640" width="640" align="center" bgcolor="#fff">
                        <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                            <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>
                            <tr>
                                <td class="w30" width="30"></td>
                                <td class="w580" width="580">
                                    <div align="center" id="headline">
                                        <p>
                                            <strong><span style="position:relative; display:block"><span class="cs-fl-wrap" ><img src="'.base_url().'/images/ng-buy.png"></span><span class="cs-button-block" style="top: 0px; opacity: 0.3;">
  <span class="cs-edit-content-button cs-edit-rounded"></span>
</span></span></strong>
                                        </p>
                                    </div>
                                </td>
                                <td class="w30" width="30"></td>
                            </tr>
                            </tbody></table>


                    </td>
                </tr>

                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>
                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">
                    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr>
                            <td class="w30" width="30"></td>
                            <td class="w580" width="580">
                <span class="cs-rp-wrap"><span class="cs-it-wrap" data-layout="Text only">
                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                            <tbody><tr>
                                <td class="w580" width="580">
                                    <p align="left" class="article-title"><span class="headertext" style="font-size: 32px; margin-left: -2px; color:#FF8000;">'.$subject.'</span></p>
                                    <div align="left" class="article-content" style="color:#FF8000;" >
                                        <span class="cs-el-wrap"><p>
                                            '.$body.'</p>
</span>
                                    </div>
                                </td>
                            </tr>
                            <tr><td class="w580" width="580" height="10"></td></tr>
                            </tbody></table>
                    </span></span>
                            </td>
                            <td class="w30" width="30"></td>
                        </tr>
                        </tbody></table>
                </td></tr>
                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>

                <tr>
                    <td class="w640" width="640">
                        <table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#017B40">
                            <tbody><tr><td class="w30" width="30"></td><td class="w580 h0" width="360" height="30"></td><td class="w0" width="60"></td><td class="w0" width="160"></td><td class="w30" width="30"></td></tr>
                            <tr>
                                <td class="w30" width="30"></td>
                                <td class="w580" width="360" valign="top">
                                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left"></p></span>
                                    <p align="left" class="footer-content-left"><a href="#" lang="en" style="color:#ffffff;">Privacy</a></p>
                                </td>
                                <td class="hide w0" width="60"></td>
                                <td class="hide w0" width="160" valign="top">
                                    <p id="street-address" align="right" class="footer-content-right"></p>
                                </td>
                                <td class="w30" width="30"></td>
                            </tr>
                            <tr><td class="w30" width="30"></td><td class="w580 h0" width="360" height="15"></td><td class="w0" width="60"></td><td class="w0" width="160"></td><td class="w30" width="30"></td></tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr><td class="w640" width="640" height="60"></td></tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>
</body>
</html>';
        $this->email->initialize($config);
        $this->email->from('order@npbuy.com', 'no-reply');
		$this->email->reply_to('order@npbuy.com', 'NPBUY');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($html);
        $this->email->send();
				//echo $this->email->print_debugger();
	}

		public function is_facility($id)
	{
		$this->db->select('entities.affiliate_id AS aid,entities.name,entities.code as fcode');
		$this->db->from('users');
		$this->db->join('entities','users.entity_id = entities.id');
		$this->db->where('users.id',$id);
		$query = $this -> db -> get();
		return $query->row_array();
	}
		public function getentity($uid)
	{
		$this -> db -> select('entities.id');
		$this -> db -> from('users');
		$this -> db -> join('entities','users.entity_id = entities.id');
		$this -> db -> where('users.id = ' . "'" . $uid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$email = $val[0]->id;
		} else{
			 $email= '';
		}

		return $email;
	}

        public function getsub_cat_name($id) {
            $this->db->select('sub_category_name');
            $this->db->where('sub_category_id',$id);
            $this->db->from('product_sub_category');
            $q = $this->db->get();
            $name = $q->row();
            if($name->sub_category_name != ''){
                return $name->sub_category_name;
            } else{
                return "";
            }
        }

		/* get GetUnitOfMessure  */
public function GetUnitOfMessure($cid)
{
	if($cid != NULL){
		$this -> db -> select('unit_of_measure');
		$this -> db -> from('unit_of_measure');
		$this -> db -> where('um_id = ' . "'" . $cid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$category_name = $val[0]->unit_of_measure;
		}else{
			$category_name = "";
		}

		return $category_name;
	}else{
		$this -> db -> select('*');
		$this -> db -> from('unit_of_measure');
		$this -> db -> where('status = 1');
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

/* Get Supplier details  */
	public function GetSupplier($uid){
        $this->db->select('*');
        $this->db->from('entities');
        $this->db->where('entities.id',$uid);
        $query=$this->db->get();
        if($query -> num_rows() == 1)
        {
            $val = $query->result();
            $Supplier = $val;
        } else {
            $Supplier = '';
        }
        return $Supplier;
    }


/* Get affiliato details  */
	public function GetAffiliato($uid){
        $this->db->select('*');
        $this->db->from('entities');
		//$this->db->join('entities','entities.id = users.entity_id');
        $this->db->where('entities.id',$uid);
        $query=$this->db->get();
        if($query -> num_rows() >= 1)
        {
            $val = $query->result();
            $affiliato = $val;
        } else {
            $affiliato = '';
        }
        return $affiliato;
    }

/* Get Facility  details  */
	public function GetFacility($uid){
        $this->db->select('*');
        $this->db->from('entities');
        $this->db->where('entities.id',$uid);
        $query=$this->db->get();
        if($query -> num_rows() >= 1)
        {
            $val = $query->result();
            $Facility = $val;
        } else {
            $Facility = '';
        }
        return $Facility;
    }

/* Get Product  details  */

public function GetProduct($pid,$aid)
{

	if($pid != NULL){
		$this -> db -> select('*');
		$this -> db -> from('products');
		$this -> db -> where('product_id = ' . "'" . $pid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$pname = $val;
		}else{
			$pname = "";
		}
		return $pname;
	}else{
		$session_data=$this->session->userdata('logged_in');
		$this -> db -> select('*');
		$this -> db -> from('products');
		$this -> db -> where('pstatus = 1');
		if($session_data['type'] != '1'){
		$this -> db -> where('product_created_by = ' . "'" . $aid . "'");
		}
		$query = $this -> db -> get();
		return $val = $query->result();
	}
}

/* check_facility */

public function check_facility($id)
	{
		$this->db->select('entities.affiliate_id,entities.name,entities.id');
		$this->db->from('users');
		$this->db->join('entities','users.entity_id = entities.id');
		$this->db->where('users.id',$id);
		$query = $this -> db -> get();
		return $query->row_array();
	}

/* check_facility */

public function get_summary_table($id)
	{

		$this->db->select('B.unit_of_measure, SUM( A.product_quantity ) as product_quantity ');
		$this->db->from('orders_items A');
		$this->db->join('products B','B.product_id = A.product_id');
		$this->db->where('A.oid',$id);
		$this->db->group_by('B.unit_of_measure');
		$query = $this -> db -> get();
		return $val = $query->result();
	}

public function update_um($um){
	$this->db->select('um_id');
		 	$this->db->from('unit_of_measure');
			$this->db->where('unit_of_measure',$um);
			$q = $this->db->get();
			if($q->num_rows > 0){
				return $unit['um_id'];
			} else{
				$this->db->insert('unit_of_measure',array('unit_of_measure' => $um));
				return $this->db->insert_id();
			}
}

public function GetUserAttatchmentList($id='')
{
	$links = array();
		$this -> db -> select('attatchment_id,file_name');
		$this -> db -> from('user_attatchment');
		$this -> db -> where('user_id = ' . "'" . $id . "'");
		$query = $this -> db -> get();
		//echo $query -> num_rows();
		if($query -> num_rows() > 0)
		{
			$val = $query->result();
			foreach($val as $vals){
				$links[] = $vals;
			}
		}else{
			$links = "0";
		}
		return $links;
}

public function getHelpPage($url)
{
		$this -> db -> select('help_id');
		$this -> db -> from('help_pages');
		$this -> db -> where('url = ' . "'" . $url . "'");

		$query = $this -> db -> get();
		if($query -> num_rows() > 0)
		{
			$val = $query->result();
			$help_id = $val[0]->help_id;
		}else{
			$this -> db -> select('help_id');
			$this -> db -> from('help_pages');
			$this -> db -> where('url = ' . "'default_help'");
			$query = $this -> db -> get();
			$val = $query->result();
			$help_id = $val[0]->help_id;
		}
		return $help_id;
}
public function getHelpPagebody($id)
{
		$this -> db -> select('title,body');
		$this -> db -> from('help_pages');
		$this -> db -> where('help_id = ' . "'" . $id . "'");
		$query = $this -> db -> get();
		$val = $query->result();
		return $val;
}

public function get_unread_orders($eid='')
{
	$q= $this->db->get_where('orders',array('status' => 1,'supplier_id'=>$eid));
	return $q->num_rows();
}

public function cartpaymentoptions($stype, $entity_id)
{
	if($stype == '2'){
		$sel = $this->db->query("SELECT affiliate_id FROM entities where id=$entity_id");
		$val = $sel->result();
		$affiliate_id = $val[0]->affiliate_id;
	}else{
		$affiliate_id = $entity_id;
	}
	$sel_aff = $this->db->query("SELECT payment_type FROM entities where id=$affiliate_id");
	$val_aff = $sel_aff->result();
	$payment_type = $val_aff[0]->payment_type;
	return $payment_type;
}

public function get_supplier_list()
    {
        $sup=$this->db->get_where('entities',array('type'=>'3','status'=>'1'));
       return $sup->result_array();
	}

public function get_affiliate_supplier_list($sid, $stype)
    {
    	if($stype == '2'){
			$sel = $this->db->query("SELECT affiliate_id FROM entities where id=$sid");
			$val = $sel->result();
			$affiliate_id = $val[0]->affiliate_id;
		}else{
			$affiliate_id = $sid;
		}
		$sel_aff = $this->db->query("SELECT suppliers_id FROM entities where id=$affiliate_id");
		$val_aff = $sel_aff->result();
		$suppliers_id = $val_aff[0]->suppliers_id;
		return $suppliers_id;
	}
public function get_affiliate_supplier_ids()
    {
		$sel_aff = $this->db->query("SELECT id FROM entities where type=3");
		$val_aff = $sel_aff->result();
		foreach($val_aff as $ss){
			$k[] = $ss->id;
		}
		return $k;
}
}
?>