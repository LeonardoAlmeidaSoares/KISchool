<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cursos
            <small>Cursos Oferecidos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Cursos</a></li>
            <li class="active">Cadastro</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <form role="form" action="<?= base_url("index.php/cursoOferecido/inserir");?>" method="POST" enctype="multipart/form-data">
            <div class="box-body">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="txtNome">Nome</label>
                        <input type="text" class="form-control" required id="txtNome" name="txtNome" placeholder="Nome do Curso">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="txtValor">Valor Base</label>
                        <input class="form-control" id="txtValor" required name="txtValor" placeholder="Valor Base do curso" />
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="col-xs-12 col-md-6 pull-right">
                    <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>
                </div>
            </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/inserirTipoCurso.js"); ?>" type="text/javascript"></script>
