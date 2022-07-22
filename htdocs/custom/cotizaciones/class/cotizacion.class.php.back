<?php
/* Copyright (C) 2017  Laurent Destailleur <eldy@users.sourceforge.net>
 * Copyright (C) ---Put here your own copyright and developer email---
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
 */

/**
 * \file        class/cotizacion.class.php
 * \ingroup     cotizaciones
 * \brief       This file is a CRUD class file for Cotizacion (Create/Read/Update/Delete)
 */

// Put here all includes required by your class file
require_once DOL_DOCUMENT_ROOT.'/core/class/commonobject.class.php';
//require_once DOL_DOCUMENT_ROOT . '/societe/class/societe.class.php';
//require_once DOL_DOCUMENT_ROOT . '/product/class/product.class.php';

/**
 * Class for Cotizacion
 */
class Cotizacion extends CommonObject
{
	/**
	 * @var string ID of module.
	 */
	public $module = 'cotizaciones';

	/**
	 * @var string ID to identify managed object.
	 */
	public $element = 'cotizacion';

	/**
	 * @var string Name of table without prefix where object is stored. This is also the key used for extrafields management.
	 */
	public $table_element = 'cotizaciones_cotizacion';

	/**
	 * @var int  Does this object support multicompany module ?
	 * 0=No test on entity, 1=Test with field entity, 'field@table'=Test with link by field@table
	 */
	public $ismultientitymanaged = 0;

	/**
	 * @var int  Does object support extrafields ? 0=No, 1=Yes
	 */
	public $isextrafieldmanaged = 1;

	/**
	 * @var string String with name of icon for cotizacion. Must be the part after the 'object_' into object_cotizacion.png
	 */
	public $picto = 'cotizacion@cotizaciones';

	//..."0":"Borrador","1":"Presupuestado","2":"FacturadoClientes","3":"FacturadoProv","9":"Cancelado"}
	const STATUS_DRAFT = 0;
	const STATUS_VALIDATED = 1;
	const STATUS_FacturadoClientes = 2;
	const STATUS_FacturadoProv = 3;
	const STATUS_CANCELED = 9;


	/**
	 *  'type' field format ('integer', 'integer:ObjectClass:PathToClass[:AddCreateButtonOrNot[:Filter[:Sortfield]]]', 'sellist:TableName:LabelFieldName[:KeyFieldName[:KeyFieldParent[:Filter[:Sortfield]]]]', 'varchar(x)', 'double(24,8)', 'real', 'price', 'text', 'text:none', 'html', 'date', 'datetime', 'timestamp', 'duration', 'mail', 'phone', 'url', 'password')
	 *         Note: Filter can be a string like "(t.ref:like:'SO-%') or (t.date_creation:<:'20160101') or (t.nature:is:NULL)"
	 *  'label' the translation key.
	 *  'picto' is code of a picto to show before value in forms
	 *  'enabled' is a condition when the field must be managed (Example: 1 or '$conf->global->MY_SETUP_PARAM)
	 *  'position' is the sort order of field.
	 *  'notnull' is set to 1 if not null in database. Set to -1 if we must set data to null if empty ('' or 0).
	 *  'visible' says if field is visible in list (Examples: 0=Not visible, 1=Visible on list and create/update/view forms, 2=Visible on list only, 3=Visible on create/update/view form only (not list), 4=Visible on list and update/view form only (not create). 5=Visible on list and view only (not create/not update). Using a negative value means field is not shown by default on list but can be selected for viewing)
	 *  'noteditable' says if field is not editable (1 or 0)
	 *  'default' is a default value for creation (can still be overwrote by the Setup of Default Values if field is editable in creation form). Note: If default is set to '(PROV)' and field is 'ref', the default value will be set to '(PROVid)' where id is rowid when a new record is created.
	 *  'index' if we want an index in database.
	 *  'foreignkey'=>'tablename.field' if the field is a foreign key (it is recommanded to name the field fk_...).
	 *  'searchall' is 1 if we want to search in this field when making a search from the quick search button.
	 *  'isameasure' must be set to 1 or 2 if field can be used for measure. Field type must be summable like integer or double(24,8). Use 1 in most cases, or 2 if you don't want to see the column total into list (for example for percentage)
	 *  'css' and 'cssview' and 'csslist' is the CSS style to use on field. 'css' is used in creation and update. 'cssview' is used in view mode. 'csslist' is used for columns in lists. For example: 'css'=>'minwidth300 maxwidth500 widthcentpercentminusx', 'cssview'=>'wordbreak', 'csslist'=>'tdoverflowmax200'
	 *  'help' is a 'TranslationString' to use to show a tooltip on field. You can also use 'TranslationString:keyfortooltiponlick' for a tooltip on click.
	 *  'showoncombobox' if value of the field must be visible into the label of the combobox that list record
	 *  'disabled' is 1 if we want to have the field locked by a 'disabled' attribute. In most cases, this is never set into the definition of $fields into class, but is set dynamically by some part of code.
	 *  'arrayofkeyval' to set a list of values if type is a list of predefined values. For example: array("0"=>"Draft","1"=>"Active","-1"=>"Cancel"). Note that type can be 'integer' or 'varchar'
	 *  'autofocusoncreate' to have field having the focus on a create form. Only 1 field should have this property set to 1.
	 *  'comment' is not used. You can store here any text of your choice. It is not used by application.
	 *	'validate' is 1 if need to validate with $this->validateField()
	 *  'copytoclipboard' is 1 or 2 to allow to add a picto to copy value into clipboard (1=picto after label, 2=picto after value)
	 *
	 *  Note: To have value dynamic, you can set value to 0 in definition and edit the value on the fly into the constructor.
	 */

