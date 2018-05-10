<?php

/* -- import --*/

# Places
require_once 'Property/category.php';
require_once 'Property/type.php';
require_once 'Property/facilities.php';
require_once 'Property/payment.php';
require_once 'Property/transportation.php';

require_once 'Property/facilities.php';
require_once 'Property/Facility_Types.php';

# Room
require_once 'Property/amenities.php';

require_once 'Property/Room.php';
require_once 'Property/Room_Category.php';
require_once 'Property/Room_Types.php';
require_once 'Property/Room_Offer_Types.php';
require_once 'Property/Room_Offers.php';

# Photo
require_once 'Property/Room_Photo.php';


require_once 'Property/Listing.php';
require_once 'Property/Owner.php';
require_once 'Property/Contact.php';
require_once 'Property/Building.php';

class Property_Model extends Model{

    public function __construct() {
        parent::__construct();

        # Places
        $this->category = new category();
        $this->type = new type();
        $this->facilities = new facilities();

        $this->facility = new facilities();
        $this->facility_types = new Facility_Types();
        
        $this->payment_options = new payment();
        $this->transportation = new transportation();
        

        # Room
        $this->amenities = new amenities();


        $this->room = new Room();
        $this->room_category = new Room_Category();
        $this->room_type = new Room_Types();
        $this->room_offer_types = new Room_Offer_Types();
        $this->room_offers = new Room_Offers();

        # Photo
        $this->photo = new Room_Photo();


        $this->listing = new Property_Listing();


        $this->building = new Property_Building();
        $this->owner = new Property_Owner();
        $this->contact = new Property_Contact();
    }


    


    private $_table = "
        property

            LEFT JOIN building ON property.idbuilding=building.idbuilding 
            
            LEFT JOIN owner ON owner.idowner=property.idowner

            LEFT JOIN (
                property_contacts_permit pp_contacs INNER JOIN contacts ON contacts.contact_id=pp_contacs.contact_id
            ) ON pp_contacs.property_id=property.idproperty
    " ;


    // LEFT JOIN owner ON property.idowner=owner.idowner
    private $_field = "
          property.idproperty as id
        
        , building.idbuilding as building_id
        , building.name as building_name
        , building.phone as building_phone
        , building.facilities as building_facilities

        , owner.idowner as owner_id
    ";
    private $_prefixField = '';

    public function find($options=array())
    {
        
        $options = array_merge(array(
            'more' => true,

            'pager' => isset($_REQUEST['pager'])? $_REQUEST['pager']:1,
            'limit' => isset($_REQUEST['limit'])? $_REQUEST['limit']:12,

            'sort' => isset($_REQUEST['sort'])? $_REQUEST['sort']: 'property.updatedate',
            'dir' => isset($_REQUEST['dir'])? $_REQUEST['dir']: 'DESC',

            'time'=> isset($_REQUEST['time'])? $_REQUEST['time']:time(),

        ), $options);

        $condition = "";
        $params = array();

        if( isset($options['enabled']) ){
            $condition = "type_enabled=:enabled";
            $params[':enabled'] = $options['enabled'];
        }

        $arr['total'] = 0;
        // $arr['total'] = $this->db->count($this->_table, $condition, $params);


        $today = date('Y-m-d');
        $previous_week = date('Y-m-d', strtotime("-1 week +1 day"));

        $av1month = date('Y-m-d', strtotime("+30 day"));
        $av2month = date('Y-m-d', strtotime("+60 day"));
        $av3month = date('Y-m-d', strtotime("+90 day"));


        $limit = !empty($options['limit']) && !empty($options['pager']) ? $this->limited( $options['limit'], $options['pager'] ):'';
        $orderby = $this->orderby( $this->_prefixField.$options['sort'], $options['dir'] );
        $where = !empty($condition) ? "WHERE {$condition}":'';
        $sql = "
            SELECT
              building.idbuilding as building_id
            , building.name as building_name
            , building.phone as building_phone
            , building.facilities as building_facilities


            , type.idtype as type_id
            , type.name as type_name

            , zone.idzone as zone_id
            , zone.name as zone_name

            , property.idproperty as property_id
            , property.notavailable as available_date
            , property.code
            , property.price as property_price

            , property.propertyfor as property_for

            , property.createdate as property_created
            , property.updatedate as property_updated
            , property.checkdate as property_lastCall
            
            , property.bedroom as property_bedroom
            , property.bathroom as property_bathroom
            

            , property.livingarea as property_livingarea
            , property.liveable_area_us_embassy as property_liveable_for_embassy
            , property.landarea as property_landarea
            , property.landarea_sqw as property_landarea_for_sqw
            -- , property.comment as property_comment
            -- , property.name as property_name


            , ( CASE 
                WHEN DATE(property.notavailable) <= DATE('{$previous_week}') THEN 2 
                WHEN DATE(property.notavailable) <= DATE('{$today}') THEN 1 
                WHEN DATE(property.notavailable) >= DATE('{$av1month}') THEN 3
                WHEN DATE(property.notavailable) >= DATE('{$av3month}') THEN 4
                ELSE 5 
            END) AS state

            , owner.idowner as owner_id
            , owner.name as owner_name
            , owner.phone as owner_phone
            , owner.mobile as owner_mobile
            , owner.email as owner_email
            , owner.social_line as owner_socialLine

        FROM 

            property

                LEFT JOIN ( building 
                    LEFT JOIN type ON type.idtype=building.idtype
                    LEFT JOIN zone ON zone.idzone=building.idzone
                ) ON property.idbuilding=building.idbuilding 
                
                LEFT JOIN owner ON owner.idowner=property.idowner

                LEFT JOIN (
                    property_contacts_permit pp_contacs INNER JOIN contacts ON contacts.contact_id=pp_contacs.contact_id
                ) ON pp_contacs.property_id=property.idproperty



        {$where} GROUP BY property.idproperty {$orderby} {$limit}";
        // $arr['sql'] = $sql;

        $arr['items'] = $this->buildFrag( $this->db->select($sql, $params), $options );


        if( !empty($options['limit']) ){
            if( ($options['pager']*$options['limit']) >= $arr['total'] ) $options['more'] = false;
        }
        else{
            $options['more'] = false;
        }

        $arr['options'] = $options;
        return $arr;
    }


    /* -- convert data -- */
    public function buildFrag($results, $options=array()) {
        $data = array();
        foreach ($results as $key => $value) { if( empty($value) ) continue; $data[] = $this->convert( $value ); }
        return $data;
    }
    public function convert($data){

        // $data['name'] = trim($data['name']);

        $data['property_created_str'] = date('j/m/Y H:i', strtotime($data['property_created']));
        $data['property_updated_str'] = date('j/m/Y H:i', strtotime($data['property_updated']));
        $data['property_lastcall_str'] = date('j/m/Y H:i', strtotime($data['property_lastCall']));
        $data['property_available_str'] = date('j/m/Y', strtotime($data['available_date']));


        $data['property_bedroom_str'] =  "{$data['property_bedroom']} Bed / {$data['property_bathroom']} Bath";
        $data['property_livingarea_str'] = number_format( round($data['property_livingarea'],2) );
        $data['property_landarea_str'] =  round($data['property_landarea'],2);

        $data['property_for'] =  json_decode($data['property_for'], 1);

        $facilities = explode(',', $data['building_facilities']);

        return $data;
    }
}
