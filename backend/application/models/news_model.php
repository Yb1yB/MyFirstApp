<?php

class News_model extends CI_Model 
{

        private $DB_NAME = 'news';

    public function __construct()
    {
/*
----------------Загрузка БД на основе данных файла database------------
*/
        $this->load->database();

    }
/*
-----------Выгрузка из БД всех новостей
*/
public function get_news()
{       
        $DB_NAME = 'news';
        $query = $this->db->get($this->DB_NAME);
        return $query->result_array();
}
/*
-----------Выгрузка из БД определенной новости
*/
public function get_new($id)
{
        $query = $this->db->get_where($this->DB_NAME, array('id' => $id));
        return $query->result_array();
}
/*
-----------Удаление из БД определенной новости
*/
public function delete_new($id)
{
        $this->db->delete($this->DB_NAME, array('id' => $id));
        return true;
}

public function update_new($id, $obj)
{
        $this->db->where('id', $id);
        $this->db->update($this->DB_NAME, $obj);
}

public function create_new($obj)
{
        $this->db->insert($this->DB_NAME, $obj);
        return true;
}
}
