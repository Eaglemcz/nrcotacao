<!doctype HTML>
<?php    
    //Linhas por página (10)
    define("ROW_PER_PAGE",10);

    //chama arquivo de conexão com o banco de dados
    require_once '../inc/dbconfig.php';

    //Código para deletar registro
    if(isset($_REQUEST['del'])){
        //pega o id da linha
        $frcid=intval($_GET['del']);
        //Query para deletar registro
        $sql = "DELETE from nrc_fornecedor_a WHERE id=:id";
        //Prepara query para execução
        $query = $dbh->prepare($sql);
        //Liga os parâmetros
        $query->bindParam(':id', $frcid, PDO::PARAM_STR);
        //Executa a query
        $query->execute();
        //Mensagem pós update
        echo "<script>alert('Registro deletado com sucesso!');</script>";
        //Código para redirecionamento
        echo "<script>window.location.href='../panel.php'</script>";
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

    <!-- INÍCIO NAV CAARTELA -->
    <!-- FIM NAV CARTELA -->

    <?php
        $search_keyword = '';
        if(!empty($_POST['search']['keyword'])) {
            $search_keyword = $_POST['search']['keyword'];
        }
                        
        $sql="SELECT frnc.id as frncid,
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
        
        
        
        WHERE nrc_fornecedor_a_codigo LIKE :keyword
        OR nrc_fornecedor_a_nomeempresa LIKE :keyword 
        OR nrc_fornecedor_a_cnpj LIKE :keyword 
        OR nrc_fornecedor_a_razaosocial LIKE :keyword 
        OR nrc_fornecedor_a_nomecontato LIKE :keyword 
        OR nrc_fornecedor_a_telefone LIKE :keyword
        OR nrc_fornecedor_a_fax LIKE :keyword
        OR nrc_fornecedor_a_celular LIKE :keyword
        OR nrc_fornecedor_a_comunicadorinstantaneo LIKE :keyword
        OR nrc_fornecedor_a_email LIKE :keyword
        OR nrc_fornecedor_a_site LIKE :keyword
        OR nrc_fornecedor_a_endereco LIKE :keyword
        OR nrc_fornecedor_a_usuario LIKE :keyword
        
        ORDER BY frncid";
                        
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
                        <th class='table-header'>EMPRESA</th>
                        <th class='table-header'>RAZÃO SOCIAL</th>
                        <th class='table-header'>CONTATO</th>
                        <th class='table-header'>TELEFONE</th>
                        <th class='table-header'>CELULAR</th>
                        <th class='table-header'>E-MAIL</th>
                        <th class='table-header'>AÇÕES</th>
                    </tr>
                </thead>
                <tbody id='table-body'>
                    <?php
                if(!empty($result)) { 
                    foreach($result as $row) {
                ?>
                    <tr class='table-row'>
                        <td><?php echo htmlentities($row->frncid);?></td>
                        <td><?php echo htmlentities($row->nrc_fornecedor_a_codigo);?></td>
                        <td><?php echo htmlentities($row->nrc_fornecedor_a_nomeempresa);?></td>
                        <td><?php echo htmlentities($row->nrc_fornecedor_a_razaosocial);?></td>
                        <td><?php echo htmlentities($row->nrc_fornecedor_a_nomecontato);?></td>
                        <td><?php echo htmlentities($row->nrc_fornecedor_a_telefone);?></td>
                        <td><?php echo htmlentities($row->nrc_fornecedor_a_celular);?></td>
                        <td><?php echo htmlentities($row->nrc_fornecedor_a_email);?></td>
                        <td><button formaction="edit.php?id=<?php echo htmlentities($row->frncid);?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
                        <td><button formaction="index.php?del=<?php echo htmlentities($row->frncid);?>" class="btn btn-danger btn-xs" onClick="return confirm('Realmente deseja deletar este registro?');"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
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
                        $add_nrc_fornecedor_a_codigo                  = $_POST['add_nrc_fornecedor_a_codigo'];
                        $add_nrc_fornecedor_a_nomeempresa             = $_POST['add_nrc_fornecedor_a_nomeempresa'];
                        $add_nrc_fornecedor_a_cnpj                    = $_POST['add_nrc_fornecedor_a_cnpj'];
                        $add_nrc_fornecedor_a_razaosocial             = $_POST['add_nrc_fornecedor_a_razaosocial'];
                        $add_nrc_fornecedor_a_inscricaoestadual       = $_POST['add_nrc_fornecedor_a_inscricaoestadual'];
                        $add_nrc_fornecedor_a_nomecontato             = $_POST['add_nrc_fornecedor_a_nomecontato'];
                        $add_nrc_fornecedor_a_telefone                = $_POST['add_nrc_fornecedor_a_telefone'];
                        $add_nrc_fornecedor_a_fax                     = $_POST['add_nrc_fornecedor_a_fax'];
                        $add_nrc_fornecedor_a_celular                 = $_POST['add_nrc_fornecedor_a_celular'];
                        $add_nrc_fornecedor_a_comunicadorinstantaneo  = $_POST['add_nrc_fornecedor_a_comunicadorinstantaneo'];
                        $add_nrc_fornecedor_a_email                   = $_POST['add_nrc_fornecedor_a_email'];
                        $add_nrc_fornecedor_a_site                    = $_POST['add_nrc_fornecedor_a_site'];
                        $add_nrc_fornecedor_a_endereco                = $_POST['add_nrc_fornecedor_a_endereco'];
                        $add_nrc_fornecedor_a_usuario                 = $_POST['add_nrc_fornecedor_a_usuario'];
                        
                        $sql = "INSERT INTO nrc_fornecedor_a(nrc_fornecedor_a_codigo, nrc_fornecedor_a_nomeempresa, nrc_fornecedor_a_cnpj,        nrc_fornecedor_a_razaosocial, nrc_fornecedor_a_inscricaoestadual, nrc_fornecedor_a_nomecontato,     nrc_fornecedor_a_telefone, nrc_fornecedor_a_fax, nrc_fornecedor_a_celular,       nrc_fornecedor_a_comunicadorinstantaneo, nrc_fornecedor_a_email, nrc_fornecedor_a_site, nrc_fornecedor_a_endereco,        nrc_fornecedor_a_usuario) VALUES (:add_nrc_fornecedor_a_codigo, :add_nrc_fornecedor_a_nomeempresa,        :add_nrc_fornecedor_a_cnpj, :add_nrc_fornecedor_a_razaosocial, :add_nrc_fornecedor_a_inscricaoestadual,        :add_nrc_fornecedor_a_nomecontato, :add_nrc_fornecedor_a_telefone, :add_nrc_fornecedor_a_fax,        :add_nrc_fornecedor_a_celular, :add_nrc_fornecedor_a_comunicadorinstantaneo, :add_nrc_fornecedor_a_email,        :add_nrc_fornecedor_a_site, :add_nrc_fornecedor_a_endereco, :add_nrc_fornecedor_a_usuario)";
                        
                        //Prepara a query para execução
                        $query = $dbh->prepare($sql);
                        
                        //Liga os parâmetros
                        $query->bindParam(':add_nrc_fornecedor_a_codigo', $add_nrc_fornecedor_a_codigo,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_nomeempresa',$add_nrc_fornecedor_a_nomeempresa,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_cnpj',$add_nrc_fornecedor_a_cnpj,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_razaosocial',$add_nrc_fornecedor_a_razaosocial,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_inscricaoestadual',$add_nrc_fornecedor_a_inscricaoestadual,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_nomecontato',$add_nrc_fornecedor_a_nomecontato,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_telefone',$add_nrc_fornecedor_a_telefone,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_fax',$add_nrc_fornecedor_a_fax,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_celular',$add_nrc_fornecedor_a_celular,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_comunicadorinstantaneo',$add_nrc_fornecedor_a_comunicadorinstantaneo,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_email',$add_nrc_fornecedor_a_email,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_site',$add_nrc_fornecedor_a_site,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_endereco',$add_nrc_fornecedor_a_endereco,PDO::PARAM_STR);
                        $query->bindParam(':add_nrc_fornecedor_a_usuario',$add_nrc_fornecedor_a_usuario,PDO::PARAM_STR);
                        
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

                    <div class="form-group card">
                        
                    <div class="card-header text-center">
                    REFERÊNCIA
                    </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_codigo" class="control-label col-xs-4">CÓDIGO</label>
                                <input type="text" id="add_nrc_fornecedor_a_codigo" name="add_nrc_fornecedor_a_codigo" class="form-control"><br />
                            </div>
                        </div>
                    </div>

                    <div class="form-group card">
                        <div class="card-header text-center">
                        DADOS DA EMPRESA
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <label for="add_nrc_fornecedor_a_razaosocial" class="control-label col-xs-4">RAZÃO SOCIAL</label>
                                <input type="text" id="add_nrc_fornecedor_a_razaosocial" name="add_nrc_fornecedor_a_razaosocial" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_nomeempresa" class="control-label col-xs-4">FANTASIA</label>
                                <input type="text" id="add_nrc_fornecedor_a_nomeempresa" name="add_nrc_fornecedor_a_nomeempresa" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_cnpj" class="control-label col-xs-4">CNPJ</label>
                                <input type="text" id="add_nrc_fornecedor_a_cnpj" name="add_nrc_fornecedor_a_cnpj" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_inscricaoestadual" class="control-label col-xs-4">INSCRIÇÃO ESTADUAL</label>
                                <input type="text" id="add_nrc_fornecedor_a_inscricaoestadual" name="add_nrc_fornecedor_a_inscricaoestadual" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group card">
                        <div class="card-header text-center">
                        DADOS DO FORNECEDOR
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <label for="add_nrc_fornecedor_a_nomecontato" class="control-label col-xs-4">CONTATO</label>
                                <input type="text" id="add_nrc_fornecedor_a_nomecontato" name="add_nrc_fornecedor_a_nomecontato" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_telefone" class="control-label col-xs-4">TELEFONE</label>
                                <input type="text" id="add_nrc_fornecedor_a_telefone" name="add_nrc_fornecedor_a_telefone" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_fax" class="control-label col-xs-4">FAX</label>
                                <input type="text" id="add_nrc_fornecedor_a_fax" name="add_nrc_fornecedor_a_fax" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_celular" class="control-label col-xs-4">CELULAR</label>
                                <input type="text" id="add_nrc_fornecedor_a_celular" name="add_nrc_fornecedor_a_celular" class="form-control">
                            </div>
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_comunicadorinstantaneo" class="control-label col-xs-4">COMUNICADOR</label>
                                <input type="text" id="add_nrc_fornecedor_a_comunicadorinstantaneo" name="add_nrc_fornecedor_a_comunicadorinstantaneo" class="form-control">
                            </div>
                            <div class="col col-md-12">
                                <label for="add_nrc_fornecedor_a_email" class="control-label col-xs-4">E-MAIL</label>
                                <input type="text" id="add_nrc_fornecedor_a_email" name="add_nrc_fornecedor_a_email" class="form-control">
                            </div>
                            <div class="col col-md-12">
                                <label for="add_nrc_fornecedor_a_site" class="control-label col-xs-4">SITE</label>
                                <input type="text" id="add_nrc_fornecedor_a_site" name="add_nrc_fornecedor_a_site" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group card">
                        <div class="card-header text-center">
                        ENDEREÇO DO FORNECEDOR
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <label for="add_nrc_fornecedor_a_endereco" class="control-label col-xs-4">ENDEREÇO</label>
                                <input type="text" id="add_nrc_fornecedor_a_endereco" name="add_nrc_fornecedor_a_endereco" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group card">
                        <div class="card-header text-center">
                        DADOS DE LOGIN
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <label for="add_nrc_fornecedor_a_usuario" class="control-label col-xs-4">USUARIO DO SISTEMA</label>
                                <input type="text" id="add_nrc_fornecedor_a_usuario" name="add_nrc_fornecedor_a_usuario" class="form-control">
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
