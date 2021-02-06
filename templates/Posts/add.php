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
 */

echo $this->Html->css('posts', ['block' => 'css']);
?>

<div class="row">
    <div class="column-responsive">
        <div class="users form content">
            <?= $this->Form->create($post) ?>
            <fieldset>
                <legend><?= __('Add new post') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('body', [
                        'value' => '',
                        'id' => 'blog-body'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('¡ADD!')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

