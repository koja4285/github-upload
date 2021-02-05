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

 $usernameExamples = [
     'iLoveKK', 'teAmoKK', 'KojaIsAwesome', 'KKK(Kohei Koja Kool)'
 ]
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <!-- <h4 class="heading"><?= __('Actions') ?></h4> -->
            <?= $this->Html->link(__('Back to blog home'),
                ['controller' => 'posts', 'action' => 'index'],
                ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('username', [
                        'placeholder' => 'e.g.) ' . $usernameExamples[array_rand($usernameExamples)]
                    ]);
                    echo $this->Form->control('password', [
                        'label' => 'Password',
                        'placeholder' => 'Must be 4 - 32 length'
                    ]);
                    echo $this->Form->control('password_confirm', [
                        'label' => 'Confirm password',
                        'placeholder' => 'Must be 4 - 32 length'
                    ]);
                    echo $this->Form->control('email', [
                        'label' => 'E-mail (Optional)',
                        'placeholder' => 'seriously@optional.ucf.edu'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('¡Let me in!')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
