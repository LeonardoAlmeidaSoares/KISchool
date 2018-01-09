<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contas a Pagar
            <small>Cadastro de Conta a Pagar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Contas a Pagar</a></li>
            <li class="active">Cadastro</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form role="form" action="<?= base_url("index.php/ContasPagar/inserir"); ?>" method="POST" enctype="multipart/form-data" id="frmCadastro">
                <div class="box-body">
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtNome">Descrição</label>
                                <input type="text" class="form-control" required id="txtDescricao" name="txtDescricao" placeholder="Descrição da Conta">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtCategoria">Tipo de Conta</label>
                                <select class="form-control" required id="codCategoriaContaPagar" name="codCategoriaContaPagar">
                                    <option value="0" disabled hidden selected>Selecione</option>
                                    <?php foreach($dados->result() as $item){ ?>
                                    <option value="<?= $item->codCategoriaContaPagar;?>"><?= $item->descricao;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtValor">Valor</label>
                                <input type="text" class="form-control" required id="txtValor" name="txtValor" placeholder="Valor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtVencimento">Data de Vencimento</label>
                                <input type="text" class="form-control" required id="txtVencimento" name="txtVencimento" placeholder="Data de Vencimento">
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="txtObservacao">Observações</label>
                                <textarea name="txtObservacao" id="txtObservacao" name="txtObservacao"></textarea>
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
<script src="<?= base_url("assets/paginas/inserirContaPagar.js"); ?>" type="text/javascript"></script>