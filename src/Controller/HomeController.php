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

namespace App\Controller;

use App\Controller\AppController;


class HomeController extends AppController
{

    /**
     * Initilize method
     * 
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        // Authentication removal
        $this->Authentication->addUnauthenticatedActions(['index']);
    }


    /**
     * Index of home page.
     */
    public function index() : void
    {
        // Authorization check
        $this->Authorization->skipAuthorization();
    }
}
?>