<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Edition Controller
 *
 * @property \App\Model\Table\EditionTable $Edition
 */
class EditionController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $edition = $this->Edition->find('all')->orderDesc('date');

        $this->set('edition', $this->paginate($edition));
        $this->set('_serialize', ['edition']);
    }

    /**
     * View method
     *
     * @param string|null $id Edition id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edition = $this->Edition->get($id, [
            'contain' => []
        ]);
        $this->set('edition', $edition);
        $this->set('_serialize', ['edition']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $edition = $this->Edition->newEntity();
        $success = false;
        $last_date = '';
        if ($this->request->is('post')) {
            if (isset($this->request->data['date'])) {
                $last_date = $this->request->data['date'];
                list($jour, $mois, $annee ) = sscanf($this->request->data['date'], "%d/%d/%d");
                $strconvert =  strtotime($annee .'-'. $mois .'-'. $jour .'');
                $data['date'] = date("Y-m-d", $strconvert);
                $this->request->data['date'] = \DateTime::createFromFormat("Y-m-d", $data['date']) ;
            }
            $edition = $this->Edition->patchEntity($edition, $this->request->data);
            if ($this->Edition->save($edition)) {
                $this->Flash->success('l\'enregistrement a ete effectue avec succes');
                $success = true;
            } else {
                $this->Flash->error("Probleme lors de l'enregistrement. Essayez encore");
            }
        }
        $this->set(compact('edition', 'last_date', 'success'));
        $this->set('_serialize', ['edition']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Edition id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $edition = $this->Edition->get($id, [
            'contain' => []
        ]);

        $success = false;
        list($jour, $mois, $annee ) = sscanf($edition->date, "%d/%d/%d");
        $strconvert =  strtotime($jour .'/'. $mois .'/'. $annee .'');
        $last_date = date("d/m/Y", $strconvert);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->data['date'])) {
                $last_date = $this->request->data['date'];
                list($jour, $mois, $annee ) = sscanf($this->request->data['date'], "%d/%d/%d");
                $strconvert =  strtotime($annee .'-'. $mois .'-'. $jour .'');
                $data['date'] = date("Y-m-d", $strconvert);
                $this->request->data['date'] = \DateTime::createFromFormat("Y-m-d", $data['date']) ;
            }
            $edition = $this->Edition->patchEntity($edition, $this->request->data);
            if ($this->Edition->save($edition)) {
                $this->Flash->success('l\'enregistrement a ete effectue avec succes');
                $success = true;
            } else {
                $this->Flash->error("Probleme lors de l'enregistrement. Essayez encore");
            }
        }
        $this->set(compact('edition', 'last_date', 'success'));
        $this->set('_serialize', ['edition']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Edition id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $edition = $this->Edition->get($id);
        if ($this->Edition->delete($edition)) {
            $this->Flash->success(__('The edition has been deleted.'));
        } else {
            $this->Flash->error(__('The edition could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
