<?php

namespace App\Controllers;


use App\Models\Gallery;
use Milhas\Controller\Controller;
use Milhas\Http\Input\Input;
use Milhas\Http\Redirect\Redirect;
use Milhas\Http\Session\Flash\Flash;

class ManagerController extends Controller
{
    /**
     * @var string
     */
    private $storagePath = 'storage/images/';

    /**
     * @var bool
     */
    public $redirect = true;

    /**
     * @var bool
     */
    public $copy = false;


    /**
     * @return mixed
     */
    public function index()
    {
        $gallery = new Gallery();

        $all = $gallery->all();

        return $this->render('layout', ['manager' => true, 'photos' => $all]);
    }

    /**
     * @param $values
     */
    public function destroy($values)
    {
        $config = appMake(configPath('app.php'));
        $msg = new Flash();

        if($config['DISPLAY_MODE'] != "READ_ONLY") {
            $msg = new Flash();
            $gallery = new Gallery();

            if (count($photo = $gallery->find($values[1])) > 0) //Check find
            {
                if (deleteFile(publicPath($photo['path']))) { //Try to delete file
                    $gallery->delete($values[1]); //Delete database value
                    $msg->success('Foto apagada com sucesso!!!'); //Flash message
                } else
                    $msg->error('Oooops... Não foi possível apagar esta foto.');//Flash message
            } else
                $msg->error('Oooops... A foto que você está procurando não existe.');//Flash message

            return Redirect::to('/manager'); //Redirect
        }
        else {
            $msg->warning('Esta função não está disponível neste modo. Modo de exibição: Ativo.');//Flash message
            return Redirect::to('/manager'); //Redirect
        }
    }

    /**
     *
     */
    public function add()
    {
        $config = include_once configPath('app.php');
        $msg = new Flash();

        if($config['DISPLAY_MODE'] != "READ_ONLY") {
            $gallery = new Gallery();

            $realName = Input::file('arquivo')["name"]; //Get real name

            if ($this->checkExtension($realName)) { //Check extension
                if ($newName = $this->storeFile($realName)) { //Try to store file
                    $result = $gallery->save([
                        'name' => $realName,
                        'path' => $this->storagePath . $newName,
                        'created_at' => date('d-m-Y H:i:s')
                    ]); //Store on DB
                } else
                    $msg->error('Não foi possivel armazenar o arquivo.');//Flash message
            } else
                $msg->error('Extensão inválida!!!');//Flash message

            if ($this->redirect)
                Redirect::to('/manager');//Redirect
            else
                return true;
        }
        else {
            $msg->warning('Esta função não está disponível neste modo. Modo de exibição: Ativo.');//Flash message
            return Redirect::to('/manager'); //Redirect
        }
    }

    /**
     * @param $realName
     * @return bool
     */
    private function checkExtension($realName)
    {
        if(strstr ('.jpg;.jpeg;.gif;.png', $this->getExtension($realName)))
            return true;
        else
            return false;
    }

    /**
     * @param $fileName
     * @return mixed
     */
    public function getExtension($fileName)
    {
        return pathinfo($fileName, PATHINFO_EXTENSION); //Get extension info
    }

    /**
     * @param $realName
     * @return bool|string
     */
    private function storeFile($realName)
    {
        $tempName = Input::file('arquivo')["tmp_name"]; //Get temp name

        $extension = $this->getExtension($realName); //Ger extension info

        $newName = sha1($realName.uniqid()); //Make a hash name for this file
        $newName = $newName.'.'.$extension;


        if($this->copy == false) {
            if (@move_uploaded_file($tempName, publicPath($this->storagePath . $newName)))
                return $newName;
            else
                return false;
        }
        else {
            copy($tempName, publicPath($this->storagePath . $newName));
            return $newName;
        }
    }
}