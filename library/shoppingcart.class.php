<?php
 class Shoppingcart
 {
	//Field
	private $items = array();

	//Property
	public function get_items()
	{
		return $this->items;
	}

	public function set_items($product)
	{
		//var_dump($product);exit();
		$this->items[] = array( 'id' => $product['id'],
								'name' => $product['name'],
								'description' => $product['description'],
								'price' => $product['price'],
								'foto_name' => $product['foto_name'],
								'aantal' => $product['aantal']);
	}

	public function add_to_cart($product, $number)
	{
	 //var_dump($product);
	 foreach ( $this->items as $key => $value)
	 {
		// 1 Kijk of het meegegeven id gelijk is aan het id binnen het items array
		if ( $value['id'] == $product[0]['Product']['product_id'])
		{
			// 2 Als dit waar is, verhoog dan het veld 'aantal van het items array'
			$this->items[$key]['aantal'] += $number;
			var_dump($this->items);
			return;
		}		
	 }
     $this->items[] = array( 'id' => $product[0]['Product']['product_id'],
							 'name' => $product[0]['Product']['product_name'],
							 'description' => $product[0]['Product']['product_description'],
							 'price' => $product[0]['Product']['product_price'],
							 'foto_name' => $product[0]['Product']['foto_name'],
							 'aantal' => $number);
	 var_dump($this->items);
	}

	public function remove_from_cart($product, $number)
	{
		//var_dump($product);exit();		
		foreach ($this->items as $key => $value)
		{
			if ($value['id'] == $product[0]['Product']['product_id'])
			{
				//echo $this->items[$key]['id'];exit();				
				if ( $value['aantal'] > 1)
				{
					$this->items[$key]['aantal'] -= $number;
					return;
				}
				else
				{
					unset($this->items[$key]);
					return;
				}
			}
		}
	}

	public function total_products()
	{
		$total = 0;
		foreach ($this->items as $value)
		{
			$total += $value['aantal'];
		}
		return $total;
	}

	public function empty_cart()
	{
		unset($this->items);
	}

	public function remove_item_from_cart($id)
	{
		foreach ($this->items as $key => $value)
		{
			if ($value['id'] == $id)
			{
				unset($this->items[$key]);
				return;
			}
		}
	}
 }
?>