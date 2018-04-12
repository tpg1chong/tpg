<?php

# Photo
require_once 'Room_Photo.php';

class Room extends Model
{
	public function __construct() {
		parent::__construct();

        # Photo
        $this->photo = new Room_Photo();
    }


    private $_table = 'property';
    private $_field = '*';
    private $_prefixField = 'property_';


    public function get($id)
    {
        $sth = $this->db->prepare("SELECT {$this->_field} FROM {$this->_table} WHERE {$this->_prefixField}id=:id LIMIT 1");
        $sth->execute( array( ':id' => $id  ) );
        return $sth->rowCount()==1 ? $this->convert( $sth->fetch( PDO::FETCH_ASSOC ) ): array();
    }
    public function findById($id)
    {
        return $this->get($id);
    }
    public function findByBuildingId($id)
    {
        return $this->find( array('building'=>$id) ); 
    }
    public function find($options=array())
    {
        foreach (array('enabled') as $key) {
            if( isset($_REQUEST[$key]) ){
                $options[$key] = $_REQUEST[$key];
            }
        }

    	$options = array_merge(array(
            'more' => true,

            'sort' => isset($_REQUEST['sort'])? $_REQUEST['sort']: 'name',
            'dir' => isset($_REQUEST['dir'])? $_REQUEST['dir']: 'ASC',

            'time'=> isset($_REQUEST['time'])? $_REQUEST['time']:time(),

        ), $options);

        $condition = "";
        $params = array();


        if( isset($options['enabled']) ){
            $condition .= !empty($condition) ? ' AND ':'';
            $condition .= "enabled=:enabled";
            $params[':enabled'] = $options['enabled'];
        }

        if( isset($options['building']) ){
            $condition .= !empty($condition) ? ' AND ':'';
            $condition .= "{$this->_prefixField}building_id=:building";
            $params[':building'] = $options['building'];
        }

        if( isset($options['category']) ){
            $condition .= !empty($condition) ? ' AND ':'';
            $condition .= "{$this->_prefixField}category_id=:category";
            $params[':category'] = $options['category'];
        }


        $arr['total'] = $this->db->count($this->_table, $condition, $params);
        $limit = !empty($options['limit']) && !empty($options['pager']) ? $this->limited( $options['limit'], $options['pager'] ):'';
        $orderby = $this->orderby( $this->_prefixField.$options['sort'], $options['dir'] );
        $where = !empty($condition) ? "WHERE {$condition}":'';
        $sql = "SELECT {$this->_field} FROM {$this->_table} {$where} {$orderby} {$limit}";


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

        $data = $this->__cutPrefixField($this->_prefixField, $data);
        $data['permit']['del'] = 1;

        $data['offers'] = json_decode($data['offers'], 1);
        $data['group_price'] = json_decode($data['group_price'], 1);
        $data['size'] = json_decode($data['size'], 1);
        $data['capacity'] = json_decode($data['capacity'], 1);

        $data['images'] = $this->photo->findByAlbumId( $data['id'] );

        return $data;
    }

	public function insert(&$data)
	{
        $data["{$this->_prefixField}created"] = date('c');
		$data["{$this->_prefixField}updated"] = date('c');

		$this->db->insert($this->_table, $data);
        $data['id'] = $this->db->lastInsertId();
	}

	public function update($id, $data)
	{
        $data["{$this->_prefixField}updated"] = date('c');
		$this->db->update($this->_table, $data, "{$this->_prefixField}id={$id}");
	}

    public function delete($id)
    {
        $this->db->delete( $this->_table, "{$this->_prefixField}id={$id}" );
    }


}