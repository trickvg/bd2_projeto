<html>

<head><title>BDII</title></head>
<link href="style.css" type="text/css" rel="stylesheet" />
<body>

<div id="centro">

<p align="center" style="font-family:'Times New Roman', Times, serif; font-size:20px; padding-bottom:20px;">
	<a href="menu.php">Voltar Menu</a></br></br>
	ATUALIZAR CADASTRO CLIENTE
</p>

<?php
//session_start();

$flag = true;

//include "conexao.inc.php";

if(isset($_REQUEST["enviar"])) {

	$p_id = $_REQUEST["id"];
	$p_nome_cliente = $_REQUEST["nome_cliente"];
	$p_cpf = $_REQUEST["cpf"];
	$p_endereco = $_REQUEST["endereco"];
	$p_email = $_REQUEST["email"];
	$p_telefone = $_REQUEST["telefone"];
		
//session_destroy("cadastro");

	if(empty($p_nome_cliente) || empty($p_id) || empty($p_cpf) || empty($p_endereco) || empty($p_email) || empty($p_telefone)) {
		echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha todos os campos!</center></font><br>";
		$flag = false;
	}
	else {
		$flag = true;

$conn = oci_connect('usr36', 'usr36', 'oracle.inf.poa.ifrs.edu.br/XE');
if (!$conn) {
    echo "teste";
   // $e = oci_error();
   // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
		
		//$sql = "BEGIN insert_cargo(:p_nome_cargo, :p_min_sal, :p_max_sal); END;";
		$sql = "BEGIN p_update_cliente(:p_id, :p_nome_cliente, :p_cpf, :p_endereco, :p_email, :p_telefone); END;";

		$stmt = OCIParse($conn,$sql);
			
		OCIBindByName($stmt, ":p_id",$p_id);
		OCIBindByName($stmt, ":p_nome_cliente",$p_nome_cliente);
		OCIBindByName($stmt, ":p_cpf", $p_cpf);
		OCIBindByName($stmt, ":p_endereco", $p_endereco);
		OCIBindByName($stmt, ":p_email", $p_email);
		OCIBindByName($stmt, ":p_telefone", $p_telefone);
				
		if(ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)){
			echo "Atualizado com sucesso!<br />";
		}	
		else{
			die ("Erro no SQL");
		}
		OCIFreeStatement($stmt); 
		OCILogoff($conn); 
	}
}


?>

<form action="<?php $PHP_SELF ?>" method="post">

<div align="center"> 
	<table align="center" width="50%" border="0" cellpadding="2">
		<tr>
        	<td align="right" style="padding-right:5px;">Id</td>
            <td><input type="number" name="id" size="15"></td>
        </tr>
		<tr>
        	<td align="right" style="padding-right:5px;">Nome Cliente</td>
            <td><input type="text" name="nome_cliente" size="15"></td>
        </tr>
        <tr>
        	<td align="right" style="padding-right:5px;">CPF</td>
            <td><input type="text" name="cpf" size="15"></td>
        </tr>
		<tr>
        	<td align="right" style="padding-right:5px;">Endereco</td>
            <td><input type="text" name="endereco" size="30"></td>
        </tr>
		<tr>
        	<td align="right" style="padding-right:5px;">E-Mail</td>
            <td><input type="text" name="email" size="30"></td>
        </tr>
		<tr>
        	<td align="right" style="padding-right:5px;">Telefone</td>
            <td><input type="text" name="telefone" size="15"></td>
        </tr>
        <tr>
        	<td></td>
            <td><input type="submit" name="enviar" value="Cadastrar">
            	<input type="submit" name="limpar" value="Limpar"></td>
	</table>    
</div>
</form>

</div>

</body>
</html>