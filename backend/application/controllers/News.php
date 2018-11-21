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
    protected function inJSON($arr)
    {
       
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
        $this->news_model->delete_new($id);
        return true;
    }
/*
--------Метод для создания новости в формате JSON
*/
    public function Create()
    {
        $obj = (object) array('title'=>'Новость о выборах' , 'text'=>'Выбор пройдут 24.09');
        $this->news_model->create_new($obj);
        return true;
    }

}
