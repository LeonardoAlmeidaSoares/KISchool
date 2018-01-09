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
        <form role="form" action="<?= base_url("index.php/avaliacao/salvarNotas"); ?>" method="POST">
            <input type="hidden" name="txtCodAvaliacao" value="<?= $avaliacao->codAvaliacao;?>" />
            <input type="hidden" name="txtCodTurma" value="<?= $avaliacao->codTurma;?>" />
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Alunos</h3>
                    <span class="pull-right"><?= $listaAlunos->num_rows(); ?> Alunos</span>
                </div>

                <div class="box-body">
                    
                    <table class="table table-condensed table-hover table-responsive table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15%">Código</th>
                                <th style="width: 70%;text-align: center;">Aluno</th>
                                <th>Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaAlunos->result() as $item) { ?>
                                <tr>
                                    <td><?= str_pad($item->codAluno, 8, "0", STR_PAD_LEFT); ?></td>
                                    <td style="width: 70%;text-align: center;"><?= $item->nome; ?></td>
                                    <td style="text-align:center;">
                                        <input type="number" min="0" max="<?= $avaliacao->valorTotal;?>" name="nota_<?= $item->codAluno; ?>" class="form-control" reference="<?= $item->codAluno; ?>" />
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php if ($listaAlunos->num_rows() > 0) { ?>
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
