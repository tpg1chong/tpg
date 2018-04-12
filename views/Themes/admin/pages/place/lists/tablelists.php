<?php

$tr = "";
$tr_total = "";
if( !empty($this->results['lists']) ){ 

    $seq = 0;
    foreach ($this->results['lists'] as $i => $item) { 

        $cls = $i%2 ? 'even' : "odd";
        // set Name

        $image = '';
        if( !empty($item['images'][0]['src']) ){

            $image = '<a target="_blank" href="'.URL.'admin/place/'.$item['id'].'" class="pic lfloat mrm" style="width: 168px;height: 94px;background-color: #b7b7b7;overflow: hidden;"><img src="'.$item['images'][0]['src'].'" style="max-width:100%;" /></a>';
        }
        else{
            $image = '<div class="pic lfloat mrm" style="width: 168px;height: 94px;background-color: #b7b7b7;"></div>';
        }
        
        $item['update_date_str'] = date('j/m/Y H:i', strtotime($item['update_date']));

        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'">'.

            '<td class="check-box"><label class="checkbox"><input id="toggle_checkbox" type="checkbox" value="'.$item['id'].'"></label></td>'.

            '<td class="name">'. 

                $image.
                '<div>'.
                    '<div class="fcg fsm">'.$item['type_name'].'</div>'.
                    '<div class="fwb"><a target="_blank" href="'.URL.'admin/place/'.$item['id'].'">'.$item['name'].'</a></div>'.
                    '<div class="fcg fsm mts"><i class="icon-map-marker mrs"></i>'. $item['location_str'] .'</div>'.
                    // '<div class="fcg fsm mts">'. $this->fn->q('text')->more( $item['description'] ).'</div>'.
                    '<div class="fcg fsm mts"><a class="t-hover fcb" data-plugins="lightbox" href="'.URL.'place/invite_partner?id='.$item['id'].'"><i class="icon-user-circle-o mrs"></i>Partner: <span class="t-hover-text">'. (!empty($item['partner_name']) ? $item['partner_name']: '-').'</span><i class="icon-pencil t-hover-icon"></i></a></div>'.
                '</div>'.

            '</td>'.

            // '<td class="status">'. (!empty( $item['partner'] ) ? $item['partner']: '-') .'</td>'.
            
            '<td class="status">'. (!empty( $item['email'] ) ? $item['email']: '-') .'</td>'.
            '<td class="status">'. (!empty( $item['phone'] ) ? $item['phone']: '-') .'</td>'.

            '<td class="status"><label class="checkbox"><input id="check-box" data-action="check-box" type="checkbox"'. (!empty( $item['enabled'] ) ? ' checked': '') .' name="enabled"></label></td>'.
            '<td class="date">'. $item['update_date_str'] .'</td>'.

            '<td class="actions"><div class="whitespace">'.

                '<span class="gbtn"><a class="btn" title="Edit" target="_blank" href="'.URL.'/admin/place/'. $item['id'].'"><i class="icon-pencil"></i></a></span>'.
                '<span class="gbtn"><a class="btn" title="Remove" data-plugins="lightbox" href="'.$this->pageURL.'del/'.$item['id'].'"><i class="icon-trash"></i></a></span>'.


            '</div></td>'.

        '</tr>';
        
    }
}

$table = '<table><tbody>'. $tr. '</tbody>'.$tr_total.'</table>';