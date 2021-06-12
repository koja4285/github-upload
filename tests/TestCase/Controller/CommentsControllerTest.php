<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CommentsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\TestSuite\EmailTrait;

/**
 * App\Controller\CommentsController Test Case
 *
 * @uses \App\Controller\CommentsController
 */
class CommentsControllerTest extends TestCase
{
    use IntegrationTestTrait;
    use EmailTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Comments',
        'app.Posts',
        'app.Users',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->Users = $this->getTableLocator()->get('Users');
        $this->Comments = $this->getTableLocator()->get('Comments');
    }

    private function _login(): void
    {
        $user = $this->Users->find('all', [
            'conditions' => ['id' => 2]
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
     * Comment count test
     * 
     * @return void
     */
    private function _assertCommentCount($count)
    {
        $commentCount = $this->Comments->find('all')->count();
        $this->assertEquals($count, $commentCount);
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAddWithoutParent(): void
    {
        $this->_login();
        $this->_csrfSetUp();
        $this->_assertCommentCount(4);
        $this->post('comments/add/1?redirect=posts/index', [
            'content' => 'hello',
        ]);
        $this->assertRedirectContains('posts');
        $this->_assertCommentCount(5);
        $admin = $this->Comments->Users->find('all', [
            'conditions' => ['role' => 'admin'],
            'fields' => ['email']
        ])->first();
        if ($admin->reply_sbsc)
        {
            $this->assertMailSentTo($admin->email);
            $this->assertMailContainsHtml('hello');
        }
        else
        {
            $this->assertNoMailSent();
        }
    }

    public function testAddWithParentCommentSubscription(): void
    {
        $this->_login();
        $this->_csrfSetUp();
        $this->_assertCommentCount(4);
        $this->post('comments/add/1/1?redirect=posts/index', [
            'content' => 'hello',
        ]);
        $this->assertRedirectContains('posts');
        $this->_assertCommentCount(5);
        $parentCommentUser = $this->Users->get(1);
        $this->assertEquals(true, $parentCommentUser->reply_sbsc);
        $this->assertMailSentTo($parentCommentUser->email);
        $this->assertMailContainsHtml($parentCommentUser->username);
        $this->assertMailContainsHtml('hello');
    }

    public function testAddWithParentCommentNotSubscription(): void
    {
        $parent_id = 3;
        $this->_login();
        $this->_csrfSetUp();
        $this->_assertCommentCount(4);
        $this->post('comments/add/1/' . $parent_id . '?redirect=posts/index', [
            'content' => 'hello',
        ]);
        $this->assertRedirectContains('posts');
        $this->_assertCommentCount(5);
        $parentCommentUser = $this->Users->get($parent_id);
        $this->assertEquals(false, $parentCommentUser->reply_sbsc);
        $this->assertNoMailSent();
    }

    /* comment as a guest */
    public function testCommentAsAGuest(): void
    {
        $parent_id = 1;
        $this->_csrfSetUp();
        $this->post('comments/add/1/' . $parent_id . '?redirect=posts/index', [
            'guestname' => 'aiueo',
            'content' => 'hello',
        ]);
        $this->assertRedirectContains('posts');
        $this->_assertCommentCount(5);
        $parentCommentUser = $this->Users->get($parent_id);
        $this->assertEquals(true, $parentCommentUser->reply_sbsc);
        $this->assertMailSentTo($parentCommentUser->email);
        $this->assertMailContainsHtml($parentCommentUser->username);
    }
}
