<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Matrícula
            <small>Efetuar Matrícula</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Aluno</a></li>
            <li class="active">Matrícula</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <form action="<?= base_url("index.php/aluno/inserir"); ?>" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" class="pull-right">
                                <h3 class="box-title">CONTRATANTE</h3>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" class="push-right">
                                <select id="txtSelCurso" class="form-control">
                                    <option value="0" selected hidden disabled>SELECIONE O CURSO</option>
                                    <?php foreach ($lista->result() as $item) { ?>
                                        <option value="<?= $item->codCurso; ?>"><?= $item->nome; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" class="push-right">
                                <select id="txtSelTurma" class="form-control">
                                    <option value="0" selected hidden disabled>SELECIONE A TURMA</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="txtNome">Nome</label>
                                    <input type="text" class="form-control" required id="txtNome" name="txtNome" placeholder="Nome do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtNome">Email</label>
                                    <input type="email" class="form-control" required id="txtEmail" name="txtEmail" placeholder="Email do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtNascimento">Data de Nascimento</label>
                                    <input type="text" class="form-control data" required id="txtNascimento" name="txtNascimento" placeholder="Data de Nascimento do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtcpf">CPF</label>
                                    <input type="text" class="form-control cpf" required id="txtcpf" name="txtcpf" placeholder="CPF do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtRg">RG</label>
                                    <input type="text" class="form-control" required id="txtRg" name="txtRg" placeholder="RG do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtTel">Telefone</label>
                                    <input type="text" class="form-control telefone" required id="txtTel" name="txtTel" placeholder="Telefone do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtCel">Celular</label>
                                    <input type="text" class="form-control celular" required id="txtCel" name="txtCel" placeholder="Celular do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="form-group">
                                    <label for="txtLogradouro">Endereço</label>
                                    <input type="text" class="form-control" required id="txtLogradouro" name="txtLogradouro" placeholder="Endereço do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtComplemento">Complemento</label>
                                    <input type="text" class="form-control" id="txtComplemento" name="txtComplemento" placeholder="Complemento do Endereço do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtBairro">Bairro</label>
                                    <input type="text" class="form-control" required id="txtBairro" name="txtBairro" placeholder="Bairro do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtCidade">Cidade</label>
                                    <input type="text" class="form-control" required id="txtCidade" name="txtCidade" placeholder="Cidade do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtUF">UF</label>
                                    <input type="text" class="form-control" required id="txtUF" name="txtUF" placeholder="UF da Cidade do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtCep">Cep</label>
                                    <input type="text" class="form-control cep" required id="txtCep" name="txtCep" placeholder="CEP do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="txtPai">Pai</label>
                                    <input type="text" class="form-control" required id="txtPai" name="txtPai" placeholder="Nome do Pai do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="txtMae">Mãe</label>
                                    <input type="text" class="form-control" required id="txtMae" name="txtMae" placeholder="Nome da mãe do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="form-group">
                                    <label for="txtProfissao">Profissão</label>
                                    <input type="text" class="form-control" required id="txtProfissao" name="txtProfissao" placeholder="Profissão do Contratante">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtTelCOmercial">Telefone Comercial</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control telefone" required id="txtTelComercial" name="txtTelComercial" placeholder="Telefone Comerical do Contratante">
                                        <div class="input-group-addon" style="cursor: pointer;" id="btnExchange">
                                            <span class="fa fa-exchange"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">ALUNO</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="txtNome">Nome</label>
                                    <input type="text" class="form-control" required id="txtNomeAluno" name="txtNomeAluno" placeholder="Nome do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtNome">Email</label>
                                    <input type="email" class="form-control" required id="txtEmailAluno" name="txtEmailAluno" placeholder="Email do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtNascimento">Data de Nascimento</label>
                                    <input type="text" class="form-control data" required id="txtNascimentoAluno" name="txtNascimentoAluno" placeholder="Data de Nascimento do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtcpf">CPF</label>
                                    <input type="text" class="form-control cpf" required id="txtcpfAluno" name="txtcpfAluno" placeholder="CPF do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtRg">RG</label>
                                    <input type="text" class="form-control" required id="txtRgAluno" name="txtRgAluno" placeholder="RG do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtTel">Telefone</label>
                                    <input type="text" class="form-control telefone" required id="txtTelAluno" name="txtTelAluno" placeholder="Telefone do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtCel">Celular</label>
                                    <input type="text" class="form-control celular" required id="txtCelAluno" name="txtCelAluno" placeholder="Celular do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="form-group">
                                    <label for="txtLogradouro">Endereço</label>
                                    <input type="text" class="form-control" required id="txtLogradouroAluno" name="txtLogradouroAluno" placeholder="Endereço do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtComplemento">Complemento</label>
                                    <input type="text" class="form-control" id="txtComplementoAluno" name="txtComplementoAluno" placeholder="Complemento do Endereço do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtBairro">Bairro</label>
                                    <input type="text" class="form-control" required id="txtBairroAluno" name="txtBairroAluno" placeholder="Bairro do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtCidade">Cidade</label>
                                    <input type="text" class="form-control" required id="txtCidadeAluno" name="txtCidadeAluno" placeholder="Cidade do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtUF">UF</label>
                                    <input type="text" class="form-control" required id="txtUFAluno" name="txtUFAluno" placeholder="UF da Cidade do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="txtCep">Cep</label>
                                    <input type="text" class="form-control" required id="txtCepAluno" name="txtCepAluno" placeholder="CEP do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="txtPai">Pai</label>
                                    <input type="text" class="form-control" required id="txtPaiAluno" name="txtPaiAluno" placeholder="Nome do Pai do Aluno">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="txtMae">Mãe</label>
                                    <input type="text" class="form-control" required id="txtMaeAluno" name="txtMaeAluno" placeholder="Nome da mãe do Aluno">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">SERVIÇOS E/OU MATERIAIS DIDÁTICOS CONTRATADOS</h3>
                        </div>
                        <div class="box-body" id="box-servicos">
                            <div class="row">
                                <table id="tblServicos" class="table table-bordered table-hover table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Material/Módulo</th>
                                            <th>Dia Letivo</th>
                                            <th>Horário</th>
                                            <th>Suporte Técnico-Pedagógico</th>
                                            <th>Início</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">VALOR DOS SERVIÇOS E MATERIAIS DIDÁTICOS CONTRATADOS</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <table id="tblValoresServicos" class="table table-bordered table-hover table-responsive">
                                    <tbody>
                                        <tr>
                                            <th>SUP. TÉC. PEDAGÓGICO</th>
                                            <td><span id="txtValorTotal"></span></td>
                                            <th>TAXA DE MATRÍCULA:</th>
                                            <td><span id="txtValorMatricula">R$ <a href="#" id="SpnValorMatricula" data-title="SpnValorMatricula">50,00</a></span></td>
                                            <th>PAGAMENTO DE MATRÍCULA</th>
                                            <td>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker" id="datepicker" name="dataPagtoMatricula" title="Deixa Vazio para Pagamento a Vista">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="3">DATA DE VENCIMENTO DAS PARCELAS</th>
                                            <td><input type="number" min="01" max="28" value="16" id="txtVencParc" name="txtVencParc" class="form-control"></td>
                                            <th>VALOR TOTAL DO CONTRATO</th>
                                            <td><span id="txtValorTotalComEntrada"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">FORMA DE PAGAMENTO (considera serviços e materiais didáticos)</h3>
                        </div>
                        <div class="box-body">

                            * O pagamento será feito mediante <a href="#" id="formapagto" data-type="text" data-title="FormadePagamento">Boleto</a> entregue no ato desta.
                            <br>* Parcelamento em <a href="#" id="qtdParcelas" data-title="FormadePagamento">00</a> Parcelas de 
                            <span id="spnValorParcela">R$ <a href="#" id="valorParcelas" data-title="ValorParcelas">00,00</a></span>

                            <br />

                        </div>
                        <!-- /.box-body -->

                    </div>

                    <input type="hidden" id="txtvalorCompra" name="txtvalorCompra" />
                    <input type="hidden" id="txtcodCurso" name="txtcodCurso" />
                    <input type="hidden" id="txtValorParcela" name="txtValorParcela" />
                    <input type="hidden" id="txtNumParcelas" name="txtNumParcelas" />
                    <input type="hidden" id="txtcodTurma" name="txtcodTurma" />
                    <input type="hidden" id="txtValorMatriculaPago" name="txtValorMatriculaPago" value="50" />

                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>  Cadastrar
                        </button>
                    </div>


                </div>

            </form>

        </div>
    </section>
    <!-- /.content -->
</div>

<style>
    .Sub{
        vertical-align: sub;
    }
</style>

<link href="<?= base_url("assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css"); ?>" rel="stylesheet" type="text/css"/>

<link href="<?= base_url("assets/plugins/datepicker/datepicker3.css"); ?>" rel="stylesheet" type="text/css"/>
<!-- /.content-wrapper -->

<script src="<?= base_url("assets/plugins/accounting.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/jquery.mask.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/datepicker/bootstrap-datepicker.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/inserirContrato.js"); ?>" type="text/javascript"></script>


