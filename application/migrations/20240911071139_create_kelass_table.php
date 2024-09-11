<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_kelass_table extends CI_Migration
{
    protected $tableName  = 'kelass';

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'nama_kelas' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'null'              => FALSE
            ],
            'wali_kelas' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'null'              => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP");
        $this->dbforge->add_field("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");

        // If you want to add a foriegn key.
        // role_id must be a column of this table, please add it above in the table. And make sure admin_roles table is added before this table. 
        // $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (role_id) REFERENCES admin_roles(id) ON DELETE RESTRICT ON UPDATE CASCADE');

        $this->dbforge->create_table($this->tableName);

        //Inserting first row
        // $this->db->insert($this->tableName, [
        //     'username'   => 'murad_ali',
        //     'phone'      => '123-123-7834',
        //     'password'   => password_hash('123456', PASSWORD_BCRYPT),
        // ]);
        
        //Inserting two rows
        $data = [
            [
                'nama_kelas' => '1A',
                'wali_kelas' => 'Budi'
            ],
            [
                'nama_kelas' => '1B',
                'wali_kelas' => 'Ani'
            ]
        ];

        $this->db->insert_batch($this->tableName, $data);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->tableName);
    }
}


/* End of file 20240911071139_create_kelass_table.php and path \application\migrations\20240911071139_create_kelass_table.php */
