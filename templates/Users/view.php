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
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

echo $this->Html->css('users', ['block' => 'css']);
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?php /*
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            */ ?>
            <?= $this->Html->link(__('Back to blog home'),
                ['controller' => 'posts', 'action' => 'index'],
                ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Account'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete?'),
                'class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive">
        <div class="users view content">
            <h3><?= h($user->username) . __('\'s Information') ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                    <td>
                        <?= $this->Html->link(__('Edit'),
                            ['action' => 'edit', 'username'],
                            ['class' => 'btn btn-outline-primary']
                        ) ?>
                    </button></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td>*******</td>
                    <td>
                        <?= $this->Html->link(__('Edit'),
                            ['action' => 'edit', 'password'],
                            ['class' => 'btn btn-outline-primary']
                        ) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                    <td>
                        <?= $this->Html->link(__('Edit'),
                            ['action' => 'edit', 'email'],
                            ['class' => 'btn btn-outline-primary']
                        ) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Since') ?></th>
                    <td><?= h($user->created->format('Y-m-d H:m')) ?></td>
                    <td></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Your Comments') ?></h4>
                <?php if (!empty($user->comments)) : ?>
                    <?php foreach($user->comments as $c): ?>
                        <div class="card text-white bg-primary mb-3 p-2 flex-grow-1 bd-highlight">
                            <div class="card-header">
                                <b><?= $this->Html->link(
                                    $c->post->title,
                                    ['controller' => 'posts', 'action' => 'view', $c->post->slug],
                                    ['class' => 'html-link']
                                ) ?></b>
                                <span class="fs-5 ms-3" id="comment-created"><?= $c->created->format('Y/m/d H:i') ?></span>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?= $c->content ?></p>
                                <div class="text-end">
                                    <a data-bs-toggle="modal" data-bs-target="#replyModal<?= $c->id?>" id="reply-text">
                                        <i class="bi bi-trash"></i>
                                        <?= $this->Html->link(
                                            __('delete'),
                                            ['controller' => 'comments', 'action' => 'delete', $c->id, '?' => [ 'redirect' => $this->request->getUri()->getPath() ] ],
                                            ['confirm' => __('Are you sure??'), 'class' => 'html-link']
                                        ) ?>
                                    </a>
                                </div>
                            </div> <!-- <div class="card-body"> -->
                        </div> <!-- <div class="card text-white bg-primary mb-3 p-2 flex-grow-1 bd-highlight"> -->
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="">You have not commented yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
