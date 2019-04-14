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
					ID
				</th>

				<th>
					Nome
				</th>
				<th>
					E-mail
				</th>
				<th>
					Ações
				</th>
			
			</tr>
				<?php 
					for ($i = 0; $i < sizeof($list); $i++){
						$array = $list[$i];
						$a = $array['name'];
						$b = $array['email'];
						$c = $array['id'];
				?>
				<tr>
					<td>
						<?php echo($c); ?>
					</td>

					<td>
						<?php echo($a); ?>
					</td>
					<td>
						<?php echo($b); ?>
					</td>

					<td>
						<a href ="index.php?action=editContactForm&id=<?php echo($c)?>">Editar</a>
						<a href ="index.php?action=deleteContact&id=<?php echo($c)?>">Remover</a>
					</td>	
					
				</tr>
				<?php } ?>
		</table>
	</div>
</body>
</html>