	// BEGIN MODULEBUILDER PROPERTIES
	/**
	 * @var array  Array with all fields and their property. Do not use it as a static var. It may be modified by constructor.
	 */
	public $fields=array(
		'rowid' => array('type'=>'integer', 'label'=>'TechnicalID', 'enabled'=>'1', 'position'=>1, 'notnull'=>1, 'visible'=>0, 'noteditable'=>'1', 'index'=>1, 'css'=>'left', 'comment'=>"Id"),
		'ref' => array('type'=>'varchar(128)', 'label'=>'Ref', 'enabled'=>'1', 'position'=>2, 'notnull'=>1, 'visible'=>4, 'noteditable'=>'1', 'default'=>'(PROV)', 'index'=>1, 'searchall'=>1, 'validate'=>'1', 'comment'=>"Reference of object"),
		'Usuario' => array('type'=>'integer:User:user/class/user.class.php', 'label'=>'Usuario', 'enabled'=>'1', 'position'=>3, 'notnull'=>0, 'visible'=>4,),
		'fk_soc' => array('type'=>'integer:Societe:societe/class/societe.class.php:1:status=1 AND client=3 AND entity IN (__SHARED_ENTITIES__)', 'label'=>'ThirdParty', 'enabled'=>'1', 'position'=>5, 'notnull'=>-1, 'visible'=>1, 'index'=>1, 'css'=>'maxwidth300 widthcentpercentminusxx', 'help'=>"LinkToThirparty", 'validate'=>'1',),
		'trabajo' => array('type'=>'varchar(128)', 'label'=>'trabajo', 'enabled'=>'1', 'position'=>6, 'notnull'=>0, 'visible'=>-1,),
		'fk_project' => array('type'=>'integer:Project:projet/class/project.class.php:1', 'label'=>'Project', 'enabled'=>'1', 'position'=>7, 'notnull'=>-1, 'visible'=>-1, 'index'=>1, 'css'=>'maxwidth300 widthcentpercentminusxx', 'validate'=>'1',),
		'description' => array('type'=>'html', 'label'=>'Description', 'enabled'=>'1', 'position'=>9, 'notnull'=>0, 'visible'=>3, 'validate'=>'1',),
		'note_public' => array('type'=>'html', 'label'=>'NotePublic', 'enabled'=>'1', 'position'=>11, 'notnull'=>0, 'visible'=>1, 'cssview'=>'wordbreak', 'validate'=>'1',),
		'entrega' => array('type'=>'date', 'label'=>'entrega', 'enabled'=>'1', 'position'=>10, 'notnull'=>1, 'visible'=>1,),
		'label' => array('type'=>'varchar(255)', 'label'=>'Label', 'enabled'=>'1', 'position'=>12, 'notnull'=>0, 'visible'=>1, 'searchall'=>1, 'cssview'=>'wordbreak', 'help'=>"Help text", 'validate'=>'1',),
		'note_private' => array('type'=>'html', 'label'=>'NotePrivate', 'enabled'=>'1', 'position'=>8, 'notnull'=>0, 'visible'=>1, 'cssview'=>'wordbreak', 'validate'=>'1',),
		'gastos' => array('type'=>'price', 'label'=>'gastos', 'enabled'=>'1', 'position'=>22, 'notnull'=>0, 'visible'=>-1,),
		'megafon' => array('type'=>'price', 'label'=>'megafon', 'enabled'=>'1', 'position'=>23, 'notnull'=>0, 'visible'=>-1,),
		'subtotal' => array('type'=>'price', 'label'=>'subtotal', 'enabled'=>'1', 'position'=>24, 'notnull'=>0, 'visible'=>-1,),
		'iva' => array('type'=>'price', 'label'=>'iva', 'enabled'=>'1', 'position'=>25, 'notnull'=>0, 'visible'=>-1,),
		'total' => array('type'=>'price', 'label'=>'total', 'enabled'=>'1', 'position'=>26, 'notnull'=>0, 'visible'=>1,),
		'date_creation' => array('type'=>'datetime', 'label'=>'DateCreation', 'enabled'=>'1', 'position'=>500, 'notnull'=>1, 'visible'=>-2,),
		'tms' => array('type'=>'timestamp', 'label'=>'DateModification', 'enabled'=>'1', 'position'=>501, 'notnull'=>0, 'visible'=>-2,),
		'fk_user_creat' => array('type'=>'integer:User:user/class/user.class.php', 'label'=>'UserAuthor', 'enabled'=>'1', 'position'=>510, 'notnull'=>1, 'visible'=>-2, 'foreignkey'=>'user.rowid',),
		'fk_user_modif' => array('type'=>'integer:User:user/class/user.class.php', 'label'=>'UserModif', 'enabled'=>'1', 'position'=>511, 'notnull'=>-1, 'visible'=>-2,),
		'last_main_doc' => array('type'=>'varchar(255)', 'label'=>'LastMainDoc', 'enabled'=>'1', 'position'=>600, 'notnull'=>0, 'visible'=>0,),
		'import_key' => array('type'=>'varchar(14)', 'label'=>'ImportId', 'enabled'=>'1', 'position'=>1000, 'notnull'=>-1, 'visible'=>-2,),
		'model_pdf' => array('type'=>'varchar(255)', 'label'=>'Model pdf', 'enabled'=>'1', 'position'=>1010, 'notnull'=>-1, 'visible'=>0,),
		'status' => array('type'=>'integer', 'label'=>'Status', 'enabled'=>'1', 'position'=>1000, 'notnull'=>1, 'visible'=>4, 'index'=>1, 'arrayofkeyval'=>array('0'=>'Borrador', '1'=>'Presupuestado', '2'=>'FacturadoCliente', '3'=>'FacturadoProv', '9'=>'Cancelado'), 'validate'=>'1',),
		'C0Ro' => array('type'=>'integer', 'label'=>'Rol', 'enabled'=>'1', 'position'=>113, 'notnull'=>0, 'visible'=>3, 'index'=>1, 'arrayofkeyval'=>array('0'=>'Stock', '1'=>'Produccion', '2'=>'Camara', '3'=>'Edicion', '4'=>'Locucion', '9'=>'Dron'), 'validate'=>'1',),
		'C0Pr' => array('type'=>'price', 'label'=>'Precio', 'enabled'=>'1', 'position'=>114, 'notnull'=>0, 'visible'=>3,),
		'C0Ca' => array('type'=>'varchar(128)', 'label'=>'Cant', 'enabled'=>'1', 'position'=>115, 'notnull'=>0, 'visible'=>3,),
		'C0Pa' => array('type'=>'price', 'label'=>'Pago', 'enabled'=>'1', 'position'=>117, 'notnull'=>0, 'visible'=>3,),
		'C1Ro' => array('type'=>'varchar(128)', 'label'=>'Rol', 'enabled'=>'1', 'position'=>118, 'notnull'=>0, 'visible'=>3, 'index'=>1, 'arrayofkeyval'=>array('0'=>'Stock', '1'=>'Produccion', '2'=>'Camara', '3'=>'Edicion', '4'=>'Locucion', '9'=>'Dron'), 'validate'=>'1',),
		'C1Pr' => array('type'=>'price', 'label'=>'Precio', 'enabled'=>'1', 'position'=>119, 'notnull'=>0, 'visible'=>3,),
		'C1Ca' => array('type'=>'varchar(128)', 'label'=>'Cant', 'enabled'=>'1', 'position'=>120, 'notnull'=>0, 'visible'=>3,),
		'C1Pa' => array('type'=>'price', 'label'=>'Pago', 'enabled'=>'1', 'position'=>122, 'notnull'=>0, 'visible'=>3,),
		'C2Ro' => array('type'=>'varchar(128)', 'label'=>'Rol', 'enabled'=>'1', 'position'=>123, 'notnull'=>0, 'visible'=>3, 'index'=>1, 'arrayofkeyval'=>array('0'=>'Stock', '1'=>'Produccion', '2'=>'Camara', '3'=>'Edicion', '4'=>'Locucion', '9'=>'Dron'), 'validate'=>'1',),
		'C2Pr' => array('type'=>'price', 'label'=>'Precio', 'enabled'=>'1', 'position'=>124, 'notnull'=>0, 'visible'=>3,),
		'C2Ca' => array('type'=>'varchar(128)', 'label'=>'Cant', 'enabled'=>'1', 'position'=>125, 'notnull'=>0, 'visible'=>3,),
		'C2Pa' => array('type'=>'price', 'label'=>'Pago', 'enabled'=>'1', 'position'=>127, 'notnull'=>0, 'visible'=>3,),
		'C3Ro' => array('type'=>'varchar(128)', 'label'=>'Rol', 'enabled'=>'1', 'position'=>128, 'notnull'=>0, 'visible'=>3, 'index'=>1, 'arrayofkeyval'=>array('0'=>'Stock', '1'=>'Produccion', '2'=>'Camara', '3'=>'Edicion', '4'=>'Locucion', '9'=>'Dron'), 'validate'=>'1',),
		'C3Pr' => array('type'=>'price', 'label'=>'Precio', 'enabled'=>'1', 'position'=>129, 'notnull'=>0, 'visible'=>3,),
		'C3Ca' => array('type'=>'varchar(128)', 'label'=>'Cant', 'enabled'=>'1', 'position'=>130, 'notnull'=>0, 'visible'=>3,),
		'C3Pa' => array('type'=>'price', 'label'=>'Pago', 'enabled'=>'1', 'position'=>132, 'notnull'=>0, 'visible'=>3,),
		'C4Ro' => array('type'=>'varchar(128)', 'label'=>'Rol', 'enabled'=>'1', 'position'=>133, 'notnull'=>0, 'visible'=>3, 'index'=>1, 'arrayofkeyval'=>array('0'=>'Stock', '1'=>'Produccion', '2'=>'Camara', '3'=>'Edicion', '4'=>'Locucion', '9'=>'Dron'), 'validate'=>'1',),
		'C4Pr' => array('type'=>'price', 'label'=>'Precio', 'enabled'=>'1', 'position'=>134, 'notnull'=>0, 'visible'=>3,),
		'C4Ca' => array('type'=>'varchar(128)', 'label'=>'Cant', 'enabled'=>'1', 'position'=>135, 'notnull'=>0, 'visible'=>3,),
		'C4Pa' => array('type'=>'price', 'label'=>'Pago', 'enabled'=>'1', 'position'=>137, 'notnull'=>0, 'visible'=>3,),
		'C0As' => array('type'=>'integer:Societe:societe/class/societe.class.php:1:status=1 AND fournisseur=1 AND entity IN (__SHARED_ENTITIES__)', 'label'=>'Asi0', 'enabled'=>'1', 'position'=>116, 'notnull'=>0, 'visible'=>3,),
		'C1As' => array('type'=>'integer:Societe:societe/class/societe.class.php:1:status=1 AND fournisseur=1 AND entity IN (__SHARED_ENTITIES__)', 'label'=>'Asi1', 'enabled'=>'1', 'position'=>121, 'notnull'=>0, 'visible'=>3,),
		'C2As' => array('type'=>'integer:Societe:societe/class/societe.class.php:1:status=1 AND fournisseur=1 AND entity IN (__SHARED_ENTITIES__)', 'label'=>'Asi2', 'enabled'=>'1', 'position'=>126, 'notnull'=>0, 'visible'=>3,),
		'C3As' => array('type'=>'integer:Societe:societe/class/societe.class.php:1:status=1 AND fournisseur=1 AND entity IN (__SHARED_ENTITIES__)', 'label'=>'Asi3', 'enabled'=>'1', 'position'=>131, 'notnull'=>0, 'visible'=>3,),
		'C4As' => array('type'=>'integer:Societe:societe/class/societe.class.php:1:status=1 AND fournisseur=1 AND entity IN (__SHARED_ENTITIES__)', 'label'=>'Asi4', 'enabled'=>'1', 'position'=>136, 'notnull'=>0, 'visible'=>3,),
	);
	public $rowid;
	public $ref;
	public $Usuario;
	public $fk_soc;
	public $trabajo;
	public $fk_project;
	public $description;
	public $note_public;
	public $entrega;
	public $label;
	public $note_private;
	public $gastos;
	public $megafon;
	public $subtotal;
	public $iva;
	public $total;
	public $date_creation;
	public $tms;
	public $fk_user_creat;
	public $fk_user_modif;
	public $last_main_doc;
	public $import_key;
	public $model_pdf;
	public $status;
	public $C0Ro;
	public $C0Pr;
	public $C0Ca;
	public $C0Pa;
	public $C1Ro;
	public $C1Pr;
	public $C1Ca;
	public $C1Pa;
	public $C2Ro;
	public $C2Pr;
	public $C2Ca;
	public $C2Pa;
	public $C3Ro;
	public $C3Pr;
	public $C3Ca;
	public $C3Pa;
	public $C4Ro;
	public $C4Pr;
	public $C4Ca;
	public $C4Pa;
	public $C0As;
	public $C1As;
	public $C2As;
	public $C3As;
	public $C4As;
	// END MODULEBUILDER PROPERTIES


