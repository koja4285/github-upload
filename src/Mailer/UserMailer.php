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

 declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Routing\Router;

class UserMailer extends Mailer
{

    /**
     * Setting up basic configs of HTML emails.
     * @param \App\Model\Entity\User $user
     */
    private function _setUpHtml($user) {
        $this
            ->setEmailFormat('html')
            ->setTo($user->email)
            ->setFrom('noreply@koja.website', 'Koja\'s website')
            ->setViewVars('user', $user);
    }

    /**
     * Welcome email
     * @param \App\Model\Entity\User $user
     */
    public function welcome($user)
    {
        $this->_setUpHtml($user);
        $this
            ->setSubject('Welcome ' . $user->username . '!')
            ->setViewVars('settingURL', Router::url([
                'controller' => 'users',
                'action' => 'view',
                $user->getIdentifier()
            ], true))
            ->viewBuilder()
                ->setLayout(null)
                ->setTemplate('welcome');
    }

    /**
     * Verfication email
     * @param \App\Model\Entity\User $user
     */
    public function verify($user)
    {
        $this->_setUpHtml($user);
        $this
            ->setSubject('Thank you for signing up!')
            ->setViewVars('url', Router::url([
                'controller' => 'users',
                'action' => 'verify',
                '?' => ['email' => $user->email, 'hash' => $user->hash]
            ], true))
            ->viewBuilder()
                ->setLayout(null)
                ->setTemplate('verify');
    }
}
