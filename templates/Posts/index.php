<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @author    Kohei Koja
 */

echo $this->Html->css('posts', ['block' => 'css']);
?>

<div class="d-flex justify-content-between">
    <div>
        <h2>Blogs</h2>
    </div>
    <div class="fs-1 menu-bar">
        <?php if (isset($thisUser)): ?>
            <div class="">
                <?= __('Welcome, ') . h($thisUser->username) ?>
            </div>
            <div class="fs-4">
                <?php if ($thisUser->role === 'admin'): ?>
                    <?= $this->Html->link( __('Add new post'), [
                        'action' => 'add'
                    ], [
                        'class' => 'button',
                        'id' => 'add-button'
                    ]) ?>
                <?php endif; ?>
                <?= $this->Html->link(__('Setting'), [
                    'controller' => 'users',
                    'action' => 'view',
                    $thisUser->id
                ], [
                    'id' => 'username-link',
                    'class' => 'button'
                ]) ?>
                <?= $this->Html->link( __('Logout'), [
                    'controller' => 'users',
                    'action' => 'logout'
                ], [
                    'class' => 'button',
                ]) ?>
            </div>
        <?php else: ?>
            <div class="fs-4">
                <?= $this->Html->link(__('Log In'), [
                    'controller' => 'users',
                    'action' => 'login'
                ], [
                    'class' => 'button'
                ]) ?>
                <?= $this->Html->link(__('Register'), [
                    'controller' => 'users',
                    'action' => 'add'
                ], [
                    'class' => 'button'
                ]) ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div>
    <p class="fs-3">
        I write about my life in America. You can freely comment on any posts here.
        By creating your account, you can receive notifications on new posts and comment replies.
    </p>
</div>

<?php if (!empty($latests)): ?>
<h3 id="latest-posts-theme">Latest Posts</h3>
<div class="container">
  <div class="row">
    <?php foreach($latests as $latest): ?>
        <div class="col-md-4">
            <a href="<?= $this->Url->build(['action' => 'view', $latest->slug]) ?>" id="text-black">
                <div class="card" id="latest-card">
                    <div id="dummy"></div>
                    <img src="/img/posts/bingata<?= rand(1, 4) ?>" class="card-img-top" alt="Latest Post" id="latest-img">
                    <div class="card-body">
                        <h5 class="card-title"><?= $latest->created->format('Y-m-d') ?></h5>
                        <p class="card-text mb-3"><?= h($latest->title) ?></p>
                        <?= $this->Html->link(__('Read'), [
                            'action' => 'view',
                            $latest->slug
                        ], [
                            'class' => 'fs-4 btn btn-primary'
                        ]) ?>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>


<h3 class="mt-5">All Posts</h3>
<?php foreach ($posts as $post): ?>
    <a href="<?= $this->Url->build(['action' => 'view', $post->slug]) ?>" id="text-black">
        <div class="card mb-3" id="post-card">
            <div class="row g-0">
                <div class="col-md-1">
                    <img class="position-absolute top-50 start-0 translate-middle-y" src="/img/posts/okinawa_symbol" alt="(^_^)", height="50px">
                </div>
                <div class="col-md-11" id="post-info">
                    <div class="card-body">
                        <h5 class="card-title">><?= $post->created->format('Y-m-d') ?></h5>
                        <p class="card-text"><?= $post->title ?></p>
                    </div>
                </div>
            </div>
        </div>
    </a>
<?php endforeach; ?>