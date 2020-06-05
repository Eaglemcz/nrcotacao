<!doctype HTML>
<?php    
    //Linhas por página (10)
    define("ROW_PER_PAGE",10);

    //chama arquivo de conexão com o banco de dados
    require_once '../inc/dbconfig.php';

    //Código para deletar registro
    if(isset($_REQUEST['del'])){
        //pega o id da linha
        $ocid=intval($_GET['del']);
        //Query para deletar registro
        $sql = "DELETE from nrc_orcamento_a WHERE id=:id";
        //Prepara query para execução
        $query = $dbh->prepare($sql);
        //Liga os parâmetros
        $query->bindParam(':id', $ocid, PDO::PARAM_STR);
        //Executa a query
        $query->execute();
        //Mensagem pós update
        echo "<script>alert('Registro deletado com sucesso!');</script>";
        //Código para redirecionamento
        echo "<script>window.location.href='../orcamentos/index.php'</script>";
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <title>NR COTAÇÂO - Orçamentos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../inc/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../inc/bootstrap/css/font-awesome.min.css" rel="stylesheet">
    <link href="../inc/custom.css" rel="stylesheet">
    <script src="../inc/jquery/jquery-3.4.1.min.js"></script>
    <script src="../inc/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- INÍCIO NAV Principal -->
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a href="#" class="btn btn-outline-dark active" role="button" aria-disabled="true"><i class="fa fa-check-circle" style="font-size:24px"></i>&nbsp;ORÇAMENTOS</a> &nbsp;
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

    <!-- INÍCIO NAV CAARTELA -->
    <!-- FIM NAV CARTELA -->

    <?php
        $search_keyword = '';
        if(!empty($_POST['search']['keyword'])) {
            $search_keyword = $_POST['search']['keyword'];
        }
                        
        $sql="SELECT tbo.id as tboid,
		nrc_orcamento_a_codigo,
        nrc_orcamento_a_descricao,
        nrc_orcamento_a_situacao,
        DATE_FORMAT(nrc_orcamento_a_datainicio,'%d/%m/%Y') AS nrc_orcamento_a_datainicio,
        DATE_FORMAT(nrc_orcamento_a_datafechamento,'%d/%m/%Y') AS nrc_orcamento_a_datafechamento,
        nrc_cliente_a_nomeempresa 
        
        FROM nrc_orcamento_a tbo 
        
        INNER JOIN nrc_cliente_a tbc ON nrc_orcamento_a_cliente = nrc_cliente_a_codigo
        
        WHERE nrc_orcamento_a_codigo LIKE :keyword
        OR nrc_orcamento_a_descricao LIKE :keyword 
        OR nrc_orcamento_a_situacao LIKE :keyword 
        OR nrc_orcamento_a_datainicio LIKE :keyword 
        OR nrc_orcamento_a_datafechamento LIKE :keyword 
        OR nrc_cliente_a_nomeempresa LIKE :keyword 
        
        ORDER BY tboid";
                        
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
                            <button class="btn btn-outline-secundary" type="button" data-toggle="modal" data-target="#novoRegistro"><i class="fa fa-plus-square-o" style="font-size:24px"></i>&nbsp;Novo Registro</button>
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
                        <th class='table-header'>ID</th>
                        <th class='table-header'>CODIGO</th>
                        <th class='table-header'>DESCRICAO</th>
                        <th class='table-header'>SITUAÇÃO</th>
                        <th class='table-header'>DT INÍCIO</th>
                        <th class='table-header'>DT FECHAMENTO</th>
                        <th class='table-header'>CLIENTE</th>
                        <th class='table-header'>AÇÕES</th>
                    </tr>
                </thead>
                <tbody id='table-body'>
                    <?php
                if(!empty($result)) { 
                    foreach($result as $row) {
                ?>
                    <tr class='table-row'>
                        <td><?php echo htmlentities($row->tboid);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_a_codigo);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_a_descricao);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_a_situacao);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_a_datainicio);?></td>
                        <td><?php echo htmlentities($row->nrc_orcamento_a_datafechamento);?></td>
                        <td><?php echo htmlentities($row->nrc_cliente_a_nomeempresa);?></td>
                        <td><button formaction="edit.php?id=<?php echo htmlentities($row->tboid);?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
                        <td><button formaction="index.php?del=<?php echo htmlentities($row->tboid);?>" class="btn btn-danger btn-xs" onClick="return confirm('Realmente deseja deletar este registro?');"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
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
</body>

