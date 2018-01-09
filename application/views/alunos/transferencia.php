<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Alunos
            <small>Transferencia de Salas</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>Alunos
                </a>
            </li>
            <li class="active">Listagem</li>
        </ol>
    </section>
    <hr />
    <section class="content container-fluid">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 col-lg-6 text-center">
                    <img src="<?= base_url("assets/images/admission-cta-ClassProfile.png"); ?>" alt=""/>
                </div>
                <div class="col-xs-12 col-lg-6">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Turmas do Mesmo Curso</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                <?php foreach ($lista->result() as $item) { ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="<?= base_url("assets/images/class-icon.png"); ?>" class="hidden-sm hidden-sm">
                                        </div>
                                        <div class="product-info">
                                            <a href="<?= base_url("index.php/aluno/confirmarTransferencia/$codAluno/$item->codTurma");?>" class="product-title"><?= $item->descricao; ?>
                                                <span class="label label-warning pull-right"><?= "$item->numVagas Vagas disponíveis"; ?></span></a>
                                            <span class="product-description">
                                                <?= $item->diaLetivo . " - " . $item->horario; ?>
                                            </span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>