<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Matrícula
            <small>Efetuar Matrícula</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Aluno</a></li>
            <li class="active">Matrícula</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form action="<?= base_url("index.php/aluno/inserirAlunoJaExistente"); ?>" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" class="pull-right">
                                <h3 class="box-title">CONTRATANTE</h3>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" class="push-right">
                                <select id="txtSelCurso" class="form-control" name="txtcodCurso">
                                    <option value="0" selected hidden disabled>SELECIONE O CURSO</option>
                                    <?php foreach ($lista->result() as $item) { ?>
                                        <option value="<?= $item->codCurso; ?>"><?= $item->nome; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" class="push-right">
                                <select id="txtSelTurma" class="form-control">
                                    <option value="0" selected hidden disabled>SELECIONE A TURMA</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="txtNome">Nome</label>
                                    <input type="text" class="form-control" required id="txtNome" name="txtNome" placeholder="Nome do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtNome">Contrato</label>
                                    <input type="text" class="form-control" required id="txtMatricula" name="txtMatricula" placeholder="Número de Matrícula">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtTel">Telefone</label>
                                    <input type="text" class="form-control telefone" required id="txtTel" name="txtTel" placeholder="Telefone do Contratante">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                    <input type="hidden" id="txtvalorCompra" name="txtvalorCompra" />
                    <input type="hidden" id="txtValorParcela" name="txtValorParcela" />
                    <input type="hidden" id="txtNumParcelas" name="txtNumParcelas" />
                    <input type="hidden" id="txtcodTurma" name="txtcodTurma" />
                    <input type="hidden" id="txtValorMatriculaPago" name="txtValorMatriculaPago" value="50" />

                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>  Cadastrar
                        </button>
                    </div>


                </div>

            </form>

        </div>
    </section>
    <!-- /.content -->
</div>

<style>
    .Sub{
        vertical-align: sub;
    }
</style>

<link href="<?= base_url("assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css"); ?>" rel="stylesheet" type="text/css"/>

<link href="<?= base_url("assets/plugins/datepicker/datepicker3.css"); ?>" rel="stylesheet" type="text/css"/>
<!-- /.content-wrapper -->

<script src="<?= base_url("assets/plugins/accounting.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/jquery.mask.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/datepicker/bootstrap-datepicker.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/inserirContrato.js"); ?>" type="text/javascript"></script>


