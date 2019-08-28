<?php
class ModelAppapiReview extends Model {
	public function addReview($data){
		$this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['author']) . "', customer_id = '" . (int)$data['customer_id'] . "', product_id = '" . (int)$data['product_id'] . "', text = '" . $this->db->escape($data['text']) . "', rating = '" . (int)$data['rating'] . "', date_added = NOW()");
	}
}