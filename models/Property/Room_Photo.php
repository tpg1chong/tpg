<?php

class Room_Photo extends Model
{
	public function __construct() {
		parent::__construct();

		$this->__source = WWW_UPLOADS.'rooms/';
		$this->__path = UPLOADS.'rooms/';
    }

    private $__objType = "property_images";
    private $__table = "property_images";
    private $__field = "*";
    private $__prefixField = "photo_";

    public function set(&$options)
    {
    	
    	$media = array(
            'photo_album_id' => $options['album_id'],
            'photo_name' => $options['name'],
            'photo_caption' => $options['caption'],
            'photo_sequence' => $options['sequence'],
            'photo_type' => 'jpg',
        );

        if( !empty($options['id']) ){
            $media['id'] = $options['id'];
            $this->update( $media['id'], $media );
        }
        else{
            // media
            $this->insert( $media );
        }

        // 75/23 ซอยสุขุมวิท ถนนสุขุมวิท, คลองตัน, สุขุมวิท, กรุงเทพ, ประเทศไทย

        if( !empty($media['id']) ){


       		$extension = strtolower(strrchr($options['name'], '.'));
       		$name = $this->setName( $options['album_id'], $media['id'] );

        	
        	$dest = $this->__source.$name.$extension;

        	if( copy($options['tmp_name'], $dest) ){

        		if($this->getType($options['name'])!='jpg') {

        			$destNew = $this->__source.$name.".jpg";
                	$this->convertImage( $dest, $dest_new );

                	if( !file_exists($destNew) ){
	                    $arr['error'] = 'ไม่สามารถใช้รูปนี้ได้';
	                    $this->del( $media_id );          
	                }

	                unlink($dest);
                	$dest = $destNew;
        		}


        		// Minimize Size
        		if( !empty($options['minimize']) ){
        			$this->minimize( $dest, $options['minimize'] );   
        		}
        	}
        	else{

        		$options['error'] = 'Copy file error!';
        		$this->del( $media['id'] );
        	}
        }
        else{
        	$options['error'] = 'Error data!';
        }
    }


    // action on base
    public function findByAlbumId($id)
    {
    	return $this->buildFrag( $this->db->select("SELECT {$this->__field} FROM {$this->__table} WHERE photo_album_id={$id} ORDER BY photo_sequence ASC") );
    }
    public function findById($id)
    {
    	$sth = $this->db->prepare("SELECT {$this->__field} FROM {$this->__table} WHERE {$this->__prefixField}id=:id LIMIT 1");
        $sth->execute( array( ':id' => $id  ) );
        return $sth->rowCount()==1 ? $this->convert( $sth->fetch( PDO::FETCH_ASSOC ) ): array();
    }
    public function insert(&$data)
    {
    	$this->db->insert( $this->__objType, $data );
    	$data['id'] = $this->db->lastInsertId();
    }
    public function update($id, $data)
    {
    	$this->db->update($this->__objType, $data, "`{$this->__prefixField}id`={$id}");
    }
    public function del($id)
    {
    	$this->db->delete($this->__objType, "`{$this->__prefixField}id`={$id}");
    }

    public function delete($id, $data=array())
    {
    	if( empty($data) ){
    		$data = $this->findById($id);
    	}

    	if( !empty($data['album_id']) && !empty($data['id']) ){
    		$name = $this->setName( $data['album_id'], $data['id'] );

    		if( file_exists($this->__source.$name.'.jpg') ){
    			unlink($this->__path.$name.'.jpg');
    		}
    	}

    	$this->del( $id );
    }


    /* -- convert data -- */
    public function buildFrag($results, $options=array()) {
        $data = array();
        foreach ($results as $key => $value) { if( empty($value) ) continue; $data[] = $this->convert( $value ); }
        return $data;
    }
    public function convert($data){

        $data = $this->__cutPrefixField($this->__prefixField, $data);
        $data['src'] = $this->__path. $this->setName( $data['album_id'], $data['id'] ).'.jpg';

        return $data;
    }
    public function setName($aid, $mid)
    {
    	$aid =  Hash::create('md5', $aid, 'album');
    	$mid =  Hash::create('md5', $mid, 'media');
    	return "{$aid}_{$mid}";
    }


    // Support
    public function convertImage($original, $output, $quality=100) {

        if( !file_exists($original) ) return false;

        $tmp = $this->import( $original );
        if( $tmp ){
            imagejpeg($tmp, $output, $quality);
            imagedestroy($tmp);
        }
    }
    public function import($path) {

        switch( $this->getType($path) ){
            case 'bmp': return imagecreatefromwbmp($path); break;
            case 'gif': return imagecreatefromgif($path); break;
            case 'jpg': case 'jpeg': return @imagecreatefromjpeg($path); break;
            case 'png': return @imagecreatefrompng($path); break;
            default:
                throw new Exception('Invalid image: '.$path);
            break;
        }
    }
    public function getType($filename) {
        return strtolower(substr(strrchr($filename,"."),1));
    }
    public function minimize($path, $max_size=array(950, 950), $options=array())
    {
    	$options = array_merge(array('quality'=>100, 'filter'=>0), $options);
        list($width, $height) = getimagesize($path);

        if( $width > $height && $width > $max_size[0] ){
            $desired[0] = $max_size[0];
            $desired[1] = round( ( $max_size[0]*$height ) / $width );
        }
        else if($height > $max_size[1]){
            $desired[1] = $max_size[1];
            $desired[0] = round( ( $max_size[1]*$width ) / $height );
        }

        if( !empty($desired) ){
            $imageTmp = $this->import( $path );
            $new_img = imagecreatetruecolor($desired[0], $desired[1]);
            imagealphablending( $new_img, false );
            imagesavealpha( $new_img, true );
            @imagecopyresampled($new_img, $imageTmp, 0, 0, 0, 0, $desired[0], $desired[1], $width, $height);

            switch( $this->getType($path) ){
                case 'bmp': imagewbmp($new_img, $path); break;
                case 'gif': imagegif($new_img, $path); break;
                case 'jpg':  case 'jpeg': imagejpeg($new_img, $path, $options['quality']); break;
                case 'png': imagepng($new_img, $path, $options['filter']); break;
            }
        }
    }
}