<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2009-2011 Christian Blanquera <cblanquera@gmail.com>
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 *  Eventbrite Organizer
 *
 * @package    Eden
 * @category   eventbrite
 * @author     Christian Blanquera <cblanquera@gmail.com>
 * @version    $Id: registry.php 1 2010-01-02 23:06:36Z blanquera $
 */
class Eden_Eventbrite_Event_Organizer extends Eden_Eventbrite_Base {
	/* Constants
	-------------------------------*/
	const URL_NEW 		= 'https://www.eventbrite.com/json/organizer_new';
	const URL_UPDATE 	= 'https://www.eventbrite.com/json/organizer_update';
	const URL_EVENTS 	= 'https://www.eventbrite.com/json/organizer_list_events';
	
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	/* Private Properties
	-------------------------------*/
	/* Get
	-------------------------------*/
	public static function get($user, $api) {
		return self::_getMultiple(__CLASS__, $user, $api);
	}
	
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function add($name, $description = NULL) {
		//Argument Test
		Eden_Eventbrite_Error::get()
			->argument(1, 'string')				//Argument 1 must be a string
			->argument(2, 'string');			//Argument 2 must be a string
		
		$query = array(
			'name' 			=> $name,
			'description'	=> $description);
		
		return $this->_getJsonResponse(self::URL_NEW, $query);
	}
	
	public function update($id, $name, $description = NULL) {
		//Argument Test
		Eden_Eventbrite_Error::get()
			->argument(1, 'int')				//Argument 1 must be an integer
			->argument(2, 'string')				//Argument 2 must be a string
			->argument(3, 'string');			//Argument 3 must be a string
		
		$query = array(
			'id'			=> $id,
			'name' 			=> $name,
			'description'	=> $description);
		
		return $this->_getJsonResponse(self::URL_UPDATE, $query);
	}
	
	public function getEvents($id) {
		//Argument 1 must be an int
		Eden_Eventbrite_Error::get()->argument(1, 'int');
		
		$query = array('id'	=> $id);
		
		return $this->_getJsonResponse(self::URL_EVENTS, $query);
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}