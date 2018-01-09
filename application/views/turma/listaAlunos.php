<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Alunos
            <small>Alunos de <?= $turma->descricao;?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Turmas</a></li>
            <li class="active">Listagem de Alunos</li>
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
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alunos->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codAluno, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= $item->telefone; ?></td>
                                <td>
                                    <a href="<?= base_url("index.php/turma/removerAluno/$item->codAluno/$turma->codTurma");?>" style="text-decoration: none;color: #000;"> 
                                        <span class="glyphicon glyphicon-trash" cod="<?= $item->codAluno;?>"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br><Br>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemCurso.js"); ?>" type="text/javascript"></script>
