<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Módulos
            <small>Módulos de Curso</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Módulos</a></li>
            <li class="active">Cadastro</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form role="form" action="<?= base_url("index.php/modulo/inserir"); ?>" method="POST" enctype="multipart/form-data" id="frmCadastro">
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6" class="push-right">
                        <div class="form-group">
                            <label for="txtNome">Nome</label>
                            <input type="text" class="form-control" required id="txtNome" name="txtNome" placeholder="Nome do Módulo">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
                            <label for="txtNome">Curso</label>
                            <select id="txtSelCurso" class="form-control" name="txtCodCurso">
                                <option value="0" selected hidden disabled>SELECIONE O CURSO</option>
                                <?php foreach ($lista->result() as $item) { ?>
                                    <option value="<?= $item->codCurso; ?>"><?= $item->nome; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-12" class="push-right">

                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>  Cadastrar
                            </button>
                        </div>
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
<script src="<?= base_url("assets/paginas/inserirTipoCurso.js"); ?>" type="text/javascript"></script>
