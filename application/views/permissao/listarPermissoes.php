<?php 
    function getValue($cod){
        $ret = "";
        switch($cod){
            case 0: $ret = "<span class='label label-danger'>Não Permitido</span>"; break;
            case 1: $ret = "<span class='label label-success'>Leitura</span>"; break;
            case 2: $ret = "<span class='label label-info'>Permitido</span>"; break;
        }
        return $ret;
    }
?>
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
        <div class="col-xs-12">
            <div class="row">
                <table id="table" class="table table-condensed table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>Cursos</th>
                            <th>Turmas</th>
                            <th>Salas</th>
                            <th>Professor</th>
                            <th>Alunos</th>
                            <th>Permissões</th>
                            <th>Pagamentos</th>
                            <th>Administração</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codUsuario, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= getValue($item->perm_alterarSite); ?></td>
                                <td><?= getValue($item->perm_cursos); ?></td>
                                <td><?= getValue($item->perm_turmas); ?></td>
                                <td><?= getValue($item->perm_salas); ?></td>
                                <td><?= getValue($item->perm_professor); ?></td>
                                <td><?= getValue($item->perm_aluno); ?></td>
                                <td><?= getValue($item->perm_permissao); ?></td>
                                <td><?= getValue($item->perm_pagamento); ?></td>
                                <td><?= getValue($item->perm_direcao); ?></td>
                                <td>
                                    <?php if($item->perm_permissao == 2){ ?>
                                    <a href="<?= base_url("index.php/permissao/editar/$item->codUsuario");?>" style="text-decoration: none;color: #000;" title="Alterar a configuração"> 
                                        <span class="glyphicon glyphicon-edit" cod="<?= $item->codUsuario;?>"></span>
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemPermissoes.js"); ?>" type="text/javascript"></script>

<?php if(isset($_SESSION["msg_err"])){ ?>
<script>
    $(function(){
        swal("Então...", "<?= $_SESSION["msg_err"];?>", "error");
    });
</script>
<?php $_SESSION["msg_err"] = NULL;} ?>

<?php if(isset($_SESSION["msg_ok"])){ ?>
<script>
    $(function(){
        swal("Parabéns", "<?= $_SESSION["msg_ok"];?>", "success");
    });
</script>
<?php $_SESSION["msg_ok"] = NULL;} ?>

