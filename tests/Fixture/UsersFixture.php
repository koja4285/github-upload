<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'username' => ['type' => 'string', 'length' => 32, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'role' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'guest', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'email' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'hash' => ['type' => 'string', 'length' => 32, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'post_sbsc' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'reply_sbsc' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => 'current_timestamp()', 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => 'current_timestamp()', 'comment' => ''],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'username' => ['type' => 'unique', 'columns' => ['username'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'username' => 'root',
                'password' => 'root',
                'role' => 'admin',
                'email' => 'koja_k@om',
                'active' => 0,
                'hash' => 'bc6d753857fe3dd4275dff707dedf329',
                'post_sbsc' => 1,
                'reply_sbsc' => 1,
                'created' => '2021-05-26 15:09:34',
                'modified' => '2021-05-26 15:09:34',
            ],
            [
                'id' => 2,
                'username' => 'active',
                'password' => 'active',
                'role' => 'guest',
                'email' => 'alalal@alalal.alala',
                'active' => 1,
                'hash' => 'bc6d753857fe3dd4275dff707dedf329',
                'post_sbsc' => 1,
                'reply_sbsc' => 1,
                'created' => '2021-05-26 15:09:34',
                'modified' => '2021-05-26 15:09:34',
            ],
            [
                'id' => 3,
                'username' => 'notSubscriber',
                'password' => 'notSubscriber',
                'role' => 'guest',
                'email' => 'alalal@not.sub',
                'active' => 1,
                'hash' => 'bc6d753857fe3dd4275dff707dedf329',
                'post_sbsc' => 0,
                'reply_sbsc' => 0,
                'created' => '2021-05-26 15:09:34',
                'modified' => '2021-05-26 15:09:34',
            ],
        ];
        parent::init();
    }
}
