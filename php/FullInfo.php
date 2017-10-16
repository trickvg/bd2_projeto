<head>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<p align="center" style="font-family:'Times New Roman', Times, serif; font-size:20px; padding-bottom:20px;">
	<a href="menu.php">Voltar Menu</a></br></br>
    INFORMACOES TODOS PEDIDOS
</p>
<?php 

$conn = oci_connect('usr36', 'usr36', 'oracle.inf.poa.ifrs.edu.br/XE');
$curs = OCINewCursor($conn); 
$stmt = OCIParse($conn,"BEGIN p_full_info_pedidos(:p_pedidos); END;"); 

OCIBindByName($stmt,":p_pedidos",&$curs,-1,OCI_B_CURSOR); 

$gid=1; // for gid = 1 only
ociexecute($stmt); 
ociexecute($curs); 

while (OCIFetchInto($curs,&$p_pedidos )) { 
echo "<pre>"; 
print_r($p_pedidos ); 
echo "</pre>"; 
}

OCIFreeStatement($stmt); 
OCIFreeCursor($curs); 
OCILogoff($conn); 

?>


