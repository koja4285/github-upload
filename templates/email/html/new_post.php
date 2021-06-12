<?php
/**
 * @link https://dashboard.unlayer.com/create/modern-subscription-email
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 * @var string $newPostURL
 */
$style = '
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
';
$this->assign('style', $style);
$this->assign('emailTitle', 'New Post');
$this->assign('subtitle', '&#8220;' . $post->title . '&#8221;');
$this->assign('body', $this->Html->link('Read', $newPostURL, ['class' => 'button']));
$footer = '<p style="font-size: 14px; line-height: 140%;">You are receiving this email because you subscribe.<br> If you do not want to receive this email, please ' . 
           $this->Html->link('unsubscribe', ['controller' => 'users', 'action' => 'login', '_full' => true]) . '</p>';
$this->assign('footer', $footer);
?>