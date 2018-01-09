<?php
function getStatus($codStatus){
    $ret = "";
    switch($codStatus){
        case COD_CONTA_PAGAR_CANCELADA: $ret = "CANCELADO"; break;
        case COD_CONTA_PAGAR_A_VENCER : $ret = "A VENCER"; break;
        case COD_CONTA_PAGAR_PAGO : $ret = "PAGO"; break;
        case COD_CONTA_PAGAR_VENCIDA : $ret = "ATRASADO"; break;
    }
    return $ret;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pagamentos
            <small>Os Pagamentos a receber</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Pagamentos</a></li>
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
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Data de Vencimento</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codContaPagar, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->descricao; ?></td>
                                <td><?= $item->Categoria; ?></td>
                                <td><?= "R$ " . number_format($item->valor, 2, ",", ".") ?></td>
                                <td><?= date("d/m/Y", strtotime($item->dataVencimento)); ?></td>
                                <td><?= getStatus($item->status); ?></td>
                                <td>
                                    <span class="glyphicon glyphicon-trash spnDelete" cod="<?= $item->codContaPagar; ?>"></span>
                                    <?php if ($item->status >= COD_CONTA_PAGAR_A_VENCER) { ?>
                                        <span class="glyphicon glyphicon-ok-circle spnStatus" cod="<?= $item->codContaPagar; ?>" newValue="1"></span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br /><br />
        </div>
        
        <div class="pull-right">
            <a href="<?= base_url("index.php/ContasPagar/novo"); ?>" class="btn btn-success">
                <i class="fa fa-plus"></i>  Novo
            </a>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemContasPagar.js"); ?>" type="text/javascript"></script>

<?php if (isset($_SESSION["msg_err"])) { ?>
    <script>
        $(function () {
            swal("Então...", "<?= $_SESSION["msg_err"]; ?>", "error");
        });
    </script>
    <?php $_SESSION["msg_err"] = NULL;
} ?>

<?php if (isset($_SESSION["msg_ok"])) { ?>
    <script>
        $(function () {
            swal("Parabéns", "<?= $_SESSION["msg_ok"]; ?>", "success");
        });
    </script>
    <?php $_SESSION["msg_ok"] = NULL;
} ?>
