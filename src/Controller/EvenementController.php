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

        $intervention = TableRegistry::get('Intervention');
        $intervention = $intervention->find()->where(['Intervention.actif' => true])->first();

        $this->set(compact('etape', 'intervention'));
        $this->set('_serialize', ['etape', 'intervention']);
    }

    public function activerSpeaker($event_id, $inter_id = null)
    {
        $editions = TableRegistry::get('Edition');
        $edition = $editions->get($event_id);

        $interventions = TableRegistry::get('Intervention');
        $intervention = $interventions->find('all')
                                        ->contain(['Edition', 'Speaker'])
                                        ->where(['edition_id' => $edition->id]);

        if($inter_id){
            $inter_id = (int)$inter_id;

            $interventionss = TableRegistry::get('Intervention');

            $intervent_actif = $interventionss->find()->where(['actif' => true])->first();

            $intervent = $interventionss->find()->where(['id' => $inter_id])->first();

            if($intervent->actif){
                $this->request->data['actif'] = 0;
            }else{
                if($intervent_actif){
                    $intervent_actif->actif = 0;
                    $interventionss->save($intervent_actif);
                }
                $this->request->data['actif'] = 1;
            }

            $intervents = $interventionss->patchEntity($intervent, $this->request->data);
            if($interventionss->save($intervents)){

                $intervent = $interventionss->find()->where(['id' => $inter_id])->first();
                $speaker['actif'] = 0;
                if($intervent->actif){
                    $speakers = TableRegistry::get('Speaker');
                    $speak = $speakers->get($intervent->speaker_id);

                    $speaker['nom'] = $speak->nom;
                    $speaker['fonction'] = $speak->fonction;
                    $speaker['sujet'] = $intervent->titre;
                    $speaker['photo'] = $speak->avatar;
                    $speaker['twitter'] = $speak->twitter;
                    $speaker['categorie'] = $intervent->categorie;
                    $speaker['intervent'] = $intervent->id;
                    $speaker['actif'] = 1;
                }

            }

        }

        $this->set(compact('edition', 'intervention', 'speaker'));
        $this->set('_serialize', ['edition', 'intervention', 'speaker']);
    }


}
