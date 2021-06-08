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

class PostMailer extends Mailer
{

    /**
     * Setting up basic configs of HTML emails.
     * @param \App\Model\Entity\Post $post
     * @param array $email
     */
    private function _setUpHtml($post, $emails) {
        foreach ($emails as $email) {
            $this->addBcc($email);
        }
        $this
            ->setEmailFormat('html')
            ->setFrom('noreply@koja.website', 'Koja\'s website')
            ->setViewVars('post', $post);
    }

    /**
     * New post email
     * @param \App\Model\Entity\Post $post
     * @param array $email
     */
    public function newPost($post, $emails)
    {
        $this->_setUpHtml($post, $emails);
        $this
            ->setSubject('New Post')
            ->setViewVars('newPostURL', Router::url([
                'controller' => 'posts',
                'action' => 'view',
                $post->slug
            ], true))
            ->viewBuilder()
                ->setLayout(null)
                ->setTemplate('new_post');
    }
}
