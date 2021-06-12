<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommentsFixture
 */
class CommentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'post_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'parent_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'lft' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rght' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'level' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'guestname' => ['type' => 'string', 'length' => 32, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'content' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => 'current_timestamp()', 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => 'current_timestamp()', 'comment' => ''],
        '_indexes' => [
            'post_key' => ['type' => 'index', 'columns' => ['post_id'], 'length' => []],
            'user_key' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'user_key' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'post_key' => ['type' => 'foreign', 'columns' => ['post_id'], 'references' => ['posts', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
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
                'post_id' => 1,
                'user_id' => 1,
                'lft' => 1,
                'rght' => 4,
                'level' => 0,
                'guestname' => '',
                'content' => 'This is a parent comment',
                'created' => '2021-02-05 15:57:11',
                'modified' => '2021-02-05 15:57:11',
            ],
            [
                'id' => 2,
                'post_id' => 1,
                'user_id' => 2,
                'parent_id' => 1,
                'lft' => 2,
                'rght' => 3,
                'level' => 1,
                'guestname' => '',
                'content' => 'This is a child comment.',
                'created' => '2021-02-05 15:57:11',
                'modified' => '2021-02-05 15:57:11',
            ],
            [
                'id' => 3,
                'post_id' => 1,
                'user_id' => 3,
                'parent_id' => null,
                'lft' => 5,
                'rght' => 8,
                'level' => 0,
                'guestname' => '',
                'content' => 'This is a parent comment of not subscriber.',
                'created' => '2021-02-05 15:57:11',
                'modified' => '2021-02-05 15:57:11',
            ],
            [
                'id' => 4,
                'post_id' => 1,
                'user_id' => 2,
                'parent_id' => 3,
                'lft' => 6,
                'rght' => 7,
                'level' => 1,
                'guestname' => '',
                'content' => 'This is a child comment of not subscriber.',
                'created' => '2021-02-05 15:57:11',
                'modified' => '2021-02-05 15:57:11',
            ],
        ];
        parent::init();
    }
}
