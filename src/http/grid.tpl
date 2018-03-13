<!DOCTYPE html>
<html>
    <head>
        <title>PHP Test Task</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
			div {
				
			}
			
			div.container {
				position: relative;
			}
            .cell{
				border: 1px solid #444;
				position: absolute;
				display: flex;
				
                /*
                    border-collapse: initial;
                */
            }
        </style>
    </head>
    <body>
        <h1>ПЕРЕД ИСПОЛЬЗОВАНИЕМ ПОЧИНИТЬ</h1>
			<div class="container" style="width: 300px; height: 300px;">
				<?php foreach ($cells as $key_num => $cell) {?>
					<div class="cell"
						style="
							align-items: <?=$cell->getValign()?>;
							width: <?=$cell->getWidth()?>;
							height: <?=$cell->getHeight()?>;
							top: <?=$cell->getTop()?>;
							left: <?=$cell->getLeft()?>;
							background-color:<?=$cell->getBgcolor()?>;
							color:<?=$cell->getColor()?>;
							justify-content:<?=$cell->getAlign()?>; 
							" 
						 >
							<?=$cell->getText()?>
					</div>
				<?php } ?>
			</div>
    </body>
</html>

