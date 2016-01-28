<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('metisMenu.css') ?>

    <?= $this->Html->css('dataTables.bootstrap.css') ?>
    <?= $this->Html->css('dataTables.responsive.css') ?>
    <?= $this->Html->css('font-awesome.css') ?>
    <?= $this->Html->css('select2.css') ?>
    <?= $this->Html->css('bootstrap-datepicker.css') ?>
    <?= $this->Html->css('bootstrap-datetimepicker.css') ?>

    <?= $this->Html->css('sb-admin-2.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="application/javascript" src="/js/jquery.js"></script>
    <?= $this->fetch('script') ?>
</head>
<body>
<div id="wrapper">
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Application Digital Thursday</a>
    </div>
    <!-- /.navbar-header -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-dashboard fa-fw"></i> Gestion de l\'evenement', ['controller' => 'index'], ['escape' => false] ) ?>

                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-file-text fa-fw"></i> Editions', ['controller' => 'edition'], ['escape' => false] ) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-users fa-fw"></i> Speakers', ['controller' => 'speaker'], ['escape' => false] ) ?>

                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<div id="page-wrapper">
        <?= $this->fetch('content') ?>
</div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
    <script type="text/javascript" src="/js/moment.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/metisMenu.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="/js/jquery.dataTables.js"></script>
    <script src="/js/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="/js/select2.full.js"></script>

    <script type="text/javascript" src="/js/inputmask.js"></script>
    <script type="text/javascript" src="/js/jquery.inputmask.js"></script>
    <script type="text/javascript" src="/js/jquery.inputmask.bundle.min.js"></script>

    <script type="text/javascript" src="/js/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="/js/sb-admin-2.js"></script>

    <?= $this->fetch('script2') ?>
</body>
</html>
