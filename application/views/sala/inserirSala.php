<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Salas
            <small>Cadastro de Salas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Salas</a></li>
            <li class="active">Cadastro</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form role="form" action="<?= base_url("index.php/sala/inserir"); ?>" method="POST" enctype="multipart/form-data" id="frmCadastro">
                <div class="box-body">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="txtNome">Descrição da Sala</label>
                                <input type="text" class="form-control" required id="txtNome" name="txtNome" placeholder="Descrição da Sala">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="txtIdentidade">Número de Vagas</label>
                                <input type="number" class="form-control" required id="txtVagas" name="txtVagas" placeholder="Número de Assentos da Sala">
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
<script src="<?= base_url("assets/paginas/inserirSala.js"); ?>" type="text/javascript"></script>