<?php
 class Pagination
 {
	//Fields
	private $current_page;
	private $records_per_page;
	private $total_records;

	public function get_records_per_page()
	{
		return $this->records_per_page;
	}

	public function get_current_page()
	{
		return $this->current_page;
	}

	//Constructor
	public function __construct($offset, $records_per_page, $total_records)
	{
		$this->records_per_page = $records_per_page;
		$this->current_page = $this->current_page($offset);
		$this->total_records = $total_records;
	}

	public function total_pages()
	{
		//ceil rond een kommagetal naar boven toe af.
		return ceil($this->total_records / $this->records_per_page);
	}

	public function current_page($value)
	{
		return ($value / $this->records_per_page) + 1;
	}
 }
?>