<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vagas
            <small>Vagas de emprego </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Vagas</a></li>
            <li class="active">Cadastro</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form role="form" action="<?= base_url("index.php/vagas/inserir");?>" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cargo</label>
                        <input type="text" class="form-control" required id="txtCargo" name="txtCargo" placeholder="Cargo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Descrição</label>
                        <textarea class="form-control" id="txtDescricao" required name="txtDescricao" placeholder="Descrição das atividades"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Cidade</label>
                        <input type="text" class="form-control" id="txtCidade" required name="txtCidade" placeholder="Cidade onde a vaga está disponível"></textarea>
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
<script src="<?= base_url("assets/paginas/inserirVaga.js"); ?>" type="text/javascript"></script>
