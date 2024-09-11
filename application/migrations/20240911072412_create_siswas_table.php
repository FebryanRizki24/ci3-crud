<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_siswas_table extends CI_Migration
{
    protected $tableName  = 'siswas';

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100'
            ],
            'nip' => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
                'unique'            => TRUE
            ],
            'jenis_kelamin' => [
                'type'              => 'ENUM',
                'constraint'        => ['Pria', 'Wanita'],
            ],
            'alamat' => [
                'type'              => 'TEXT',
                'null'              => TRUE
            ],
            'tanggal_lahir' => [
                'type'              => 'DATE',
                'null'              => TRUE
            ],
            'id_kelas' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => TRUE,
                'null'              => FALSE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP");
        $this->dbforge->add_field("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");

        // If you want to add a foriegn key.
        // role_id must be a column of this table, please add it above in the table. And make sure admin_roles table is added before this table. 
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_kelas) REFERENCES kelass(id) ON DELETE RESTRICT ON UPDATE CASCADE');

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
                 'name'   => 'murad ali',
                 'nip'      => '123100217834',
                 'jenis_kelamin'   => 'Pria',
                 'alamat'   => 'jl arwana',
                 'tanggal_lahir' => '2002-03-03',
                 'id_kelas' => 1
             ],
             [
                 'name'   => 'junaidah',
                 'nip'      => '123100217835',
                 'jenis_kelamin'   => 'Wanita',
                 'alamat'   => 'jl macan',
                 'tanggal_lahir' => '2002-04-03',
                 'id_kelas' => 2
             ]
        ];

        $this->db->insert_batch($this->tableName, $data);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->tableName);
    }
}
/* End of file 20240911072412_create_siswas_table.php and path \application\migrations\20240911072412_create_siswas_table.php */
