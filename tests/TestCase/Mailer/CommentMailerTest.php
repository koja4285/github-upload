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

use App\Mailer\CommentMailer;
use Cake\TestSuite\EmailTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Mailer\CommentMailer Test Case
 */
class CommentMailerTest extends TestCase
{
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

    /**
     * Test subject
     *
     * @var \App\Mailer\CommentMailer
     */
    protected $CommentMailer;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadRoutes();
        $this->Comments = $this->getTableLocator()->get('Comments');
        $this->CommentMailer = new CommentMailer();
    }

    /**
     * Reply email test
     */
    public function testReply()
    {
        $comment = $this->Comments->get(2, ['contain' => ['Users', 'ParentComments.Users', 'Posts']]);
        $this->CommentMailer->send('reply', [$comment]);
    
        $this->assertMailSentTo($comment->parentComment->user->email);
        $this->assertMailContainsHtml($comment->parentComment->user->username);
        $this->assertMailContainsHtml($comment->user->username);
    }
}
