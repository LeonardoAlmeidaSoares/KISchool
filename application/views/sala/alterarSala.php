<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Turma
            <small>Alteração de Salas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Turma</a></li>
            <li class="active">Alteração de Sala</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->

    <?php $salaAtual = (is_null($minhaSala)) ? 0 : $minhaSala->codSala; ?>

    <input type="hidden" id="codTurma" value="<?= $codTurma; ?>" />
    <input type="hidden" id="txtSalaAtual" value="<?= $salaAtual;?>">
    
    <section class="content container-fluid">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Salas</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-9"  style="text-align: center;">
                            <?php foreach ($lista->result() as $item) { ?>
                                <div class="col-lg-2">
                                    <?php $img = ($item->codSala == $salaAtual) ? base_url("assets/images/door2.png") : base_url("assets/images/door.png"); ?>
                                    <a href="#" codSala="<?= $item->codSala; ?>" style="color: #000; text-decoration: none;" class="imgPorta" nomeSala='<?= $item->descricao;?>'>
                                        <div class="form-group activediv" style="float: left;margin-left: 25px;" class="">
                                            <figure>
                                                <img src="<?= $img; ?>" class="imgDoor">
                                                <figcaption style="text-align: center;">
                                                    <?= $item->descricao; ?>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class='col-lg-3'>
                            <dl id='listaUsosSala'>
                                <dt>
                                    Atuais Usos da sala
                                    <button class='btn btn-info pull-right' id="btnSave">
                                        <span class="fa fa-save"></span> Usar
                                    </button>
                                </dt>
                                <dt id='descSala'></dt>
                                <hr>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</div>
<script src="<?= base_url("assets/paginas/alterarSala.js"); ?>" type="text/javascript"></script>
<style>
    .activediv{
        border: 2px solid #dadada;
        border-radius: 7px;
        outline: none;
        border-color: #9ecaed;
        box-shadow: 0 0 10px #9ecaed;
    }
</style>