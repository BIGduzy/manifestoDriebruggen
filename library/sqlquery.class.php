<?php
 class SqlQuery
 {
	//Fields
	protected $_dbHandle;
	protected $_result;
	
	public function connect($host, $user, $password, $dbname)
	{
		$this->_dbHandle = mysql_connect($host, $user, $password);
		if ($this->_dbHandle != 0)
		{
			if (mysql_select_db($dbname, $this->_dbHandle))
			{
				return true;
			}	
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function query($query, $singleResult = 0)
	{
		$this->_result = mysql_query($query, $this->_dbHandle);
		
		if (preg_match("/select/i", $query))
		{
			$result 	= array();
			$table 		= array();
			$field 		= array();
			$tempResults = array();
			$numOfFields = mysql_num_fields($this->_result);
			//echo $numOfFields;
			
			for ($i = 0; $i < $numOfFields; $i++)
			{
				array_push($table, mysql_field_table($this->_result, $i));
				array_push($field, mysql_field_name($this->_result, $i));
			}
			//var_dump($table);
			//var_dump($field);
			
			while($row = mysql_fetch_row($this->_result))
			{
				for ($i = 0; $i < $numOfFields; $i++)
				{
					$table[$i] = trim(ucfirst($table[$i]), 's');
					$tempResults[$table[$i]][$field[$i]] = $row[$i];
				}
				
				if ($singleResult == 1)
				{
					mysql_free_result($this->_result);
					return $tempResults;
				}
				array_push($result, $tempResults);
			}
			mysql_free_result($this->_result);			
			//var_dump($table);
			//var_dump($result);
			return $result;			
		}
	}
	
	public function find_last_inserted_id()
	{
		return mysql_insert_id();
	}
 }
?>














