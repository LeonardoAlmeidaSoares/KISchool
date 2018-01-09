<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Professor
            <small>Listagem de Professores</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Professor</a></li>
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
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codProfessor, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= $item->email; ?></td>
                                <td><?= $item->telefone; ?></td>
                                <td>
                                    <?php if ($item->status == 1) { ?>
                                        <span class="label label-success">ATIVO</span>
                                    <?php } else { ?>
                                        <span class="label label-danger">INATIVO</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <span class="glyphicon glyphicon-trash btnDelete" cod="<?= $item->codProfessor; ?>"></span>
                                    <?php if ($item->status == 1) { ?>
                                        <span class="glyphicon glyphicon-ban-circle spnStatus" cod="<?= $item->codProfessor; ?>" newValue="0"></span>
                                    <?php } else { ?>
                                        <span class="glyphicon glyphicon-ok-circle spnStatus" cod="<?= $item->codProfessor; ?>" newValue="1"></span>
                                    <?php } ?>
                                    <span class="glyphicon glyphicon-comment btnObservacao" cod="<?= $item->codProfessor; ?>"></span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br><Br>
        </div>
        <?php if ($_SESSION["perm_data"]->perm_professor == 2) { ?>
            <div class="pull-right">
                <a href="<?= base_url("index.php/professor/novo"); ?>" class="btn btn-success">
                    <i class="fa fa-plus"></i>  Novo
                </a>
            </div>
        <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemProfessor.js"); ?>" type="text/javascript"></script>


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

