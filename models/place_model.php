<?php

require_once 'Place/Photo.php';


class Place_Model extends Model{

    public function __construct() {
        parent::__construct();

        $this->photo = new Photo();
    }

    private $__objType = "property_building";
    private $__table = "

        property_building AS building 
            LEFT JOIN property_type AS type ON building.building_type=type.type_id

            LEFT JOIN location_country AS country ON building.location_country=country.country_id
            LEFT JOIN location_province AS province ON building.location_province=province.province_id
            LEFT JOIN location_zone AS zone ON building.location_zone=zone.zone_id
            LEFT JOIN location_district AS district ON building.location_district=district.district_id
            
            LEFT JOIN partner ON building.building_partner_id=partner.partner_id

    ";
    private $__field = "*";
    private $__prefixField = "building_";

    /* -- actions -- */
    public function insert(&$data) {

        $data["{$this->__prefixField}create_date"] = date('c');
        $data["{$this->__prefixField}update_date"] = date('c');

        $this->db->insert($this->__objType, $data);
        $data['id'] = $this->db->lastInsertId();

        $data = $this->__cutPrefixField($this->__prefixField, $data);
    }
    public function update($id, $data) {
        $data["{$this->__prefixField}update_date"] = date('c');
        $this->db->update($this->__objType, $data, "{$this->__prefixField}id={$id}");
    }
    public function delete($id) {
        $this->db->delete($this->__objType, "{$this->__prefixField}id={$id}");
    }


    /* -- find -- */
    public function findById($id){
        $sth = $this->db->prepare("SELECT {$this->__field} FROM {$this->__table} WHERE {$this->__prefixField}id=:id LIMIT 1");
        $sth->execute( array( ':id' => $id  ) );
        return $sth->rowCount()==1 ? $this->convert( $sth->fetch( PDO::FETCH_ASSOC ) ): array();
    }
    public function find( $options=array() ) {

        foreach (array('enabled', 'type', 'q') as $key) {
            if( isset($_REQUEST[$key]) ){
                $options[$key] = $_REQUEST[$key];
            }
        }

        

        $options = array_merge(array(
            'pager' => isset($_REQUEST['pager'])? $_REQUEST['pager']:1,
            'limit' => isset($_REQUEST['limit'])? $_REQUEST['limit']:50,
            'more' => true,

            'sort' => isset($_REQUEST['sort'])? $_REQUEST['sort']: 'update_date',
            'dir' => isset($_REQUEST['dir'])? $_REQUEST['dir']: 'DESC',

            'time'=> isset($_REQUEST['time'])? $_REQUEST['time']:time(),

        ), $options);

        $date = date('Y-m-d H:i:s', $options['time']);

        $condition = "";
        $params = array();

        if( !empty($options['type']) ){
            $condition .= "building_type=:type";
            $params[':type'] = $options['type'];
        }

        if( !empty($options['q']) ){

            $arrQ = explode(' ', $options['q']);
            $wq = '';
            foreach ($arrQ as $key => $value) {
                $wq .= !empty( $wq ) ? " OR ":'';
                $wq .= "building_name LIKE :q{$key} OR building_name=:f{$key}";
                $params[":q{$key}"] = "%{$value}%";
                $params[":f{$key}"] = $value;
            }

            if( !empty($wq) ){
                $condition .= !empty( $condition ) ? " AND ":'';
                $condition .= "($wq)";
            }
        }

        $arr['total'] = $this->db->count($this->__table, $condition, $params);

        $limit = !empty($options['unlimit']) ? '': $this->limited( $options['limit'], $options['pager'] );
        $orderby = $this->orderby( $this->__prefixField.$options['sort'], $options['dir'] );
        $where = !empty($condition) ? "WHERE {$condition}":'';
        $sql = "SELECT {$this->__field} FROM {$this->__table} {$where} {$orderby} {$limit}";

        $arr['lists'] = $this->buildFrag( $this->db->select($sql, $params ), $options );

        if( ($options['pager']*$options['limit']) >= $arr['total'] ) $options['more'] = false;
        $arr['options'] = $options;

        return $arr;
    }


    /* -- convert data -- */
    public function buildFrag($results, $options=array()) {
        $data = array();
        foreach ($results as $key => $value) {
            if( empty($value) ) continue;
            $data[] = $this->convert( $value );
        }

        return $data;
    }
    public function convert($data){

        $data = $this->__cutPrefixField($this->__prefixField, $data);

        $data['images'] = $this->photo->findByAlbumId( $data['id'] );
        $data['permit']['del'] = 1;


        
        $data['location_str'] = '';
        if( !empty($data['location_number']) ){
            $data['location_str'] .= !empty($data['location_str']) ? ' ':'';
            $data['location_str'] .= $data['location_number'];
        }

        if( !empty($data['location_soi']) ){
            $data['location_str'] .= !empty($data['location_str']) ? ' ':'';
            $data['location_str'] .= 'ซอย'.$data['location_soi'];
        }

        if( !empty($data['location_road']) ){
            $data['location_str'] .= !empty($data['location_str']) ? ' ':'';
            $data['location_str'] .= 'ถนน'.$data['location_road'];
        }

        $data['location_str'] .= !empty($data['location_str']) ? ', ':'';
        $data['location_str'] .= trim($data['district_name']) .', '. trim($data['zone_name']) .', '. trim($data['province_name']) .', '. trim($data['country_name']);

        return $data;
    }

}
