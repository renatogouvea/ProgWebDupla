<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar contato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
</head>
<body>
    <div>
        <h3>Informações atuais</h3>
        <table  border="1px"  width="800">
            <tr>
                <th>
                    Nome
                </th>
                <th>
                    E-mail
                </th>
            </tr>
            <tr>
                <td>
                    <?php echo($name); ?>
                </td>

                <td>
                    <?php echo($email); ?>
                </td>
            </tr>
        </table>
   
    </div>

    <div>
    	<h3>Editar contato </h3>
        <form method="post" action="index.php?action=editContact&id=<?php echo($id) ?>" >
            <div><input type="text" name="name" placeholder="novo nome" /></div>
            <div><input type="text" name="email" placeholder="novo email" /></div>
            <div><input type="submit" value="Cadastrar"/></div>

        </form>
    </div>
</body>
</html>