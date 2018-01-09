<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Modals
            <small>new</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">Modals</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <input type="hidden" id="codContrato" value="<?= $codContrato;?>" />
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Documentos Pré-Cadastrados</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-2">
                            <button type="button" class="btn bg-purple btnLista" id="btnAcordo">
                                Documento de Acordo
                            </button>

                            <br><br>

                            <button type="button" class="btn bg-teal btnLista" id="btnDeclaracao">
                                Documento de Declaração
                            </button>

                            <br><br>

                            <button type="button" class="btn bg-maroon btnLista" id="btnRescisao">
                                Documento de Rescisão
                            </button>

                            <br><br>

                            <button type="button" class="btn btn-warning btnLista" id="btnTrancamento">
                                Documento de Trancamento
                            </button>

                            <br><br>

                        </div>
                        <div class="col-xs-10">
                            <iframe id="AjaxContent" src="<?= base_url("assets/images/loguinha.png"); ?>" height="100%" width="100%"></iframe>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url("assets/plugins/jQuery.print.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/documentacao.js"); ?>" type="text/javascript"></script>

<style>
    .btnLista{
        min-width: 200px;
        min-height: 64px;
    }

    #AjaxContent{
        min-height: 640px;
    }
</style>
