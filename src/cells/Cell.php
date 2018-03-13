<?php
	namespace Cells;
	class Cell
	{
		protected $errors;
		protected $is_debug = false;
		
		protected $cols; 
		protected $rows; 
		protected $different_cols = []; 
		protected $different_rows = []; 
		protected $text = "";
		protected $coords = []; 
		/**
		 * cells
		 */
		protected $places = []; 
		protected $min; 
		protected $align = "inherit";
		protected $valign = "inherit";
		protected $color = "inherit";
		protected $bgcolor = "inherit";
		
		protected $colspan = 1;
		protected $rowspan = 1;
		protected $width;
		protected $height;
		protected $top;
		protected $left;
		
		
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
				if(property_exists($this, $key)){
					$this->{$key} = $value;
				} 
			}
			if(isset($data['valign'])){
				$this->valign = $this->getValidValign($data['valign']);
			}
			if(isset($data['align'])){
				$this->align = $this->getValidAlign($data['align']);
			}
			if(isset($data['color'])){
				$this->align = $this->getValidAlign($data['align']);
			}
			
			$this->colspan = count($this->different_cols);
			$this->rowspan = count($this->different_rows);
			
			
			$this->width = $this->getActualWidth();
			$this->height = $this->getActualHeight();
			$this->setActualMin();
			$this->top = $this->getActualTop();
			$this->left = $this->getActualLeft();
		}
		
		protected function getValidValign($valign)
		{
			switch ($valign) {
				case 'top':
					return 'flex-start';	
				case 'middle':
					return 'center';	
				case 'bottom':
					return 'flex-end';	
				default:
					return $this->valign;
			}
		}
		protected function getValidAlign($align)
		{
			switch ($align) {
				case 'left':
					return 'flex-start';	
				case 'center':
					return 'center';	
				case 'right':
					return 'flex-end';	
				default:
					return $this->valign;
			}
		}

		



		protected function getActualTop()
		{
			$result = $this->coords[$this->min]['num_row'] - 1;
			
			
//			return $result * 100 / $this->rows . '%';
			return $result * 300 / $this->rows . 'px';
		}
		protected function getActualLeft()
		{			
			$result = $this->coords[$this->min]['num_col'];
			
//			return $result * 100 / $this->cols . '%';
			return $result * 300 / $this->cols . 'px';
			
		}
		protected function getActualWidth()
		{
//			$result = (floor(100 / $this->cols) * $this->colspan);
//			return $result . '%';
			$result = (100 - 1) * $this->colspan;
			return $result . 'px';
		}
		protected function getActualHeight()
		{
//			$result = (floor(100 / $this->rows)) * $this->rowspan;
//			return $result . '%';
			$result = (100 - 1) * $this->rowspan;
			return $result . 'px';
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

			if(count($places) != (count($this->different_cols) * count($this->different_rows))){
				$this->errors[] = 'Произведение колличества отличающихся строк и колличества отличяющися столцов должно быть равно count($places) ';
				return false;
			}
			return true;
		}
		protected function setDifferentSides($places)
		{
			foreach ($places as $place) {
				$num_row = floor(($place - 1)/ $this->cols) + 1; 
				$num_col = $place - $this->cols * ($num_row - 1); 
				
				if(!in_array($num_row, $this->different_rows)){
					$this->different_rows[] = $num_row;
				}
				if(!in_array($num_col, $this->different_cols)){
					$this->different_cols[] = $num_col;
				}
				$this->coords[$place] = [
					'num_row' => $num_row,
					'num_col' => $num_col,
				];
			}
		}

		protected function setActualMin()
		{
			$this->min = min($this->places);
		}
		public function getMin()
		{
			return $this->min;
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
			return $this->bgcolor ;
		}

		

		public function getHeight()
		{
			return $this->height;
		}

		public function getWidth()
		{
			return $this->width;
		}
	
		public function getTop()
		{
			return $this->top;
		}

		public function getLeft()
		{
			return $this->left;
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
	
