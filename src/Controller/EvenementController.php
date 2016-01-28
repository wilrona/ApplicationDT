<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Evenement Controller
 *
// * @property \App\Model\Table\EvenementTable $Evenement
 */
class EvenementController extends AppController
{

    /**
     * change_etape method
     *
     * @return void
     */
    public function changeEtape()
    {
        $etapes = TableRegistry::get('Moment');
        $etape = $etapes->find()->first();

        if ($this->request->is('post')) {
            $etapess = $etapes->patchEntity($etape, $this->request->data);
            if($etapes->save($etapess)){
                $etape = $etape->etape;
            }
        }

        $this->set('etape', $etape);
        $this->set('_serialize', ['etape']);
    }

    public function activerSpeaker($event_id)
    {
        $editions = TableRegistry::get('Edition');
        $edition = $editions->get($event_id);

        $interventions = TableRegistry::get('Intervention');
        $intervention = $interventions->find('all')->where(['edition_id' => $edition->id]);

        $this->set(compact('edition', 'intervention'));
        $this->set('_serialize', ['edition', 'intervention']);
    }


}
