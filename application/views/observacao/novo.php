<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Cadastrar observação</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <input class="form-control" placeholder="To:" value="<?= $dadosAluno->nome;?>" disabled>
        </div>
        <div class="form-group">
            <textarea name="txtMensagem" id="txtMensagem"></textarea>
        </div>
        
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="pull-right">
            <button class="btn btn-primary" id="btnCadNovo"><i class="fa fa-envelope-o"></i> Salvar</button>
        </div>
        <button class="btn btn-default"><i class="fa fa-times"></i> Cancelar</button>
    </div>
    <!-- /.box-footer -->
</div>
<!-- /. box -->

<script src="<?= base_url("assets/paginas/novaObservacao.js");?>" type="text/javascript"></script>