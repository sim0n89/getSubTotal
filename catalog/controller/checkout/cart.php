<?php 
// Display prices
if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
	$unit_price = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));

	//$price = $this->currency->format($unit_price, $this->session->data['currency']);
	//$total = $this->currency->format($unit_price * $product['quantity'], $this->session->data['currency']);
	

	$unit_price = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
	$buy_price = $unit_price;

	$subtotal = $this->cart->getTotal();
	
	//$total = $this->currency->format($unit_price * $product['quantity'], $this->session->data['currency']);
	$total = $unit_price * $product['quantity'];
	if ($subtotal >= 30001 && $subtotal <= 100000){
		$buy_price = 10*ceil($unit_price*1.1/10);  
	}
	if ($subtotal <= 30000){
		$buy_price = 10*ceil($unit_price*1.65/10);  
	}
	
	$price = $this->currency->format($buy_price, $this->session->data['currency']);
	$total = $this->currency->format($buy_price * $product['quantity'], $this->session->data['currency']);
} else {
	$price = false;
	$total = false;
}