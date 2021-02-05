<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
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
    <div class="column-responsive column-80">
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
                    <td><?= h($user->created) ?></td>
                    <td></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Comments') ?></h4>
                <?php if (!empty($user->comments)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Post Id') ?></th>
                                <th><?= __('User Id') ?></th>
                                <th><?= __('Parent Id') ?></th>
                                <th><?= __('Guestname') ?></th>
                                <th><?= __('Content') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Modified') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($user->comments as $comments) : ?>
                            <tr>
                                <td><?= h($comments->id) ?></td>
                                <td><?= h($comments->post_id) ?></td>
                                <td><?= h($comments->user_id) ?></td>
                                <td><?= h($comments->parent_id) ?></td>
                                <td><?= h($comments->guestname) ?></td>
                                <td><?= h($comments->content) ?></td>
                                <td><?= h($comments->created) ?></td>
                                <td><?= h($comments->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="">You have not commented yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
