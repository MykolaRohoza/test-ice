<?php
	namespace Cells;
	
	class Validator
	{
		protected $errors;
		protected $last_error;
		protected $cols; 
		protected $rows;
		
		protected $input_data;
		protected $default_cells = [];
		
		protected $cells;
		
		public function __construct($input_data = [], $rows = 3, $cols = 3)
		{
			$this->init($rows, $cols);
			$this->rows = $rows;
			$this->cols = $cols;
			if(!$input_data){
				$input_data = $this->default_cells;
			}
			
			$this->setInputData($input_data);
			$this->validateInputData($input_data);
			$this->cells = $this->input_data;
		}
		protected function init($rows, $cols)
		{
			$cells = $rows*$cols;
			for ($i = 0; $cells > $i; $i++){
				$this->default_cells[] = ['cells' => ($i + 1)];
			}
		}
		
		protected function validateInputData($input_data)
		{
			count($this->cells);
			foreach ($input_data as $index => $input_item) {
				if($this->validateInputItem($input_item) && false !== $places = $this->getValidatedPlaces($input_item['cells'])){
					
					$cell = new Cell($input_data, $places, $this->rows, $this->cols);
					if($cell->isValid()){
						$this->cells[] = $cell;
					} else {
						die($cell->getErrors());
					}
				} else {
					$this->errors[$index] = $this->last_error;
					return false;
				}
			}
			if(!empty($this->default_cells)){
				$this->validateInputData($this->default_cells);
			}
			return true;
		}
		protected function getValidatedPlaces($cells)
		{
			$places = explode(',', str_replace(' ', '', $cells));
			foreach ($places as $place) {
				if($this->checkFreePlace($place)){
					$index = array_search(['cells' => $place], $this->default_cells);
					unset($this->default_cells[$index]);
				} else {
					die($this->last_error);
					return false;
				}
			}
			
			return $places;
			
		}
		protected function checkFreePlace($place)
		{
			if($this->rows * $this->cols < $place){
				$this->last_error = 'Invalid cell num "' . $place . '"';
				return false;
			}
			if(!in_array(['cells' => $place], $this->default_cells)){
				$this->last_error = "Place occupied";
				return false;
			}
			return true;
		}
		protected function validateInputItem($input_item)
		{
			if(empty($input_item['cells'])){
				$this->last_error = "Empty cell";
				return false;
			}
			$cells = str_replace(' ', '', $input_item['cells']);
			if(!$cells){
				$this->last_error = "Empty cell";
				return false;
			}
			
			if(trim(preg_replace('~[0-9,]~', '', $cells))){
				$this->last_error = "All cells must be an instance of int";
				return false;
			}
			
			return true;
			
		}
		
		protected function setInputData($input_data)
		{
			$this->input_data = $input_data;
		}
		public function getCells()
		{
			if($this->errors){
				echo print_r ($this->errors, true);
			}
			
			return $this->cells;
		}
		
	
	}
	