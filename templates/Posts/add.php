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

// [START] summernote install
// echo $this->Html->css(
//     'https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css',
//     ['block' => 'css_end']
// );
// echo $this->Html->script(
//     'https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js',
//     ['block' => 'script_end']
// );
// echo $this->Html->script(
//     'https://code.jquery.com/jquery-3.5.1.min.js',
//     ['block' => 'script_end']
// );
// echo $this->Html->css('summernote/summernote.min', ['block' => 'css_end']);
// echo $this->Html->script('summernote/summernote.min', ['block' => 'script_end']);
// [END] summernote install

$this->assign('summernote',
    '
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    '
);

// insert at the end of body tag because of summernote.
echo $this->Html->script('posts', ['block' => 'script_end']);

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
                        'id' => 'summernote',
                        'name' => 'editordata'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('¡ADD!')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

