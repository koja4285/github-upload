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

use App\Model\Entity\User;
use Authorization\IdentityInterface;
use Cake\Cache\InvalidArgumentException;

/**
 * User policy
 */
class UserPolicy
{
    // /**
    //  * Check if $user can add User
    //  *
    //  * @param \Authorization\IdentityInterface $user The user.
    //  * @param \App\Model\Entity\User $resource
    //  * @return bool
    //  */
    // public function canAdd(IdentityInterface $user, User $resource)
    // {
    //     return !$this->_isLoggedIn($user);
    // }

    /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        return $this->_isAdmin($user) || $this->_isOneself($user, $resource);
    }

    /**
     * Check if $user can delete User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        return $this->_isAdmin($user) || $this->_isOneself($user, $resource);
    }

    // /**
    //  * Check if $user can login
    //  *
    //  * @param \Authorization\IdentityInterface $user The user.
    //  * @param \App\Model\Entity\User $resource
    //  * @return bool
    //  */
    // public function canLogin(IdentityInterface $user, User $resource)
    // {
    //     return !$this->_isLoggedIn($user);
    // }

    // /**
    //  * Check if $user can logout
    //  *
    //  * @param \Authorization\IdentityInterface $user The user.
    //  * @param \App\Model\Entity\User $resource
    //  * @return bool
    //  */
    // public function canLogout(IdentityInterface $user, User $resource)
    // {
    //     return $this->_isLoggedIn($user);
    // }

    /**
     * Check if $user can view User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return $this->_isAdmin($user) || $this->_isOneself($user, $resource);
    }

    /**
     * [public] Check if $user is admin
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canBeAdmin(IdentityInterface $user, User $resource)
    {
        return $this->_isAdmin($user);
    }

    
    /**
     * [Private] Check if the user is admin or not
     * 
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    private function _isAdmin(IdentityInterface $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if the user is him/herself.
     * 
     * @param \Authorization\IdentityInterface $user The user.
     * @throws \Cake\Cache\InvalidArgumentException When $user is not instance of App\Model\Entity\User.
     * @return bool
     */
    private function _isOneself(IdentityInterface $user, User $resource)
    {
        if ($user instanceof User) {
            return $user->getIdentifier() === $resource->id;
        } else {
            throw new InvalidArgumentException('The argument $user is expected to be an instance of App\Model\Entity\User instead of ' . gettype($user) . '.');
        }
    }

    // /**
    //  * Check if the user is logged-in.
    //  * 
    //  * @param \Authorization\IdentityInterface $user The user.
    //  * @return bool
    //  */
    // private function _isLoggedIn(IdentityInterface $user, User $resource)
    // {
    //     return $user->getIdentifier() != null;
    // }

}
