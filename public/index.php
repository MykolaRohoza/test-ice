<?php 
	chdir(dirname(__DIR__));
	
	require_once 'vendor/autoload.php';
	$cells = [
				[
					"text"		=> "Sample text",
					"cells"		=> "1,2,3",
					"align"		=> "left",
					"valign"	=> "top",
					"color"		=> "fad413",
					"bgcolor"	=> "17541f"
				],
				[
					"text"		=> "Another example",
					"cells"		=> "5, 6, 8, 9",
					"align"		=> "right",
					"valign"	=> "bottom",
					"color"		=> "17541f",
					"bgcolor"	=> "fad413"
				],
				[
					"text"		=> "Hi!",
					"cells"		=> "7",
					"align"		=> "center",
					"valign"	=> "middle",
					"color"		=> "fff",
					"bgcolor"	=> "000"
				],
	
			];
/*
	$cells = [
				[
					"text"		=> "Sample text",
					"cells"		=> "1,2",
					"align"		=> "left",
					"valign"	=> "top",
					"color"		=> "fad413",
					"bgcolor"	=> "17541f"
				],
				[
					"text"		=> "Sample text -- 2",
					"cells"		=> "3",
					"align"		=> "left",
					"valign"	=> "top",
					"color"		=> "fad413",
					"bgcolor"	=> "17541f"
				],
				[
					"text"		=> "Another example",
					"cells"		=> "5, 6, 8, 9",
					"align"		=> "right",
					"valign"	=> "bottom",
					"color"		=> "17541f",
					"bgcolor"	=> "fad413"
				],
				[
					"text"		=> "Hi!",
					"cells"		=> "7",
					"align"		=> "center",
					"valign"	=> "middle",
					"color"		=> "fff",
					"bgcolor"	=> "000"
				],
	
			];
	*/
	(new \http\Grid($cells))->render();

