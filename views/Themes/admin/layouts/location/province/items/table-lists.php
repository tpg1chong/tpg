<?php

$tr = "";
if( !empty($this->results['items']) ){ 

    $seq = 0;
    foreach ($this->results['items'] as $i => $item) { 

        $cls = $i%2 ? 'even' : "odd";


        $option = '';
        foreach ($this->countryList as $key => $value) {
        	$seter = $value['id']==$item['id'] ? ' selected': '';
        	$option.='<option'.$seter.' value="'.$value['id'].'">'.$value['name'].'</option>';
        }
        $option = '<select class="inputtext" name="">'.$option.'</select>';
        
        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'">'.

            '<td class="name">'. $item['name']. '</td>'.

            '<td class="status">'. $option  .'</td>'.

            '<td class="check"><label class="checkbox"><input id="toggle_checkbox"'. (!empty($item['enabled'])?' checked':'') .' type="checkbox" value="'.$item['id'].'"></label></td>'.

            '<td class="actions">'.
            	'<span class="gbtn"><a class="btn" title="Edit"><i class="icon-pencil"></i></a></span>'.
            	'<span class="gbtn"><a class="btn" title="Remove"><i class="icon-trash"></i></a></span>'.
            '</td>'.
              
        '</tr>';
        
    }
}

$table = '<table class="settings-table"><tbody>'. $tr. '</tbody></table>';