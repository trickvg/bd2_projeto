<html>

<head><title>BDII</title></head>
<link href="style.css" type="text/css" rel="stylesheet" />
<body>

<div id="centro">

<p align="center" style="font-family:'Times New Roman', Times, serif; font-size:20px; padding-bottom:20px;">
	<title>Banco Dados 2</title>
	<a href="menu.php">Voltar Menu</a></br></br>
	DELETAR PEDIDO-PRODUTOS/ESTOQUE
</p>

<?php
//session_start();

$flag = true;

//include "conexao.inc.php";

if(isset($_REQUEST["deletar"])) {

	$p_id_pedido = $_REQUEST["id_pedido"];
		
//session_destroy("cadastro");

	if(empty($p_id_pedido)) {
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
		$sql = "BEGIN p_delete_pedidoProdutos(:p_id_pedido); END;";

		$stmt = OCIParse($conn,$sql);
			
		OCIBindByName($stmt, ":p_id_pedido",$p_id_pedido);
				
		if(ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)){
			echo "Deletado com sucesso!<br />";
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
        	<td align="right" style="padding-right:5px;">Id Pedido</td>
            <td><input type="number" name="id_pedido" size="15"></td>
        </tr>
        <tr>
        	<td></td>
            <td><input type="submit" name="deletar" value="Deletar">
            	<input type="submit" name="limpar" value="Limpar"></td>
	</table>    
</div>
</form>

</div>