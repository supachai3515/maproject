<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_province()
    {
        $sql ="SELECT * FROM  province";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function get_contract()
    {
        $sql ="SELECT * FROM  discount_of_contract";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

		function get_status()
	  	{
			$sql ="SELECT * FROM  order_status";
	      $query = $this->db->query($sql);
	      $result = $query->result();
	      return $result;
	  	}


    public function get_products($txt_search)
    {
        $sql ="SELECT product_owner_id, part_number, name, model FROM product_owner ORDER BY product_owner_id  LIMIT 10";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_products_serach($searchText, $start, $limit)
    {
        // $this->db->escape() ใส่ '' ให้
        // $this->db->escape_str()  ไม่ใส่ '' ให้
        // $this->db->escape_like_str($searchText) like
        $searchText = $this->db->escape_like_str($searchText);
        $sqlString = "";
        $data   = preg_split('/\s+/', $searchText);

        $sqlString = $sqlString.$this->whereSqlConcat($data);
        $countSql = count($data);

        $sql   ="";
        if ($countSql < 2) {
            $sql   = "SELECT p.product_owner_id, p.part_number, p.name, p.model ,b.`name` brand_name
													FROM product_owner p
													INNER JOIN (
														SELECT CONCAT(IFNULL(pw.part_number,''),
																					IFNULL(pw.`name`,''),
																					IFNULL(pw.description,''),
																					IFNULL(pw.model,''),
																					IFNULL(b.`name`,''),
																					IFNULL(b.description,'')
																			) AS search ,
																			pw.product_owner_id
																		FROM product_owner pw
																		LEFT JOIN product_brand b ON pw.product_brand_id = b.product_brand_id
																		WHERE b.is_active = 1 AND pw.is_active = 1

													) ps ON ps.product_owner_id = p.product_owner_id
													LEFT JOIN product_brand b ON p.product_brand_id = b.product_brand_id
													WHERE 1=1 AND ps.search like UPPER('%".$searchText."%') LIMIT ". $this->db->escape_str($start).",". $this->db->escape_str($limit);
        } else {
            $sql  = $sqlString ."LIMIT ". $this->db->escape_str($start).",". $this->db->escape_str($limit);
        }

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function whereSqlConcat($keyArray)
    {
        $countKey = count($keyArray);
        $sqlString=" SELECT ps.search , p.product_owner_id, p.part_number, p.name, p.model ,b.`name` brand_name
										FROM product_owner p
										INNER JOIN (
											SELECT CONCAT(IFNULL(pw.part_number,''),
																		IFNULL(pw.`name`,''),
																		IFNULL(pw.description,''),
																		IFNULL(pw.model,''),
																		IFNULL(b.`name`,''),
																		IFNULL(b.description,'')
																) AS search ,
																pw.product_owner_id
															FROM product_owner pw
															LEFT JOIN product_brand b ON pw.product_brand_id = b.product_brand_id
															WHERE b.is_active = 1 AND pw.is_active = 1

										) ps ON ps.product_owner_id = p.product_owner_id
										LEFT JOIN product_brand b ON p.product_brand_id = b.product_brand_id WHERE 1=1 AND";
        if ($countKey >1) {
            $checkLine = 0;
            $sqlString = $sqlString." ( ";

            foreach ($keyArray as $key) {
                $checkLine++;
                if ($checkLine != $countKey) {
                    $sqlString  = $sqlString." ps.search like UPPER('%" . $key . "%') AND ";
                } else {
                    $sqlString  = $sqlString." ps.search like UPPER('%" . $key . "%')";
                }
            }
            $sqlString = $sqlString." ) ";
        }

        return $sqlString;
    }
}

/* End of file discount_of_contract_model.php */
/* Location: ./application/models/discount_of_contract_model.php */
