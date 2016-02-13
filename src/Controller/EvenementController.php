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

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Twitter');
    }

    public function index($etape = null)
    {
        $this->viewBuilder()->layout('frontend');

        $etapes = TableRegistry::get('Moment');
        $etape = $etapes->find()->first();

        $edition_encours = TableRegistry::get('Edition');
        $edition_encours = $edition_encours->find()
            ->orderDesc('date')->first();

        $intervention = TableRegistry::get('Intervention');
        $intervention = $intervention->find('all', array('conditions' => array(
                'Intervention.actif' => true
            )))->contain(['Edition', 'Speaker'])->first();

        $this->set(compact('etape', 'edition_encours', 'intervention'));
        $this->set('_serialize', ['etape', 'edition_encours', 'intervention']);

    }



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
                $this->request->data['afficher'] = 0;
            }else{
                if($intervent_actif){
                    $intervent_actif->actif = 0;
                    $intervent_actif->afficher = 0;
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
                    $speaker['number'] = $intervent->number;
                    $speaker['actif'] = 1;
                }

            }

        }

        $this->set(compact('edition', 'intervention', 'speaker'));
        $this->set('_serialize', ['edition', 'intervention', 'speaker']);
    }


    public function affiche(){
        $interventionss = TableRegistry::get('Intervention');

        $intervent_actif = $interventionss->find()->where(['actif' => true])->first();
        $intervent_actif->afficher = 1;

        $count_startup = 0;

        if($intervent_actif->categorie == 'startup'){

            $count_startup = $interventionss->find()->where(['categorie' => 'startup', 'number !=' => '0'])->count();
            if($intervent_actif->number == 0){
                $count_startup++;
                $intervent_actif->number = $count_startup;
            }

        }

        $interventionss->save($intervent_actif);

        $this->set(compact('count_startup'));
    }

    public function twitterNote(){

        $twitter = $this->Twitter->Oauth();

        $interventionss = TableRegistry::get('Intervention');

        $intervent_actif = $interventionss->find()->where(['actif' => true, 'afficher' => true])->first();

        $query = '#DigitalThursday #Startup'.$intervent_actif->number;

        $last_tweet = 0;
        if($this->request->query('last_tweet')){
            $last_tweet = $this->request->query('last_tweet');
            $twitter = $twitter->get('search/tweets', ['q' => $query, 'count' => 10, 'since_id' => $last_tweet]);
        }else{
            $twitter = $twitter->get('search/tweets', ['q' => $query]);
        }

        $note = 0;
        $nbr_tweet = 0;
        $moyenne = 0;
        $date_tweet = 0;

        $edition_encours = TableRegistry::get('Edition');
        $edition_encours = $edition_encours->find()
            ->orderDesc('date')->first();

        foreach($twitter->statuses as $tweet){
            $text = $tweet->text;
            $date_tweet = \DateTime::createFromFormat("Y-m-d", $this->Twitter->convert_date_tweeter($tweet->created_at));

            $text = explode(" ",$text);
            if(in_array("#0", $text)){
                $note = $note + 0;
            }
            if(in_array("#1", $text)){
                $note = $note + 1;
            }
            if(in_array("#2", $text)){
                $note = $note + 2;
            }
            if(in_array("#3", $text)){
                $note = $note + 3;
            }
            if(in_array("#4", $text)){
                $note = $note + 4;
            }
            if(in_array("#5", $text)){
                $note = $note + 5;
            }
            $nbr_tweet++;

        }

        if($nbr_tweet){
            $moyenne = $note / $nbr_tweet;
        }

        if($nbr_tweet > 0){
            if($this->request->query('moyenne')){
                if($last_tweet != $twitter->statuses[0]->id){
                    $moyennes = $this->request->query('moyenne');
                    $moyenne = $moyenne + $moyennes;
                    $moyenne = $moyenne / 2;
                }
            }
            $last_tweet = $twitter->statuses[0]->id;
        }

        $this->set(compact('moyenne', 'last_tweet', 'twitter', 'date_tweet'));
        $this->set('_serialize', ['moyenne', 'last_tweet', 'twitter', 'date_tweet']);
    }

    public function live(){
        $this->viewBuilder()->layout('frontend');

        $twitter = $this->Twitter->Oauth();
        $autolink = \Twitter_Autolink::create();

        $query = '#DigitalThursday';
        if($this->request->query('last')){
            $twitter = $twitter->get('search/tweets', ['q' => $query, 'since_id' => $this->request->query('last'), 'count' => 7]);
            if($twitter->statuses && $twitter->statuses[0]->id == $this->request->query('last')){
                $twitter = [];
            }else if(empty($twitter->statuses)){
                $twitter = [];
            }else{
                foreach($twitter->statuses as $tweet){
                    $text = $autolink->autoLink($tweet->text);
                    $tweet->text = $text;
                }
                $twitter = $twitter->statuses;
            }
        }else{
            $twitter = $twitter->get('search/tweets', ['q' => $query, 'count' => 7]);
            $twitter = $twitter->statuses;
        }

        $this->set(compact('twitter', 'autolink'));
        $this->set('_serialize', ['twitter', 'autolink']);
    }


}
