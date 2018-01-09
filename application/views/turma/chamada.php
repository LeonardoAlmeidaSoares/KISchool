<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Turma
            <small>Lista de Presença</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Turma</a></li>
            <li class="active">Chamada</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <form role="form" action="<?= base_url("index.php/turma/salvarChamada"); ?>" method="POST">
            <input type="hidden" id="txtcodTurma" name="txtcodTurma" value="<?= $codTurma; ?>"/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Alunos</h3>
                    <span class="pull-right"><?= $alunos->num_rows(); ?> Alunos</span>
                </div>

                <div class="box-body">

                    <table class="table table-condensed table-hover table-responsive table-striped">
                        <thead>
                            <tr>
                                <th style="width: 25px">Código</th>
                                <th>Presença</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alunos->result() as $item) { ?>
                                <tr>
                                    <td><?= str_pad($item->codAluno, 8, "0", STR_PAD_LEFT); ?></td>
                                    <td><input type="checkbox" name="presenca_<?= $item->codAluno; ?>" class="js-switch" checked reference="<?= $item->codAluno; ?>" /></td>
                                    <td><?= $item->nome; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php if ($alunos->num_rows() > 0) { ?>
                        <br /><br />
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i>  Cadastrar
                            </button>
                        </div>
                    <?php } ?>
                </div>

                <!-- /.box-body -->
            </div>

        </form>
    </section>
</div>
<link href="<?= base_url("assets/plugins/iCheck/all.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/iCheck/icheck.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/chamada.js"); ?>" type="text/javascript"></script>

<?php if ($chamadasHoje > 0) { ?>
    <script>
        $(function () {

            swal({
                title: 'Então',
                text: "Você só pode fazer uma chamada por dia",
                type: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Voltar'
            }).then(function () {
                window.history.back();
            });
            
        });
    </script>
<?php } ?>
