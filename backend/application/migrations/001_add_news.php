<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_news extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE,
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'text' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'timeCreate' => array(
                                'type' => 'DATETIME'

                        ),
                        'image' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '2048',
                        ),
                        'id_user' => array(
                                'type' => 'INT',
                                'constraint' => 5
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('newsTab');
        }

        public function down()
        {
                $this->dbforge->drop_table('newsTab');
        }
}