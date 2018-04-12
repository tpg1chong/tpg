<?php

$tr = "";
$tr_total = "";
if( !empty($this->results['items']) ){ 

    $seq = 0;
    foreach ($this->results['items'] as $i => $item) { 

        $cls = $i%2 ? 'even' : "odd";
        
        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'">'.

            '<td class="name">'. $item['name']. '</td>'.
            '<td class="check"><label class="checkbox"><input id="toggle_checkbox"'. (!empty($item['enabled'])?' checked':'') .' type="checkbox" value="'.$item['id'].'"></label></td>'.

            '<td class="actions">'.
            	'<span class="gbtn"><a class="btn" title="Edit"><i class="icon-pencil"></i></a></span>'.
            	'<span class="gbtn"><a class="btn" title="Remove"><i class="icon-trash"></i></a></span>'.
            '</td>'.
              
        '</tr>';
        
    }
}

$table = '<table class="settings-table"><tbody>'. $tr. '</tbody>'.$tr_total.'</table>';