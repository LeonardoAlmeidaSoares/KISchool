
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Alunos
            <small>Listagem de Observações</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>Alunos
                </a>
            </li>
            <li class="active">Listagem de Observações</li>
        </ol>
    </section>
    <hr />
    <input type="hidden" id="txtCodigo" value="<?= $codAluno; ?>" />
    <input type="hidden" id="txtTipo" value="A" />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Observações Cadastradas</h3>
                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <button class="btn btn-success" id="btnNovaMensagem">
                                <span class="fa fa-plus"> Novo</span>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                            <i class="fa fa-square-o quadrado-checado"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm lixeira">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fa fa-refresh"></i>
                        </button>

                        <!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped" id="table">
                            <tbody>
                                <?php foreach ($lista->result() as $item) { ?>
                                    <tr class='clickable-row' data-href='#' codItem="<?= $item->codObservacao; ?>">
                                        <td>
                                            <input type="checkbox" class="chk_sel" value="<?= $item->codObservacao; ?>" />
                                        </td>
                                        <td class="mailbox-name" style="width: 15%;">
                                            <a href="#"><?= $item->nome; ?></a>
                                        </td>
                                        <td class="mailbox-subject" style="text-align: left; width: 50%;">
                                            <?= $item->assunto; ?>
                                        </td>
                                        <td class="mailbox-date" style="text-align: center;"><?= date("d/m/Y", strtotime($item->data)); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                            <i class="fa fa-square-o quadrado-checado"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            </button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>

                        <!-- /.pull-right -->
                    </div>
                </div>
            </div>
            <!-- /. box -->
        </div>

        <div class="col-sm-12 col-xs-12 col-lg-6 col-md-6">
            <div id="area_trabalho" style="text-align: center;">
                <img src="<?= base_url("assets/images/correo-electronico.png"); ?>" alt="" width="85%"/>
            </div>
            <div class="box box-primary" id="div_novo_obs">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar observação</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <input class="form-control" placeholder="Assunto:" id="txtAssunto" name="txtAssunto">
                    </div>
                    <div class="form-group">
                        <textarea name="txtMensagem" id="txtMensagem"></textarea>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button class="btn btn-primary" id="btnCadNovo"><i class="fa fa-envelope-o"></i> Salvar</button>
                    </div>
                    <button class="btn btn-default"><i class="fa fa-times"></i> Cancelar</button>
                </div>
                <!-- /.box-footer -->
            </div>

            <div class="box box-primary" id="div_ler_obs">
                <div class="box-header with-border">
                    <h3 class="box-title">Ler Observação</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h5>
                            Cadastrado Por: <span id="span_nome_usuario"></span>
                            <span class="mailbox-read-time pull-right" id="spanHorario"></span>
                        </h5>
                    </div>

                    <div class="mailbox-read-message" id="read_message" style="background-color: #FFF;">
                        
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>

            </div>
            <!-- /. box -->


        </div>
    </section>

</div>
<script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/ckeditor/config.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemObservacoes.js"); ?>" type="text/javascript"></script>