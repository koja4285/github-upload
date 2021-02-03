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

namespace App\Policy;

use App\Model\Entity\Comment;
use Authorization\IdentityInterface;

/**
 * Comment policy
 */
class CommentPolicy
{
    /**
     * Check if $user can add Comment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Comment $comment)
    {
    }

    /**
     * Check if $user can edit Comment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Comment $comment)
    {
    }

    /**
     * Check if $user can delete Comment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Comment $comment)
    {
    }

    /**
     * Check if $user can view Comment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canView(IdentityInterface $user, Comment $comment)
    {
    }
}