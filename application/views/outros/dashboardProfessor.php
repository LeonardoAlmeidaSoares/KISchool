<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard Principal
            <small>Saiba como anda a empresa</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= str_pad($numTurmas,3,"0",STR_PAD_LEFT);?></h3>
                        <p>Turmas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= base_url("index.php/aluno/novo");?>" class="small-box-footer">Nova Matrícula 
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= str_pad($aniversariantes,3,"0",STR_PAD_LEFT);?></h3>

                        <p>Aniversariantes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?= base_url("index.php/aluno/listarFaltosos/");?>" class="small-box-footer">Visão Detalhada <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>0<sup style="font-size: 20px">0</sup></h3>

                        <p>Lorem Ipsum</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= str_pad($alunos, 3, "0", STR_PAD_LEFT);?></h3>

                        <p>Alunos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url("index.php/aluno/aniversariantes/");?>" class="small-box-footer">Ver Detalhes 
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <br><br>
        <!--div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="box box-success">
                    <div id="cont_grad_"></div>
                </div>
            </div>
            
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="box box-success">
                    <div id="cont_grad_2"></div>
                </div>
            </div>
            
        </div-->
        
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php function getStatusPagto($cod){
    switch($cod){
        case 0: return "Em Aberto"; break;
        case 1: return "Pago"; break;
        default: return "Outra Situação"; break;
    }
}
?>
<script src="https://code.highcharts.com/highcharts.js" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/dashboardProfessor.js");?>" type="text/javascript"></script>

<?php if(isset($_SESSION["msg_err"])){ ?>
<script>
    $(function(){
        swal("Então...", "<?= $_SESSION["msg_err"];?>", "error");
    });
</script>
<?php $_SESSION["msg_err"] = NULL;} ?>
