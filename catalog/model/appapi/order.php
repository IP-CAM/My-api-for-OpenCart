<?php
class ModelAppapiOrder extends Model {
	public function changeOrderStatus($order_id, $order_status_id){
		$this->db->query("UPDATE " . DB_PREFIX . "order SET order_status_id = ". (int)$order_status_id." WHERE order_id = " . (int)$order_id);
	}
}