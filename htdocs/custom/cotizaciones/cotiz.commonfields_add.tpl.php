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

include 'myStuff/js/sumador.js.php';

$object->fields = dol_sort_array($object->fields, 'position');

#----------------->RED  
print '<div class="ui inverted red segment">';

$boton = 0;


foreach ($object->fields as $key => $val) {
	// Discard if extrafield is a hidden field on form
	if (abs($val['visible']) != 1 && abs($val['visible']) != 3) {
		continue;
	}

	if (array_key_exists('enabled', $val) && isset($val['enabled']) && !verifCond($val['enabled'])) {
		continue; // We don't want this field
	}
	//------------------------------------------------
    # OPEN BLUE
	switch ($key) {
		//case 'Usuario':
		case 'fk_soc':
			###ABRO primer green 
			print'<div class="ui inverted teal segment">';
			print' <div class="ui grid">';
			//print'<div class="ui  segment">';
			print '<div class="row">';
			break;
		case 'descripcion':
			#cierro tree column
			print '</div></div>';
			break;

		case 'gastos':
			//case 'status':
				print '</div>';
				###ABRO segundo Green
				//print' <div class="ui three column grid ">';
				print'<div class="ui inverted blue segment ">';
			//print'<div class="ui  segment">';
			
			//<div class="row">';
			break;
		#tabla
		case 'C0Ro':
			print'<div class="ui inverted violet segment">';
			//print '<div class="table-responsive">';
			//print '<code>overflow: hidden;</code>';
			//print'<div class="ui inverted violet segment">';
			print'<table class="ui celled collapsing single line table" >';
			//print '<table class="table table-hover table-bordered">';
			//print'<table class="ui celled single line table" >';
			print '
			<thead>
				<tr>
			  		<th>Rol</th>
			  		<th>Precio</th>
			  		<th>Cant</th>
			  		<th>Asign</th>
			  		<th>Pago</th>
			  	</tr>
			</thead>';
		
			print '<tbody><tr><td class="collapsing"  label="'.$val["label"].'">';
			#print '<tbody><tr><td label="'.$val["label"].'">';
			break;
		case 'C1Ro':
		case 'C2Ro':
		case 'C3Ro':
		case 'C4Ro':
			echo '<tr><td class="collapsing" label="'.$val["label"].'">';
			#echo '<tr><td label="'.$val["label"].'">';
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
			echo '<td class="collapsing" label="'.$val["label"].'">';
			#echo '<td label="'.$val["label"].'">';
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
			//yellow
			//print'<div class="ui yellow segment">';
			print'<div class="ui inverted orange segment">';
			/* 
			
			if ($boton==0) {
				print'<div class="ui inverted olive segment">';
				$boton = 1;
			}else {
				print'<div class="ui inverted yellow segment">';
				$boton=0;
			}
			 */
		
			print '<div'; 
			
			
			
			print ' class="ui small icon input';
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
			//     print '<!-- Cierra Amarillo -->';
			//echo str_repeat('&nbsp;', 5);
		
			break;
	}


	$tipo=' onkeyup="sumar();" tipo="'.$val['label'].'" ';      


	//print '<div class="valuefieldcreate">';
	/* 	if (!empty($val['picto'])) {
	print img_picto('', $val['picto'], '', false, 0, 0, '', 'pictofixedwidth');
	} */
	if (in_array($val['type'], array('int', 'integer'))) {
		$value = GETPOST($key, 'int');
	} elseif ($val['type'] == 'double') {
		$value = price2num(GETPOST($key, 'alphanohtml'));
	} elseif ($val['type'] == 'text' || $val['type'] == 'html') {
		$value = GETPOST($key, 'restricthtml');
		echo $value;
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
			print $formadmin->select_language($value, $key, 0, null, 1, 0, 0, 'minwidth50', 2);
		} else {
		
			print $object->showInputField($val, $key, $value, $tipo, '', '', 0);
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
		//print '<!-- Cierra Amarillo -->';			
		default:
			print '</div>';
			print '<!-- Cierra Amarillo -->';
			break;
	}
	

	//CERRAR AZUL
	switch ($key) {
	    case 'label':
		//case 'total':
		case 'status':
			print '</div>'; 
			break;
		case 'total':
			#Cierro segundo azul 
			print ' </div>';
			print '     
			<div class="ui inverted pink segment"> 	
				<div class="ui form">
					<div class="inline fields">					
						<label>?</label>
						<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" name="frequency" onchange="sumar();" id="check1" checked="checked">
								<label>con IVA</label>
							</div>
						</div>
						<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" id="check2" onchange="sumar();" name="frequency">
								<label>Sin IVA</label>
							</div>
						</div>
						<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" id="check3" onchange="sumar();" name="frequency">
								<label>Contado</label>
							</div>
						</div>
					</div>
				</div>	
		  	</div>';
		  	#####FIJATE ESTA
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
			<tfoot>
				<tr>
					<th></th>
					<th><span>Subotal: $</span><input class="subtotal2" id="subtotal2"></input></th>
					<th></th>
					<th></th>
					<th>Pago</th>
				</tr>
			</tfoot>
		  	</table>
			</div>
			</div>
			</div>';
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
	
}
#----------------->RED  
print '</div>'; //CERRAR ROJO
?>
<!-- cerrar rojo END PHP TEMPLATE commonfields_add.tpl.php -->

