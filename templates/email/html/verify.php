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
 * @var string $url
 */

?>
<h3>Welcome <b><?= $user->username ?></b> to Koja's website!</h3>
<br>
<p>To activate your account, please click <a href='<?= $url ?>'>here</a> to verify your email address.</p>
<br>
<h4>Love always,<br>Kohei</h4>