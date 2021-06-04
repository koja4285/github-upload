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
 * @var \App\Model\Entity\User $user
 * @var string $settingURL
 */

?>
<h3>Thank you for signing up <b><?= $user->username ?>!</h3>
<br>
<p>
    I just want to say, by default, you are subscribing all the email notifications.<br>
    If you wanna change your preference, please go to your <a href="<?= $settingURL ?>">setting</a>.<br>
    Again, I appreciate you sparing your time and signing up my silly website.
</p>
<br>
<h4>Love always,<br>Kohei</h4>