	// If this object has a subtable with lines

	// /**
	//  * @var string    Name of subtable line
	//  */
	// public $table_element_line = 'cotizaciones_cotizacionline';

	// /**
	//  * @var string    Field with ID of parent key if this object has a parent
	//  */
	// public $fk_element = 'fk_cotizacion';

	// /**
	//  * @var string    Name of subtable class that manage subtable lines
	//  */
	// public $class_element_line = 'Cotizacionline';

	// /**
	//  * @var array	List of child tables. To test if we can delete object.
	//  */
	// protected $childtables = array();

	// /**
	//  * @var array    List of child tables. To know object to delete on cascade.
	//  *               If name matches '@ClassNAme:FilePathClass;ParentFkFieldName' it will
	//  *               call method deleteByParentField(parentId, ParentFkFieldName) to fetch and delete child object
	//  */
	// protected $childtablesoncascade = array('cotizaciones_cotizaciondet');

	// /**
	//  * @var CotizacionLine[]     Array of subtable lines
	//  */
	// public $lines = array();



	/**
	 * Constructor
	 *
	 * @param DoliDb $db Database handler
	 */
	public function __construct(DoliDB $db)
	{
		global $conf, $langs;

		$this->db = $db;

		if (empty($conf->global->MAIN_SHOW_TECHNICAL_ID) && isset($this->fields['rowid'])) {
			$this->fields['rowid']['visible'] = 0;
		}
		if (empty($conf->multicompany->enabled) && isset($this->fields['entity'])) {
			$this->fields['entity']['enabled'] = 0;
		}

		// Example to show how to set values of fields definition dynamically
		/*if ($user->rights->cotizaciones->cotizacion->read) {
			$this->fields['myfield']['visible'] = 1;
			$this->fields['myfield']['noteditable'] = 0;
		}*/

		// Unset fields that are disabled
		foreach ($this->fields as $key => $val) {
			if (isset($val['enabled']) && empty($val['enabled'])) {
				unset($this->fields[$key]);
			}
		}

		// Translate some data of arrayofkeyval
		if (is_object($langs)) {
			foreach ($this->fields as $key => $val) {
				if (!empty($val['arrayofkeyval']) && is_array($val['arrayofkeyval'])) {
					foreach ($val['arrayofkeyval'] as $key2 => $val2) {
						$this->fields[$key]['arrayofkeyval'][$key2] = $langs->trans($val2);
					}
				}
			}
		}
	}

