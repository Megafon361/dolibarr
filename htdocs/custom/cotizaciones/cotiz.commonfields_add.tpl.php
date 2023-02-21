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
#print '<div class="ui inverted grey segment">';
print '<div class="ui red segment">';

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
		
		case 'fk_soc':
			###ABRO primer BLUE
			#print'<div class="ui inverted blue segment">';
			print'<div class="ui segment">';
			#GRID 1
		  print' <div class="ui three grid">';
							  
			//print'<div class="ui  segment">';
			#Row 1
			print '<div class="row">';
			break;
		case 'gastos':
			###ABRO primer BLUE
			#print'<div class="ui segment">';
			#print'<div class="ui inverted blue segment">';
			#GRID 1
			
							#Imprimo o checkbox 
							print '     
							<div class="ui segment"> 	
								<div class="ui form">
									<div class="ui radio checkbox">
										<input type="radio" name="frequency" onchange="sumar();" id="check1" checked="checked">
										<label>con IVA</label>
									</div>
									<div class="ui radio checkbox">
										<input type="radio" id="check2" onchange="sumar();" name="frequency">
										<label>Sin IVA</label>
									</div>	
									<div class="ui radio checkbox">
										<input type="radio" id="check3" onchange="sumar();" name="frequency">
										<label>Contado</label>
									</div>						
								</div>	
							</div>';
							  #####FIJATE ESTA
							  print' <div class="ui three grid">';
							  
			//print'<div class="ui  segment">';
			#Row 1
			print '<div class="row">';
			break;
		case 'label':
		case 'description':
		#case 'subtotal':
		case 'total':
			#Row 2 
			#print '<div class="row">';
			break;
		#tabla
		case 'C0Ro':
			print'<div class="ui inverted violet segment">';
			#print'<div class="ui segment">';
			#print'<table class="ui celled collapsing single line table" style="width:800px;height:300px;overflow-x: scroll;">';
			print'<table class="ui celled single line table" >';
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
		
			#print '<tbody><tr><td class="collapsing"  label="'.$val["label"].'">';
			print '<tbody><tr><td label="'.$val["label"].'">';
			break;
		case 'C1Ro':
		case 'C2Ro':
		case 'C3Ro':
		case 'C4Ro':
		case 'C5Ro':
		case 'C6Ro':
		case 'C7Ro':
		case 'C8Ro':
		case 'C9Ro':

			#echo '<tr><td class="collapsing" label="'.$val["label"].'">';
			echo '<tr><td label="'.$val["label"].'">';
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

		case 'C5Pr':
		case 'C6Pr':
		case 'C7Pr':
		case 'C8Pr':
		case 'C9Pr':

		case 'C5Ca':
		case 'C6Ca':
		case 'C7Ca':
		case 'C8Ca':
		case 'C9Ca':

		case 'C5Ro':
		case 'C6Ro':
		case 'C7Ro':
		case 'C8Ro':
		case 'C9Ro':
		
		case 'C5As':
		case 'C6As':
		case 'C7As':
		case 'C8As':
		case 'C9As':
		case 'C5Pa':
		case 'C6Pa':
		case 'C7Pa':
		case 'C8Pa':
		case 'C9Pa':


			#echo '<td class="collapsing" label="'.$val["label"].'">';
			echo '<td label="'.$val["label"].'">';
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
		case 'C5Pr':
		case 'C6Pr':
		case 'C7Pr':
		case 'C8Pr':
		case 'C9Pr':
		case 'C5Ca':
		case 'C6Ca':
		case 'C7Ca':
		case 'C8Ca':
		case 'C9Ca':
		case 'C5Ro':
		case 'C6Ro':
		case 'C7Ro':
		case 'C8Ro':
		case 'C9Ro':
		case 'C5As':
		case 'C6As':
		case 'C7As':
		case 'C8As':
		case 'C9As':
		case 'C5Pa':
		case 'C6Pa':
		case 'C7Pa':
		case 'C8Pa':
		case 'C9Pa':


		break;
		default:
			#ORANGE/Yellow
			//print'<div class="ui inverted orange segment">';		
			//print ''
			echo str_repeat('&nbsp;', 2);
			#ABRO COLUMNA
			#print '<div class="column">';

			#agrego separador 1
			echo str_repeat('&nbsp;', 2);
			print '   <div class="separador">';

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

			#cierro separador 1
			print '</div>';
			#agrego separador 2
			print '<div class="separador">';

			if (!empty($val['help'])) {
				print $form->textwithpicto($langs->trans($val['label']), $langs->trans($val['help']));
			} else {
				print $langs->trans($val['label']);
			}
			#ACA NO CIERRA EL AMARILLO O SI?  
			//print '</div>';
			//     print '<!-- Cierra Amarillo -->';

			echo str_repeat('&nbsp;', 2);
			
			break;
	}


	$tipo=' onkeyup="sumar();" tipo="'.$val['label'].'" ';      
	//$tipo='';


	//print '<div class="valuefieldcreate">';
	// 	if (!empty($val['picto'])) {
	//print img_picto('', $val['picto'], '', false, 0, 0, '', 'pictofixedwidth');
	//} 
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
			
			
			if ($key == 'C0As') {
				
				 // array
				
			}
			print $object->showInputField($val, $key, $value, $tipo, '', '', 0);
			
			if ($key == 'C0As') {

				//var_dump($val); //array(6) { ["type"]=> string(112) "integer:Societe:societe/class/societe.class.php:1:status=1 AND fournisseur=1 AND entity IN (__SHARED_ENTITIES__)" ["label"]=> string(4) "Asi0" ["enabled"]=> string(1) "1" ["position"]=> int(116) ["notnull"]=> int(0) ["visible"]=> int(3) }
				//var_dump($key); //string(4) "C0As"
				//var_dump($value); //String 0
				//var_dump($tipo); //string(32) " onkeyup="sumar();" tipo="Asi0" " 
				//''
				//''
				//0
			}

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
		case 'C5Pr':
		case 'C6Pr':
		case 'C7Pr':
		case 'C8Pr':
		case 'C9Pr':
		case 'C5Ca':
		case 'C6Ca':
		case 'C7Ca':
		case 'C8Ca':
		case 'C9Ca':
		case 'C5Ro':
		case 'C6Ro':
		case 'C7Ro':
		case 'C8Ro':
		case 'C9Ro':
		case 'C5As':
		case 'C6As':
		case 'C7As':
		case 'C8As':
		case 'C9As':
		case 'C5Pa':
		case 'C6Pa':
		case 'C7Pa':
		case 'C8Pa':
		case 'C9Pa':
		

			break;		
		default:
			
		
			print '<!-- Cierra Amarillo -->';
			print '</div>';
			#cierro columna
			#print '</div>';


			#cierro separador 2
			print '</div>'; 
			break;
	}
	

	//CERRAR AZUL
	switch ($key) {
		case 'entrega':
		case 'megafon':
		case 'iva':
			#Cierra row 1
			#print '</div>';
			break;
	    case 'fk_project':
			#Cierra row 2
			print '</div>';
			break;
		case 'total':

			#cierro Row
			print '</div>';
			#cierro blue
			#print '</div>';
			#cierra Grid
			print '</div>';
			break;
		case 'note_private':
			
			print '<!-- Cierra Row 3 --></div>';
			#print '</div>';
			#cierra Grid
			print '<!-- Cierra GRID --></div>';
			#Cierra BLUE 1
			#print '</div>';

		
			break;
		
		case 'C0Pa':
		case 'C1Pa':
		case 'C2Pa':
		case 'C3Pa':
		case 'C4Pa':
		case 'C5Pa':
		case 'C6Pa':
		case 'C7Pa':
		case 'C8Pa':
		
			print'</td></tr>';
			break;
		case 'C9Pa':
			print'</td> </tr>
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th><span>Sub: $</span><output class="subtotal2" max-width: 5px; id="subtotal2"></output></th>
					<th></th>
					<th></th>
					<th>Pago</th>
				</tr>
			</tfoot>
		  	</table>
			  </div>
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
		case 'C5PAs':
		case 'C6PAs':
		case 'C7PAs':
		case 'C8PAs':
		case 'C9PAs':

		case 'C5PAs':
		case 'C6PAs':
		case 'C7PAs':
		case 'C8PAs':
		case 'C9PAs':
		case 'C5PAs':
		case 'C6PAs':
		case 'C7PAs':
		case 'C8PAs':
		case 'C9PAs':
		case 'C5PAs':
		case 'C6PAs':
		case 'C7PAs':
		case 'C8PAs':
		case 'C9PAs':
		case 'C5PAs':
		case 'C6PAs':
		case 'C7PAs':
		case 'C8PAs':
		case 'C9PAs':
		case 'C5PAs':
		case 'C6PAs':
		case 'C7PAs':
		case 'C8PAs':
		case 'C9PAs':

						
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

