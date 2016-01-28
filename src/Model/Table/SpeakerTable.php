<?php
namespace App\Model\Table;

use App\Model\Entity\Speaker;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Speaker Model
 *
 * @property \Cake\ORM\Association\HasMany $Intervention
 */
class SpeakerTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('speaker');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Intervention', [
            'foreignKey' => 'speaker_id'
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('nom', 'create', 'update')
            ->notEmpty('nom');

        $validator
            ->requirePresence('fonction', 'create', 'update')
            ->notEmpty('fonction');

        $validator
            ->requirePresence('avatar', 'create')
            ->notEmpty('avatar');

        $validator
            ->requirePresence('twitter', 'create', 'update')
            ->notEmpty('twitter');

        return $validator;
    }
}
