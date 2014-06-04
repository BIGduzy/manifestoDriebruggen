<?php
 class Template
 {
	//Fields
	protected $_variables = array();
	protected $_controller;
	protected $_action;
	
	public function set($name, $value)
	{
		$this->_variables[$name] = $value;
	}
	
	//Constructor
	public function __construct($controller, $action)
	{
		$this->_controller = $controller; //users
		$this->_action = $action;		  //viewall
	}
	
	public function render()
	{
		extract($this->_variables);
		
		//header
		if (file_exists(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.'header.php'))
		{
			require_once(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.'header.php');
		}
		else
		{
			require_once(ROOT.DS.'application'.DS.'views'.DS.'header.php');
		}
		//content
		if ( file_exists(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.$this->_action.'.php'))
		{
			require_once(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.$this->_action.'.php');
		}
		else
		{
			echo 'De view behorende bij de method: '.$this->_action.' bestaat nog niet';
		}
		//footer
		if (file_exists(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.'footer.php'))
		{
			require_once(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.'footer.php');
		}
		else
		{
			require_once(ROOT.DS.'application'.DS.'views'.DS.'footer.php');
		}
	}
 }
?>