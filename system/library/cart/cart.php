<?php 

public function getSubTotal() {
	$total = 0;

	foreach ($this->getProducts() as $product) {
		$total += 10*ceil($unit_price*1.65/10) * $product['quantity'];
	}
	$cust_total = 0;
	switch ($total) {
		
		case ($total <= 30000):	
			
			foreach ($this->getProducts() as $product) {
				$unit_price = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
				$cust_total += 10*ceil($unit_price*1.65/10) * $product['quantity']; 
				
			}
		break;
		case ($total >= 30001 && $total <=100000):	
			
			foreach ($this->getProducts() as $product) {
				$unit_price = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
				$cust_total += 10*ceil($unit_price*1.1/10) * $product['quantity']; 
			}
			if ($cust_total >= 30001 && $cust_total <=100000){
				
			}
			else {
				$cust_total = 0;
				foreach ($this->getProducts() as $product) {
					$unit_price = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
					$cust_total += 10*ceil($unit_price*1.65/10) * $product['quantity']; 
				}
			}
		break;
		case ($total >= 100001):	
			
			foreach ($this->getProducts() as $product) {
				$unit_price = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
				$cust_total += $unit_price * $product['quantity']; 
			}
			if ($cust_total >= 100001){
				
			}
			else {
				$cust_total = 0;
				foreach ($this->getProducts() as $product) {
					$unit_price = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
					$cust_total += 10*ceil($unit_price*1.1/10) * $product['quantity']; 
				}
			}
		break;		
	}
	return $cust_total;
}
