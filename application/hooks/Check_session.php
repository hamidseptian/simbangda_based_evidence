<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Check_session
{
    public function __get($property)
    {
        if (!property_exists(get_instance(), $property))
        {
                show_error('property: <strong>' .$property . '</strong> not exist.');
        }
        return get_instance()->$property;
    }
    public function validate()
    {
        $result     = [];
        $module     = $this->db->query("SELECT module_name FROM v_modules_groups WHERE id_group ='{$this->session->userdata('id_group')}' AND is_active = 1");
		foreach($module->result_array() as $value):
			$result[] = $value['module_name'];
        endforeach;


        $public_modules = $this->db->query("SELECT modules from modules_public where status = '1'")->result_array();
        foreach ($public_modules as $key => $value) {
            $result[] = $value['modules'];
            # code...
        }

        // $module_integrasi = $this->db->query()-
        array_push($result,"auth","beranda");
        if(in_array($this->router->fetch_class(), $result))
        {
            return;
        }else{
            show_404();
        }
    }
}