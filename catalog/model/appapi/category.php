<?php
class ModelAppapiCategory extends Model {
	public function getCategory(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c 
			INNER JOIN " . DB_PREFIX . "category_description AS cd ON c.category_id = cd.category_id WHERE c.top = 1 AND c.status = 1");
		return $query->rows;
	}
	
	public function getSubCategory($parent){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c 
			INNER JOIN " . DB_PREFIX . "category_description AS cd ON c.category_id = cd.category_id WHERE c.parent_id = ". (int)$parent ." AND c.status = 1");
		return $query->rows;
	}
}