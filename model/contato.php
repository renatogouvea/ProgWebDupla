<?php
	
	namespace model;

	class contato{
	public $name;
	public $email;

		public function __construct($name, $email){
			$this->name = $name;
			$this->email = $email;
		}		
	}
