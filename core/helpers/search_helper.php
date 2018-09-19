<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Output database date
 *
 * @access  public
 * @param   string
 * @return  string
 */ 

if (!function_exists('prepare_search_conditions')) {
    function prepare_search_conditions($fields = array(), $session_namespace) 
    {
        $CI = get_instance();
        $conditions = array();

        $current_namespace_value = $CI->session->userdata($session_namespace);

        foreach ($fields as $field) {
            $value = $CI->input->post($field);       

            if (is_array($value)) {
                $values = $value;
                foreach ($values as $key => $value) {
                    if (empty($value) && !is_numeric($value)) {
                        unset($values[$key]);
                    }
                }
                $value = $values;
            } 


            if ( $value === false || is_null($value) ) {
                if( is_array($current_namespace_value) && isset($current_namespace_value[$field]) )
                {
                    $value = $current_namespace_value[$field];
                }   
            }

            $conditions[$field] = is_null($value) ? null: $value;
        }

        $CI->session->set_userdata($session_namespace, $conditions);
        return $conditions;
    }
}




?>
