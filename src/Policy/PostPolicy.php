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

use App\Model\Entity\Post;
use Authorization\IdentityInterface;

/**
 * Post policy
 */
class PostPolicy
{
    /**
     * Check if $user can add Post
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Post $post
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Post $post)
    {
        return _isAdmin($user);
    }

    /**
     * Check if $user can edit Post
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Post $post
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Post $post)
    {
        return _isAdmin($user);
    }

    /**
     * Check if $user can delete Post
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Post $post
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Post $post)
    {
        return _isAdmin($user);
    }

    /**
     * Check if $user can view Post
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Post $post
     * @return bool
     */
    public function canView(IdentityInterface $user, Post $post)
    {
        return true;
    }

    /**
     * Check if the user is admin or not
     * 
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    private function _isAdmin(IdentityInterface $user)
    {
        return $user->role === 'admin';
    }

}
