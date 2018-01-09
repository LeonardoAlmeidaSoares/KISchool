<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cursos
            <small>Os Cursos Disponíveis</small>
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
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codCurso, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= substr($item->texto,0,150) . "..."; ?></td>
                                <td>
                                    <span class="glyphicon glyphicon-trash spnDelete" cod="<?= $item->codTipoCurso;?>"></span>
                                    <?php if($item->status == 1){ ?>
                                        <span class="glyphicon glyphicon-ban-circle spnStatus" cod="<?= $item->codCurso;?>" newValue="0"></span>
                                    <?php } else { ?>
                                        <span class="glyphicon glyphicon-ok-circle spnStatus" cod="<?= $item->codCurso;?>" newValue="1"></span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br><Br>
            <div class="pull-right">
                <a href="<?= base_url("index.php/curso/novo"); ?>" class="btn btn-success">NOVO</a>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemCurso.js"); ?>" type="text/javascript"></script>
