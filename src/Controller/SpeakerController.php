<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Speaker Controller
 *
 * @property \App\Model\Table\SpeakerTable $Speaker
 */
class SpeakerController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Upload');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('speaker', $this->paginate($this->Speaker));
        $this->set('_serialize', ['speaker']);
    }

    /**
     * View method
     *
     * @param string|null $id Speaker id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $speaker = $this->Speaker->get($id, [
            'contain' => ['Intervention']
        ]);
        $this->set('speaker', $speaker);
        $this->set('_serialize', ['speaker']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $speaker = $this->Speaker->newEntity();
        $success = false;

        if ($this->request->is('post')) {
            $sended = $this->Upload->send($this->request->data['avatar']);
            $this->request->data['avatar'] = '';
            if($sended) {
                $this->request->data['avatar'] = $sended;
            }
            $speaker = $this->Speaker->patchEntity($speaker, $this->request->data);
            if ($this->Speaker->save($speaker)) {
                $this->Flash->success('l\'enregistrement a ete effectue avec succes');
                $success = true;
            } else {
                if(!$sended) {
                    $this->Flash->error("PNG et JPG sont les formats de fichier accepte");
                }else {

                    $this->Flash->error("Certains Informations n'ont pas ete fournies");
                }
            }
        }
        $this->set(compact('speaker','success', 'url_upload'));
        $this->set('_serialize', ['speaker']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Speaker id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $speaker = $this->Speaker->get($id, [
            'contain' => []
        ]);
        $success = false;
        if ($this->request->is(['patch', 'post', 'put'])) {

            if(!empty($this->request->data['avatar']['tmp_name'])) {
                $sended = $this->Upload->send($this->request->data['avatar'], $this->request->data['photo']);
                $this->request->data['avatar'] = '';
                if($sended) {
                    $this->request->data['avatar'] = $sended;
                }
            }else{
                $this->request->data['avatar'] = $this->request->data['photo'];
                $sended = true;
            }

            $speaker = $this->Speaker->patchEntity($speaker, $this->request->data);
            if ($this->Speaker->save($speaker)) {
                $this->Flash->success('l\'enregistrement a ete effectue avec succes');
                $success = true;
            } else {
                if(!$sended) {
                    $this->Flash->error("PNG et JPG sont les formats de fichier accepte");
                }else {
                    $this->Flash->error("Certains Informations n'ont pas ete fournies");
                }
            }

        }
        $this->set(compact('speaker', 'success','sended'));
        $this->set('_serialize', ['speaker']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Speaker id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $speaker = $this->Speaker->get($id);
        if ($this->Speaker->delete($speaker)) {
            $this->Flash->success(__('The speaker has been deleted.'));
        } else {
            $this->Flash->error(__('The speaker could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function test(){
        $customers['id'] = '123';
        $this->set('customers', $customers);
        $this->set('_serialize', ['customers']);
    }
}
