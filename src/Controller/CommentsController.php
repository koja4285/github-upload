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

namespace App\Controller;

use Cake\Http\Exception\InternalErrorException;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{
    /**
     * Initializer
     */
    public function initialize() : void
    {
        parent::initialize();
        // $this->loadComponent('Paginator');

        // Authentication removal
        $this->Authentication->addUnauthenticatedActions(['add']);

        // Configure Authorization actions
        $this->Authorization->skipAuthorization(['add']);

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Posts', 'Users', 'ParentComments'],
        ];
        $comments = $this->paginate($this->Comments);

        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Posts', 'Users', 'ParentComments', 'ChildComments'],
        ]);

        $this->set(compact('comment'));
    }

    /**
     * Add method.
     * It takes $redirect method from query parameters.
     *
     * @param int $post_id Post id.
     * @param int|null $parent_id Comment id of parent node. If there is no parent, set null.
     * @throws InternalErrorException If $post_id or $redirect is null.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($post_id, $parent_id = null)
    {        
        // Takes $redirect from query params.
        $redirect = $this->request->getQuery('redirect');

        // Null check for $redirect
        if (is_null($redirect)) throw new InternalErrorException(__('Redirect URL is not passed.'));
        // Null check for $post_id
        if (is_null($post_id)) throw new InternalErrorException(__('Post ID is not passed.'));

        // If user is already logged in, set $thisUser
        $result = $this->Authentication->getResult();
        if ($result->isValid())
        {
            $thisUser = $this->request->getAttribute('identity')->getOriginalData();
            $this->set(compact('thisUser'));
        }

        $commentsTable = $this->getTableLocator()->get('Comments');
        $post = $commentsTable->Posts->get($post_id);
        $parentComment = (is_null($parent_id)) ? null : $commentsTable->get($parent_id);
        
        // new comment
        $comment = $this->Comments->newEmptyEntity();
        if ($this->request->is(['post']))
        {
            $this->Comments->patchEntity($comment, $this->request->getData());

            // If user is logged in, add foreign key
            if (isset($thisUser))
            {
                $comment->user_id = $thisUser->getIdentifier();
            }
            else // Guest's name always starts with 'guest_'
            {
                $comment->guestname = 'guest_' . $this->request->getData('guestname');
            }

            $comment->post = $post;
            $comment->parentComment = $parentComment;
            if ($this->Comments->save($comment))
            {
                $this->Flash->success(__('Thanks for commenting!'));
            }
            else
            {
                $this->Flash->error(__('Oops!! Failed to comment!'));
            }
        }

        return $this->redirect($redirect);

    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $posts = $this->Comments->Posts->find('list', ['limit' => 200]);
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $parentComments = $this->Comments->ParentComments->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'posts', 'users', 'parentComments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
