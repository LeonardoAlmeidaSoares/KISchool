<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Avaliação
            <small>Cadastro de Avaliação para <?= $turma->row(0)->descricao;?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Avaliações</a></li>
            <li class="active">Cadastro</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <form role="form" action="<?= base_url("index.php/avaliacao/inserir"); ?>" method="POST" enctype="multipart/form-data">

            <div class="col-xs-12 col-lg-4">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" required id="txtNome" name="txtNome" placeholder="Nome do Curso">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-4">
                <div class="box-body">
                    <div class="form-group">
                        <label for="txtData">Data da Aplicação</label>
                        <input type="text" class="form-control" required id="txtData" name="txtData" placeholder="Data da Aplicação">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-4">
                <div class="box-body">
                    <div class="form-group">
                        <label for="txtValor">Valor da Avaliação</label>
                        <input type="text" class="form-control" required id="txtValor" name="txtValor" placeholder="Valor da Avaliação">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-lg-12">
                <div class="box-body">
                    <div class="form-group">
                        <label for="txtDescricao">Descrição</label>
                        <textarea class="form-control" id="txtDescricao" required name="txtDescricao"></textarea>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="col-xs-12 col-lg-12">
                <div class="box-body">
                    <input type="hidden" name="txtCodTurma" value="<?= $turma->row(0)->codTurma;?>" />
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/datepicker/bootstrap-datepicker.js"); ?>" type="text/javascript"></script>
<link href="<?= base_url("assets/plugins/datepicker/datepicker3.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/paginas/inserirAvaliacao.js"); ?>" type="text/javascript"></script>
