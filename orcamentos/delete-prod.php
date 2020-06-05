<?php
    //chama arquivo de conexão com o banco de dados
    require_once '../inc/dbconfig.php';

    //Código para deletar registro
    if(isset($_REQUEST['del'])){
        //pega o id da linha
        $ocprid=intval($_GET['del']);
        //Query para deletar registro
        $sql = "DELETE from nrc_orcamento_produto_a WHERE id=:id";
        //Prepara query para execução
        $query = $dbh->prepare($sql);
        //Liga os parâmetros
        $query->bindParam(':id', $ocprid, PDO::PARAM_STR);
        //Executa a query
        $query->execute();
        //Mensagem pós update
        echo "<script>alert('Registro deletado com sucesso!');</script>";
        //Código para redirecionamento
        echo "<script>window.location.href='../orcamentos/index.php'</script>";
    }
?>