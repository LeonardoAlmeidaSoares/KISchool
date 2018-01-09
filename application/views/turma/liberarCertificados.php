<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Turma
            <small>Gerar Certificados</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Turma</a></li>
            <li class="active">Gerar Certificados</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <form role="form" action="<?= base_url("index.php/turma/salvarCertificados"); ?>" method="POST">
            <input type="hidden" id="txtcodTurma" name="txtcodTurma" value="<?= $codTurma; ?>"/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Alunos</h3>
                    <span class="pull-right">
                        <select class="form-control" id="txtCodModulo" name="txtCodModulo">
                            <?php foreach ($modulos->result() as $item) { ?>
                                <option value="<?= $item->codItem; ?>"><?= $item->descricao; ?></option>
                            <?php } ?> 
                        </select>
                    </span>
                </div>

                <div class="box-body no-padding">

                    <table class="table table-condensed table-hover table-responsive">
                        <thead>
                            <tr>
                                <th style="width: 10px">Código</th>
                                <th>Presença</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alunos->result() as $item) { ?>
                                <tr>
                                    <td><?= str_pad($item->codAluno, 4, "0", STR_PAD_LEFT); ?></td>
                                    <td><input type="checkbox" name="cert_<?= $item->codAluno; ?>" class="js-switch" checked reference="<?= $item->codAluno; ?>" /></td>
                                    <td><?= $item->nome; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
           
            <?php if ($alunos->num_rows() > 0) { ?>
                <div class="pull-right">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>  Criar Certificados
                    </button>
                </div>
            <?php } ?>



            <!-- /.box-body -->
        </form>
    </section>
</div>
<link href="<?= base_url("assets/plugins/iCheck/all.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/iCheck/icheck.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/chamada.js"); ?>" type="text/javascript"></script>


