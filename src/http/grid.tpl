<!DOCTYPE html>
<html>
    <head>
        <title>PHP Test Task</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
			div {
				float: left;
			}
            .cell{
				border: 1px solid #444;
                padding: 1px;
                /*
                    border-collapse: initial;
                */
            }
        </style>
    </head>
    <body>
        <h1>ПЕРЕД ИСПОЛЬЗОВАНИЕМ ПОЧИНИТЬ</h1>
			<div style="width: 300px; height: 300px;">
				<?php foreach ($cells as $key_num => $cell) {?>
					<div class="cell" style="width: 32%; height: 32%; "><?=$cell->getText() . " #" .  ($key_num)?></div>
				<?php } ?>
			</div>
    </body>
</html>

