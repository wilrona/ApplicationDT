<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Intervention Controller
 *
 * @property \App\Model\Table\InterventionTable $Intervention
 */
class InterventionController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index($id, $id_intervention = null)
    {

        if($id_intervention){
            $intervention = $this->Intervention->get($id_intervention);
            $edition = $intervention->edition_id;
            if ($this->Intervention->delete($intervention)) {
                $this->Flash->success(__('The intervention has been deleted.'));
            } else {
                $this->Flash->error(__('The intervention could not be deleted. Please, try again.'));
            }
        }

        $intervention = $this->Intervention->find('all')->where(['edition_id' => $id]);

        $edition = TableRegistry::get('Edition');
        $edition = $edition->get($id);

        $this->paginate = [
            'contain' => ['Edition', 'Speaker']
        ];

        $this->set(compact('intervention', 'edition', $this->paginate($intervention)));
        $this->set('_serialize', ['intervention', 'edition']);

    }

    /**
     * View method
     *
     * @param string|null $id Intervention id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $intervention = $this->Intervention->get($id, [
            'contain' => ['Edition', 'Speaker']
        ]);
        $this->set('intervention', $intervention);
        $this->set('_serialize', ['intervention']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id)
    {
        $intervention = $this->Intervention->newEntity();

        $edition = TableRegistry::get('Edition');
        $edition = $edition->get($id);
        $success = false;
        if ($this->request->is('post')) {

            $this->request->data['edition_id'] = $id;
            $this->request->data['speaker_id'] = (int)$this->request->data['speaker_id'];
            $intervention = $this->Intervention->patchEntity($intervention, $this->request->data);
            if ($this->Intervention->save($intervention)) {
                $this->Flash->success(__('The intervention has been saved.'));
                $success = true;
            } else {
                $this->Flash->error(__('The intervention could not be saved. Please, try again.'));
            }
        }

        $speaker = $this->Intervention->Speaker->find('all', array('fields' => array('Speaker.id', 'Speaker.nom')));

        $list = array();

        foreach($speaker as $row) {
            $id = $row['id'];
            $name = $row['nom'];
            $list[$id] = $name;
        }

        $this->set(compact('intervention', 'edition', 'list', 'speaker', 'success'));
        $this->set('_serialize', ['intervention']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Intervention id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $intervention = $this->Intervention->get($id, [
            'contain' => []
        ]);

        $edition = TableRegistry::get('Edition');
        $edition = $edition->get($intervention->edition_id);

        $speaker = $this->Intervention->Speaker->find('all', array('fields' => array('Speaker.id', 'Speaker.nom')));

        $list = array();

        foreach($speaker as $row) {
            $id = $row['id'];
            $name = $row['nom'];
            $list[$id] = $name;
        }

        $success = false;

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['edition_id'] = $intervention->edition_id;
            $this->request->data['speaker_id'] = (int)$this->request->data['speaker_id'];

            $intervention = $this->Intervention->patchEntity($intervention, $this->request->data);
            if ($this->Intervention->save($intervention)) {
                $this->Flash->success(__('The intervention has been saved.'));
                $success = true;
            } else {
                $this->Flash->error(__('The intervention could not be saved. Please, try again.'));
            }
        }


        $this->set(compact('intervention', 'edition', 'speaker', 'list', 'success'));
        $this->set('_serialize', ['intervention']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Intervention id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $intervention = $this->Intervention->get($id);

        $edition = $intervention->edition_id;

        if ($this->Intervention->delete($intervention)) {
            $this->Flash->success(__('The intervention has been deleted.'));
        } else {
            $this->Flash->error(__('The intervention could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index', $edition]);
    }
}
