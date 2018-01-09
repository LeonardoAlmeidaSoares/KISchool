<?php function getStatus($cod, $dataVencimento){
    $ret = "";
    switch($cod){
        case -1:
            $ret = "<span class='label label-danger'>Cancelado</span>";
            break;
        case 0:
            if(date("Y-m-d") == $dataVencimento){
                $ret = "<span class='label bg-navy'>Vencendo Hoje</span>";
            }else{
                if(date("Y-m-d") < $dataVencimento){
                    $ret = "<span class='label label-warning'>A Vencer</span>";
                }else{
                    $ret = "<span class='label bg-purple'>Atrasado</span>";
                }
            }
            break;
        case 1:
            $ret = "<span class='label label-success'>Quitado</span>";
            break;
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
                            <th>Contrato</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Valor</th>
                            <th>Data de Vencimento</th>
                            <th>Data de Pagamento</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codPagamento, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= str_pad($item->codContrato, 8, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= $item->telefone; ?></td>
                                <?php if($item->desconto == 0){ ?>
                                <td>
                                    <span style="color: #00a65a;font-weight: bold;">
                                        <?= "R$ " . number_format($item->valor, 2, ",", "."); ?>
                                    </span>
                                </td>
                                <?php } else { ?>
                                <td>
                                    <span style="text-decoration: line-through;color: #dd4b39;font-weight: bold;"><?= "R$ " . number_format($item->valor, 2, ",", "."); ?></span> 
                                    &nbsp;&nbsp;&nbsp;
                                    <span style="color: #00a65a;font-weight: bold;">
                                        <?= "R$ " . number_format((doubleval($item->valor) - doubleval($item->desconto)), 2, ",", ".");?>
                                    </span>
                                </td>
                                <?php } ?>
                                <td><?= $item->Vencimento; ?></td>
                                <td><?= $item->dataPagto; ?></td>
                                <td><?= getStatus($item->status, $item->dataVencimento);?></td>
                                <td>
                                    <span class="glyphicon glyphicon-trash spnDelete" cod="<?= $item->codPagamento; ?>"></span>
                                    <?php if ($item->status == 1) { ?>
                                        <span class="glyphicon glyphicon-ok-circle spnStatus" cod="<?= $item->codPagamento; ?>" newValue="1"></span>
                                    <?php } ?>
                                    <a href="<?= base_url("index.php/boleto/gerarBoleto/$item->codPagamento"); ?>" target="_blank">
                                        <span class="glyphicon glyphicon-link download"></span>
                                    </a>
                                        
                                    <span class="glyphicon glyphicon-erase spnDesconto" cod="<?= $item->codPagamento; ?>"></span>  
                                        
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--div class="pull-right">
            <a href="<?= base_url("index.php/pagamento/novo"); ?>" class="btn btn-success">
                <i class="fa fa-plus"></i>  Novo
            </a>
        </div-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemPagamentos.js"); ?>" type="text/javascript"></script>

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
