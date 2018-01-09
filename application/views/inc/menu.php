
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel" style="margin-top: 25px;">
            <div class="pull-left image">
                <img src="<?= base_url("assets/images/User.png");?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $_SESSION["user_data"]->nome;?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <?php if($_SESSION["perm_data"]->perm_alterarSite >= 1){ ?>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> 
                    <span>Site</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url("index.php/textos/");?>">Textos Institucionais</a></li>
                    <li><a href="<?= base_url("index.php/vagas/");?>">Vagas</a></li>
                    <li><a href="<?= base_url("index.php/tipocurso/");?>">Tipo de Cursos</a></li>
                    <li><a href="<?= base_url("index.php/curso/");?>">Cursos</a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> 
                    <span>Administrativo</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    
                    <?php if($_SESSION["perm_data"]->perm_cursos >= 1){ ?>
                        <li><a href="<?= base_url("index.php/cursoOferecido/");?>">Cursos</a></li>
                    <?php } ?>
                    <?php if($_SESSION["perm_data"]->perm_cursos >= 1){ ?>
                        <li><a href="<?= base_url("index.php/modulo/getModulos");?>">Módulos</a></li>
                    <?php } ?>
                    <?php if($_SESSION["perm_data"]->perm_professor >= 1){ ?>
                        <li><a href="<?= base_url("index.php/professor/");?>">Professores</a></li>
                    <?php } ?>
                    <?php if($_SESSION["perm_data"]->perm_turmas >= 1){ ?>
                        <li><a href="<?= base_url("index.php/turma/");?>">Turmas</a></li>
                    <?php } ?>
                    <?php if($_SESSION["perm_data"]->perm_salas >= 1){ ?>
                        <li><a href="<?= base_url("index.php/sala/");?>">Salas</a></li>
                    <?php } ?>
                    <?php if($_SESSION["perm_data"]->perm_aluno >= 1){ ?>
                        <li><a href="<?= base_url("index.php/aluno/");?>">Alunos</a></li>
                    <?php } ?>
                    <?php if($_SESSION["perm_data"]->perm_permissao >= 1){ ?>
                        <li><a href="<?= base_url("index.php/permissao/");?>">Permissões</a></li>
                    <?php } ?>
                    <?php if($_SESSION["perm_data"]->perm_pagamento >= 1){ ?>
                        <li><a href="<?= base_url("index.php/pagamento/");?>">Pagamentos</a></li>
                    <?php } ?>
                        <?php if($_SESSION["perm_data"]->perm_pagamento >= 1){ ?>
                        <li><a href="<?= base_url("index.php/contasPagar/");?>">Contas a Pagar</a></li>
                    <?php } ?>
                    
                </ul>
            </li>
            <?php if($_SESSION["perm_data"]->perm_direcao >= 1){ ?>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> 
                    <span>Diretoria</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url("index.php/contrato/cancelamentosPendentes");?>">Cancelamentos</a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
