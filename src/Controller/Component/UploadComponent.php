<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\Utility\Text;
use Cake\ORM\Entity;


/**
 * Upload component
 */
class UploadComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function send($data, $old_data = null)
    {
        if (!empty($data)) {
                $filename = $data['name'];
                $file_tmp_name = $data['tmp_name'];
                $dir_root = WWW_ROOT.'img'.DS.'uploads';
                $dir = 'uploads';
                $allowed = array('png', 'jpg', 'jpeg');

                if (!in_array(substr(strrchr( $filename , '.') , 1 ) , $allowed) ) {
                    return false;
                }elseif( is_uploaded_file( $file_tmp_name ) ){

                    if($old_data != null){
                        $old_file = substr(strrchr($old_data, DS), 1);
                        if(file_exists($dir_root.DS.$old_file)){
                            unlink($dir_root.DS.$old_file);
                        }
                    }
                    $file = Text::uuid().'-'.$filename; // enregistrement du nom du fichier
                    $file_root = $dir_root.DS.$file; // definition du chemin ou sera stocker le fichier
                    move_uploaded_file($file_tmp_name, $file_root); // deplacement du fichier
                    $filedb = $dir.DS.$file; // definition du chemin qui sera utilise dans la base de donnee
                    return $filedb;

                }
        }
    }
}
