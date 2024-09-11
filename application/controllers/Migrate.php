<?php

class Migrate extends CI_Controller
{
    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->version(20240911072412) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migration completed!";
        }
    }
}