<!-- MODAL ADD -->
<div class="modal fade" id="novoRegistro" tabindex="-1" role="dialog" aria-labelledby="novoRegistro" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="novoRegistroLabel">Novo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
                    //chama arquivo de conexão com o banco de dados
                    require_once '../inc/dbconfig.php';
                    
                    if (isset($_POST['insert'])){
                        //Valores POST
                        $add_nrc_orcamento_a_codigo         = $_POST['add_nrc_orcamento_a_codigo'];
                        $add_nrc_orcamento_a_descricao      = $_POST['add_nrc_orcamento_a_descricao'];
                        $add_nrc_orcamento_a_situacao       = $_POST['add_nrc_orcamento_a_situacao'];
                        $add_nrc_orcamento_a_datainicio     = $_POST['add_nrc_orcamento_a_datainicio'];
                        $add_nrc_orcamento_a_datafechamento = $_POST['add_nrc_orcamento_a_datafechamento'];
                        $add_nrc_orcamento_a_observacao     = $_POST['add_nrc_orcamento_a_observacao'];
                        $add_nrc_orcamento_a_cliente        = $_POST['add_nrc_orcamento_a_cliente'];
                        
                        $sql = "INSERT INTO nrc_orcamento_a(nrc_orcamento_a_codigo, nrc_orcamento_a_descricao, nrc_orcamento_a_situacao, nrc_orcamento_a_datainicio, nrc_orcamento_a_datafechamento, nrc_orcamento_a_observacao, nrc_orcamento_a_cliente) VALUES (:add_nrc_orcamento_a_codigo, :add_nrc_orcamento_a_descricao, :add_nrc_orcamento_a_situacao, :add_nrc_orcamento_a_datainicio, :add_nrc_orcamento_a_datafechamento, :add_nrc_orcamento_a_observacao, :add_nrc_orcamento_a_cliente)";
                        
                        //Prepara a query para execução
                        $query = $dbh->prepare($sql);
                        
                        //Liga os parâmetros
                        $query->bindParam(':add_nrc_orcamento_a_codigo', $add_nrc_orcamento_a_codigo,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_a_descricao',$add_nrc_orcamento_a_descricao,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_a_situacao',$add_nrc_orcamento_a_situacao,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_a_datainicio',$add_nrc_orcamento_a_datainicio,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_a_datafechamento',$add_nrc_orcamento_a_datafechamento,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_a_observacao',$add_nrc_orcamento_a_observacao,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_orcamento_a_cliente',$add_nrc_orcamento_a_cliente,PDO::PARAM_STR);
                        
                        //Executa a query
                        $query->execute();
                        
                        //Checa se o ultimo id inserido é maior que zero, se sim, a inserção funcionou.
                        $ultimoregistro = $dbh->lastInsertId();
                        if ($ultimoregistro)
                            {
                                //Mensagem em caso de sucesso
                                echo"<script>alert('Registro gravado com sucesso!');</script>";
                                echo"<script>window.location.href='index.php'</script>";
                            }else{
                                //Mensagem em caso mau sucedido
                                echo"<script>alert('Oops, algo deu errado! Por favor, tente novamente.');</script>";
                                echo"<script>window.location.href='index.php'</script>";
                            }
                    }
                ?>

            <form class="form-horizontal" name="insertrecord" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-6">
                                <label for="add_nrc_orcamento_a_codigo" class="control-label col-xs-4">CÓDIGO</label>
                                <input type="text" id="add_nrc_orcamento_a_codigo" name="add_nrc_orcamento_a_codigo" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-6">
                                <label for="add_nrc_orcamento_a_datainicio" class="control-label col-xs-4">INÍCIO</label>
                                <input type="date" id="add_nrc_orcamento_a_datainicio" name="add_nrc_orcamento_a_datainicio" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_orcamento_a_datafechamento" class="control-label col-xs-4">FECHAMENTO</label>
                                <input type="date" id="add_nrc_orcamento_a_datafechamento" name="add_nrc_orcamento_a_datafechamento" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-6">
                                <label for="add_nrc_orcamento_a_descricao" class="control-label col-xs-4">DESCRIÇÃO</label>
                                <input type="text" id="add_nrc_orcamento_a_descricao" name="add_nrc_orcamento_a_descricao" class="form-control">
                            </div>

                            <div class="col col-md-6">
                                <label for="add_nrc_orcamento_a_situacao" class="control-label col-xs-4">SITUAÇÃO</label>
                                <input type="text" id="add_nrc_orcamento_a_situacao" name="add_nrc_orcamento_a_situacao" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-12">
                                <label for="add_nrc_orcamento_a_cliente" class="control-label col-xs-4">CLIENTE</label>

                                <select id="add_nrc_orcamento_a_cliente" name="add_nrc_orcamento_a_cliente" class="select form-control">
                                    <option value="">SELECIONE UM CLIENTE</option>
                                    <?php
                                        $sql = "SELECT nrc_cliente_a_codigo, nrc_cliente_a_nomeempresa FROM nrc_cliente_a ORDER BY nrc_cliente_a_nomeempresa";
                                        foreach ($dbh->query($sql) as $row){
                                            echo "<option selected value=".$row['nrc_cliente_a_codigo'].">".$row['nrc_cliente_a_nomeempresa']."</option>";
                                        }
                                    ?>
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-md-12">
                                <label for="add_nrc_orcamento_a_observacao" class="control-label col-xs-4">OBSERVAÇÕES</label>
                                <textarea rows="5" id="add_nrc_orcamento_a_observacao" name="add_nrc_orcamento_a_observacao" class="form-control"></textarea>
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


</html>
