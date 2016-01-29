<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Index Controller
 *
// * @property \App\Model\Table\IndexTable $Index
 */
class IndexController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $edition_encours = TableRegistry::get('Edition');
        $edition_encours = $edition_encours->find()
            ->orderDesc('date')->first();


        $etape = TableRegistry::get('Moment');
        $etape = $etape->find()->first();

        $intervention = TableRegistry::get('Intervention');
        $intervention = $intervention->find('all', array('conditions' => array(
                'Intervention.actif' => true
            )))->contain(['Edition', 'Speaker']);



//        $this->set('index', $this->paginate($this->Index));
        $this->set(compact('edition_encours', 'etape', 'intervention'));
    }



}
