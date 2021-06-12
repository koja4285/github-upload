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
 * @author        Kohei Koja
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 * @var string $postURL
 * @var string $commenter
 */

$style = '
.dialogbox .body {
    position: relative;
    max-width: 500px;
    height: auto;
    margin: 20px 10px;
    padding: 5px;
    background-color: #DADADA;
    border-radius: 3px;
    border: 5px solid #ccc;
  }
  
  .body .message {
    min-height: 30px;
    border-radius: 3px;
    font-family: Arial;
    font-size: 14px;
    line-height: 1.5;
    color: #797979;
  }
';
$this->assign('style', $style);
$this->assign('emailTitle', '');
$this->assign('subtitle', 'Hello');
$body = '<b>' . $commenter . '</b> commented
<div class="dialogbox">
    <div class="body">
        <div class="message">
            <span>' . $comment->content . '</span>
        </div>
    </div>
</div>
to this post:'
. $this->Html->link('"' . $comment->post->title . '"', ['controller' => 'posts', 'action' => 'view', $comment->post->slug, '_full' => true]);

$this->assign('body', $body);
$footer = '<p style="font-size: 14px; line-height: 140%;">You are receiving this email because you subscribe.<br> If you do not want to receive this email, please ' . 
           $this->Html->link('unsubscribe', ['controller' => 'users', 'action' => 'login', '_full' => true]) . '</p>';
$this->assign('footer', $footer);
?>