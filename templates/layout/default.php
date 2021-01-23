<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 * @author        Kohei Koja
 */

$websiteDescription = 'koja\'s website';
$modifedDateTime = date('Y-m-d H:i:s', strtotime($siteInfo['modified']));
$currentController = $this->request->getParam('controller');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $websiteDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">


    <?= $this->Html->css('bootstrap') ?>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>
    <?= $this->Html->css(['default_layout']) ?>

    <!-- Include external files and scripts here (See HTML helper for more info.) -->
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Cake</span>PHP</a>
        </div>
        <div class="top-nav-links">
            <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/">Documentation</a>
            <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a>
        </div>
    </nav> -->

    <nav class="top-nav navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Welcome</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex justify-content-around">
                    <li class="nav-item">
                        <a href="/home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/posts" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="/portfolio" class="nav-link">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://www.linkedin.com/in/koheikoja">
                            <img src="img/LI-In-Bug.png" alt="LinkedIn" width="45" height="36">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-9">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
                <div class="col-md-3">
                    <h3 class="">
                        Website's Infomation
                    </h3>
                    <table class="table table-borderless">
                        <?= $this->Html->tableHeaders(['Visitors', 'Last update']) ?>
                        <?= $this->Html->tableCells([
                            $siteInfo['visit_count'],
                            $modifedDateTime
                        ]) ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="my-5 pt-5 text-muted text-center">
        <p class="mb-1">poweredBy <a href="https://cakephp.org"><span>Cake</span>PHP</a></p>
    </footer>    </footer>
    <!-- Bootstrap Bundle with Popper -->
    <?= $this->Html->script('bootstrap.bundle') ?>
</body>
</html>
