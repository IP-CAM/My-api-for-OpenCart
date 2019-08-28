<?php
class ControllerAppapiProducts extends Controller{
	public function index(){
		$this->load->model('appapi/product');
		$this->load->model('tool/image');

$res = array();

if (isset($this->request->get['id'])) {
	$id = $this->request->get['id'];
	$res = $this->model_appapi_product->getProductsCatId($id);
} else {
	$res = $this->model_appapi_product->getProducts();
}

		foreach ($res as $r => $value) {
			if($value['image']){
				$res[$r]["image"] = $this->model_tool_image->resize($value['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
			} else {
				$res[$r]["image"] = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($res));
	}
}