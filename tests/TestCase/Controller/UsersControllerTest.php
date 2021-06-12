<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
        $this->Users = $this->getTableLocator()->get('Users');
    }

    private function _csrfSetUp(): void
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
    }

    /** test adding user */
    public function testAdd(): void
    {
        $user = $this->Users->find('all', [
            'role' => 'admin',
        ])->first();
        $this->assertNotEmpty($user);
        $this->post('/users/add', [
            'username' => 'user1',
            'password' => 'user1',
            'password_confirm' => 'user1',
            'email' => 'koja_k@outlook.com',
        ]);
        $user = $this->Users->find('all', [
            'username' => 'user1',
        ])->first();
        $this->assertNotNull($user->hash);
    }


    /**
     * Test verify method
     * @return void
     */
    public function testVerify(): void
    {
        $user = $this->Users->find('all', [
            'fields' => ['username', 'hash', 'active'],
            'conditions' => ['email' => 'koja_k@om']
        ])->first();
        $this->assertNotEmpty($user);
        $this->assertEquals(false, $user->active);

        $this->get('/users/verify?email=koja_k@om&hash=bc6d753857fe3dd4275dff707dedf329');

        $this->assertResponseOk();

        $user = $this->Users->find('all', [
            'fields' => ['username', 'hash', 'active'],
            'conditions' => ['email' => 'koja_k@om']
        ])->first();
        $this->assertNotEmpty($user);
        $this->assertEquals(true, $user->active);
    }

    /**
     * test view method
     * @return void
     */
    public function testViewAuthAcivated()
    {
        $user = $this->Users->find('all', [
            'conditions' => ['id' => 2]
        ])->first();
        
        $this->session([
            'Auth' => $user,
        ]);

        $this->assertEquals(true, $user->active);
        $this->get('/users/view/2');
        $this->assertResponseOk();
    }

    /**
     * @return void
     */
    public function testViewAuthWithoutActivation()
    {
        $user = $this->Users->find('all', [
            'conditions' => ['id' => 1]
        ])->first();
        
        $this->session([
            'Auth' => $user,
        ]);

        $this->assertEquals(false, $user->active);
        $this->get('/users/view/1');
        $this->assertResponseCode(302);
        $this->assertRedirectContains('posts');
        // $this->assertResponseContains('The user is not activated.');
    }

    /**
     * test login method without activation
     * @return void
     */
    public function testLoginWithoutActivation()
    {
        $user = $this->Users->find('all', [
            'conditions' => ['id' => 1]
        ])->first();
        
        // Authentication
        $this->session([
            'Auth' => $user,
        ]);

        // not active
        $this->assertEquals($user->active, false);
        $this->get('/users/login');
        $this->assertResponseContains('The user is not activated.');
    }

    /**
     * test login method
     * @return void
     */
    public function testLogin()
    {
        $user = $this->Users->find('all', [
            'conditions' => ['id' => 2]
        ])->first();
        
        // Authentication
        $this->session([
            'Auth' => $user,
        ]);

        // not active
        $this->assertEquals($user->active, true);
        $this->get('/users/login');
        $this->assertResponseNotContains('The user is not activated.');
    }


    /**
     * test edits
     * @return void
     */
    public function testEditSub(): void
    {
        $this->_csrfSetUp();
        $user = $this->Users->find('all', [
            'conditions' => ['id' => 1]
        ])->first();
        
        // Authentication
        $this->session([
            'Auth' => $user,
        ]);

        $this->assertEquals(true, $user->post_sbsc);
        $this->assertEquals(true, $user->reply_sbsc);
        // $this->get('users/edit/subscription');
        $this->put('users/edit/subscription', [
            'post_sbsc' => 0,
            'reply_sbsc' => 0
        ]);
        $user = $this->Users->find('all', [
            'conditions' => ['id' => 1]
        ])->first();
        $this->assertRedirectContains('users/view');
        $this->assertEquals(false, $user->post_sbsc);
        $this->assertEquals(false, $user->reply_sbsc);
    }
}
