<?php
	namespace Template;
	
	class Helper
	{
		public static function view($file_name, $vars = array())
		{
			if(!is_file($file_name)) {
				die('Could not load file "' . $file_name . '"');
			}
			if (count($vars) > 0){
				foreach ($vars as $key => $value){ 
					$$key = $value;
				}
			}     
			ob_start(); 
			include ($file_name); 
			return ob_get_clean(); 	
		}
	}
	