	/**
	 * Create object into database
	 *
	 * @param  User $user      User that creates
	 * @param  bool $notrigger false=launch triggers after, true=disable triggers
	 * @return int             <0 if KO, Id of created object if OK
	 */
	public function create(User $user, $notrigger = false)
	{
		$resultcreate = $this->createCommon($user, $notrigger);

		//$resultvalidate = $this->validate($user, $notrigger);

		return $resultcreate;
	}

	/**
	 * Clone an object into another one
	 *
	 * @param  	User 	$user      	User that creates
	 * @param  	int 	$fromid     Id of object to clone
	 * @return 	mixed 				New object created, <0 if KO
	 */
	public function createFromClone(User $user, $fromid)
	{
		global $langs, $extrafields;
		$error = 0;

		dol_syslog(__METHOD__, LOG_DEBUG);

		$object = new self($this->db);

		$this->db->begin();

		// Load source object
		$result = $object->fetchCommon($fromid);
		if ($result > 0 && !empty($object->table_element_line)) {
			$object->fetchLines();
		}

		// get lines so they will be clone
		//foreach($this->lines as $line)
		//	$line->fetch_optionals();

		// Reset some properties
		unset($object->id);
		unset($object->fk_user_creat);
		unset($object->import_key);

		// Clear fields
		if (property_exists($object, 'ref')) {
			$object->ref = empty($this->fields['ref']['default']) ? "Copy_Of_".$object->ref : $this->fields['ref']['default'];
		}
		if (property_exists($object, 'label')) {
			$object->label = empty($this->fields['label']['default']) ? $langs->trans("CopyOf")." ".$object->label : $this->fields['label']['default'];
		}
		if (property_exists($object, 'status')) {
			$object->status = self::STATUS_DRAFT;
		}
		if (property_exists($object, 'date_creation')) {
			$object->date_creation = dol_now();
		}
		if (property_exists($object, 'date_modification')) {
			$object->date_modification = null;
		}
		// ...
		// Clear extrafields that are unique
		if (is_array($object->array_options) && count($object->array_options) > 0) {
			$extrafields->fetch_name_optionals_label($this->table_element);
			foreach ($object->array_options as $key => $option) {
				$shortkey = preg_replace('/options_/', '', $key);
				if (!empty($extrafields->attributes[$this->table_element]['unique'][$shortkey])) {
					//var_dump($key); var_dump($clonedObj->array_options[$key]); exit;
					unset($object->array_options[$key]);
				}
			}
		}

		// Create clone
		$object->context['createfromclone'] = 'createfromclone';
		$result = $object->createCommon($user);
		if ($result < 0) {
			$error++;
			$this->error = $object->error;
			$this->errors = $object->errors;
		}

		if (!$error) {
			// copy internal contacts
			if ($this->copy_linked_contact($object, 'internal') < 0) {
				$error++;
			}
		}

		if (!$error) {
			// copy external contacts if same company
			if (!empty($object->socid) && property_exists($this, 'fk_soc') && $this->fk_soc == $object->socid) {
				if ($this->copy_linked_contact($object, 'external') < 0) {
					$error++;
				}
			}
		}

		unset($object->context['createfromclone']);

		// End
		if (!$error) {
			$this->db->commit();
			return $object;
		} else {
			$this->db->rollback();
			return -1;
		}
	}

	/**
	 * Load object in memory from the database
	 *
	 * @param int    $id   Id object
	 * @param string $ref  Ref
	 * @return int         <0 if KO, 0 if not found, >0 if OK
	 */
	public function fetch($id, $ref = null)
	{
		$result = $this->fetchCommon($id, $ref);
		if ($result > 0 && !empty($this->table_element_line)) {
			$this->fetchLines();
		}
		return $result;
	}

	/**
	 * Load object lines in memory from the database
	 *
	 * @return int         <0 if KO, 0 if not found, >0 if OK
	 */
	public function fetchLines()
	{
		$this->lines = array();

		$result = $this->fetchLinesCommon();
		return $result;
	}


	/**
	 * Load list of objects in memory from the database.
	 *
	 * @param  string      $sortorder    Sort Order
	 * @param  string      $sortfield    Sort field
	 * @param  int         $limit        limit
	 * @param  int         $offset       Offset
	 * @param  array       $filter       Filter array. Example array('field'=>'valueforlike', 'customurl'=>...)
	 * @param  string      $filtermode   Filter mode (AND or OR)
	 * @return array|int                 int <0 if KO, array of pages if OK
	 */
	public function fetchAll($sortorder = '', $sortfield = '', $limit = 0, $offset = 0, array $filter = array(), $filtermode = 'AND')
	{
		global $conf;

		dol_syslog(__METHOD__, LOG_DEBUG);

		$records = array();

		$sql = "SELECT ";
		$sql .= $this->getFieldList('t');
		$sql .= " FROM ".MAIN_DB_PREFIX.$this->table_element." as t";
		if (isset($this->ismultientitymanaged) && $this->ismultientitymanaged == 1) {
			$sql .= " WHERE t.entity IN (".getEntity($this->table_element).")";
		} else {
			$sql .= " WHERE 1 = 1";
		}
		// Manage filter
		$sqlwhere = array();
		if (count($filter) > 0) {
			foreach ($filter as $key => $value) {
				if ($key == 't.rowid') {
					$sqlwhere[] = $key." = ".((int) $value);
				} elseif (in_array($this->fields[$key]['type'], array('date', 'datetime', 'timestamp'))) {
					$sqlwhere[] = $key." = '".$this->db->idate($value)."'";
				} elseif ($key == 'customsql') {
					$sqlwhere[] = $value;
				} elseif (strpos($value, '%') === false) {
					$sqlwhere[] = $key." IN (".$this->db->sanitize($this->db->escape($value)).")";
				} else {
					$sqlwhere[] = $key." LIKE '%".$this->db->escape($value)."%'";
				}
			}
		}
		if (count($sqlwhere) > 0) {
			$sql .= " AND (".implode(" ".$filtermode." ", $sqlwhere).")";
		}

		if (!empty($sortfield)) {
			$sql .= $this->db->order($sortfield, $sortorder);
		}
		if (!empty($limit)) {
			$sql .= $this->db->plimit($limit, $offset);
		}

		$resql = $this->db->query($sql);
		if ($resql) {
			$num = $this->db->num_rows($resql);
			$i = 0;
			while ($i < ($limit ? min($limit, $num) : $num)) {
				$obj = $this->db->fetch_object($resql);

				$record = new self($this->db);
				$record->setVarsFromFetchObj($obj);

				$records[$record->id] = $record;

				$i++;
			}
			$this->db->free($resql);

			return $records;
		} else {
			$this->errors[] = 'Error '.$this->db->lasterror();
			dol_syslog(__METHOD__.' '.join(',', $this->errors), LOG_ERR);

			return -1;
		}
	}

