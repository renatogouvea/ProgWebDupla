<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contatos cadastrados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	
</head>
<body>
	<div align="center">
		<table  border="1px"  width="800">
			<tr>
				
				<th>
					Nome
				</th>
				<th>
					E-mail
				</th>
			
			</tr>
				<?php 
					for ($i = 0; $i < sizeof($lista); $i++){
						$array = $lista[$i];
						$a = $array['nome'];
						$b = $array['email'];
				?>
				<tr>
					<td>
						<?php echo($a); ?>
					</td>
					<td>
						<?php echo($b); ?>
					</td>
				</tr>
				<?php } ?>
		</table>
	</div>
</body>
</html>
