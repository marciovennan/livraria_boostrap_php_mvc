<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Livraria</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=PATH_PUBLIC?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script src="<?=PATH_PUBLIC?>bootstrap/js/jquery.js"></script>
    <!-- Custom CSS -->
    <link href="<?=PATH_PUBLIC?>bootstrap/css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body> 
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=URL?>">Livraria</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?=URL?>cliente/add">Cadastrar</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                        $total_itens_carrinho = 0;  
                        if (!empty($_COOKIE['livros'])){
                            $itens = unserialize($_COOKIE['livros']);
                            $total_itens_carrinho = count($itens);
                        }
                    ?>
                    <li><a href="<?=URL?>carrinho/checkout"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><span class="badge"><?=$total_itens_carrinho?></span></a></li>
                    <li class="dropdown" style="float: right">
                    <?php if (isset($_SESSION['cliente_id']) && $_SESSION['usuario_id']){?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?=$_SESSION['usuario_nome']?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <li>
                            <a href="<?=URL?>conta"><i class="fa fa-fw fa-user"></i> Conta</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?=URL?>login/logout"><i class="fa fa-fw fa-power-off"></i>Sair</a>
                        </li>
                    </ul>
                    <?php }else {?>
                        <a href="<?=URL?>/login">Faça seu login:</a>                   
                     <?php }?>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
        <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <?php if (!empty($categorias)):?>
                <p class="lead">Categorias</p>
                <div class="list-group">
                    
                    <?php foreach ($categorias as $categoria):?>
                    <a href="<?=URL?>categorias/listaLivrosPorCategoria/<?=$categoria['idCategoria']?>" class="list-group-item"><?php echo $categoria['nome']?></a>
                    <?php endforeach;?>
                    
                </div>
                <?php endif;?>
            </div>
             <?php $this->getFlash() ?>
