<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Permissões
            <small>Gerencia de Permissões</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>Permissões
                </a>
            </li>
            <li class="active">Listagem</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <form role=form" action="<?= base_url("index.php/permissao/salvar"); ?>" method="POST">
            <input type="hidden" name="codUsuario" value="<?= $codUsuario; ?>" />
            <div class="col-xs-12">
                <div class="row">
                    <table id="table" class="table table-condensed table-responsive table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Permissão</th>
                                <th>Sem Acesso</th>
                                <th>Somente Visualizar</th>
                                <th>Controle Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista->result() as $item) { ?>
                                <tr>
                                    <th>Gerencia do Site</th>
                                    <td>
                                        <input type="radio" name="txtSite" <?= $item->perm_alterarSite == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtSite" <?= $item->perm_alterarSite == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtSite" <?= $item->perm_alterarSite == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>Gerencia de Cursos</th>
                                    <td>
                                        <input type="radio" name="txtCursos" <?= $item->perm_cursos == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtCursos" <?= $item->perm_cursos == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtCursos" <?= $item->perm_cursos == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Gerencia de Turmas</th>
                                    <td>
                                        <input type="radio" name="txtTurmas" <?= $item->perm_turmas == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtTurmas" <?= $item->perm_turmas == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtTurmas" <?= $item->perm_turmas == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>Gerencia de Professores</th>
                                    <td>
                                        <input type="radio" name="txtProfessor" <?= $item->perm_professor == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtProfessor" <?= $item->perm_professor == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtProfessor" <?= $item->perm_professor == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>Gerencia de Alunos</th>
                                    <td>
                                        <input type="radio" name="txtAluno" <?= $item->perm_aluno == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtAluno" <?= $item->perm_aluno == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtAluno" <?= $item->perm_aluno == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>Gerencia de Salas</th>
                                    <td>
                                        <input type="radio" name="txtSalas" <?= $item->perm_salas == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtSalas" <?= $item->perm_salas == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtSalas" <?= $item->perm_salas == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Gerencia de Permissões</th>
                                    <td>
                                        <input type="radio" name="txtPermissao" <?= $item->perm_permissao == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtPermissao" <?= $item->perm_permissao == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtPermissao" <?= $item->perm_permissao == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Boletos e Pagamentos</th>
                                    <td>
                                        <input type="radio" name="txtPagamento" <?= $item->perm_pagamento == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtPagamento" <?= $item->perm_pagamento == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtPagamento" <?= $item->perm_pagamento == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Decisões de Diretoria</th>
                                    <td>
                                        <input type="radio" name="txtDiretoria" <?= $item->perm_direcao == 0 ? "checked" : ""; ?> value="0" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtDiretoria" <?= $item->perm_direcao == 1 ? "checked" : ""; ?> value="1" class="my-check" style="width: 63px;" />
                                    </td>
                                    <td>
                                        <input type="radio" name="txtDiretoria" <?= $item->perm_direcao == 2 ? "checked" : ""; ?> value="2" class="my-check" style="width: 63px;" />
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>  Cadastrar
                </button>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.js"); ?>" type="text/javascript"></script>
<link href="<?= base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/paginas/editarPermissoes.js"); ?>" type="text/javascript"></script>
