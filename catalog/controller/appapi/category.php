<?php
class ControllerAppapiCategory extends Controller{
	public function index(){
		$this->load->model('appapi/category');
		$this->load->model('tool/image');
		
		$res = array();

		if (isset($this->request->get['parent'])) {
			$parent = $this->request->get['parent'];
			$res = $this->model_appapi_category->getSubCategory($parent);
		} else {
			$res = $this->model_appapi_category->getCategory();
		}

		foreach ($res as $r => $value) {
			if($value['image']){
				$res[$r]["image"] = $this->model_tool_image->resize($value['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_height'));
			} else {
				$res[$r]["image"] = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_height'));
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($res));
	}
}