	/**
	 * Update object into database
	 *
	 * @param  User $user      User that modifies
	 * @param  bool $notrigger false=launch triggers after, true=disable triggers
	 * @return int             <0 if KO, >0 if OK
	 */
	public function update(User $user, $notrigger = false)
	{
		return $this->updateCommon($user, $notrigger);
	}

	/**
	 * Delete object in database
	 *
	 * @param User $user       User that deletes
	 * @param bool $notrigger  false=launch triggers after, true=disable triggers
	 * @return int             <0 if KO, >0 if OK
	 */
	public function delete(User $user, $notrigger = false)
	{
		return $this->deleteCommon($user, $notrigger);
		//return $this->deleteCommon($user, $notrigger, 1);
	}

	/**
	 *  Delete a line of object in database
	 *
	 *	@param  User	$user       User that delete
	 *  @param	int		$idline		Id of line to delete
	 *  @param 	bool 	$notrigger  false=launch triggers after, true=disable triggers
	 *  @return int         		>0 if OK, <0 if KO
	 */
	public function deleteLine(User $user, $idline, $notrigger = false)
	{
		if ($this->status < 0) {
			$this->error = 'ErrorDeleteLineNotAllowedByObjectStatus';
			return -2;
		}

		return $this->deleteLineCommon($user, $idline, $notrigger);
	}


	/**
	 *	Validate object
	 *
	 *	@param		User	$user     		User making status change
	 *  @param		int		$notrigger		1=Does not execute triggers, 0= execute triggers
	 *	@return  	int						<=0 if OK, 0=Nothing done, >0 if KO
	 */
	public function validate($user, $notrigger = 0)
	{
		global $conf, $langs;

		require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';

		$error = 0;

		// Protection
		if ($this->status == self::STATUS_VALIDATED) {
			dol_syslog(get_class($this)."::validate action abandonned: already validated", LOG_WARNING);
			return 0;
		}

		/*if (! ((empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->cotizacion->write))
		 || (! empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->cotizacion->cotizacion_advance->validate))))
		 {
		 $this->error='NotEnoughPermissions';
		 dol_syslog(get_class($this)."::valid ".$this->error, LOG_ERR);
		 return -1;
		 }*/

		$now = dol_now();

		$this->db->begin();

		// Define new ref
		if (!$error && (preg_match('/^[\(]?PROV/i', $this->ref) || empty($this->ref))) { // empty should not happened, but when it occurs, the test save life
			$num = $this->getNextNumRef();
		} else {
			$num = $this->ref;
		}
		$this->newref = $num;

		if (!empty($num)) {
			// Validate
			$sql = "UPDATE ".MAIN_DB_PREFIX.$this->table_element;
			$sql .= " SET ref = '".$this->db->escape($num)."',";
			$sql .= " status = ".self::STATUS_VALIDATED;
			if (!empty($this->fields['date_validation'])) {
				$sql .= ", date_validation = '".$this->db->idate($now)."'";
			}
			if (!empty($this->fields['fk_user_valid'])) {
				$sql .= ", fk_user_valid = ".((int) $user->id);
			}
			$sql .= " WHERE rowid = ".((int) $this->id);

			dol_syslog(get_class($this)."::validate()", LOG_DEBUG);
			$resql = $this->db->query($sql);
			if (!$resql) {
				dol_print_error($this->db);
				$this->error = $this->db->lasterror();
				$error++;
			}

			if (!$error && !$notrigger) {
				// Call trigger
				$result = $this->call_trigger('COTIZACION_VALIDATE', $user);
				if ($result < 0) {
					$error++;
				}
				// End call triggers
			}
		}

		if (!$error) {
			$this->oldref = $this->ref;

			// Rename directory if dir was a temporary ref
			if (preg_match('/^[\(]?PROV/i', $this->ref)) {
				// Now we rename also files into index
				$sql = 'UPDATE '.MAIN_DB_PREFIX."ecm_files set filename = CONCAT('".$this->db->escape($this->newref)."', SUBSTR(filename, ".(strlen($this->ref) + 1).")), filepath = 'cotizacion/".$this->db->escape($this->newref)."'";
				$sql .= " WHERE filename LIKE '".$this->db->escape($this->ref)."%' AND filepath = 'cotizacion/".$this->db->escape($this->ref)."' and entity = ".$conf->entity;
				$resql = $this->db->query($sql);
				if (!$resql) {
					$error++; $this->error = $this->db->lasterror();
				}

				// We rename directory ($this->ref = old ref, $num = new ref) in order not to lose the attachments
				$oldref = dol_sanitizeFileName($this->ref);
				$newref = dol_sanitizeFileName($num);
				$dirsource = $conf->cotizaciones->dir_output.'/cotizacion/'.$oldref;
				$dirdest = $conf->cotizaciones->dir_output.'/cotizacion/'.$newref;
				if (!$error && file_exists($dirsource)) {
					dol_syslog(get_class($this)."::validate() rename dir ".$dirsource." into ".$dirdest);

					if (@rename($dirsource, $dirdest)) {
						dol_syslog("Rename ok");
						// Rename docs starting with $oldref with $newref
						$listoffiles = dol_dir_list($conf->cotizaciones->dir_output.'/cotizacion/'.$newref, 'files', 1, '^'.preg_quote($oldref, '/'));
						foreach ($listoffiles as $fileentry) {
							$dirsource = $fileentry['name'];
							$dirdest = preg_replace('/^'.preg_quote($oldref, '/').'/', $newref, $dirsource);
							$dirsource = $fileentry['path'].'/'.$dirsource;
							$dirdest = $fileentry['path'].'/'.$dirdest;
							@rename($dirsource, $dirdest);
						}
					}
				}
			}
		}

		// Set new ref and current status
		if (!$error) {
			$this->ref = $num;
			$this->status = self::STATUS_VALIDATED;
		}

		if (!$error) {
			$this->db->commit();
			return 1;
		} else {
			$this->db->rollback();
			return -1;
		}
	}


