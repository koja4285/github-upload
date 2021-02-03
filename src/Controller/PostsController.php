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

class PostsController extends AppController
{

    /**
     * Initializer
     */
    public function initialize() : void
    {
        parent::initialize();
        $this->loadComponent('Paginator');

        // Authentication removal
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);

    }

    /**
     * The head page of blog's page.
     * Present list of blogs and archives.
     */
    public function index()
    {
        // Authorization check
        $this->Authorization->skipAuthorization();


        // Takes up to three posts within last week.
        // The posts are used as latest posts.
        // "\" specifies default namespace.
        $today = new \DateTime('now', new \DateTimeZone('America/New_York'));
        $aWeekAgo = $today->sub(new \DateInterval('P7D'))->format('Y-m-d');
        $latest = $this->Posts->find()
            ->limit(3)
            ->order(['created' => 'DESC'])
            ->where(['created >=' => $aWeekAgo])
            ->toArray();
        $this->set(compact('latest'));




        $posts = $this->Paginator->paginate($this->Posts->find());
        $this->set(compact('posts'));
    }

    public function view($slug = null)
    {
        $post = $this->Posts->findBySlug($slug)->firstOrFail();
        $this->set(compact('post'));
    }

}

?>