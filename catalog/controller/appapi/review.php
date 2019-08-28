<?php
class ControllerAppapiReview extends Controller{
	public function index(){
		$this->load->model('catalog/review');
		$start = 0;
		if (isset($this->request->get['start'])) {
			$start = $this->request->get['start'];
		}

		$review_info = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], $start);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($review_info));
	}
	public function addReview(){
		$this->load->model('appapi/review');

		$data = array();
		$data = json_decode($_GET['data'], true);

		$data["status"] = 0;
		$data["customer_id"] = 0;

		$this->model_appapi_review->addReview($data);
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));

	}
}