<?php

$tr = "";
$tr_total = "";
if( !empty($this->results['lists']) ){ 

    $seq = 0;
    foreach ($this->results['lists'] as $i => $item) { 

        $cls = $i%2 ? 'even' : "odd";
        // set Name

        $image = '';
        


        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'">'.

            '<td class="check-box"><label class="checkbox"><input id="toggle_checkbox" type="checkbox" value="'.$item['id'].'"></label></td>'.

            '<td class="name">'. 

                '<div class="anchor clearfix"><div class="avatar lfloat no-avatar mrm"><div class="initials"><i class="icon-user"></i></div></div><div class="content"><div class="spacer"></div><div class="massages">'.
                        
                        '<strong class="fullname">'.$item['name'].'</strong>'.
                        '<div class="username">@<b>'.$item['username'].'</b></div>'.

                    // '<div class="subname"></div>'.

                    '</div></div></div>'.

            '</td>'.

            '<td class="email">'. (!empty( $item['email'] ) ? $item['email']: '-') .'</td>'.
            '<td class="phone">'. (!empty( $item['phone'] ) ? $item['phone']: '-') .'</td>'.

            '<td class="status"><label class="checkbox"><input data-action="checked" name="partner_enabled" type="checkbox"'.(!empty($item['enabled'] ) ? ' checked':'' ).'></label></td>'.
            
            '<td class="status">'. (!empty($item['lastvisit']) ? date('j/m/Y H:s', strtotime($item['lastvisit'])): '-').'</td>'.

            '<td class="actions"><div class="whitespace">'.

                '<span class="gbtn"><a class="btn" title="Change password" data-plugins="lightbox" href="'.$this->pageURL.'change_password/'.$item['id'].'"><i class="icon-lock"></i></a></span>'.
                '<span class="gbtn"><a class="btn" title="Edit" data-plugins="lightbox" href="'.$this->pageURL.'edit/'.$item['id'].'"><i class="icon-pencil"></i></a></span>'.
                '<span class="gbtn"><a class="btn" title="Remove" data-plugins="lightbox" href="'.$this->pageURL.'del/'.$item['id'].'"><i class="icon-trash"></i></a></span>'.
            '</div></td>'.

        '</tr>';
    }
}

$table = '<table><tbody>'. $tr. '</tbody>'.$tr_total.'</table>';