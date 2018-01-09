<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tipos de Cursos
            <small>As Categorias de seus cursos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Tipos de Cursos</a></li>
            <li class="active">Listagem</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form role="form" action="<?= base_url("index.php/tipocurso/inserir");?>" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" required id="txtNome" placeholder="Nome do Tipo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Descrição</label>
                        <textarea class="form-control" id="txtDescricao" required name="txtDescricao" placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Ícone</label>
                        <input type="file" id="txtIcone" name="txtIcone" required>

                    </div>
                </div>
                <!-- /.box-body -->

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/inserirTipoCurso.js"); ?>" type="text/javascript"></script>
