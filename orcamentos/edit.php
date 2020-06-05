<!DOCTYPE html>
<?php
    //chama arquivo de conexão com o banco de dados
    require_once '../inc/dbconfig.php';

    // Pega o ID do orçamento
    $ocid=intval($_GET['id']);
    $sql = "SELECT tbo.id as tboid, 
            nrc_orcamento_a_codigo,
            nrc_orcamento_a_descricao,
            nrc_orcamento_a_situacao,
            DATE_FORMAT(nrc_orcamento_a_datainicio,'%d/%m/%Y') AS nrc_orcamento_a_datainicio,
            DATE_FORMAT(nrc_orcamento_a_datafechamento,'%d/%m/%Y') AS nrc_orcamento_a_datafechamento,
            nrc_orcamento_a_observacao,
            nrc_cliente_a_nomeempresa 
        
            FROM 
            nrc_orcamento_a tbo 

            INNER JOIN nrc_cliente_a tbc ON nrc_orcamento_a_cliente = nrc_cliente_a_codigo 

            WHERE tbo.id = :ocid";
    // Prepara a query
    $query = $dbh->prepare($sql);
    //Une os parâmetros
    $query->bindParam(':ocid', $ocid,PDO::PARAM_STR);
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
    <title>NRCotação - Editar cotação </title>
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
                <a class="btn btn-outline-warning" href="../orcamentos/index.php" role="button">Voltar à lista de orçamentos</a>
            </form>
        </nav>
    </div>
    <!-- FIM NAV ORÇAMENTOS -->

    <div class="container">
        <div class="row">
            <h2>Editar Orçamento Nº: <?php echo htmlentities($resultado->tboid);?></h2>
        </div>
    </div>


    <div class="container">
        <form name="update_jogo" method="post">
            <div class="form-group">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6"><b>CÓDIGO</b>
                            <input disabled id="edit_nrc_orcamento_a_codigo" name="edit_nrc_orcamento_a_codigo" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_a_codigo );?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"><b>DATA INÍCIO</b>
                        <input id="edit_nrc_orcamento_a_datainicio" name="edit_nrc_orcamento_a_datainicio" type="date" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_a_datainicio);?>">
                    </div>
                    <div class="col-md-4"><b>DATA FECHAMENTO</b>
                        <input id="edit_nrc_orcamento_a_datafechamento" name="edit_nrc_orcamento_a_datafechamento" type="date" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_a_datafechamento);?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6"><b>DESCRIÇÃO</b>
                        <input id="edit_nrc_orcamento_a_descricao" name="edit_nrc_orcamento_a_descricao" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_a_descricao );?>">
                    </div>
                    <div class="col-md-6"><b>SITUAÇÂO</b>
                        <input id="edit_nrc_orcamento_a_situacao" name="edit_nrc_orcamento_a_situacao" type="text" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_a_situacao );?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="edit_nrc_orcamento_a_cliente" class="control-label col-xs-4">CLIENTE</label>
                <select id="edit_nrc_orcamento_a_cliente" name="edit_nrc_orcamento_a_cliente" class="select form-control">
                    <option value="">SELECIONE UM CLIENTE</option>
                    <?php
                                        $sql = "SELECT nrc_cliente_a_codigo, nrc_cliente_a_nomeempresa FROM nrc_cliente_a ORDER BY nrc_cliente_a_nomeempresa";
                        
                                        foreach ($dbh->query($sql) as $row){
                                            echo "<option selected value=".$row['nrc_cliente_a_codigo'].">".$row['nrc_cliente_a_nomeempresa']."</option>";
                                        }
                                    ?>
                </select>
                <br />
                <span class="border border-secondary">
                    <?php echo "CLIENTE ATUAL: ".htmlentities($resultado->nrc_cliente_a_nomeempresa);?>
                </span>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12"><b>OBSERVAÇÃO</b>
                        <textarea id="edit_nrc_orcamento_a_observacao" name="edit_nrc_orcamento_a_observacao" rows="5" cols="50" class="form-control" value="<?php echo htmlentities($resultado->nrc_orcamento_a_observacao);?>"><?php echo htmlentities($resultado->nrc_orcamento_a_observacao);?></textarea>
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
                    $ocid=intval($_GET['id']);
                    
                    //Valores Post
                    
                    $edit_nrc_orcamento_a_descricao      = $_POST['edit_nrc_orcamento_a_descricao'];
                    $edit_nrc_orcamento_a_situacao       = $_POST['edit_nrc_orcamento_a_situacao'];
                    $edit_nrc_orcamento_a_datainicio     = $_POST['edit_nrc_orcamento_a_datainicio'];
                    $edit_nrc_orcamento_a_datafechamento = $_POST['edit_nrc_orcamento_a_datafechamento'];
                    $edit_nrc_orcamento_a_observacao     = $_POST['edit_nrc_orcamento_a_observacao'];
                    $edit_nrc_orcamento_a_cliente        = $_POST['edit_nrc_orcamento_a_cliente'];
                    
                    //Query para o update
                    $sql = "UPDATE nrc_orcamento_a SET nrc_orcamento_a_descricao=:edit_nrc_orcamento_a_descricao, nrc_orcamento_a_situacao=:edit_nrc_orcamento_a_situacao, nrc_orcamento_a_datainicio=:edit_nrc_orcamento_a_datainicio, nrc_orcamento_a_datafechamento=:edit_nrc_orcamento_a_datafechamento, nrc_orcamento_a_observacao=:edit_nrc_orcamento_a_observacao, nrc_orcamento_a_cliente=:edit_nrc_orcamento_a_cliente where id=:ocid";
                    
                    //Prepara a query para execução
                    $query = $dbh->prepare($sql);
                    
                    //Liga os parâmetros
                    $query->bindParam(':edit_nrc_orcamento_a_descricao', $edit_nrc_orcamento_a_descricao, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_a_situacao', $edit_nrc_orcamento_a_situacao, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_a_datainicio', $edit_nrc_orcamento_a_datainicio, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_a_datafechamento', $edit_nrc_orcamento_a_datafechamento, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_a_observacao', $edit_nrc_orcamento_a_observacao, PDO::PARAM_STR);
                    $query->bindParam(':edit_nrc_orcamento_a_cliente', $edit_nrc_orcamento_a_cliente, PDO::PARAM_STR);
                    $query->bindParam(':ocid', $ocid, PDO::PARAM_STR);
                    
                    //Executa a query
                    $query->execute();
                    
                    // Mesagem após atualizar
                    echo "<script>alert('Registro atualizado com sucesso');</script>";
                    // Redireciona para a home de jogos
                    echo "<script>window.location.href='../orcamentos/index.php'</script>";
                }
            ?>
        </form>
    </div>
    <br />

    <!doctype HTML>
    <?php    
    //Linhas por página (10)
    define("ROW_PER_PAGE",10);

    //chama arquivo de conexão com o banco de dados
    require_once '../inc/dbconfig.php';

    //Código para deletar registro
    if(isset($_REQUEST['del'])){
        //pega o id da linha
        $codigo=intval($_GET['del']);
        //Query para deletar registro
        $sql = "DELETE from nrc_orcamento_produto_a WHERE nrc_orcamento_produto_a_codigo=:codigo";
        //Prepara query para execução
        $query = $dbh->prepare($sql);
        //Liga os parâmetros
        $query->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        //Executa a query
        $query->execute();
        //Mensagem pós update
        echo "<script>alert('Registro deletado com sucesso!');</script>";
        //Código para redirecionamento
        echo "<script>window.location.href='../orcamentos/index.php'</script>";
    }