	/**
	 *	Set draft status
	 *
	 *	@param	User	$user			Object user that modify
	 *  @param	int		$notrigger		1=Does not execute triggers, 0=Execute triggers
	 *	@return	int						<0 if KO, >0 if OK
	 *  "0":"Borrador","1":"Presupuestado","2":"FacturadoClientes","3":"FacturadoProv","9":"Cancelado"}</span>
	 */
	public function setDraft($user, $notrigger = 0)
	{
		// Protection
		if ($this->status <= self::STATUS_DRAFT) {
			return 0;
		}

		/*if (! ((empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->write))
		 || (! empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->cotizaciones_advance->validate))))
		 {
		 $this->error='Permission denied';
		 return -1;
		 }*/

		return $this->setStatusCommon($user, self::STATUS_DRAFT, $notrigger, 'COTIZACION_UNVALIDATE');
	}

	public function setFacturadoProv($user, $notrigger = 0)
	{
		// Protection
		if ($this->status <= self::STATUS_FacturadoProv) {
			return 0;
		}

		/*if (! ((empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->write))
		 || (! empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->cotizaciones_advance->validate))))
		 {
		 $this->error='Permission denied';
		 return -1;
		 }*/

		return $this->setStatusCommon($user, self::STATUS_FacturadoProv, $notrigger, 'STATUS_FacturadoProv');
	}




	/**
	 *	Set cancel status
	 *
	 *	@param	User	$user			Object user that modify
	 *  @param	int		$notrigger		1=Does not execute triggers, 0=Execute triggers
	 *	@return	int						<0 if KO, 0=Nothing done, >0 if OK
	 */
	public function cancel($user, $notrigger = 0)
	{
		// Protection
		if ($this->status != self::STATUS_VALIDATED) {
			return 0;
		}

		/*if (! ((empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->write))
		 || (! empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->cotizaciones_advance->validate))))
		 {
		 $this->error='Permission denied';
		 return -1;
		 }*/

		return $this->setStatusCommon($user, self::STATUS_CANCELED, $notrigger, 'COTIZACION_CANCEL');
	}


	/**
	 *	Set Facturado 
	 *
	 *	@param	User	$user			Object user that modify
	 *  @param	int		$notrigger		1=Does not execute triggers, 0=Execute triggers
	 *	@return	int						<0 if KO, >0 if OK
	 *  "0":"Borrador","1":"Presupuestado","2":"FacturadoClientes","3":"FacturadoProv","9":"Cancelado"}</span>
	 */
	
	
	 public function FacturadoClientes($user, $notrigger = 0)
	{
		// Protection
		if ($this->status <= self::STATUS_FacturadoClientes) {
			return 0;
		}

		/*if (! ((empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->write))
		 || (! empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->cotizaciones_advance->validate))))
		 {
		 $this->error='Permission denied';
		 return -1;
		 }*/
		 ##setStatusCommon($user, $status, $notrigger = 0, $triggercode = '')
		return $this->setStatusCommon($user, self::STATUS_FacturadoClientes, $notrigger, 'COTIZACION_facturadaAClientes');
	}





	/**
	 *	Set back to validated status
	 *
	 *	@param	User	$user			Object user that modify
	 *  @param	int		$notrigger		1=Does not execute triggers, 0=Execute triggers
	 *	@return	int						<0 if KO, 0=Nothing done, >0 if OK
	 */
	public function reopen($user, $notrigger = 0)
	{
		// Protection
		if ($this->status != self::STATUS_CANCELED) {
			return 0;
		}

		/*if (! ((empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->write))
		 || (! empty($conf->global->MAIN_USE_ADVANCED_PERMS) && ! empty($user->rights->cotizaciones->cotizaciones_advance->validate))))
		 {
		 $this->error='Permission denied';
		 return -1;
		 }*/

		return $this->setStatusCommon($user, self::STATUS_VALIDATED, $notrigger, 'COTIZACION_REOPEN');
	}

