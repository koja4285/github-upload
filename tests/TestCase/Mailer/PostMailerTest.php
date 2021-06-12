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

namespace App\Test\TestCase\Mailer;

use App\Mailer\PostMailer;
use Cake\TestSuite\TestCase;
use Cake\TestSuite\EmailTrait;

/**
 * App\Mailer\PostMailer Test Case
 */
class PostMailerTest extends TestCase
{
    use EmailTrait;

    /**
     * Test subject
     *
     * @var \App\Mailer\PostMailer
     */
    protected $PostMailer;

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
        $this->loadRoutes();
        $this->Users = $this->getTableLocator()->get('Users');
        $this->Posts = $this->getTableLocator()->get('Posts');
        $this->PostMailer = new PostMailer();
    }
    /**
     * Test newPost method
     *
     * @return void
     */
    public function testNewPost(): void
    {
        $post = $this->Posts->get(1);
        $users = $this->Users->find('all')->all();
        $emails = array();
        foreach ($users as $user)
        {
            if ($user->post_sbsc)
            {
                array_push($emails, $user->email);
            }
        }
        $this->PostMailer->send('newPost', [$post, $emails]);
    
        // foreach ($users as $user)
        // {
        //     if ($user->post_sbsc)
        //     {
        //         $this->assertMailSentTo($user->email);
        //     }
        //     else
        //     {
        //         $this->assertNoMailSent($user->email);
        //     }
        // }
        $this->assertMailContainsHtml('Read');
        $this->assertMailContainsHtml($post->title);
    }
}