?>
    <?php
        $search_keyword = '';
        if(!empty($_POST['search']['keyword'])) {
            $search_keyword = $_POST['search']['keyword'];
        }
    
        $sql="SELECT tbocpr.id as ocprid,
		nrc_orcamento_produto_a_codigo,
        nrc_orcamento_produto_a_quantidade,
        nrc_orcamento_produto_a_unidade,
        DATE_FORMAT(nrc_orcamento_produto_a_prazoentrega,'%d/%m/%Y') AS nrc_orcamento_produto_a_prazoentrega,
        nrc_orcamento_produto_a_observacao,
        nrc_orcamento_produto_a_orcamento,
        nrc_orcamento_produto_a_produto
        
        FROM nrc_orcamento_produto_a tbocpr 
        
        INNER JOIN nrc_orcamento_a tboc ON nrc_orcamento_produto_a_orcamento = tboc.id
        
        WHERE nrc_orcamento_produto_a_orcamento = :ocid AND
        (nrc_orcamento_produto_a_codigo LIKE :keyword
        OR nrc_orcamento_produto_a_quantidade LIKE :keyword 
        OR nrc_orcamento_produto_a_unidade LIKE :keyword 
        OR nrc_orcamento_produto_a_prazoentrega LIKE :keyword 
        OR nrc_orcamento_produto_a_observacao LIKE :keyword
        OR nrc_orcamento_produto_a_produto LIKE :keyword)
        
        ORDER BY nrc_orcamento_produto_a_produto";
                        
        /* Pagination Code starts */
        $per_page_html = '';
	    $page = 1;
	    $start=0;
	    if(!empty($_POST["page"])) {
		  $page = $_POST["page"];
		  $start=($page-1) * ROW_PER_PAGE;
        }
	    $limit=" limit " . $start . "," . ROW_PER_PAGE;
	    $pagination_statement = $dbh->prepare($sql);
        $pagination_statement->bindParam(':ocid',$ocid,PDO::PARAM_STR);
	    $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	    $pagination_statement->execute();
        $row_count = $pagination_statement->rowCount();
	    if(!empty($row_count)){
            $per_page_html .= '<nav aria-label="paginacao">';
            $per_page_html .= '<div style="text-align:center;margin:20px 0px;">';
            $per_page_html .= '<ul class="pagination pagination-lg">';
		    $page_count=ceil($row_count/ROW_PER_PAGE);
		    if($page_count>1) {
                for($i=1;$i<=$page_count;$i++){
                    if($i==$page){
                        $per_page_html .= '<li class="page-item"><input type="submit" name="page" value="' . $i . '" class="btn-page form-control current" /></li>';
                    } else {
                        $per_page_html .= '<li class="page-item"><input type="submit" name="page" value="' . $i . '" class="btn-page form-control" />';
                    }
                }
            }
            $per_page_html .= '</ul>';
		    $per_page_html .= '</div>';
            $per_page_html .= '</nav>';
        }
	
        $query = $sql.$limit;
	    $pdo_statement = $dbh->prepare($query);
        $pdo_statement->bindParam(':ocid',$ocid,PDO::PARAM_STR);
	    $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	    $pdo_statement->execute();
	    //$result = $pdo_statement->fetchAll();
        $result=$pdo_statement->fetchAll(PDO::FETCH_OBJ);

    ?>
    <div class="container">
        <form name='frmSearch' action='' method='post'>
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-light">
                        <div class="col col-md-6">
                            <button class="btn btn-outline-secundary" type="button" data-toggle="modal" data-target="#novoRegistro"><i class="fa fa-plus-square-o" style="font-size:24px"></i>&nbsp;Adicionar Produto à Cotação</button>
                        </div>
                        <div class="col col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25' placeholder="Buscar" aria-label="Buscar" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <table class='tbl-qa table table-bordred table-striped'>
                <thead>
                    <tr>
                        <th class='table-header'>CODIGO</th>
                        <th class='table-header'>PRODUTO</th>
                        <th class='table-header'>QUANTIDADE</th>
                        <th class='table-header'>UNIDADE</th>
                        <th class='table-header'>PRAZO ENTREGA</th>
                        <th class='table-header'>AÇÕES</th>
                    </tr>
                </thead>
                <tbody id='table-body'>
                    <?php
                if(!empty($result)) { 
                    foreach($result as $row) {
                ?>
                    <tr class='table-row'>
                        <td><?php echo htmlentities($row->nrc_orcamento_produto_a_codigo);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_produto_a_produto);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_produto_a_quantidade);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_produto_a_unidade);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_produto_a_prazoentrega);?></td>
                        <td><button formaction="edit.php?id=<?php echo htmlentities($row->ocprid);?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
                        <td><button formaction="index.php?del=<?php echo htmlentities($row->nrc_orcamento_produto_a_codigo);?>" class="btn btn-danger btn-xs" onClick="return confirm('Realmente deseja deletar este registro?');"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <?php echo $per_page_html; ?>
        </form>
    </div>


    <!-- MODAL ADD -->
    <div class="modal fade" id="novoRegistro" tabindex="-1" role="dialog" aria-labelledby="novoRegistro" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novoRegistroLabel">Novo Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                    //chama arquivo de conexão com o banco de dados
                    require_once '../inc/dbconfig.php';
                    
                    if (isset($_POST['insert'])){
                        //Valores POST
                        $add_nrc_orcamento_produto_a_codigo         = $_POST['add_nrc_orcamento_produto_a_codigo'];
                        $add_nrc_orcamento_produto_a_quantidade     = $_POST['add_nrc_orcamento_produto_a_quantidade'];
                        $add_nrc_orcamento_produto_a_unidade        = $_POST['add_nrc_orcamento_produto_a_unidade'];
                        $add_nrc_orcamento_produto_a_prazoentrega   = $_POST['add_nrc_orcamento_produto_a_prazoentrega'];
                        $add_nrc_orcamento_produto_a_observacao     = $_POST['add_nrc_orcamento_produto_a_observacao'];
                        $add_nrc_orcamento_produto_a_produto        = $_POST['add_nrc_orcamento_produto_a_produto'];
                        
                        $sql = "INSERT INTO nrc_orcamento_produto_a(nrc_orcamento_produto_a_codigo, nrc_orcamento_produto_a_quantidade, nrc_orcamento_produto_a_unidade, nrc_orcamento_produto_a_prazoentrega, nrc_orcamento_produto_a_observacao, nrc_orcamento_produto_a_orcamento, nrc_orcamento_produto_a_produto) VALUES (:add_nrc_orcamento_produto_a_codigo, :add_nrc_orcamento_produto_a_quantidade, :add_nrc_orcamento_produto_a_unidade, :add_nrc_orcamento_produto_a_prazoentrega, :add_nrc_orcamento_produto_a_observacao, :add_nrc_orcamento_produto_a_orcamento, :add_nrc_orcamento_produto_a_produto)";
                        
                        //Prepara a query para execução
                        $query = $dbh->prepare($sql);
                        
                        //Liga os parâmetros
                        $query->bindParam(':add_nrc_orcamento_produto_a_codigo', $add_nrc_orcamento_produto_a_codigo,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_produto_a_quantidade',$add_nrc_orcamento_produto_a_quantidade,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_produto_a_unidade',$add_nrc_orcamento_produto_a_unidade,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_produto_a_prazoentrega',$add_nrc_orcamento_produto_a_prazoentrega,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_produto_a_observacao',$add_nrc_orcamento_produto_a_observacao,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_produto_a_orcamento',$ocid,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_produto_a_produto',$add_nrc_orcamento_produto_a_produto,PDO::PARAM_STR);
                        
                        //Executa a query
                        $query->execute();
                        
                        //Checa se o ultimo id inserido é maior que zero, se sim, a inserção funcionou.
                        $ultimoregistro = $dbh->lastInsertId();
                        if ($ultimoregistro)
                            {
                                //Mensagem em caso de sucesso
                                echo"<script>alert('Registro gravado com sucesso!');</script>";
                                echo"<script>window.location.href='edit.php'</script>";
                            }else{
                                //Mensagem em caso mau sucedido
                                echo"<script>alert('Oops, algo deu errado! Por favor, tente novamente.');</script>";
                                echo"<script>window.location.href='edit.php'</script>";
                            }
                    }
                ?>

                <form class="form-horizontal" name="insertrecord" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="row">
                                <div class="col col-md-6">
                                    <label for="add_nrc_orcamento_produto_a_codigo" class="control-label col-xs-4">CÓDIGO</label>
                                    <input type="text" id="add_nrc_orcamento_produto_a_codigo" name="add_nrc_orcamento_produto_a_codigo" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col col-md-12">
                                <label for="add_nrc_orcamento_produto_a_produto" class="control-label col-xs-4">PRODUTO</label>
                                <input type="text" id="add_nrc_orcamento_produto_a_produto" name="add_nrc_orcamento_produto_a_produto" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_orcamento_produto_a_quantidade" class="control-label col-xs-4">QUANTIDADE</label>
                                <input type="text" id="add_nrc_orcamento_produto_a_quantidade" name="add_nrc_orcamento_produto_a_quantidade" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_orcamento_produto_a_unidade" class="control-label col-xs-4">UNIDADE</label>
                                <input type="text" id="add_nrc_orcamento_produto_a_unidade" name="add_nrc_orcamento_produto_a_unidade" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col col-md-6">
                                    <label for="add_nrc_orcamento_produto_a_prazoentrega" class="control-label col-xs-4">PRAZO DE ENTREGA</label>
                                    <input type="date" id="add_nrc_orcamento_produto_a_prazoentrega" name="add_nrc_orcamento_produto_a_prazoentrega" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col col-md-12">
                                    <label for="add_nrc_orcamento_produto_a_observacao" class="control-label col-xs-4">OBSERVAÇÕES</label>
                                    <textarea rows="5" id="add_nrc_orcamento_produto_a_observacao" name="add_nrc_orcamento_produto_a_observacao" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-around">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button name="insert" type="submit" value="insert" class="btn btn-primary">Gravar Registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



</body>

</html>
