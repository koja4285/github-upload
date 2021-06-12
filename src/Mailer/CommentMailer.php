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
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class CommentMailer extends Mailer
{

    /**
     * Setting up basic configs of HTML emails.
     * @param \App\Model\Entity\Comment $comment
     * @param string $email
     */
    private function _setUpHtml($comment, $email) {
        $this
            ->setEmailFormat('html')
            ->setTo($email)
            ->setFrom('noreply@koja.website', 'Koja\'s website')
            ->setViewVars('comment', $comment);
    }

    /**
     * Reply email
     * @param \App\Model\Entity\Comment $comment
     */
    public function reply($comment)
    {
        $this->_setUpHtml($comment, $comment->parentComment->user->email);
        
        // set who replies
        $replier = (is_null($comment->user_id)) ? $comment->guestname : $comment->user->username;

        $this
            ->setSubject('Someone replied to your comment')
            ->setViewVars('postURL', Router::url([
                'controller' => 'posts',
                'action' => 'view',
                $comment->post->slug
            ], true))
            ->setViewVars('replier', $replier)
            ->viewBuilder()
                ->setLayout('goodLooking')
                ->setTemplate('reply');
    }

    /**
     * New comment email
     * @param \App\Model\Entity\Comment $comment
     * @param string $email
     */
    public function newComment($comment, $email)
    {
        $this->_setUpHtml($comment, $email);
        
        // set who commenter
        $commenter = (is_null($comment->user_id)) ? $comment->guestname : $comment->user->username;

        $this
            ->setSubject($commenter . ' replied to your comment')
            ->setViewVars('postURL', Router::url([
                'controller' => 'posts',
                'action' => 'view',
                $comment->post->slug
            ], true))
            ->setViewVars('commenter', $commenter)
            ->viewBuilder()
                ->setLayout('goodLooking')
                ->setTemplate('new_comment');
    }
}
