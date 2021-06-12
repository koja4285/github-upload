<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PostsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\TestSuite\EmailTrait;

/**
 * App\Controller\PostsController Test Case
 *
 * @uses \App\Controller\PostsController
 */
class PostsControllerTest extends TestCase
{
    use IntegrationTestTrait;
    use EmailTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Users',
        'app.Comments',
        'app.Posts',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->Posts = $this->getTableLocator()->get('Posts');
        $this->Users = $this->getTableLocator()->get('Users');
    }

    private function _login(): void
    {
        $user = $this->Users->find('all', [
            'conditions' => ['id' => 1]
        ])->first();
        
        $this->session([
            'Auth' => $user,
        ]);
    }

    private function _csrfSetUp(): void
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
    }

    /**
     * Test new post
     * @return void
     */
    public function testNewPost(): void
    {
        $this->_login();
        $this->_csrfSetUp();
        $this->post('posts/add', [
            'title' => 'this is a title',
            'editordata' => 'this is a body',
        ]);
        $this->assertRedirectContains('posts');
        $this->assertMailCount(1);
    }

    /**
     * Test edit post
     * @return void
     */
    public function testEditPost(): void
    {
        $this->_login();
        $this->_csrfSetUp();
        $this->get('posts/add/1');
        $this->assertNoMailSent();
    }
}
