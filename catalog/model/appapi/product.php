<?php
class ModelAppapiProduct extends Model {
	public function getProducts(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product AS p 
			INNER JOIN " . DB_PREFIX . "product_description AS d ON p.product_id = d.product_id 
			WHERE p.status = 1");
		return $query->rows;
	}
	
	public function getProductsCatId($id){
		$query = $this->db->query("SELECT op.product_id, op.image, op.price, opd.name, op.status FROM " . DB_PREFIX . "product op 
			INNER JOIN " . DB_PREFIX . "product_to_category optc ON (op.product_id = optc.product_id AND op.status = 1) 
			INNER JOIN " . DB_PREFIX . "category cc ON (optc.category_id = cc.category_id)
			INNER JOIN " . DB_PREFIX . "product_description opd ON (opd.product_id = op.product_id)
			WHERE cc.category_id = " . (int)$id . " OR cc.parent_id = " . (int)$id);
		return $query->rows;
	}
}