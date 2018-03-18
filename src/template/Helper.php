<?php
	namespace Template;
	
	class Helper
	{
	 /**
     * @assert (0) == -1
     * @assert (1) == 0
     * @assert (3) == 2
     * @assert (2) == 1
     * @assert (4) == 3
     */
		public function hz($data)
		{
			return $data - 1;
		}
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
	