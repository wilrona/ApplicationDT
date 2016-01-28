<?php
namespace App\Model\Table;

use App\Model\Entity\Intervention;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Intervention Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Edition
 * @property \Cake\ORM\Association\BelongsTo $Speaker
 */
class InterventionTable extends Table
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

        $this->table('intervention');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Edition', [
            'foreignKey' => 'edition_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Speaker', [
            'foreignKey' => 'speaker_id',
            'joinType' => 'INNER'
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
            ->requirePresence('titre', 'create')
            ->notEmpty('titre');

        $validator
            ->requirePresence('categorie', 'create', 'update')
            ->notEmpty('categorie');

        $validator
            ->add('edition_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('edition_id', 'create', 'update')
            ->notEmpty('edition_id');

        $validator
            ->add('speaker_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('speaker_id', 'create', 'update')
            ->notEmpty('speaker_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['edition_id'], 'Edition'));
        $rules->add($rules->existsIn(['speaker_id'], 'Speaker'));
        return $rules;
    }
}


