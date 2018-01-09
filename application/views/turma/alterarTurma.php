<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Turma
            <small>Turmas Abertas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Turma</a></li>
            <li class="active"><?= $dadosTurma->descricao;?></li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form role="form" action="<?= base_url("index.php/turma/alterar"); ?>" method="POST" enctype="multipart/form-data" id="frmCadastro">
                <input type="hidden" name="txtCod" value="<?= $dadosTurma->codTurma;?>">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtNome">Nome</label>
                                <input type="text" value="<?= $dadosTurma->descricao;?>" class="form-control" required id="txtNome" name="txtNome" placeholder="Nome da Turma">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtNumVagas">Número de Vagas</label>
                                <input type="text" value="<?= $dadosTurma->numVagas;?>" class="form-control" required id="txtNumVagas" name="txtNumVagas" placeholder="Vagas Disponíveis">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtDiaLetivo">Dia de Aula</label>
                                <input type="text" value="<?= $dadosTurma->diaLetivo;?>" class="form-control" required id="txtDiaLetivo" name="txtDiaLetivo" placeholder="Dias de Aulas">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtInicio">Início das aulas</label>
                                <input type="text" value="<?= $dadosTurma->dataInicio;?>" class="form-control" required id="txtInicio" name="txtInicio" placeholder="Início das Aulas">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtEmail">Curso</label>
                                <select id="txtCurso" name="txtCurso" class="form-control">
                                    <?php foreach ($cursos->result() as $item) { ?>
                                        <?php $sel = ($item->codCurso == $dadosTurma->codCurso) ? "selected" : "0";?>
                                        <option value="<?= $item->codCurso; ?>" <?= $sel;?>><?= $item->nome; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtProfessor">Professor</label>
                                <select id="txtProfessor" name="txtProfessor" class="form-control">
                                    <option value="0" disabled hidden selected>Selecione o Professor</option>
                                    <?php foreach ($professores->result() as $item) { ?>
                                        <?php $sel = ($item->codProfessor == $dadosTurma->codProfessor) ? "selected" : "0";?>
                                        <option value="<?= $item->codProfessor; ?>" <?= $sel;?>><?= $item->nome; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtEscola">Escola</label>
                                <select id="txtEscola" name="txtEscola" class="form-control" disabled>
                                    <?php foreach ($instituicoes->result() as $item) { ?>
                                        <option value="<?= $item->codInstituicao; ?>"><?= $item->descricao; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtHorario">Horários</label>
                                <input type="text" value="<?= $dadosTurma->horario;?>" class="form-control" required id="txtHorario" name="txtHorario" placeholder="Horário da Turma">
                            </div>
                        </div>

                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>  Cadastrar
                        </button>
                    </div>
                </div>
                <!-- /.box-body -->

            </form>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/jquery.validate.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/jquery.mask.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/inserirTurma.js"); ?>" type="text/javascript"></script>


<?php if (isset($_SESSION["msg_err"])) { ?>
    <script>
        $(function () {
            swal("Então...", "<?= $_SESSION["msg_err"]; ?>", "error");
        });
    </script>
    <?php $_SESSION["msg_err"] = NULL;
} ?>


<?php if (isset($_SESSION["msg_ok"])) { ?>
    <script>
        $(function () {
            swal("Parabéns", "<?= $_SESSION["msg_ok"]; ?>", "success");
        });
    </script>
    <?php $_SESSION["msg_ok"] = NULL;
} ?>

