<?php
namespace App\Model\Table;

use App\Model\Entity\Edition;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Edition Model
 *
 * @property \Cake\ORM\Association\HasMany $Intervention
 */
class EditionTable extends Table
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

        $this->table('edition');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Intervention', [
            'foreignKey' => 'edition_id'
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
            ->requirePresence('titre', 'create', 'update')
            ->notEmpty('titre');

        $validator
            ->add('date', 'valid', ['rule' => array('date', 'ymd')])
            ->requirePresence('date', 'create', 'update')
            ->notEmpty('date');

        return $validator;
    }
}
