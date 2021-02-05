<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
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
