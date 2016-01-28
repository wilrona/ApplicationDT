<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Intervention Entity.
 *
 * @property int $id
 * @property string $titre
 * @property float $note
 * @property string $categorie
 * @property int $actif
 * @property int $chrono_speaking
 * @property int $chrono_question
 * @property \Cake\I18n\Time $date_speaking
 * @property \Cake\I18n\Time $date_question
 * @property \Cake\I18n\Time $date_update
 * @property int $edition_id
 * @property \App\Model\Entity\Edition $edition
 * @property int $speaker_id
 * @property \App\Model\Entity\Speaker $speaker
 */
class Intervention extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
