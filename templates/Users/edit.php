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
    <?php /*
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    */ ?>
    <div class="column-responsive">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit') ?></legend>
                <?php
                    if ($field === 'username')
                    {
                        echo $this->Form->control('username', [
                            'label' => __('New username'),
                            'value' => ''
                        ] );
                    }
                    else if ($field === 'password')
                    {
                        // TODO
                        // old password validation
                        // echo $this->Form->control('old_password', [
                        //     'label' => __('Old Password'),
                        //     'value' => ''
                        // ]);
                        echo $this->Form->control('password', [
                            'label' => 'New Password',
                            'value' => '',
                            'type' => 'password'
                        ] );
                        echo $this->Form->control('password_confirm', [
                            'label' => __('Confirm New Password'),
                            'type' => 'password'
                        ] );
                    }
                    else if ($field === 'email')
                    {
                        echo $this->Form->control('email');
                    }
                    else if ($field == 'subscription')
                    {
                        echo '<div class="flex-label"> <label>New Post Notification</label>';
                        echo $this->Form->control('post_sbsc', [
                            'label' => [
                                'text' => '',
                                'class' => 'form-check form-switch',
                            ],
                            'type' => 'checkbox',
                            'class' => 'form-check-input',
                        ]);
                        echo '</div>';
                        echo '<div class="flex-label"> <label>Comment Reply Notification</label>';
                        echo $this->Form->control('reply_sbsc', [
                            'label' => [
                                'text' => '',
                                'class' => 'form-check form-switch',
                            ],
                            'type' => 'checkbox',
                            'class' => 'form-check-input',
                        ]);
                        echo '</div>';
                    }
                    else
                    {
                        echo __('Yo, there is nothing you can edit. Please go back ');
                        echo $this->Html->link(__('here'),
                            ['action' => 'view', $user->id]
                        );
                    }
                ?>
            </fieldset>
            <?= $this->Form->button(__('Save change')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