	/**
	 *  Return a link to the object card (with optionaly the picto)
	 *
	 *  @param  int     $withpicto                  Include picto in link (0=No picto, 1=Include picto into link, 2=Only picto)
	 *  @param  string  $option                     On what the link point to ('nolink', ...)
	 *  @param  int     $notooltip                  1=Disable tooltip
	 *  @param  string  $morecss                    Add more css on link
	 *  @param  int     $save_lastsearch_value      -1=Auto, 0=No save of lastsearch_values when clicking, 1=Save lastsearch_values whenclicking
	 *  @return	string                              String with URL
	 */
	public function getNomUrl($withpicto = 0, $option = '', $notooltip = 0, $morecss = '', $save_lastsearch_value = -1)
	{
		global $conf, $langs, $hookmanager;

		if (!empty($conf->dol_no_mouse_hover)) {
			$notooltip = 1; // Force disable tooltips
		}

		$result = '';

		$label = img_picto('', $this->picto).' <u>'.$langs->trans("Cotizacion").'</u>';
		if (isset($this->status)) {
			$label .= ' '.$this->getLibStatut(5);
		}
		$label .= '<br>';
		$label .= '<b>'.$langs->trans('Ref').':</b> '.$this->ref;

		$url = dol_buildpath('/cotizaciones/cotizacion_card.php', 1).'?id='.$this->id;

		if ($option != 'nolink') {
			// Add param to save lastsearch_values or not
			$add_save_lastsearch_values = ($save_lastsearch_value == 1 ? 1 : 0);
			if ($save_lastsearch_value == -1 && preg_match('/list\.php/', $_SERVER["PHP_SELF"])) {
				$add_save_lastsearch_values = 1;
			}
			if ($url && $add_save_lastsearch_values) {
				$url .= '&save_lastsearch_values=1';
			}
		}

		$linkclose = '';
		if (empty($notooltip)) {
			if (!empty($conf->global->MAIN_OPTIMIZEFORTEXTBROWSER)) {
				$label = $langs->trans("ShowCotizacion");
				$linkclose .= ' alt="'.dol_escape_htmltag($label, 1).'"';
			}
			$linkclose .= ' title="'.dol_escape_htmltag($label, 1).'"';
			$linkclose .= ' class="classfortooltip'.($morecss ? ' '.$morecss : '').'"';
		} else {
			$linkclose = ($morecss ? ' class="'.$morecss.'"' : '');
		}

		if ($option == 'nolink' || empty($url)) {
			$linkstart = '<span';
		} else {
			$linkstart = '<a href="'.$url.'"';
		}
		$linkstart .= $linkclose.'>';
		if ($option == 'nolink' || empty($url)) {
			$linkend = '</span>';
		} else {
			$linkend = '</a>';
		}

		$result .= $linkstart;

		if (empty($this->showphoto_on_popup)) {
			if ($withpicto) {
				$result .= img_object(($notooltip ? '' : $label), ($this->picto ? $this->picto : 'generic'), ($notooltip ? (($withpicto != 2) ? 'class="paddingright"' : '') : 'class="'.(($withpicto != 2) ? 'paddingright ' : '').'classfortooltip"'), 0, 0, $notooltip ? 0 : 1);
			}
		} else {
			if ($withpicto) {
				require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';

				list($class, $module) = explode('@', $this->picto);
				$upload_dir = $conf->$module->multidir_output[$conf->entity]."/$class/".dol_sanitizeFileName($this->ref);
				$filearray = dol_dir_list($upload_dir, "files");
				$filename = $filearray[0]['name'];
				if (!empty($filename)) {
					$pospoint = strpos($filearray[0]['name'], '.');

					$pathtophoto = $class.'/'.$this->ref.'/thumbs/'.substr($filename, 0, $pospoint).'_mini'.substr($filename, $pospoint);
					if (empty($conf->global->{strtoupper($module.'_'.$class).'_FORMATLISTPHOTOSASUSERS'})) {
						$result .= '<div class="floatleft inline-block valignmiddle divphotoref"><div class="photoref"><img class="photo'.$module.'" alt="No photo" border="0" src="'.DOL_URL_ROOT.'/viewimage.php?modulepart='.$module.'&entity='.$conf->entity.'&file='.urlencode($pathtophoto).'"></div></div>';
					} else {
						$result .= '<div class="floatleft inline-block valignmiddle divphotoref"><img class="photouserphoto userphoto" alt="No photo" border="0" src="'.DOL_URL_ROOT.'/viewimage.php?modulepart='.$module.'&entity='.$conf->entity.'&file='.urlencode($pathtophoto).'"></div>';
					}

					$result .= '</div>';
				} else {
					$result .= img_object(($notooltip ? '' : $label), ($this->picto ? $this->picto : 'generic'), ($notooltip ? (($withpicto != 2) ? 'class="paddingright"' : '') : 'class="'.(($withpicto != 2) ? 'paddingright ' : '').'classfortooltip"'), 0, 0, $notooltip ? 0 : 1);
				}
			}
		}

		if ($withpicto != 2) {
			$result .= $this->ref;
		}

		$result .= $linkend;
		//if ($withpicto != 2) $result.=(($addlabel && $this->label) ? $sep . dol_trunc($this->label, ($addlabel > 1 ? $addlabel : 0)) : '');

		global $action, $hookmanager;
		$hookmanager->initHooks(array('cotizaciondao'));
		$parameters = array('id'=>$this->id, 'getnomurl'=>$result);
		$reshook = $hookmanager->executeHooks('getNomUrl', $parameters, $this, $action); // Note that $action and $object may have been modified by some hooks
		if ($reshook > 0) {
			$result = $hookmanager->resPrint;
		} else {
			$result .= $hookmanager->resPrint;
		}

		return $result;
	}

	/**
	 *  Return the label of the status
	 *
	 *  @param  int		$mode          0=long label, 1=short label, 2=Picto + short label, 3=Picto, 4=Picto + long label, 5=Short label + Picto, 6=Long label + Picto
	 *  @return	string 			       Label of status
	 */
	public function getLabelStatus($mode = 0)
	{
		return $this->LibStatut($this->status, $mode);
	}

	/**
	 *  Return the label of the status
	 *
	 *  @param  int		$mode          0=long label, 1=short label, 2=Picto + short label, 3=Picto, 4=Picto + long label, 5=Short label + Picto, 6=Long label + Picto
	 *  @return	string 			       Label of status
	 */
	public function getLibStatut($mode = 0)
	{
		return $this->LibStatut($this->status, $mode);
	}

	// phpcs:disable PEAR.NamingConventions.ValidFunctionName.ScopeNotCamelCaps
	/**
	 *  Return the status
	 *
	 *  @param	int		$status        Id status
	 *  @param  int		$mode          0=long label, 1=short label, 2=Picto + short label, 3=Picto, 4=Picto + long label, 5=Short label + Picto, 6=Long label + Picto
	 *  @return string 			       Label of status
	 */
	public function LibStatut($status, $mode = 0)
	{
		// phpcs:enable

/* 		const STATUS_DRAFT = 0;
		const STATUS_VALIDATED = 1;
		const STATUS_FacturadoClientes = 2;
		const STATUS_FacturadoProv = 3;
		const STATUS_CANCELED = 9; */



		if (empty($this->labelStatus) || empty($this->labelStatusShort)) {
			global $langs;
			//$langs->load("cotizaciones@cotizaciones");
			$this->labelStatus[self::STATUS_DRAFT] = $langs->transnoentitiesnoconv('Draft');
			$this->labelStatus[self::STATUS_FacturadoClientes] = $langs->transnoentitiesnoconv('F.Cliente');#
			$this->labelStatus[self::STATUS_FacturadoProv] = $langs->transnoentitiesnoconv('F.Prov'); #
			$this->labelStatus[self::STATUS_VALIDATED] = $langs->transnoentitiesnoconv('Presupuestado');
			$this->labelStatus[self::STATUS_CANCELED] = $langs->transnoentitiesnoconv('Disabled');

			$this->labelStatusShort[self::STATUS_DRAFT] = $langs->transnoentitiesnoconv('Draft');
			$this->labelStatusShort[self::STATUS_VALIDATED] = $langs->transnoentitiesnoconv('Presupuestado');
			$this->labelStatusShort[self::STATUS_CANCELED] = $langs->transnoentitiesnoconv('Disabled');

			$this->labelStatusShort[self::STATUS_FacturadoClientes] = $langs->transnoentitiesnoconv('Facturado a Client');#
			$this->labelStatusShort[self::STATUS_FacturadoProv] = $langs->transnoentitiesnoconv('Facturado a Prov');#
		}

		$statusType = 'status'.$status;
		//if ($status == self::STATUS_VALIDATED) $statusType = 'status1';
		if ($status == self::STATUS_CANCELED) {
			$statusType = 'status6';
		}

		return dolGetStatus($this->labelStatus[$status], $this->labelStatusShort[$status], '', $statusType, $mode);
	}

