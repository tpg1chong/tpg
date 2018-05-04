<?php

class System_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function pageNav()
    {
        $nav[] = array('id'=>'dashboard','name'=> Translate::val('Dashboard'), 'icon'=>'television','url'=>URL.'dashboard' );
        $nav[] = array('id'=>'calendar','name'=> Translate::val('Calendar'), 'icon'=>'calendar-o','url'=> 'https://calendar.google.com', 'target' => '_blank' );
        $nav[] = array('id'=>'client','name'=> Translate::val('Client'), 'icon'=>'user-circle-o','url'=>URL.'client' );
        $nav[] = array('id'=>'company','name'=> Translate::val('Company'), 'icon'=>'building-o','url'=>URL.'company' );
        $nav[] = array('id'=>'property','name'=> Translate::val('Property'), 'icon'=>'home','url'=>URL.'property' );
        // $nav[] = array('id'=>'listing','name'=> Translate::val('Listing'), 'icon'=>'file-text-o','url'=>URL.'property' );
        // $nav[] = array('id'=>'contacts','name'=> Translate::val('Contacts'), 'icon'=>'address-card-o','url'=>URL.'contacts' );
        // $nav[] = array('id'=>'reports','name'=> Translate::val('Reports'), 'icon'=>'line-chart','url'=>URL.'reports' );

        return $nav; 
    }

    /* -- Page Authorization -- */
    public function auth( $access=array() ) {

        // Settings
        $arr = array(
            // 'notifications' => array('view'=>1),
            // 'calendar' => array('view'=>1),

            'view_website' => array('view'=>1),
            'my' => array('view'=>1,'edit'=>1),
        );

        // Supper Admin
        if( in_array(1, $access) ){

            // set menu
            $arr['dashboard'] = array('view'=>1);

            // set settings
            $arr['overview'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['calendar'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);

            # setting
            $arr['seo'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['analytics'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['social'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);

            #People
            $arr['site_manager'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);

            $arr['authorization'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);

            # blog
            $arr['blog_manager'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);

            $arr['blog_category'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['blog_topic'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);


            # member
            $arr['member_manager'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['inbox'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);

            
            # property
            $arr['property_manager'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['property_type'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['property_zone'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['property_near'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['property_building'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);


            $arr['partner'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['place'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['booking'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            
            #Data Management
            $arr['import'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['export'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);


            #promotions
            $arr['promotions'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            #property


            $arr['accounts'] = array('view'=>1);
            $arr['business'] = array('view'=>1);
            
            #location
            $arr['location'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);

            # Settings
            $arr['settings'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_email'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);

            $arr['settings_property_category'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_property_type'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_property_facility'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_property_facility_type'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);

            $arr['settings_room_category'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_room_offers'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_room_offers_type'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);

            $arr['settings_location_region'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_location_country'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_location_geography'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_location_province'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_location_zone'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_location_district'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);

            $arr['settings_import'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['settings_export'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);   
        }

        /* Manage */
        if( in_array(2, $access) ){

            $arr['dashboard'] = array('view'=>1);
            $arr['employees'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);

            $arr['orders'] = array('view'=>1);
            $arr['booking'] = array('view'=>1);

            $arr['package'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['promotions'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);

            $arr['tasks'] = array('view'=>1,'edit'=>1, 'del'=>1, 'add'=>1);
            $arr['reports'] = array('view'=>1);
        }


        if( in_array(3, $access) ){
        }


        // PR
        if( in_array(4, $access) ){

            #People
            $arr['organization'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
            $arr['people'] = array('view'=>1,'edit'=>1,'del'=>1, 'add'=>1);
        }

        return $arr;
    }


    /* -- Page Default Data  -- */
    public function set($name, $value) {
        $sth = $this->db->prepare("SELECT option_name as name FROM system_info WHERE option_name=:name LIMIT 1");
        $sth->execute( array(
            ':name' => $name
        ) );

        if( $sth->rowCount()==1 ){
            $fdata = $sth->fetch( PDO::FETCH_ASSOC );

            if( !empty($value) ){
                $this->db->update('system_info', array(
                    'option_name' => $name,
                    'option_value' => $value
                ), "`option_name`='{$fdata['name']}'");
            }
            else{
                $this->db->delete('system_info', "`option_name`='{$fdata['name']}'");
            }
        }
        else{

            if( !empty($value) ){
                $this->db->insert('system_info', array(
                    'option_name' => $name,
                    'option_value' => $value
                ));
            }

        }
    }
    public function get() {
        $data = $this->db->select( "SELECT * FROM system_info" );

        $object = array();
        foreach ($data as $key => $value) {
            $object[$value['option_name']] = $value['option_value'];
        }

        if( empty($object['title']) ){
            $object['title'] = '';
        }

        return $object;
    }



    /* -- Prefix Name -- */
    public function prefixName( $options=array() ){

        $a['Mr.'] = array('id'=>'Mr.', 'name'=> Translate::Val('Mr.') );
        $a['Mrs.'] = array('id'=>'Mrs.', 'name'=> Translate::Val('Mrs.') );
        $a['Ms.'] = array('id'=>'Ms.', 'name'=> Translate::Val('Ms.') );

        return array_merge($a, $options);
    }
    public function getPrefixName($name) {

       $prefix = $this->prefixName();
       foreach ($prefix as $key => $value) {
            if( $value['id'] == $name ){
                $name = $value['name'];
                break;
            }
       }
       return $name;
    }
}
