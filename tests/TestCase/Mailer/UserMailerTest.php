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
namespace App\Test\TestCase\Mailer;

use App\Mailer\UserMailer;
use App\Mailer\WelcomeMailer;
use App\Model\Entity\User;

use Cake\TestSuite\EmailTrait;
use Cake\TestSuite\TestCase;

class WelcomeMailerTestCase extends TestCase
{
    use EmailTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadRoutes();
    }

    /**
     * Verification email test
     */
    public function testVerifyEmail()
    {
        $user = new User([
            'username' => 'test',
            'email' => 'koja_k@outlook.com',
            'hash' => md5( strval( rand(1, 9999) ) )
        ]);
        $mailer = new UserMailer();
        $mailer->send('verify', [$user]);
    
        $this->assertMailSentTo($user->email);
        $this->assertMailContainsHtml($user->username);
        $this->assertMailContainsHtml('To activate your account');
    }

    /**
     * Welcome email test
     */
    public function testWelcomeEmail()
    {
        $user = new User([
            'username' => 'test',
            'email' => 'koja_k@outlook.com',
            'hash' => md5( strval( rand(1, 9999) ) )
        ]);
        $mailer = new UserMailer();
        $mailer->send('welcome', [$user]);
    
        $this->assertMailSentTo($user->email);
        $this->assertMailContainsHtml($user->username);
        $this->assertMailContainsHtml('Welcome');
        $this->assertMailContainsHtml('I just want to say, by default, you are subscribing all the email notifications.');
    }
}