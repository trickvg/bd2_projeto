<html>

<head><title>BDII</title></head>
<link href="style.css" type="text/css" rel="stylesheet" />
<body>

<p align="center" style="font-family:'Times New Roman', Times, serif; font-size:20px; padding-bottom:20px;">
	<a href="menu.php">Voltar Menu</a></br></br>
    MAIS VENDIDO
</p>
<?php

// Connects to the XE service (i.e. database) on the "localhost" machine
$conn = oci_connect('usr36', 'usr36', 'oracle.inf.poa.ifrs.edu.br/XE');
//$conn = oci_connect('usr36', 'usr36', '\/XE');
if (!$conn) {
    echo "teste";
   // $e = oci_error();
   // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stmt = ociparse($conn, 'select f_produto_mais_vendido() from dual');
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
?> 
</body>

</html>
