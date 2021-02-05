<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $Comments
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Comments', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->lengthBetween('username', [4, 32], __('The length must be between 4 and 32.'))
            ->notEmptyString('username', __('Fill out this field.'))
            ->notBlank('username', __('Cannot contain white space.'))
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->lengthBetween('password', [4, 32], __('The length must be between 4 and 32.'))
            ->notBlank('password', __('Cannot contain white space.'))
            ->notEmptyString('password', __('Fill out this field.'));

        $validator
            ->scalar('password_confirm')
            ->lengthBetween('password_confirm', [4, 32], __('The length must be between 4 and 32.'))
            ->notBlank('password_confirm', __('Cannot contain white space.'))
            ->sameAs('password_confirm', 'password', __('Does not match with password.'))
            ->notEmptyString('password_confirm', __('Fill out this field.'));

        $validator
            ->scalar('role')
            ->equals('role', 'guest', __('User must be a guest.'))   // Now, you cannot create admin.
            ->notEmptyString('role');

        $validator
            ->email('email')
            ->notBlank('email', __('Cannot contain white space.'))
            ->allowEmptyString('email');

        return $validator;
    }

        /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationEdit(Validator $validator): Validator
    {
        $validator = validationDefault($validator);

        $validator
            ->scalar('new_password')
            ->lengthBetween('new_password', [4, 32], __('The length must be between 4 and 32.'))
            ->notBlank('new_password', __('Cannot contain white space.'))
            ->notEmptyString('new_password', __('Fill out this field.'));

        $validator
            ->scalar('new_password_confirm')
            ->lengthBetween('new_password_confirm', [4, 32], __('The length must be between 4 and 32.'))
            ->notBlank('new_password_confirm', __('Cannot contain white space.'))
            ->sameAs('new_password_confirm', 'new_password', __('Does not match with password.'))
            ->notEmptyString('new_password_confirm', __('Fill out this field.'));

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']), [
            'errorField' => 'username',
            'message' => __('This username is already used by other user')
            ]);
        $rules->add($rules->isUnique(['email']), [
            'errorField' => 'email',
            'message' => __('This e-mail address is already in use.')
            ]);

        return $rules;
    }
}
