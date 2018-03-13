<?php
	namespace Cells;
	class Cell
	{
		protected $errors;
		protected $is_debug = false;
		
		protected $cols; 
		protected $rows; 
		protected $different_cells = []; 
		protected $different_rows = []; 
		protected $text = "";
		/**
		 * cells
		 */
		protected $places = array(); 
		protected $align = "inherit";
		protected $valign = "inherit";
		protected $color = "inherit";
		protected $bgcolor = "inherit";
		protected $colspan = 1;
		protected $rowspan = 1;
		public function __construct($data, $places, $rows = 3, $cols = 3)
		{
			$this->rows = $rows;
			$this->cols = $cols;
			$this->init($data, $places);
		}
		
		protected function init($data, $places)
		{

			if($this->checkPlaces($places)){
				$this->places = $places;
			} else {
				die('<br> $places ' . print_r($places, true) . ' - ' . print_r($this->errors, true) . '<br>');
			}
			foreach ($data as $key => $value) {
				if($key == 'text'){
					var_dump(property_exists($this, 'text'));
					var_dump(property_exists($this, $key));
				}
				
				if(property_exists($this, $key)){
					$this->{$key} = $value;
				} else {
//					var_dump($key, $value);
				}
			}
			
		}
		protected function checkPlaces($places)
		{
			if(!is_array($places)){
				$this->errors[] = '<br> $places is not array <br>';
				return false;
			}
			

			if(!$this->checkRectangle($places)){
				$this->errors[] = '<br> $places is not a Rectangle <br>';
				return false;
			}
			

			return true;
		}
		protected function checkRectangle($places)
		{
			$this->setDifferentSides($places);

			if(count($places) != (count($this->different_cells) * count($this->different_rows))){
				$this->errors[] = 'Произведение колличества отличающихся строк и колличества отличяющися столцов должно быть равно count($places) ';
				return false;
			}
			return true;
		}
		protected function setDifferentSides($places)
		{
			if($this->is_debug){
				$tmp_places = [];
			}
			foreach ($places as $place) {
				$num_row = floor(($place - 1)/ $this->cols) + 1; 
				$num_cell = $place - $this->cols * ($num_row - 1); 
				
				if(!in_array($num_row, $this->different_rows)){
					$this->different_rows[] = $num_row;
				}
				if(!in_array($num_cell, $this->different_cells)){
					$this->different_cells[] = $num_cell;
				}
				if($this->is_debug){
					$tmp_places[] = 'r' . $num_row . '|c' . $num_cell;
					var_dump('r' . $num_row . '|c' . $num_cell) ; echo '<br>';
				}
			}
		}

		public function getMin()
		{
			return min($this->places);
		}
		public function getText()
		{
			return $this->text;
		}

		public function getPlace()
		{
			return $this->place;
		}

		public function getAlign()
		{
			return $this->align;
		}

		public function getValign()
		{
			return $this->valign;
		}

		public function getColor()
		{
			return $this->color;
		}

		public function getBgcolor()
		{
			return $this->bgcolor;
		}

		public function getColspan()
		{
			return $this->colspan;
		}

		public function getRowspan()
		{
			return $this->rowspan;
		}
	
		public function isValid()
		{
			return !$this->errors;
		}	
		public function getErrors()
		{
			return $this->errors;
		}	

	}
	