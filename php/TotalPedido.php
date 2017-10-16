<html>

<head><title>BDII</title></head>
<link href="style.css" type="text/css" rel="stylesheet" />
<body>

<p align="center" style="font-family:'Times New Roman', Times, serif; font-size:20px; padding-bottom:20px;">
	<link href="style.css" type="text/css" rel="stylesheet" />
	<a href="menu.php">Voltar Menu</a></br></br>
    TOTAL PEDIDO
</p>
<?php
if(isset($_REQUEST["consultar"])) {

	$p_id = $_REQUEST["id"];
		
//session_destroy("cadastro");

	if(empty($p_id)) {
		echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha todos os campos!</center></font><br>";
		$flag = false;
	}
	else {
		$flag = true;

// Connects to the XE service (i.e. database) on the "localhost" machine
$conn = oci_connect('usr36', 'usr36', 'oracle.inf.poa.ifrs.edu.br/XE');
//$conn = oci_connect('usr36', 'usr36', '\/XE');
if (!$conn) {
    echo "teste";
   // $e = oci_error();
   // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stmt = ociparse($conn, 'select f_total_pedido(:p_id) from dual');
OCIBindByName($stmt, ":p_id",$p_id);

ociexecute($stmt);



echo "<table border='1'>\n";
while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
OCIFreeStatement($stmt);  
OCILogoff($conn);
	}
}
?>

<form action="<?php $PHP_SELF ?>" method="post">

<div align="center"> 
	<table align="center" width="50%" border="0" cellpadding="2">
		<tr>
        	<td align="right" style="padding-right:5px;">Id PEDIDO</td>
            <td><input type="number" name="id" size="15"></td>
        </tr>
        <tr>
        	<td></td>
            <td><input type="submit" name="consultar" value="Consutlar">
            	<input type="submit" name="limpar" value="Limpar"></td>
	</table>    
</div>
</form>

</div>
</body>
</html>


