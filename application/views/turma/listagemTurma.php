<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Turmas
            <small>As Turmas Abertas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Cursos</a></li>
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
                            <th>Horário</th>
                            <th>Vagas</th>
                            <th>Aulas</th>
                            <th>Curso</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codTurma, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->descricao; ?></td>
                                <td><?= $item->diaLetivo . ", " . $item->horario; ?></td>
                                <td><?= str_pad($item->numVagas, 2, "0", STR_PAD_LEFT);?></td>
                                <td><?= str_pad($item->NumAulas, 2, "0", STR_PAD_LEFT);?></td>
                                <td><?= $item->curso; ?></td>
                                <td>
                                    <a href="<?= base_url("index.php/turma/chamada/$item->codTurma");?>" style="text-decoration: none;color: #000;" title="Chamada">    
                                        <span class="glyphicon glyphicon-th-list spnChamada" cod="<?= $item->codTurma;?>"></span>
                                    </a>
                                    <?php if($item->status == 1){ ?>
                                        <span class="glyphicon glyphicon-ban-circle spnStatus" cod="<?= $item->codTurma;?>" newValue="0" title="Alterar Status"></span>
                                    <?php } else { ?>
                                        <span class="glyphicon glyphicon-ok-circle spnStatus" cod="<?= $item->codTurma;?>" newValue="1" title="Alterar Status"></span>
                                    <?php } ?>
                                    <span class="glyphicon glyphicon-trash spnDelete" cod="<?= $item->codTurma;?>"  title="Excluir Turma"></span>
                                    <a href="<?= base_url("index.php/turma/listaAlunos/$item->codTurma");?>" style="text-decoration: none;color: #000;"  title="Visualizar Alunos"> 
                                        <span class="glyphicon glyphicon-list-alt spnListaAlunos" cod="<?= $item->codTurma;?>"></span>
                                    </a>
                                    <a href="<?= base_url("index.php/turma/AlterarModulo/$item->codTurma");?>" style="text-decoration: none;color: #000;"  title="Alterar Módulo Ensinado"> 
                                        <span class="glyphicon glyphicon-cog spnListaModulos" cod="<?= $item->codTurma;?>"></span>
                                    </a>
                                    <a href="<?= base_url("index.php/turma/gerirCertificados/$item->codTurma");?>" style="text-decoration: none;color: #000;"  title="Emitir Certificados"> 
                                        <span class="glyphicon glyphicon-check spnListaCertificados" cod="<?= $item->codTurma;?>"></span>
                                    </a>
                                    <a href="<?= base_url("index.php/turma/alterarSala/$item->codTurma");?>" style="text-decoration: none;color: #000;"  title="Alterar Sala"> 
                                        <span class="glyphicon glyphicon-home spnAlterarSala" cod="<?= $item->codTurma;?>"></span>
                                    </a>
                                    <a href="<?= base_url("index.php/avaliacao/listagem/$item->codTurma");?>" style="text-decoration: none; color: #000;" title="MArcar Avaliação">
                                        <span class="glyphicon glyphicon-calendar spnMarcarProva" cod="<?= $item->codTurma;?>"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br><br>
        </div>
        <?php if($_SESSION["perm_data"]->perm_turmas == 2){ ?>
            <div class="pull-right">
                <a href="<?= base_url("index.php/turma/novo"); ?>" class="btn btn-success">
                    <i class="fa fa-plus"></i>  Novo
                </a>
            </div>
            <?php } ?>
    </section>
    <!-- /.content -->
</div>

<!-- /.content-wrapper -->
<script src="<?= base_url("assets/plugins/sweetalert/dist/sweetalert.min.js"); ?>" type="text/javascript"></script>
<link href="<?= base_url("assets/plugins/sweetalert/dist/sweetalert.css"); ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemTurma.js"); ?>" type="text/javascript"></script>

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

