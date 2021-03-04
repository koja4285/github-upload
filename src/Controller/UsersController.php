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

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Initilize method
     * 
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);

        // Configure Authorization actions
        $this->Authorization->skipAuthorization(['login']);
    }    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Authorization: Check if the user is admin
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'beAdmin');
        
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));    
    }


    /**
     * Login method.
     * This is unauthenticated method.
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // If redirect query param is not defined, redirect to /posts after login success
            $redirect = $this->request->getQuery('redirect', $this->Authentication->getLoginRedirect());
            
            if (is_null($redirect))
            {
                // If redirect is null, manually construct redirect URL.
                $redirect = [
                    'controller' => 'Posts',
                    'action' => 'index',
                ];
            }
    
            return $this->redirect($redirect);
        }


        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }

    }    


    /**
     * Logout method
     */
    public function logout()
    {
        // If user is not logged in, redirect to unauthenticatedRedirect
        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
        }
    }
    


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // Authorization: Check if the user is admin
        // $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        // $this->Authorization->authorize($thisUser, 'beAdmin');

        $user = $this->Users->get($id, [
            'contain' => ['Comments'],
        ]);
        $this->set(compact('user'));
    }



    /**
     * Add method. Basically sign up method.
     * This is unauthenticated method.
     * Only admin and unlogged-in user can add (or sign up) a user.
     * 
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // If user is already logged in, redirect to unauthenticatedRedirect
        // unless the user is admin
        $result = $this->Authentication->getResult();
        if ($result->isValid())
        {
            // Authorization: Check if user is not admin
            $thisUser = $this->request->getAttribute('identity')->getOriginalData();
            if (! $this->Authorization->can($thisUser, 'beAdmin'))
            {
                // redirect to /posts after login success
                $redirect = $this->Authentication->getLoginRedirect();
                if (!$redirect)
                {
                    // If redirect is null (which is unlikely...), manually
                    // construct redirect URL.
                    $redirect = $this->request->getQuery('redirect', [
                        'controller' => 'Posts',
                        'action' => 'index',
                    ]);
                }
        
                return $this->redirect($redirect);
            }
                
        }

        // Unlogged in user or admin can reach here.
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            // If the email is empty, it should be unset and stores null.
            $requestData = $this->request->getData();
            if (empty($requestData['email']))
            {
                unset($requestData['email']);
            }

            $user = $this->Users->patchEntity($user, $requestData);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $field field name to change.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($field = null)
    {
        // Authorization: Check if the user is admin or oneself
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'edit');


        // Takes logged in user.
        $user = $this->Users->get($thisUser->getIdentifier(), [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            /**
             * @todo old password validation
             */

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'view', $thisUser->getIdentifier()]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'field'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // Authorization: Check if the user is admin or oneself
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'delete');

        try
        {
            $this->request->allowMethod(['post', 'delete']);
            $user = $this->Users->get($id);
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('The user has been deleted.'));
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
    
        }
        catch (MethodNotAllowedException $e)
        {
            $this->Flash->error(__('GET HTTP method is not allowed.'));
        }
        finally
        {
            return $this->redirect([
                'controller' => 'Posts',
                'action' => 'index',
            ]);
        }

    }
}
