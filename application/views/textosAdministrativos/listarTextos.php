<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tipos de Cursos
            <small>As Categorias de seus cursos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Tipos de Cursos</a></li>
            <li class="active">Listagem</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <div class="row">
                <?php foreach ($textos->result() as $item) { ?>
                    <form method="POST" action="<?= base_url("index.php/textos/alterar/$item->codTexto"); ?>" >
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $item->tipoTexto; ?></h3>
                            </div>
                            <div class="box-body">
                                <textarea class="textareas" id="txt<?= $item->codTexto; ?>" name="txtTexto">
                                    <?= $item->texto;?>
                                </textarea>
                                                                
                                <input type="submit" class="btn btn-success pull-right" style=" min-width: 150px;margin-top: 20px;" />
                            </div>
                            <!-- /.box-body -->
                            
                        </div>
                        
                    </form>
                <?php } ?>
            </div>
        </div>
    </section>
</div>

<script>
    var textareas = [];
<?php foreach ($textos->result() as $item) { ?>
        textareas.push("txt<?= $item->codTexto; ?>");
<?php } ?>
</script>
<script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemTextos.js"); ?>" type="text/javascript"></script>