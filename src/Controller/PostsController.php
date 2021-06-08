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
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception\MethodNotAllowedException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\TableRegistry;

class PostsController extends AppController
{
    use MailerAwareTrait;

    /**
     * Initializer
     */
    public function initialize() : void
    {
        parent::initialize();
        $this->loadComponent('Paginator');

        // Authentication removal
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);

        // Configure Authorization actions
        $this->Authorization->skipAuthorization(['index', 'view']);

    }

    /**
     * The head page of blog's page.
     * Present list of blogs and archives.
     */
    public function index()
    {
        // Authentication: Check if user is logged in
        $result = $this->Authentication->getResult();
        if ($result->isValid())
        {
            $thisUser = $this->request->getAttribute('identity')->getOriginalData();
            $this->set(compact('thisUser'));
        }


        // Takes up to three posts within last week.
        // The posts are used as latest posts.
        // "\" specifies default namespace.
        $today = new \DateTime('now', new \DateTimeZone('America/New_York'));
        $aWeekAgo = $today->sub(new \DateInterval('P7D'))->format('Y-m-d');
        $latests = $this->Posts->find()
            ->limit(3)
            ->order(['created' => 'DESC'])
            ->where(['created >=' => $aWeekAgo])
            ->toArray();
        $this->set(compact('latests'));




        $posts = $this->Paginator->paginate(
            $this->Posts->find()
                ->order(['created' => 'DESC'])
        );
        $this->set(compact('posts'));
        $this->viewBuilder()->setOption('serialize', ['latests', 'posts']); // For REST
    }

    /**
     * View method.
     * Anybody can view any blog.
     */
    public function view($slug = null)
    {
        $post = $this->Posts->findBySlug($slug)->firstOrFail();
        $this->set(compact('post'));

        // If the request is GET, increment view counter.
        if ($this->request->is(['get']))
        {
            ++$post->view_count;
            $this->Posts->save($post);
        }

        // If user is already logged in, set $thisUser
        $result = $this->Authentication->getResult();
        if ($result->isValid())
        {
            $thisUser = $this->request->getAttribute('identity')->getOriginalData();
            $this->set(compact('thisUser'));
        }

        $comment = $this->Posts->Comments->newEmptyEntity();
        $this->set(compact('comment'));

        // Get all comments
        $comments = $this->Posts->Comments->find('all', [
                'order' => ['Comments.lft' => 'ASC']
            ])
            ->where(['post_id' => $post->id])
            ->contain(['Users'])
            ->toArray();
        if (!empty($comments))
            $this->set(compact('comments'));
        
        $this->viewBuilder()->setOption('serialize', ['post']); // For REST
    }


    /**
     * Add method.
     * Only admin can add a post.
     */
    public function add($id = null)
    {
        // Authorization: Check if the user is admin
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'beAdmin');

        $post = is_null($id)? $this->Posts->newEmptyEntity() : $this->Posts->get($id);

        if ($this->request->is(['post', 'put']))
        {
            // Set up slug.
            // Slug is hyphen-based title instead of space-based.
            // e.g.) title: "this is title" => slug: "this-is-title"
            $data = $this->request->getData();
            $data['slug'] = str_replace(' ', '-', trim(strtolower($data['title'])));

            // Uppercase the first character of each word in a title
            $data['title'] = ucwords($data['title']);

            // copy editordata to body
            $data['body'] = $data['editordata'];
            unset($data['editordata']);

            $post = $this->Posts->patchEntity($post, $data);
            if ($this->Posts->save($post))
            {
                if ($post->isNew())
                {
                    // send emails to subscribers
                    $emails = $this->_getSubscribersEmails('post_sbsc');
                    $this->getMailer('Post')->send('newPost', [$post, $emails]);
                }
                $this->Flash->success(__('Successfully added a new post!'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('Could not add a new post'));
            }
        }

        $this->set(compact('post'));

    }

    /**
     * Edit method.
     * Only admin can edit a post.
     *
     * @param integer|null $id field name to change.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // Authorization: Check if the user is admin
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'beAdmin');
    }


    /**
     * Upload file method.
     * Only admin can upload a file.
     * Processed as ajax request.
     * @throws InternalErrorException If unspported file extension is passed
     * @return string|boolean string if successful, false if not.
     */
    public function upload()
    {
        // Authorization: Check if the user is admin
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'beAdmin');

        $this->autoRender = false;

        if ($this->request->is(['ajax']))
        {
            $this->response = $this->response->withDisabledCache();

            // This object is Laminas\Diactoros\UploadedFile which supports
            // a bunch of useful methods to upload a file.
            $fileObj = $this->request->getData('file');

            // The format of filename is "yyyy-mm-dd-hh-mm-ss.fileExtension".
            $fileExtension = pathinfo($fileObj->getClientFilename(), PATHINFO_EXTENSION);
            $filename = (new \DateTime('now'))->format('Y-m-d-H-i-s') . '.' . $fileExtension;

            // Change target directory based on file extension.
            switch ($fileExtension)
            {
                case 'jpg'  :
                case 'jpeg' :
                case 'png'  :
                    $dir = 'img';
                    break;

                default :
                    throw new InternalErrorException(__('Invalid file extension'));
            }
            $fileUrl = $dir . DS . 'uploads' . DS . $filename;

            // Moves an uploaded file to a new location
            $fileObj->moveTo(WWW_ROOT . $fileUrl);
            if ($fileObj->getError() === UPLOAD_ERR_OK)
            {
                echo DS . $fileUrl;
                return;
            }
            else
            {
                throw new InternalErrorException(__('File Upload Error'));
            }
        }

        throw new InternalErrorException(__('Request Error'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Cake\Http\Exception\MethodNotAllowedException When illegal methods are used.
     */
    public function delete($id = null)
    {
        // Authorization: Check if the user is admin or oneself
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'beAdmin');

        try
        {
            $this->request->allowMethod(['post', 'delete']);
            $post = $this->Posts->get($id);
            if ($this->Posts->delete($post)) {
                $this->Flash->success(__('The post has been deleted.'));
            } else {
                $this->Flash->error(__('The post could not be deleted. Please, try again.'));
            }
    
        }
        catch (MethodNotAllowedException $e)
        {
            $this->Flash->error(__('GET HTTP method is not allowed.'));
        }
        catch (RecordNotFoundException $e)
        {
            $this->Flash->error(__('The record you try to delte is not found.'));
        }
        finally
        {
            return $this->redirect([
                'controller' => 'Posts',
                'action' => 'index',
            ]);
        }

    }

    /**
     * Get all the subscribers' emails.
     * @param string $sbscAttr The attibute of subscription.
     * @return array The subscribers' emails
     */
    private function _getSubscribersEmails($sbscAttr) : array {
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $users = $usersTable->find('all', [
            'condition' => [
                $sbscAttr => 1,
                'active' => 1,
            ]
        ])
        ->all();
        $emails = array();
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }
        return $emails;
    }

}

?>