<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2009-2011 Christian Blanquera <cblanquera@gmail.com>
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 * Generates insert query string syntax
 *
 * @package    Eden
 * @category   sql
 * @author     Christian Blanquera <cblanquera@gmail.com>
 * @version    $Id: insert.php 1 2010-01-02 23:06:36Z blanquera $
 */
class Eden_Sql_Insert extends Eden_Sql_Query {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
        protected $_setKey = array();
        protected $_setVal = array();

	/* Private Properties
	-------------------------------*/
	/* Get
	-------------------------------*/
	public static function get($table = NULL) {
		return self::_getMultiple(__CLASS__, $table);
	}
	
	/* Magic
	-------------------------------*/
	public function __construct($table = NULL) {
		if(is_string($table)) {
			$this->setTable($table);
		}
	}
	
	/* Public Methods
	-------------------------------*/
	/**
	 * Set the table name in which you want to delete from
	 *
	 * @param string name
	 * @return this
	 */
	public function setTable($table) {
		//Argument 1 must be a string
		Eden_Sql_Error::get()->argument(1, 'string');
		
		$this->_table = $table;
		return $this;
	}
	
	/**
	 * Set clause that assigns a given field name to a given value.
	 * You can also use this to add multiple rows in one call
	 *
	 * @param string
	 * @param string
	 * @return this
	 * @notes loads a set into registry
	 */
	public function set($key, $value, $index = 0) {
		//argument test
		Eden_Sql_Error::get()
			->argument(1, 'string')				//Argument 1 must be a string
			->argument(2, 'string', 'number');	//Argument 2 must be a string or number
		
		if(!in_array($key, $this->_setKey)) {
			$this->_setKey[] = $key;
		}
		
		$this->_setVal[$index][] = $value;
		return $this;
	}
	
	/**
	 * Returns the string version of the query 
	 *
	 * @param  bool
	 * @return string
	 * @notes returns the query based on the registry
	 */
	public function getQuery() {
		$multiValList = array();
		foreach($this->_setVal as $val) {
			$multiValList[] = '('.implode(', ', $val).')';
		}
		
		return 'INSERT INTO '. $this->_table . ' ('.implode(', ', $this->_setKey).") VALUES ".implode(", \n", $multiValList).';';
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}