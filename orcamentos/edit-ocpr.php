<!DOCTYPE html>
<?php
    //chama arquivo de conexão com o banco de dados
    require_once '../inc/dbconfig.php';

    // Pega o ID do orçamento
    $ocprid=intval($_GET['id']);
    $sql = "SELECT tbocpr.id as ocprid,
		nrc_orcamento_produto_a_codigo,
        nrc_orcamento_produto_a_quantidade,
        nrc_orcamento_produto_a_unidade,
        DATE_FORMAT(nrc_orcamento_produto_a_prazoentrega,'%d/%m/%Y') AS nrc_orcamento_produto_a_prazoentrega,
        nrc_orcamento_produto_a_observacao,
        nrc_orcamento_produto_a_orcamento,
        nrc_orcamento_a_codigo as orcamento_codigo,
        nrc_orcamento_produto_a_produto
        
        FROM nrc_orcamento_produto_a tbocpr 
        
        INNER JOIN nrc_orcamento_a tboc ON nrc_orcamento_produto_a_orcamento = tboc.id 

        WHERE tbocpr.id = :ocprid";
    // Prepara a query
    $query = $dbh->prepare($sql);
    //Une os parâmetros
    $query->bindParam(':ocprid', $ocprid,PDO::PARAM_STR);
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
    <title>NRCotação - Editar Produto do orçamento <?php echo htmlentities($resultado->nrc_orcamento_produto_a_orcamento);?> </title>
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
            <a href="../orcamentos/index.php" class="btn btn-outline-dark active" role="button" aria-disabled="true"><i class="fa fa-check-circle" style="font-size:24px"></i>&nbsp;ORÇAMENTOS</a> &nbsp;
            <a href="#" class="btn btn-outline-dark" role="button" aria-pressed="true"><i class="fa fa-money" style="font-size:24px"></i>&nbsp;PRODUTOS</a> &nbsp;
            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs" style="font-size:24px"></i>
                    Configurar
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Clientes</a>
                    <a class="dropdown-item" href="../fornecedores/index.php">Fornecedores</a>
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
                <a class="btn btn-outline-warning" href="../orcamentos/edit.php?id=<?php echo htmlentities($resultado->nrc_orcamento_produto_a_orcamento);?>" role="button">Voltar à edição do orçamento</a>
            </form>
        </nav>
    </div>
    <!-- FIM NAV ORÇAMENTOS -->

    <div class="container">
        <div class="row">
            <h2>Editar Produto <?php echo htmlentities($resultado->nrc_orcamento_produto_a_produto);?></h2>
        </div>
    </div>


    <div class="container">
        <form name="update_jogo" method="post">
            <div class="form-group">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6"><b>ORÇAMENTO</b>
                            <!--NÃO EDITÁVEL-->
                            <input disabled id="edit_orcamento_codigo" name="edit_orcamento_codigo" type="text" class="form-control" value="<?php echo htmlentities($resultado->orcamento_codigo );?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group card">
                <div class="row">
                    <div class="col-md-12"><b>PRODUTO</b>
                        <input id="edit_nrc_orcamento_produto_a_produto" name="edit_nrc_orcamento_produto_a_produto" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_produto_a_produto );?>">
                    </div>
                    <div class="col-md-6"><b>CÓDIGO</b>
                        <input id="edit_nrc_orcamento_produto_a_codigo" name="edit_nrc_orcamento_produto_a_codigo" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_produto_a_codigo );?>">
                    </div>
                    <div class="col-md-6"><b>PRAZO PARA ENTREGA</b>
                        <input id="edit_nrc_orcamento_produto_a_prazoentrega" name="edit_nrc_orcamento_produto_a_prazoentrega" type="date" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_produto_a_prazoentrega );?>">
                    </div>
                    <div class="col-md-6"><b>QUANTIDADE</b>
                        <input id="edit_nrc_orcamento_produto_a_quantidade" name="edit_nrc_orcamento_produto_a_quantidade" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_produto_a_quantidade );?>">
                    </div>
                    <div class="col-md-6"><b>UNIDADE</b>
                        <input id="edit_nrc_orcamento_produto_a_unidade" name="edit_nrc_orcamento_produto_a_unidade" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_produto_a_unidade );?>">
                    </div>
                    
                </div>
            </div>

            <div class="form-group card">
                <div class="row">
                    <div class="col-md-12"><b>OBSERVAÇÃO</b>
                        <textarea id="edit_nrc_orcamento_produto_a_observacao" name="edit_nrc_orcamento_produto_a_observacao" rows="5" cols ="50" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_produto_a_observacao);?>"><?php echo htmlentities($resultado->nrc_orcamento_produto_a_observacao);?></textarea>
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
                    $ocprid=intval($_GET['id']);
                    
                    //Valores Post
                    $edit_nrc_orcamento_produto_a_codigo      = $_POST['edit_nrc_orcamento_produto_a_codigo'];
                    $edit_nrc_orcamento_produto_a_quantidade      = $_POST['edit_nrc_orcamento_produto_a_quantidade'];
                    $edit_nrc_orcamento_produto_a_unidade      = $_POST['edit_nrc_orcamento_produto_a_unidade'];
                    $edit_nrc_orcamento_produto_a_prazoentrega      = $_POST['edit_nrc_orcamento_produto_a_prazoentrega'];
                    $edit_nrc_orcamento_produto_a_observacao      = $_POST['edit_nrc_orcamento_produto_a_observacao'];
                    $edit_nrc_orcamento_produto_a_produto      = $_POST['edit_nrc_orcamento_produto_a_produto'];
                    
                    //Query para o update
                    $sql = "UPDATE nrc_orcamento_produto_a SET nrc_orcamento_produto_a_codigo=:edit_nrc_orcamento_produto_a_codigo, nrc_orcamento_produto_a_quantidade=:edit_nrc_orcamento_produto_a_quantidade, nrc_orcamento_produto_a_unidade=:edit_nrc_orcamento_produto_a_unidade, nrc_orcamento_produto_a_prazoentrega=:edit_nrc_orcamento_produto_a_prazoentrega, nrc_orcamento_produto_a_observacao=:edit_nrc_orcamento_produto_a_observacao, nrc_orcamento_produto_a_produto=:edit_nrc_orcamento_produto_a_produto, where id=:ocprid";
                    
                    //Prepara a query para execução
                    $query = $dbh->prepare($sql);
                    
                    //Liga os parâmetros
                    $query->bindParam(':edit_nrc_orcamento_produto_a_codigo', $edit_nrc_orcamento_produto_a_codigo, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_produto_a_quantidade', $edit_nrc_orcamento_produto_a_quantidade, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_produto_a_unidade', $edit_nrc_orcamento_produto_a_unidade, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_produto_a_prazoentrega', $edit_nrc_orcamento_produto_a_prazoentrega, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_produto_a_observacao', $edit_nrc_orcamento_produto_a_observacao, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_produto_a_produto', $edit_nrc_orcamento_produto_a_produto, PDO::PARAM_STR);
                    $query->bindParam(':ocprid', $ocprid, PDO::PARAM_STR);
                    
                    //Executa a query
                    $query->execute();
                    
                    // Mesagem após atualizar
                    echo "<script>alert('Registro atualizado com sucesso');</script>";
                    // Redireciona para a home de jogos
                    echo "<script>window.location.href='../orcamentos/edit-ocpr.php?id=$resultado->ocprid'</script>";
                }
            ?>
        </form>
    </div>
</body>

</html>
