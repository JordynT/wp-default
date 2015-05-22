<?php

class sc_custom_columns {

    function __construct(){
        add_filter('manage_users_columns', array(__CLASS__,'test_modify_user_table'));
        add_filter('manage_users_custom_column', array(__CLASS__,'test_modify_user_table_row'), 10, 3);
    }

    /**
     * Created the custom column
     */
    static function test_modify_user_table($column) {
        $column['registered-date'] = 'Registered Date';

        return $column;
    }

    /**
     * Grabs the data to dynamically fill in the custom column
     */
     static function test_modify_user_table_row($val, $column_name, $user_id) {
        get_currentuserinfo();
        $user_data = get_userdata($user_id);
        $registered_date = $user_data->user_registered;
        $date = strtotime($registered_date);

        switch ($column_name) {
            case 'registered-date' :
                return date('Y-m-d', $date);
                break;

            default:
        }

        return $return;
    }

}
$custom_columns = new sc_custom_columns();