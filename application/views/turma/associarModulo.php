<form class="form-horizontal" method="POST" action="<?= base_url("index.php/turma/alterarModuloTurma"); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Turma
                <small>Associar Módulo</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Turma</a></li>
                <li class="active">Modulo Ensinado</li>
            </ol>
        </section>
        <hr />
        <section class="content container-fluid">

            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Associar Módulo</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" name="txtCodTurma" value="<?= $dadosTurma->codTurma; ?>" />
                            <label for="inputEmail3" class="col-sm-4 control-label">Módulo Atual</label>

                            <div class="col-sm-8">
                                <?php $atual = (is_null($moduloAtual)) ? "Nenhum Módulo Cursado" : $moduloAtual->descricao; ?>
                                <input type="text" class="form-control" placeholder="" disabled value="<?= $atual; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Novo Módulo</label>

                            <div class="col-sm-8">
                                <select id="sel_modulo" name="sel_modulo" class="form-control">
                                    <?php foreach ($lista->result() as $item) { ?>
                                        <option value="<?= $item->codItem; ?>"><?= $item->descricao; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Configurações</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">

                        <table class="table table-bordered table-striped table-responsive">
                            <tr>
                                <th>
                                    <input type="radio" name="txtGerarCertificados" class="my-check" style="width: 50px;" disabled />
                                </th>
                                <th style="text-align: right;vertical-align: middle;font-size: 18px;">
                                    Gerar Certificados do Módulo Atual  
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <input type="radio" name="txtEnviarEmailAvisando" class="my-check" style="width: 50px;" disabled />
                                </th>
                                <th style="text-align: right;vertical-align: middle;font-size: 18px;">
                                    Enviar Email Avisando aos Alunos
                                </th>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="reset" class="btn btn-default">Voltar</button>
                <button type="submit" class="btn btn-info pull-right">Associar</button>
            </div>
            <!-- /.box-footer -->
        </section>
    </div>
</form>

<script src="<?= base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.js"); ?>" type="text/javascript"></script>
<link href="<?= base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/paginas/associarModulos.js"); ?>" type="text/javascript"></script>