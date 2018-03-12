<?php
	namespace http;
	/**
	 * Description of calendar
	 *
	 * @author Kalyan
	 */
	class Grid
	{
		protected $data = array();
		protected $template;

		public function __construct($cells)
		{
			$this->init();
			$valid_cells = new \Cells\Validator($cells);
			$this->data['cells'] = $valid_cells->getCells(); 
		}

		public function render()
		{
			echo \Template\Helper::view($this->template, $this->data);
		}
		
		protected function init()
		{
			$this->setTemplate($this->getDefaultTemplate());
		}
		protected function setTemplate($template)
		{
			$this->template = $template;
		}
		protected function getDefaultTemplate()
		{
			return preg_replace('~\.php~', '.tpl', __FILE__);
		}
	}
	