<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InterventionFixture
 *
 */
class InterventionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'intervention';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'titre' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'note' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'categorie' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'actif' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'chrono_speaking' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'chrono_question' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'date_speaking' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'date_question' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'date_update' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'edition_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'speaker_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'edition_id' => ['type' => 'index', 'columns' => ['edition_id'], 'length' => []],
            'speaker_id' => ['type' => 'index', 'columns' => ['speaker_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'intervention_ibfk_3' => ['type' => 'foreign', 'columns' => ['edition_id'], 'references' => ['edition', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'intervention_ibfk_4' => ['type' => 'foreign', 'columns' => ['speaker_id'], 'references' => ['speaker', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'titre' => 'Lorem ipsum dolor sit amet',
            'note' => 1,
            'categorie' => 'Lorem ipsum dolor sit amet',
            'actif' => 1,
            'chrono_speaking' => 1,
            'chrono_question' => 1,
            'date_speaking' => '2016-01-22 16:03:39',
            'date_question' => '2016-01-22 16:03:39',
            'date_update' => '2016-01-22 16:03:39',
            'edition_id' => 1,
            'speaker_id' => 1
        ],
    ];
}
