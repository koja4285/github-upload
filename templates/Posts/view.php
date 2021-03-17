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

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('< Back to blog home'),
                ['controller' => 'posts', 'action' => 'index'],
                ['class' => 'side-nav-item']) ?>
            <?php if (isset($thisUser) && $thisUser->role === 'admin'): ?>
                <?= $this->Html->link(__('EDIT'),
                    ['controller' => 'posts', 'action' => 'add', $post->id],
                    ['class' => 'btn btn-warning']) ?>
                <?= $this->Form->postLink(
                    __('DELETE'),
                    ['controller' => 'posts', 'action' => 'delete', $post->id],
                    [
                        'class' => 'btn btn-danger',
                        'confirm' => __('Are you sure?')
                    ])
                ?>
            <?php endif; ?>
        </div>
    </aside>
</div>

<h1 id="post-title"><?= h($post->title) ?></h1>
<p id="post-created"><small>Created: <?= $post->created->setTimeZone(new \DateTimeZone('America/New_York'))
                                                       ->format(DATE_RFC850) ?></small></p>
<div id="post-body">
    <p><?= $this->Text->autoParagraph($post->body) ?></p>
</div>

<hr id="border"></hr>

<div class="d-flex justify-content-between">
    <div>
        <h3>Comments</h3>
    </div>
    <div class="fs-1 menu-bar">
        <?php if (!isset($thisUser)): ?>
            <div class="fs-4">
                <?= $this->Html->link(__('Log In'), [
                    'controller' => 'users',
                    'action' => 'login',
                    '?' => [ 'redirect' => $this->request->getUri()->getPath() ]
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
<?php if (!isset($comments)): ?>
    <p>No comments so far... Please dump any comment (-_-)</p>
<?php else: ?>
    <?php // To avoid naming confilication, use $c instead of $comment ?>
    <?php foreach($comments as $c): ?>
        <div class="d-flex bd-highlight">
            <?php
                // Add left margin as many times as the level of the comment.
                for($i = 0; $i < $c->level; ++$i)
                {
                    echo '<div class="p-2 bd-highlight" style="margin-left: 2%">';
                    if ($i == $c->level-1) echo '<i class="bi bi-arrow-return-right"></i>';
                    echo '</div>';
                }
            ?>
            <div class="card text-white bg-primary mb-3 p-2 flex-grow-1 bd-highlight">
                <div class="card-header">
                    <span><img src="/img/comments/user_icon" alt="" height="35px"></span>
                    <?php if (isset($c->user_id)): ?>
                        <?= $c->user->username ?>
                    <?php else: ?>
                        <?= $c->guestname ?>
                    <?php endif; ?>
                    <span class="fs-5" id="comment-created"><?= $c->created->format('Y/m/d H:i') ?></span>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $c->content ?></p>
                    <?php if ($c->level <= 10): ?>
                        <!-- Button trigger modal -->
                        <div class="text-end">
                            <a data-bs-toggle="modal" data-bs-target="#replyModal<?= $c->id?>" id="reply-text">
                                <i class="bi bi-reply"></i>reply
                            </a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="replyModal<?= $c->id?>" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="replyModalLabel">
                                            Reply to <?= (isset($c->user_id)) ? $c->user->username : $c->guestname ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $this->Form->create($comment, [
                                            'url' => [
                                                'controller' => 'comments',
                                                'action' => 'add',
                                                $post->id,
                                                $c->id,
                                                '?' => [ 'redirect' => $this->request->getUri()->getPath() ]
                                            ]
                                        ]) ?>
                                        <fieldset>
                                            <?php
                                                if (isset($thisUser))
                                                {
                                                    echo $this->Form->control('username', [
                                                        'disabled' => true,
                                                        'class' => 'form-control fs-4',
                                                        'value' => $thisUser['username']
                                                    ]);
                                                }
                                                else
                                                {
                                                    echo $this->Form->control('guestname', [
                                                        'label' => false,
                                                        'placeholder' => 'Guestname',
                                                    ]);
                                                }
                                                echo $this->Form->control('content', [
                                                    'label' => false,
                                                    'value' => '',
                                                    'placeholder' => 'Type your thought!'
                                                ]);
                                            ?>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <?= $this->Form->button(__('Reply'), [ 'id' => 'comment-submit' ]) ?>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Modal -->
                    <?php endif; ?>
                </div> <!-- <div class="card-body"> -->
            </div> <!-- <div class="card text-white bg-primary mb-3 p-2 flex-grow-1 bd-highlight"> -->
        </div> <!-- <div class="d-flex bd-highlight"> -->

    <?php endforeach; ?>
<?php endif; ?>

<div class="content mx-3">
    <?= $this->Form->create($comment, [
            'url' => [
                'controller' => 'comments',
                'action' => 'add',
                $post->id,
                '?' => [ 'redirect' => $this->request->getUri()->getPath() ]
            ]
        ]) ?>
    <fieldset>
        <?php
            if (isset($thisUser))
            {
                echo $this->Form->control('username', [
                    'disabled' => true,
                    'class' => 'new-comment-form form-control fs-4',
                    'value' => $thisUser['username']
                ]);
            }
            else
            {
                echo $this->Form->control('guestname', [
                    'class' => 'new-comment-form',
                    'placeholder' => 'Guestname'
                ]);
            }
            echo $this->Form->control('content', [
                'label' => 'Comment',
                'value' => '',
                'class' => 'new-comment-form',
                'placeholder' => 'Type your thought!'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('¡Comment!'), [ 'id' => 'comment-submit' ]) ?>
    <?= $this->Form->end() ?>
</div>
