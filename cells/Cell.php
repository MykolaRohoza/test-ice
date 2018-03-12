<?php
	namespace Cells;
	class Cell
	{
		protected $cols; 
		protected $rows; 
		
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
			$tmp_places = array();
			$places[] = 4;
			$places[] = 5;
			$places[] = 6;
			$places[] = 7;
			$places[] = 8;
			$places[] = 9;

			
			/*
			 * Произведение колличества отличающихся строк и колличества отличяющися столцов должно быть равно 
			 * count($places)
			 */
			$different_rows = [];
			$different_cells = [];
			
			foreach ($places as $place) {
				$num_row = floor(($place - 1)/ $this->cols) + 1; 
				$num_cell = $place - $this->cols * ($num_row - 1); 
				if(!in_array($place, $different_cells)){
					$different_cells[] = $place;
				}
				if(!in_array($place, $different_rows)){
					$different_rows[] = $place;
				}
				$tmp_places[] = 'r' . $num_row . '|c' . $num_cell;
			}
			var_dump($tmp_places, $different_rows, $different_cells);die;
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
			$places_li = count($places) -1;
			for ($i = 0; $i <= $places_li; $i++) {
				for ($j = $i+1; $j <= $places_li; $j++) {
						echo "<br>$i<br>$j<br>";
						var_dump($places[$i]);
						var_dump($places[$j]);
				}
			}
			die;
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

		public function setText($text)
		{
			$this->text = $text;
		}

		public function setPlace($place)
		{
			$this->place = $place;
		}

		public function setAlign($align)
		{
			$this->align = $align;
		}

		public function setValign($valign)
		{
			$this->valign = $valign;
		}

		public function setColor($color)
		{
			$this->color = $color;
		}

		public function setBgcolor($bgcolor)
		{
			$this->bgcolor = $bgcolor;
		}

		public function setColspan($colspan)
		{
			$this->colspan = $colspan;
		}

		public function setRowspan($rowspan)
		{
			$this->rowspan = $rowspan;
		}

	
		public function isValid()
		{
			return true;
		}	
		public function getErrors()
		{
			return 'todo';
		}	

	}
	