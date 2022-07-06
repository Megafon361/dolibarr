<?php
/* Copyright (C) 2017  Laurent Destailleur  <eldy@users.sourceforge.net>
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

?> <!-- BEGIN PHP TEMPLATE Cotiz.commonfields_add.tpl.php --> <?php

$object->fields = dol_sort_array($object->fields, 'position');
echo '<div class="ui red segment">';

foreach ($object->fields as $key => $val) {
	// Discard if extrafield is a hidden field on form
	if (abs($val['visible']) != 1 && abs($val['visible']) != 3) {
		continue;
	}

	if (array_key_exists('enabled', $val) && isset($val['enabled']) && !verifCond($val['enabled'])) {
		continue; // We don't want this field
	}
	








	?><!-- BEGIN to put hands in --><?php


	
	switch ($key) {
		case 'label':
				echo '<div class="ui blue segment"><div class="column">';
				break;

		case 'fk_soc':
		case 'fk_project':
		case 'description':
		case 'entrega':
		case 'trabajo':
					echo '</div><div class="column">';
					break;
				case 'C0Ro':
				echo '</div></div><div class="ui green segment"><table class="ui celled table"><thead>				<tr><th>Rol</th>
				<th>Precio</th>
				<th>Cant</th>
				<th>Asignado</th>
				<th>Pago</th>
			  	</tr></thead>
			  	<tbody>';
				break;
	}

	switch ($key) {
		case 'C1Ro':
	
			echo '<div class="ui green segment"><table class="ui celled table"><thead>				<tr><th>Rol</th>
			<th>Precio</th>
			<th>Cant</th>
			<th>Asignado</th>
			<th>Pago</th>
			  </tr></thead>
			  <tbody>';
				break;
		case 'C2Ro':
				echo '</table></div><div class="ui green segment"><table>';
				break;
		case 'C3Ro':
				echo '</table></div><div class="ui green segment"><table>';
				break;
		case 'C4Ro':
				echo '</table></div><div class="ui green segment"><table>';
				break;
		case 'C5Ro':
				echo '</table></div><div class="ui green segment"><table>';
				break;
	
		case 'status':
				echo '</table></div><div class="ui green segment"><table>';
				break;
	
		case 'C3Pa':
				echo '';
				break;
	
			}
print '<table>';

switch ($key) {
				case 'label':
				case 'fk_soc':
				case 'fk_project':
				case 'description':
				case 'entrega':
				case 'trabajo':
				case 'iva':
				case 'subtotal':
				case 'gastos':
				case 'megafon':
				case 'total':
				case 'Usuario':
				case 'status':

					echo '</div>';
					print '<div class="column">';	
					print '<div class="field_'.$key.'">';
					print '<div ';
					print ' class="titlefieldcreate';
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

		
		
					break;
	
					default:
					# code...
					break;
	}


	





	print '<div class="column">';
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

		print '<div class="column">';





	}

	switch ($key) {
		case 'label':
		case 'fk_soc':
		case 'fk_project':
		case 'description':
		case 'entrega':
		case 'trabajo':
		case 'iva':
		case 'subtotal':
		case 'gastos':
		case 'megafon':
		case 'total':
		case 'Usuario':
		case 'status':
		//	print '</div>';
			break;
		}


	//print '</table>';
//	print '</div>';
//	print '</div>';


	



	switch ($key) {
		case 'status':
			echo '</div>';
			break;
			}



}
print '</div>';
?>
<!-- END PHP TEMPLATE commonfields_add.tpl.php -->
