<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
----------------Класс News наследует класс My_controller из файла MY_Controller в папке core
*/
class News extends MY_Controller
{
/*
---------Метод для вывода данных в JSON формате
*/

    protected function headerq()
    {
        $this->output->set_header('Access-Control-Allow-Origin: http://localhost:8080');
        $this->output->set_header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE');
        $this->output->set_header('Access-Control-Allow-Headers: *');
    }

    protected function inJSON($arr)
    {
        $this->headerq();
        $str = $this->output->set_content_type('application/json')->set_output(json_encode($arr, JSON_UNESCAPED_UNICODE));
    }
/*
--------Метод для вывода всех новостей в формате JSON
*/
    public function Index()
    {
        $data['news'] = $this->news_model->get_news();
        $this->inJSON($data['news']);
    }
/*
--------Метод для вывода определенной новости в формате JSON
*/
    public function View($id)
    {
        $data['new'] = $this->news_model->get_new($id);
        $this->inJSON($data['new']);
    }
/*
--------Метод для обновления определенной новости в формате JSON
*/
    public function Update($id)
    {
        $obj = (object) array(
            'text' => 'Выборы пройдут 28.09'
        );
        $this->news_model->update_new($id, $obj);
    }
/*
--------Метод для удаленя определенной новости в формате JSON
*/
    public function Delete($id)
    {
        $this->headerq();
        $this->news_model->delete_new($id);
        return true;
        }
    
/*
--------Метод для создания новости в формате JSON
*/
    public function Create()
    {
        $this->headerq();

        $json_str = file_get_contents('php://input');

        $json_obj = json_decode($json_str);

        if ($json_obj != NULL){

        $this->news_model->create_new($json_obj);
        return var_dump($json_obj);
        }
    }

}
