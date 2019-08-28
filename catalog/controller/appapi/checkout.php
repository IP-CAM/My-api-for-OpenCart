<?php
class ControllerAppapiCheckout extends Controller{
	public function index(){
		$this->load->model('checkout/order');
		$this->load->model('appapi/order');
		$this->load->model('localisation/currency');

		$currency = $this->model_localisation_currency->getCurrencyByCode("UAH");

		$data = array();
		$data = json_decode($_GET['data'], true);
		$new_data = array();
		$new_data["firstname"] = $data["firstname"];
		$new_data["lastname"] = $data["lastname"];
		$new_data["payment_firstname"] = $data["firstname"];
		$new_data["payment_lastname"] = $data["lastname"];
		$new_data["shipping_firstname"] = $data["firstname"];
		$new_data["shipping_lastname"] = $data["lastname"];
		$new_data["payment_address_1"] = $data["address"];
		$new_data["shipping_address_1"] = $data["address"];
		$new_data["email"] = $data["email"];
		$new_data["telephone"] = $data["telephone"];
		$new_data["order_status_id"] = 1;
		$new_data["total"] = 0;
		$new_data["currency_id"] = $currency["currency_id"];
		$new_data["currency_code"] = $currency["code"];
		$new_data["currency_value"] = $currency["value"];
		$i = 0;
		foreach ($data['products'] as $product) {
			$new_data["products"][$i]["product_id"] = $product["product_id"];
			$new_data["products"][$i]["name"] = $product["name"];
			$new_data["products"][$i]["price"] = $product["price"];
			$new_data["products"][$i]["quantity"] = $product["quantity"];
			$new_data["products"][$i]["total"] = $product["price"]*$product["quantity"];
			$new_data["total"] += $new_data["products"][$i]["total"];
			$i++;
		}

		$id = $this->model_checkout_order->addOrder($new_data);
		$this->model_appapi_order->changeOrderStatus($id, 1);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));

	}
}