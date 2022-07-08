<?php
/* Copyright (C) 2017  Laurent Destailleur  <eldy@users.sourceforge.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * Need to have following variables defined:
 * $object (invoice, order, ...)
 * $action
 * $conf
 * $langs
 * $form
 */

// Protection to avoid direct call of template
if (empty($conf) || !is_object($conf)) {
	print "Error, template page can't be called as URL";
	exit;
}

?>
<!-- BEGIN PHP TEMPLATE commonfields_add.tpl.php -->
<?php

$object->fields = dol_sort_array($object->fields, 'position');
print '<div class="ui red inverted segment">';

foreach ($object->fields as $key => $val) {
	// Discard if extrafield is a hidden field on form
	if (abs($val['visible']) != 1 && abs($val['visible']) != 3) {
		continue;
	}

	if (array_key_exists('enabled', $val) && isset($val['enabled']) && !verifCond($val['enabled'])) {
		continue; // We don't want this field
	}
		//------------------------------------------------




/* 	Usuario		
	fk_soc		
	trabajo		
	fk_project	
	description	
	note_public	
	entrega		
	label		
	note_private
	gastos		
	megafon		
	subtotal	
	iva	 */		

     
   //  var_dump($key);
    switch ($key) {
		case 'Usuario':
		case 'gastos':
			print'<div class="ui blue inverted segment"><div class="ui four column grid"><div class="row">';
			break;
			case 'C0Ro':
			print'<div class="ui blue inverted segment"><table class="ui celled collapsing table">
			<thead>
			  <tr>
			  <th>Rol</th>
			  <th>Precio</th>
			  <th>Cant</th>
			  <th>Asign</th>
			  <th>Pago</th>
			</tr></thead>
			<tbody><tr><td data-label="'.$val['label'];
			echo '">';
			break;
			case 'C1Ro':
			case 'C2Ro':
			case 'C3Ro':
			case 'C4Ro':
				echo '<tr><td data-label="'.$val["label"].'">';
				break;
					case 'C0Pr':
					case 'C0Ca':
					case 'C0Pa':
					case 'C1Ro':
					case 'C1Pr':
					case 'C1Ca':
					case 'C1Pa':
					case 'C2Ro':
					case 'C2Pr':
					case 'C2Ca':
					case 'C2Pa':
					case 'C3Ro':
					case 'C3Pr':
					case 'C3Ca':
					case 'C3Pa':
					case 'C4Ro':
					case 'C4Pr':
					case 'C4Ca':
					case 'C4Pa':
					case 'C0As':
					case 'C1As':
					case 'C2As':
					case 'C3As':
					case 'C4As':
						echo '<td data-label="'.$val["label"].'" class="chorizo">';
						break;



			case 'status':
				print'';
        break;
        
        default:
            # code...
            break;
    }



   



	switch ($key) {

					case 'C0Ro':
					case 'C0Pr':
					case 'C0Ca':
					case 'C0Pa':
					case 'C1Ro':
					case 'C1Pr':
					case 'C1Ca':
					case 'C1Pa':
					case 'C2Ro':
					case 'C2Pr':
					case 'C2Ca':
					case 'C2Pa':
					case 'C3Ro':
					case 'C3Pr':
					case 'C3Ca':
					case 'C3Pa':
					case 'C4Ro':
					case 'C4Pr':
					case 'C4Ca':
					case 'C4Pa':
					case 'C0As':
					case 'C1As':
					case 'C2As':
					case 'C3As':
					case 'C4As':
					break;
					default:
					print'<div class="ui yellow inverted segment">';
					print '<div';
					print ' class="ui input';
					if (isset($val['notnull']) && $val['notnull'] > 0) {
						print ' fieldrequired';
					}
					if ($val['type'] == 'text' || $val['type'] == 'html') {
						print ' tdtop';
					}
					print '"';
					print '>';
					if (!empty($val['help'])) {
						print $form->textwithpicto($langs->trans($val['label']), $langs->trans($val['help']));
					} else {
						print $langs->trans($val['label']);
					}
					print '</div>';
					echo str_repeat('&nbsp;', 5);
				
					break;
			}


	






	//print '<div class="valuefieldcreate">';
	if (!empty($val['picto'])) {
		print img_picto('', $val['picto'], '', false, 0, 0, '', 'pictofixedwidth');
	}
	if (in_array($val['type'], array('int', 'integer'))) {
		$value = GETPOST($key, 'int');
	} elseif ($val['type'] == 'double') {
		$value = price2num(GETPOST($key, 'alphanohtml'));
	} elseif ($val['type'] == 'text' || $val['type'] == 'html') {
		$value = GETPOST($key, 'restricthtml');
	} elseif ($val['type'] == 'date') {
		$value = dol_mktime(12, 0, 0, GETPOST($key.'month', 'int'), GETPOST($key.'day', 'int'), GETPOST($key.'year', 'int'));
	} elseif ($val['type'] == 'datetime') {
		$value = dol_mktime(GETPOST($key.'hour', 'int'), GETPOST($key.'min', 'int'), 0, GETPOST($key.'month', 'int'), GETPOST($key.'day', 'int'), GETPOST($key.'year', 'int'));
	} elseif ($val['type'] == 'boolean') {
		$value = (GETPOST($key) == 'on' ? 1 : 0);
	} elseif ($val['type'] == 'price') {
		$value = price2num(GETPOST($key));
	} elseif ($key == 'lang') {
		$value = GETPOST($key, 'aZ09');
	} else {
		$value = GETPOST($key, 'alphanohtml');
	}
	if (!empty($val['noteditable'])) {
		print $object->showOutputField($val, $key, $value, '', '', '', 0);
	} else {
		if ($key == 'lang') {
			print img_picto('', 'language', 'class="pictofixedwidth"');
			print $formadmin->select_language($value, $key, 0, null, 1, 0, 0, 'minwidth300', 2);
		} else {
			print $object->showInputField($val, $key, $value, '', '', '', 0);
		}
	}


	switch ($key) {
		case 'C0Ro':
		case 'C0Pr':
		case 'C0Ca':
		case 'C0Pa':
		case 'C1Ro':
		case 'C1Pr':
		case 'C1Ca':
		case 'C1Pa':
		case 'C2Ro':
		case 'C2Pr':
		case 'C2Ca':
		case 'C2Pa':
		case 'C3Ro':
		case 'C3Pr':
		case 'C3Ca':
		case 'C3Pa':
		case 'C4Ro':
		case 'C4Pr':
		case 'C4Ca':
		case 'C4Pa':
		case 'C0As':
		case 'C1As':
		case 'C2As':
		case 'C3As':
		case 'C4As':
			echo '';
			break;

	//print '</div>';
    //Cerrar amarillo

		default:
		print '</div>';
			break;
	}
	

	//CERRAR AZUL
	switch ($key) {
        case 'label':
		case 'total':
		case 'status':
			print '</div></div></div>';
		break;
		case 'C0Pa':
		case 'C1Pa':
		case 'C2Pa':
		case 'C3Pa':
			print'</td></tr>';
			break;
		case 'C4Pa':
			print'</td> </tr>
			</tbody>
		  </table>';
			break;

			case 'C0Pr':
				case 'C0Ca':
				case 'C0Pa':
				case 'C1Ro':
				case 'C1Pr':
				case 'C1Ca':
				case 'C1Pa':
				case 'C2Ro':
				case 'C2Pr':
				case 'C2Ca':
				case 'C2Pa':
				case 'C3Ro':
				case 'C3Pr':
				case 'C3Ca':
				case 'C3Pa':
				case 'C4Ro':
				case 'C4Pr':
				case 'C4Ca':
				case 'C4Pa':
				case 'C0As':
				case 'C1As':
				case 'C2As':
				case 'C3As':
				case 'C4As':
				echo '</td>';
				break;
		default:
			# code...
			break;
	}
	
	
			

	
	
	
	//------------------------------------------------------
	



	
}
print '</div>'; //CERRAR ROJO
?>
<!-- END PHP TEMPLATE commonfields_add.tpl.php -->




