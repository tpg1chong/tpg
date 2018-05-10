<?php

class Property_Owner extends Model
{
	public function __construct() {
		parent::__construct();
    }

    private $_table = "owner";
    private $_field = "idowner, name, mobile, phone";
    private $_prefixField = '';


    public function findById($id)
    {
        $sth = $this->db->prepare("SELECT {$this->_field} FROM {$this->_table} WHERE {$this->_prefixField}id=:id LIMIT 1");
        $sth->execute( array( ':id' => $id  ) );
        return $sth->rowCount()==1 ? $this->convert( $sth->fetch( PDO::FETCH_ASSOC ) ): array();
    }
    public function find($options=array())
    {
        foreach (array('enabled', 'q') as $key) {
            if( isset($_REQUEST[$key]) ){
                $options[$key] = trim($_REQUEST[$key]);
            }
        }

    	$options = array_merge(array(
            'more' => true,

            'pager' => isset($_REQUEST['pager'])? $_REQUEST['pager']:1,
            'limit' => isset($_REQUEST['limit'])? $_REQUEST['limit']:50,

            'sort' => isset($_REQUEST['sort'])? $_REQUEST['sort']: 'idowner',
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

        if( !empty($options['q']) ){
            $condition .= !empty($condition) ? ' AND ':'';
            $condition .= "(owner.name LIKE '%{$options['q']}' OR owner.phone=:qPhone OR owner.phone=:qPhone1 OR owner.mobile=:qPhone OR owner.mobile=:qPhone1)";

            $params[':qPhone'] = $options['q'];
            $params[':qPhone1'] = trim( str_replace('-', '', $options['q']) );
            
            // $condition .= "(owner.idowner=:id OR owner.name LIKE '%{$options['q']}')";
            // $params[':id'] = intval($options['q']);


            // $params[':q'] = $options['q'];
            // $condition .= "{$this->_prefixField}name LIKE '%{$options['q']}%'";
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
        foreach ($results as $key => $value) { if( empty($value) ) continue; $data[] = $this->convert( $value, $options ); }
        return $data;
    }
    public function convert($data, $options=array()){

        // $data = $this->__cutPrefixField($this->_prefixField, $data);

        $view_stype = !empty($options['view_stype']) ? $options['view_stype']: 'convert';
        if( !in_array($view_stype, array('bucketed' )) ) $view_stype = 'convert';
        return $view_stype=='convert'? $data: $this->{$view_stype}( $data );
    }
    public function bucketed($data , $options=array()) {

        $category = '';

        if( !empty($data['mobile']) ){
            $category = $data['mobile'];
        }

        return array(
            'id'=> $data['idowner'],
            'text'=> $data['name'],
            'subtext' => '',
            "category"=> $category,

            'theme' => 'people',
        );;
    }


    /* -- actions -- */
	/*public function insert(&$data)
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
    }*/

}