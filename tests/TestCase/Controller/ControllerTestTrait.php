<?php
/**
 * Contoller Test Trait
 * 
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

namespace App\Test\TestCase\Controller;

/**
 * Contoller's test trait
 */
trait ContollerTestTrait
{

    public function login($user_id): void
    {
        $user = $this->Users->find('all', [
            'conditions' => ['id' => $user_id]
        ])->first();
        
        $this->session([
            'Auth' => $user,
        ]);
    }

    public function csrfSetUp(): void
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
    }

}