<?php
// Credenciais do banco de dados.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS', '');
define('DB_NAME','brparafu_nrcotacao');
// Estabelece conexão com a base de dados.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
}
catch (PDOException $e)
{
exit("Erro: " . $e->getMessage());
}
?>