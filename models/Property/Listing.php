<?php

class Property_Listing extends Model
{
	public function __construct() {
		parent::__construct();

        # Photo
        $this->photo = new Room_Photo();
    }


    private $_table = "listing LEFT JOIN users ON listing.idusercreate=users.iduser";
    private $_field = "

          listing.idlisting as id
        , listing.name


        , listing.createdate
        , users.username

    ";
    private $_prefixField = '';


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

            'pager' => isset($_REQUEST['pager'])? $_REQUEST['pager']:1,
            'limit' => isset($_REQUEST['limit'])? $_REQUEST['limit']:50,

            'sort' => isset($_REQUEST['sort'])? $_REQUEST['sort']: 'idlisting',
            'dir' => isset($_REQUEST['dir'])? $_REQUEST['dir']: 'DESC',

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

        $data['code'] = sprintf("%05d",$data['id']);
        $data['created_str'] = $this->fn->q('time')->stamp( $data['createdate'] );
        $data['user_name'] = ucfirst( $data['username'] );

        return $data;
    }


    /* -- actions -- */
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