	/**
	 *	Load the info information in the object
	 *
	 *	@param  int		$id       Id of object
	 *	@return	void
	 */
	public function info($id)
	{
		$sql = "SELECT rowid, date_creation as datec, tms as datem,";
		$sql .= " fk_user_creat, fk_user_modif";
		$sql .= " FROM ".MAIN_DB_PREFIX.$this->table_element." as t";
		$sql .= " WHERE t.rowid = ".((int) $id);

		$result = $this->db->query($sql);
		if ($result) {
			if ($this->db->num_rows($result)) {
				$obj = $this->db->fetch_object($result);
				$this->id = $obj->rowid;
				if (!empty($obj->fk_user_author)) {
					$cuser = new User($this->db);
					$cuser->fetch($obj->fk_user_author);
					$this->user_creation = $cuser;
				}

				if (!empty($obj->fk_user_valid)) {
					$vuser = new User($this->db);
					$vuser->fetch($obj->fk_user_valid);
					$this->user_validation = $vuser;
				}

				if (!empty($obj->fk_user_cloture)) {
					$cluser = new User($this->db);
					$cluser->fetch($obj->fk_user_cloture);
					$this->user_cloture = $cluser;
				}

				$this->date_creation     = $this->db->jdate($obj->datec);
				$this->date_modification = $this->db->jdate($obj->datem);
				$this->date_validation   = $this->db->jdate($obj->datev);
			}

			$this->db->free($result);
		} else {
			dol_print_error($this->db);
		}
	}

	/**
	 * Initialise object with example values
	 * Id must be 0 if object instance is a specimen
	 *
	 * @return void
	 */
	public function initAsSpecimen()
	{
		// Set here init that are not commonf fields
		// $this->property1 = ...
		// $this->property2 = ...

		$this->initAsSpecimenCommon();
	}

	/**
	 * 	Create an array of lines
	 *
	 * 	@return array|int		array of lines if OK, <0 if KO
	 */
	public function getLinesArray()
	{
		$this->lines = array();

		$objectline = new CotizacionLine($this->db);
		$result = $objectline->fetchAll('ASC', 'position', 0, 0, array('customsql'=>'fk_cotizacion = '.((int) $this->id)));

		if (is_numeric($result)) {
			$this->error = $this->error;
			$this->errors = $this->errors;
			return $result;
		} else {
			$this->lines = $result;
			return $this->lines;
		}
	}

	/**
	 *  Returns the reference to the following non used object depending on the active numbering module.
	 *
	 *  @return string      		Object free reference
	 */
	public function getNextNumRef()
	{
		global $langs, $conf;
		$langs->load("cotizaciones@cotizaciones");

		if (empty($conf->global->COTIZACIONES_COTIZACION_ADDON)) {
			$conf->global->COTIZACIONES_COTIZACION_ADDON = 'mod_cotizacion_standard';
		}

		if (!empty($conf->global->COTIZACIONES_COTIZACION_ADDON)) {
			$mybool = false;

			$file = $conf->global->COTIZACIONES_COTIZACION_ADDON.".php";
			$classname = $conf->global->COTIZACIONES_COTIZACION_ADDON;

			// Include file with class
			$dirmodels = array_merge(array('/'), (array) $conf->modules_parts['models']);
			foreach ($dirmodels as $reldir) {
				$dir = dol_buildpath($reldir."core/modules/cotizaciones/");

				// Load file with numbering class (if found)
				$mybool |= @include_once $dir.$file;
			}

			if ($mybool === false) {
				dol_print_error('', "Failed to include file ".$file);
				return '';
			}

			if (class_exists($classname)) {
				$obj = new $classname();
				$numref = $obj->getNextValue($this);

				if ($numref != '' && $numref != '-1') {
					return $numref;
				} else {
					$this->error = $obj->error;
					//dol_print_error($this->db,get_class($this)."::getNextNumRef ".$obj->error);
					return "";
				}
			} else {
				print $langs->trans("Error")." ".$langs->trans("ClassNotFound").' '.$classname;
				return "";
			}
		} else {
			print $langs->trans("ErrorNumberingModuleNotSetup", $this->element);
			return "";
		}
	}

	/**
	 *  Create a document onto disk according to template module.
	 *
	 *  @param	    string		$modele			Force template to use ('' to not force)
	 *  @param		Translate	$outputlangs	objet lang a utiliser pour traduction
	 *  @param      int			$hidedetails    Hide details of lines
	 *  @param      int			$hidedesc       Hide description
	 *  @param      int			$hideref        Hide ref
	 *  @param      null|array  $moreparams     Array to provide more information
	 *  @return     int         				0 if KO, 1 if OK
	 */
	public function generateDocument($modele, $outputlangs, $hidedetails = 0, $hidedesc = 0, $hideref = 0, $moreparams = null)
	{
		global $conf, $langs;

		$result = 0;
		$includedocgeneration = 1;

		$langs->load("cotizaciones@cotizaciones");

		if (!dol_strlen($modele)) {
			$modele = 'standard_cotizacion';

			if (!empty($this->model_pdf)) {
				$modele = $this->model_pdf;
			} elseif (!empty($conf->global->COTIZACION_ADDON_PDF)) {
				$modele = $conf->global->COTIZACION_ADDON_PDF;
			}
		}

		$modelpath = "core/modules/cotizaciones/doc/";

		if ($includedocgeneration && !empty($modele)) {
			$result = $this->commonGenerateDocument($modelpath, $modele, $outputlangs, $hidedetails, $hidedesc, $hideref, $moreparams);
		}

		return $result;
	}

	/**
	 * Action executed by scheduler
	 * CAN BE A CRON TASK. In such a case, parameters come from the schedule job setup field 'Parameters'
	 * Use public function doScheduledJob($param1, $param2, ...) to get parameters
	 *
	 * @return	int			0 if OK, <>0 if KO (this function is used also by cron so only 0 is OK)
	 */
	public function doScheduledJob()
	{
		global $conf, $langs;

		//$conf->global->SYSLOG_FILE = 'DOL_DATA_ROOT/dolibarr_mydedicatedlofile.log';

		$error = 0;
		$this->output = '';
		$this->error = '';

		dol_syslog(__METHOD__, LOG_DEBUG);

		$now = dol_now();

		$this->db->begin();

		// ...

		$this->db->commit();

		return $error;
	}
}


require_once DOL_DOCUMENT_ROOT.'/core/class/commonobjectline.class.php';

/**
 * Class CotizacionLine. You can also remove this and generate a CRUD class for lines objects.
 */
class CotizacionLine extends CommonObjectLine
{
	// To complete with content of an object CotizacionLine
	// We should have a field rowid, fk_cotizacion and position

	/**
	 * @var int  Does object support extrafields ? 0=No, 1=Yes
	 */
	public $isextrafieldmanaged = 0;

	/**
	 * Constructor
	 *
	 * @param DoliDb $db Database handler
	 */
	public function __construct(DoliDB $db)
	{
		$this->db = $db;
	}
}
