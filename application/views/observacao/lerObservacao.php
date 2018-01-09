<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Ler Observação</h3>

        <!--div class="box-tools pull-right">
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a>
        </div-->
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h5>
                From: help@example.com
                <span class="mailbox-read-time pull-right"><?= date("d/m/Y", strtotime($dados->data));?></span>
            </h5>
        </div>
        
        <div class="mailbox-read-message" style="background-color: #FFF;">
            <?= $dados->texto; ?>
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    
</div>
<!-- /. box -->
