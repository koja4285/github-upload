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
    }

    /**
     * View method.
     * Anybody can view any blog.
     */
    public function view($slug = null)
    {
        $post = $this->Posts->findBySlug($slug)->firstOrFail();
        $this->set(compact('post'));

        // If user is already logged in, set $thisUser
        $result = $this->Authentication->getResult();
        if ($result->isValid())
        {
            $thisUser = $this->request->getAttribute('identity')->getOriginalData();
            $this->set(compact('thisUser'));
        }

        // Comments which already exist
        $comments = $this->Posts->Comments->find('threaded')
            ->where(['post_id' => $post->id])
            ->contain(['Users'])
            ->toArray();
        if (!empty($comments))
            $this->set(compact('comments'));

        // new comment
        $comment = $this->Posts->Comments->newEmptyEntity();
        if ($this->request->is(['post']))
        {
            $this->Posts->Comments->patchEntity($comment, $data = $this->request->getData());

            // If user is logged in, add foreign key
            if (isset($thisUser))
            {
                $comment->user_id = $thisUser->getIdentifier();
            }
            else // Guest's name always starts with 'guest_'
            {
                $comment->guestname = 'guest_' . $this->request->getData('guestname');
            }

            $post->comments = [$comment];
            if ($this->Posts->save($post))
            {
                $this->Flash->success(__('Thanks for commenting!'));
            }
            else
            {
                $this->Flash->error(__('Oops!! Failed to comment!'));
            }
        }
        $this->set(compact('comment'));
    }


    /**
     * Add method.
     * Only admin can add a post.
     */
    public function add()
    {
        // Authorization: Check if the user is admin
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'beAdmin');

        $post = $this->Posts->newEmptyEntity();

        if ($this->request->is('post'))
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
     * @todo complete this method
     */
    public function upload()
    {
        // Authorization: Check if the user is admin
        $thisUser = $this->request->getAttribute('identity')->getOriginalData();
        $this->Authorization->authorize($thisUser, 'beAdmin');

        // $this->autoRender = false;

        if ($this->request->is(['post']))
        {
            debug($this->request->getData());
            $fileObj = new \SplFileObject($this->request->getData('form')['file']['tmp_name']);

            // The format of filename is "yyyy-mm-dd-hh-mm-ss.fileExtension".
            $fileExtension = $fileObj->getExtension();
            $filename = (new \DateTime('now'))->format('Y-m-d-H-i-s') . $fileExtension;

            // Change target directory based on file extension.
            switch ($fileExtension)
            {
                case 'jpg'  :
                case 'jpeg' :
                case 'png'  :
                    $dir = 'img';
                    break;

                default :
                    $dir = 'uploads';
                    break;
            }
            $fileUrl = ROOT . DS . $dir . DS . 'uploads' . DS . $filename;

            // Upload file
            if (move_uploaded_file($fileObj->getFilename(), $fileUrl))
            {
                echo $fileUrl;
            }
            else
            {
                echo false;
            }
        }
    }

}

?>