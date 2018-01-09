<?php function getStatus($codStatus){
    $ret = "";
    switch($codStatus){
       case COD_AVALIACAO_ADIADA: $ret = "<a class='btn btn-warning btn-xs'>ADIADA</a>"; break;
       case COD_AVALIACAO_CANCELADA:  $ret = "<a class='btn btn-danger btn-xs'>CANCELADA</a>";break;
       case COD_AVALIACAO_EFETUADA:  $ret = "<a class='btn btn-success btn-xs'>APLICADA</a>";break;
       case COD_AVALIACAO_MARCADA:  $ret = "<a class='btn btn-info btn-xs'>MARCADA</a>";break;
   } 
   return $ret;
}?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Avaliações
            <small>Listagem de Avaliações </small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>Avaliações
                </a>
            </li>
            <li class="active">Listagem</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <div class="row">
                <table id="table" class="table table-condensed table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Data de Aplicação</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codAvaliacao, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= date("d/m/Y", strtotime($item->dataAplicacao)); ?></td>
                                <td><?= getStatus($item->status);?></td>
                                <td>
                                    <a href="<?= base_url("index.php/avaliacao/listarNotas/$item->codAvaliacao");?>" style="text-decoration: none; color: #000;" title="Armazenar Notas">
                                        <span class="glyphicon glyphicon-check" cod="<?= $item->codAvaliacao;?>"></span>
                                    </a>
                                    
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if($_SESSION["perm_data"]->perm_turmas == 2){ ?>
            
            <div class="pull-right">
                <a href="<?= base_url("index.php/avaliacao/novo/$codTurma"); ?>" class="btn btn-success">
                    <i class="fa fa-plus"></i>  Novo
                </a>
            </div>
            
            <?php } ?>
            </div>
            
            <br><br>
            
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemCurso.js"); ?>" type="text/javascript"></script>

<?php if(isset($_SESSION["msg_err"])){ ?>
<script>
    $(function(){
        swal("Então...", "<?= $_SESSION["msg_err"];?>", "error");
    });
</script>
<?php $_SESSION["msg_err"] = NULL;} ?>

<?php if(isset($_SESSION["msg_ok"])){ ?>
<script>
    $(function(){
        swal("Parabéns", "<?= $_SESSION["msg_ok"];?>", "success");
    });
</script>
<?php $_SESSION["msg_ok"] = NULL;} ?>
