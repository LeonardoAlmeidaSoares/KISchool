<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Professor
            <small>Professores Contratados</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Professor</a></li>
            <li class="active">Cadastro</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form role="form" action="<?= base_url("index.php/professor/inserir"); ?>" method="POST" enctype="multipart/form-data" id="frmCadastro">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="txtNome">Nome</label>
                                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtIdentidade">R.G.</label>
                                <input type="text" class="form-control" required id="txtIdentidade" name="txtIdentidade" placeholder="Identidade do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtCpf">CPF</label>
                                <input type="text" class="form-control" required id="txtCpf" name="txtCpf" placeholder="CPF do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtEmail">Email</label>
                                <input type="email" class="form-control" required id="txtEmail" name="txtEmail" placeholder="Email do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtNascimento">Nascimento</label>
                                <input type="text" class="form-control" required id="txtNascimento" name="txtNascimento" placeholder="Data de Nascimento do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtTelefone">Telefone</label>
                                <input type="text" class="form-control" required id="txtTelefone" name="txtTelefone" placeholder="Telefone do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtCelular">Celular/Whatsapp</label>
                                <input type="text" class="form-control" required id="txtCelular" name="txtCelular" placeholder="Celular do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtLogradouro">Logradouro</label>
                                <input type="text" class="form-control" required id="txtLogradouro" name="txtLogradouro" placeholder="Endereço do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtComplemento">Complemento</label>
                                <input type="text" class="form-control" required id="txtComplemento" name="txtComplemento" placeholder="Complemento do Endereço do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtBairro">Bairro</label>
                                <input type="text" class="form-control" required id="txtBairro" name="txtBairro" placeholder="Bairro do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="txtCidade">Cidade</label>
                                <input type="text" class="form-control" required id="txtCidade" name="txtCidade" placeholder="Cidade do Professor">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtSenha">Senha</label>
                                <input type="password" class="form-control" required id="txtSenha" name="txtSenha" placeholder="Insira a senha de acesso">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="txtCSenha">Confirmar Senha</label>
                                <input type="password" class="form-control" required id="txtCSenha" name="txtCSenha" placeholder="Confirme a senha">
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            
                            <div class="form-group">
                                <label for="txtArea">Área Lecionada</label>
                                <input type="text" class="form-control" required id="txtArea" name="txtArea" placeholder="Área de Atuação">
                            </div>
                        </div>
                        
                        <input type="hidden" name="txtTipoSalario" value="A" id="txtTipoSalario" />
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">   
                                <label for="txtSalario">Salário</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" required id="txtSalario" name="txtSalario" placeholder="Valor do Salário">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="trigger_select_typeSalario" aria-haspopup="true" aria-expanded="false">Pagamento <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#" class="selectType" value="A">Valor Por Aula</a></li>
                                            <li><a href="#" class="selectType" value="M">Valor Fixo</a></li>
                                        </ul>
                                    </div><!-- /input-group-btn -->
                                </div><!-- /input-group -->
                            </div><!-- /form-group -->
                        </div><!-- /.col-lg-6 -->
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
<script src="<?= base_url("assets/paginas/inserirProfessor.js"); ?>" type="text/javascript"></script>