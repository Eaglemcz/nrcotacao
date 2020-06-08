<!DOCTYPE html>
<?php
    //chama arquivo de conexão com o banco de dados
    require_once '../inc/dbconfig.php';

    // Pega o ID do orçamento
    $frncid=intval($_GET['id']);
    $sql = "SELECT frnc.id as frncid,
		    nrc_fornecedor_a_codigo,
            nrc_fornecedor_a_nomeempresa,
            nrc_fornecedor_a_cnpj,
            nrc_fornecedor_a_razaosocial,
            nrc_fornecedor_a_inscricaoestadual,
            nrc_fornecedor_a_nomecontato,
            nrc_fornecedor_a_telefone,
            nrc_fornecedor_a_fax,
            nrc_fornecedor_a_celular,
            nrc_fornecedor_a_comunicadorinstantaneo,
            nrc_fornecedor_a_email,
            nrc_fornecedor_a_site,
            nrc_fornecedor_a_endereco,
            nrc_fornecedor_a_usuario
        
            FROM nrc_fornecedor_a frnc 

            WHERE frnc.id = :frncid";
    // Prepara a query
    $query = $dbh->prepare($sql);
    //Une os parâmetros
    $query->bindParam(':frncid', $frncid,PDO::PARAM_STR);
    //Executa a Query
    $query->execute();
    //Assina os dados com o retorno da tabela, podemos imprimir os registros num loop foreach
    $resultados=$query->fetchAll(PDO::FETCH_OBJ);
    //para inicialização do número de série
    $cnt=1;
    if($query->rowcount() > 0)
    {
    //no caso da query reotnar ao menos um resultado, podemos imprimir os registros num loop foreach
    foreach($resultados as $resultado)
    {    
?>
<html>

<head>
    <meta charset="utf-8">
    <title>NRCotação - Editar fornecedor </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../inc/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../inc/bootstrap/css/font-awesome.min.css" rel="stylesheet">
    <script src="../inc/jquery/jquery-3.4.1.min.js"></script>
    <script src="../inc/bootstrap/js/bootstrap.min.js"></script>
    <script src="../inc/custom.js"></script>
</head>

<body>
    <!-- INÍCIO NAV PRINCIPAL -->
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a href="../orcamentos/index.php" class="btn btn-outline-dark" role="button" aria-disabled="true"><i class="fa fa-check-circle" style="font-size:24px"></i>&nbsp;ORÇAMENTOS</a> &nbsp;
            <a href="#" class="btn btn-outline-dark" role="button" aria-pressed="true"><i class="fa fa-money" style="font-size:24px"></i>&nbsp;PRODUTOS</a> &nbsp;
            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs" style="font-size:24px"></i>
                    Configurar
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Clientes</a>
                    <a class="dropdown-item active" href="../fornecedores/index.php">Fornecedores</a>
                    <a class="dropdown-item" href="#">Situação</a>
                </div>
            </div>
        </form>
    </nav>
    <!-- FIM NAV PRINCIPAL -->

    <!-- INÍCIO NAV ORÇAMENTOS -->
    <div class="container">
        <nav class="navbar navbar-light">
            <form class="form-inline">
                <a class="btn btn-outline-warning" href="../fornecedores/index.php" role="button">Voltar à lista de fornecedores</a>
            </form>
        </nav>
    </div>
    <!-- FIM NAV ORÇAMENTOS -->

    <div class="container">
        <div class="row">
            <h2>Editar fornecedor <?php echo htmlentities($resultado->nrc_fornecedor_a_nomeempresa);?></h2>
        </div>
    </div>


    <div class="container">
        <form name="update_jogo" method="post">
            <div class="form-group">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6"><b>CÓDIGO</b>
                            <!--NÃO EDITÁVEL-->
                            <input disabled id="edit_nrc_fornecedor_a_codigo" name="edit_nrc_fornecedor_a_codigo" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_codigo );?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group card">
                <div class="row">
                    <div class="col-md-12"><b>RAZÃO SOCIAL</b>
                        <input id="edit_nrc_fornecedor_a_razaosocial" name="edit_nrc_fornecedor_a_razaosocial" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_razaosocial );?>">
                    </div>
                    <div class="col-md-6"><b>NOME FANTASIA</b>
                        <input id="edit_nrc_fornecedor_a_nomeempresa" name="edit_nrc_fornecedor_a_nomeempresa" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_nomeempresa );?>">
                    </div>
                    <div class="col-md-6"><b>CNPJ</b>
                        <input id="edit_nrc_fornecedor_a_cnpj" name="edit_nrc_fornecedor_a_cnpj" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_cnpj );?>">
                    </div>
                    <div class="col-md-6"><b>INSC. ESTADUAL</b>
                        <input id="edit_nrc_fornecedor_a_inscricaoestadual" name="edit_nrc_fornecedor_a_inscricaoestadual" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_inscricaoestadual );?>">
                    </div>
                </div>
            </div>

            <div class="form-group card">
                <div class="row">
                    <div class="col-md-12"><b>CONTATO</b>
                        <input id="edit_nrc_fornecedor_a_nomecontato" name="edit_nrc_fornecedor_a_nomecontato" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_nomecontato );?>">
                    </div>
                    <div class="col-md-6"><b>TELEFONE</b>
                        <input id="edit_nrc_fornecedor_a_telefone" name="edit_nrc_fornecedor_a_telefone" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_telefone );?>">
                    </div>
                    <div class="col-md-6"><b>FAX</b>
                        <input id="edit_nrc_fornecedor_a_fax" name="edit_nrc_fornecedor_a_fax" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_fax );?>">
                    </div>
                    <div class="col-md-6"><b>CELULAR</b>
                        <input id="edit_nrc_fornecedor_a_celular" name="edit_nrc_fornecedor_a_celular" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_celular );?>">
                    </div>
                    <div class="col-md-6"><b>COMUNICADOR INSTANTÂNEO</b>
                        <input id="edit_nrc_fornecedor_a_comunicadorinstantaneo" name="edit_nrc_fornecedor_a_comunicadorinstantaneo" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_comunicadorinstantaneo );?>">
                    </div>
                    <br />
                    <div class="col-md-12"><b>E-MAIL</b>
                        <input id="edit_nrc_fornecedor_a_email" name="edit_nrc_fornecedor_a_email" type="email" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_email );?>">
                    </div>
                    <div class="col-md-12"><b>SITE</b>
                        <input id="edit_nrc_fornecedor_a_site" name="edit_nrc_fornecedor_a_site" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_site );?>">
                    </div>
                </div>
            </div>

            <div class="form-group card">
                <div class="row">
                    <div class="col-md-12"><b>ENDEREÇO</b>
                        <input id="edit_nrc_fornecedor_a_endereco" name="edit_nrc_fornecedor_a_endereco" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_endereco );?>">
                    </div>
                </div>
            </div>

            <div class="form-group card">
                <div class="row">
                    <div class="col-md-12"><b>USUARIO DO SISTEMA</b>
                        <input id="edit_nrc_fornecedor_a_usuario" name="edit_nrc_fornecedor_a_usuario" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_fornecedor_a_usuario );?>">
                    </div>
                </div>
            </div>
            <?php }} ?>
            <div class="row">
                <input class="btn btn-primary" type="submit" name="update" value="Atualizar">
            </div>
            <?php
                if (isset($_POST['update'])){
                    //Pega a ID
                    $frncid=intval($_GET['id']);
                    
                    //Valores Post
                    $edit_nrc_fornecedor_a_nomeempresa      = $_POST['edit_nrc_fornecedor_a_nomeempresa'];
                    $edit_nrc_fornecedor_a_cnpj      = $_POST['edit_nrc_fornecedor_a_cnpj'];
                    $edit_nrc_fornecedor_a_razaosocial      = $_POST['edit_nrc_fornecedor_a_razaosocial'];
                    $edit_nrc_fornecedor_a_inscricaoestadual      = $_POST['edit_nrc_fornecedor_a_inscricaoestadual'];
                    $edit_nrc_fornecedor_a_nomecontato      = $_POST['edit_nrc_fornecedor_a_nomecontato'];
                    $edit_nrc_fornecedor_a_telefone      = $_POST['edit_nrc_fornecedor_a_telefone'];
                    $edit_nrc_fornecedor_a_fax      = $_POST['edit_nrc_fornecedor_a_fax'];
                    $edit_nrc_fornecedor_a_celular      = $_POST['edit_nrc_fornecedor_a_celular'];
                    $edit_nrc_fornecedor_a_comunicadorinstantaneo      = $_POST['edit_nrc_fornecedor_a_comunicadorinstantaneo'];
                    $edit_nrc_fornecedor_a_email      = $_POST['edit_nrc_fornecedor_a_email'];
                    $edit_nrc_fornecedor_a_site      = $_POST['edit_nrc_fornecedor_a_site'];
                    $edit_nrc_fornecedor_a_endereco      = $_POST['edit_nrc_fornecedor_a_endereco'];
                    $edit_nrc_fornecedor_a_usuario      = $_POST['edit_nrc_fornecedor_a_usuario'];
                    
                    //Query para o update
                    $sql = "UPDATE nrc_fornecedor_a SET nrc_fornecedor_a_nomeempresa=:edit_nrc_fornecedor_a_nomeempresa, nrc_fornecedor_a_cnpj=:edit_nrc_fornecedor_a_cnpj, nrc_fornecedor_a_razaosocial=:edit_nrc_fornecedor_a_razaosocial, nrc_fornecedor_a_inscricaoestadual=:edit_nrc_fornecedor_a_inscricaoestadual, nrc_fornecedor_a_nomecontato=:edit_nrc_fornecedor_a_nomecontato, nrc_fornecedor_a_telefone=:edit_nrc_fornecedor_a_telefone, nrc_fornecedor_a_fax=:edit_nrc_fornecedor_a_fax, nrc_fornecedor_a_celular=:edit_nrc_fornecedor_a_celular, nrc_fornecedor_a_comunicadorinstantaneo=:edit_nrc_fornecedor_a_comunicadorinstantaneo, nrc_fornecedor_a_email=:edit_nrc_fornecedor_a_email, nrc_fornecedor_a_site=:edit_nrc_fornecedor_a_site, nrc_fornecedor_a_endereco=:edit_nrc_fornecedor_a_endereco, nrc_fornecedor_a_usuario=:edit_nrc_fornecedor_a_usuario where id=:frncid";
                    
                    //Prepara a query para execução
                    $query = $dbh->prepare($sql);
                    
                    //Liga os parâmetros
                    $query->bindParam(':edit_nrc_fornecedor_a_nomeempresa', $edit_nrc_fornecedor_a_nomeempresa, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_cnpj', $edit_nrc_fornecedor_a_cnpj, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_razaosocial', $edit_nrc_fornecedor_a_razaosocial, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_inscricaoestadual', $edit_nrc_fornecedor_a_inscricaoestadual, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_nomecontato', $edit_nrc_fornecedor_a_nomecontato, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_telefone', $edit_nrc_fornecedor_a_telefone, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_fax', $edit_nrc_fornecedor_a_fax, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_celular', $edit_nrc_fornecedor_a_celular, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_comunicadorinstantaneo', $edit_nrc_fornecedor_a_comunicadorinstantaneo, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_email', $edit_nrc_fornecedor_a_email, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_site', $edit_nrc_fornecedor_a_site, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_endereco', $edit_nrc_fornecedor_a_endereco, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_fornecedor_a_usuario', $edit_nrc_fornecedor_a_usuario, PDO::PARAM_STR);
                    $query->bindParam(':frncid', $frncid, PDO::PARAM_STR);
                    
                    //Executa a query
                    $query->execute();
                    
                    // Mesagem após atualizar
                    echo "<script>alert('Registro atualizado com sucesso');</script>";
                    // Redireciona para a home de jogos
                    echo "<script>window.location.href='../fornecedores/edit.php?id=$resultado->frncid'</script>";
                }
            ?>
        </form>
    </div>
</body>

</html>
