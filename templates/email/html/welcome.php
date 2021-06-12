<?php
/**
 * @link https://dashboard.unlayer.com/create/modern-subscription-email
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string $settingURL
 */

$this->assign('emailTitle', 'Welcome');
$this->assign('subtitle', $user->username);
$this->assign('body', 'I just want to say, by default, you are subscribing all the email notifications.<br />&nbsp;If you wanna change your preference, please go to your <a href="' . $settingURL . '">setting</a>.<br />&nbsp;Again, I appreciate you sparing your time and signing up my silly website.');
?>