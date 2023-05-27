<?php
/* Copyright (C) 2017 Laurent Destailleur  <eldy@users.sourceforge.net>
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
 *   	\file       cotizacion_card.php
 *		\ingroup    cotizaciones
 *		\brief      Page to create/edit/view cotizacion
 */

//if (! defined('NOREQUIREDB'))              define('NOREQUIREDB', '1');				// Do not create database handler $db
//if (! defined('NOREQUIREUSER'))            define('NOREQUIREUSER', '1');				// Do not load object $user
//if (! defined('NOREQUIRESOC'))             define('NOREQUIRESOC', '1');				// Do not load object $mysoc
//if (! defined('NOREQUIRETRAN'))            define('NOREQUIRETRAN', '1');				// Do not load object $langs
//if (! defined('NOSCANGETFORINJECTION'))    define('NOSCANGETFORINJECTION', '1');		// Do not check injection attack on GET parameters
//if (! defined('NOSCANPOSTFORINJECTION'))   define('NOSCANPOSTFORINJECTION', '1');		// Do not check injection attack on POST parameters
//if (! defined('NOCSRFCHECK'))              define('NOCSRFCHECK', '1');				// Do not check CSRF attack (test on referer + on token).
//if (! defined('NOTOKENRENEWAL'))           define('NOTOKENRENEWAL', '1');				// Do not roll the Anti CSRF token (used if MAIN_SECURITY_CSRF_WITH_TOKEN is on)
//if (! defined('NOSTYLECHECK'))             define('NOSTYLECHECK', '1');				// Do not check style html tag into posted data
//if (! defined('NOREQUIREMENU'))            define('NOREQUIREMENU', '1');				// If there is no need to load and show top and left menu
//if (! defined('NOREQUIREHTML'))            define('NOREQUIREHTML', '1');				// If we don't need to load the html.form.class.php
//if (! defined('NOREQUIREAJAX'))            define('NOREQUIREAJAX', '1');       	  	// Do not load ajax.lib.php library
//if (! defined("NOLOGIN"))                  define("NOLOGIN", '1');					// If this page is public (can be called outside logged session). This include the NOIPCHECK too.
//if (! defined('NOIPCHECK'))                define('NOIPCHECK', '1');					// Do not check IP defined into conf $dolibarr_main_restrict_ip
//if (! defined("MAIN_LANG_DEFAULT"))        define('MAIN_LANG_DEFAULT', 'auto');					// Force lang to a particular value
//if (! defined("MAIN_AUTHENTICATION_MODE")) define('MAIN_AUTHENTICATION_MODE', 'aloginmodule');	// Force authentication handler
//if (! defined("NOREDIRECTBYMAINTOLOGIN"))  define('NOREDIRECTBYMAINTOLOGIN', 1);		// The main.inc.php does not make a redirect if not logged, instead show simple error message
//if (! defined("FORCECSP"))                 define('FORCECSP', 'none');				// Disable all Content Security Policies
//if (! defined('CSRFCHECK_WITH_TOKEN'))     define('CSRFCHECK_WITH_TOKEN', '1');		// Force use of CSRF protection with tokens even for GET
//if (! defined('NOBROWSERNOTIF'))     		 define('NOBROWSERNOTIF', '1');				// Disable browser notification
//if (! defined('NOSESSION'))     		     define('NOSESSION', '1');				    // Disable session

// Load Dolibarr environment
$res = 0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (!$res && !empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) {
	$res = @include $_SERVER["CONTEXT_DOCUMENT_ROOT"]."/main.inc.php";
}
// Try main.inc.php into web root detected using web root calculated from SCRIPT_FILENAME
$tmp = empty($_SERVER['SCRIPT_FILENAME']) ? '' : $_SERVER['SCRIPT_FILENAME']; $tmp2 = realpath(__FILE__); $i = strlen($tmp) - 1; $j = strlen($tmp2) - 1;
while ($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i] == $tmp2[$j]) {
	$i--; $j--;
}
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1))."/main.inc.php")) {
	$res = @include substr($tmp, 0, ($i + 1))."/main.inc.php";
}
if (!$res && $i > 0 && file_exists(dirname(substr($tmp, 0, ($i + 1)))."/main.inc.php")) {
	$res = @include dirname(substr($tmp, 0, ($i + 1)))."/main.inc.php";
}
// Try main.inc.php using relative path
if (!$res && file_exists("../main.inc.php")) {
	$res = @include "../main.inc.php";
}
if (!$res && file_exists("../../main.inc.php")) {
	$res = @include "../../main.inc.php";
}
if (!$res && file_exists("../../../main.inc.php")) {
	$res = @include "../../../main.inc.php";
}
if (!$res) {
	die("Include of main fails");
}

require_once DOL_DOCUMENT_ROOT.'/core/class/html.formcompany.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formprojet.class.php';
dol_include_once('/cotizaciones/class/cotizacion.class.php');
dol_include_once('/cotizaciones/lib/cotizaciones_cotizacion.lib.php');

// Load translation files required by the page
$langs->loadLangs(array("cotizaciones@cotizaciones", "other"));

// Get parameters
$id = GETPOST('id', 'int');
$ref = GETPOST('ref', 'alpha');
$action = GETPOST('action', 'aZ09');
$confirm = GETPOST('confirm', 'alpha');
$cancel = GETPOST('cancel', 'aZ09');
$contextpage = GETPOST('contextpage', 'aZ') ? GETPOST('contextpage', 'aZ') : 'cotizacioncard'; // To manage different context of search
$backtopage = GETPOST('backtopage', 'alpha');
$backtopageforcancel = GETPOST('backtopageforcancel', 'alpha');
$lineid   = GETPOST('lineid', 'int');

// Initialize technical objects
$object = new Cotizacion($db);
$extrafields = new ExtraFields($db);
$diroutputmassaction = $conf->cotizaciones->dir_output.'/temp/massgeneration/'.$user->id;
$hookmanager->initHooks(array('cotizacioncard', 'globalcard')); // Note that conf->hooks_modules contains array

// Fetch optionals attributes and labels
$extrafields->fetch_name_optionals_label($object->table_element);

$search_array_options = $extrafields->getOptionalsFromPost($object->table_element, '', 'search_');


$search_all = GETPOST("search_all", 'alpha');
$search = array();
foreach ($object->fields as $key => $val) {
	if (GETPOST('search_'.$key, 'alpha')) {
		$search[$key] = GETPOST('search_'.$key, 'alpha');
	}
}

if (empty($action) && empty($id) && empty($ref)) {
	$action = 'view';
}

// Load object
include DOL_DOCUMENT_ROOT.'/core/actions_fetchobject.inc.php'; // Must be include, not include_once.

// There is several ways to check permission.
// Set $enablepermissioncheck to 1 to enable a minimum low level of checks
$enablepermissioncheck = 0;
if ($enablepermissioncheck) {
	$permissiontoread = $user->rights->cotizaciones->cotizacion->read;
	$permissiontoadd = $user->rights->cotizaciones->cotizacion->write; // Used by the include of actions_addupdatedelete.inc.php and actions_lineupdown.inc.php
	$permissiontodelete = $user->rights->cotizaciones->cotizacion->delete || ($permissiontoadd && isset($object->status) && $object->status == $object::STATUS_DRAFT);
	$permissionnote = $user->rights->cotizaciones->cotizacion->write; // Used by the include of actions_setnotes.inc.php
	$permissiondellink = $user->rights->cotizaciones->cotizacion->write; // Used by the include of actions_dellink.inc.php
} else {
	$permissiontoread = 1;
	$permissiontoadd = 1; // Used by the include of actions_addupdatedelete.inc.php and actions_lineupdown.inc.php
	$permissiontodelete = 1;
	$permissionnote = 1;
	$permissiondellink = 1;
}

$upload_dir = $conf->cotizaciones->multidir_output[isset($object->entity) ? $object->entity : 1].'/cotizacion';

// Security check (enable the most restrictive one)
//if ($user->socid > 0) accessforbidden();
//if ($user->socid > 0) $socid = $user->socid;
//$isdraft = (isset($object->status) && ($object->status == $object::STATUS_DRAFT) ? 1 : 0);
//restrictedArea($user, $object->element, $object->id, $object->table_element, '', 'fk_soc', 'rowid', $isdraft);
if (empty($conf->cotizaciones->enabled)) accessforbidden();
if (!$permissiontoread) accessforbidden();


/*
 * Actions
 */

$parameters = array();
$reshook = $hookmanager->executeHooks('doActions', $parameters, $object, $action); // Note that $action and $object may have been modified by some hooks
if ($reshook < 0) {
	setEventMessages($hookmanager->error, $hookmanager->errors, 'errors');
}

if (empty($reshook)) {
	$error = 0;

	$backurlforlist = dol_buildpath('/cotizaciones/cotizacion_list.php', 1);

	if (empty($backtopage) || ($cancel && empty($id))) {
		if (empty($backtopage) || ($cancel && strpos($backtopage, '__ID__'))) {
			if (empty($id) && (($action != 'add' && $action != 'create') || $cancel)) {
				$backtopage = $backurlforlist;
			} else {
				$backtopage = dol_buildpath('/cotizaciones/cotizacion_card.php', 1).'?id='.((!empty($id) && $id > 0) ? $id : '__ID__');
			}
		}
	}

	$triggermodname = 'COTIZACIONES_COTIZACION_MODIFY'; // Name of trigger action code to execute when we modify record

	// Actions cancel, add, update, update_extras, confirm_validate, confirm_delete, confirm_deleteline, confirm_clone, confirm_close, confirm_setdraft, confirm_reopen
	include DOL_DOCUMENT_ROOT.'/core/actions_addupdatedelete.inc.php';

	// Actions when linking object each other
	include DOL_DOCUMENT_ROOT.'/core/actions_dellink.inc.php';

	// Actions when printing a doc from card
	include DOL_DOCUMENT_ROOT.'/core/actions_printing.inc.php';

	// Action to move up and down lines of object
	//include DOL_DOCUMENT_ROOT.'/core/actions_lineupdown.inc.php';

	// Action to build doc
	include DOL_DOCUMENT_ROOT.'/core/actions_builddoc.inc.php';

	if ($action == 'set_thirdparty' && $permissiontoadd) {
		$object->setValueFrom('fk_soc', GETPOST('fk_soc', 'int'), '', '', 'date', '', $user, $triggermodname);
	}
	if ($action == 'classin' && $permissiontoadd) {
		$object->setProject(GETPOST('projectid', 'int'));
	}

	// Actions to send emails
	$triggersendname = 'COTIZACIONES_COTIZACION_SENTBYMAIL';
	$autocopy = 'MAIN_MAIL_AUTOCOPY_COTIZACION_TO';
	$trackid = 'cotizacion'.$object->id;
	include DOL_DOCUMENT_ROOT.'/core/actions_sendmails.inc.php';
}


//print ($object->id);




include "doliclass.php";

//Recibir numero de cotizacion con get 
//$NumCotiz = $_POST['nroCotiz1'];
//var_dump($NumCotiz);


//var_dump($object);



if (!isset($NumCotiz)) {
    echo "fuck, la variable  numcotiz no esta seteada";
    # code...
}

echo "<br>";



/* 


////////////tomar datos de cotizacion para hacer invoice 
/* $object["C0Ro"]	; */
/* $object["C0Pr"]	; */
/* $object["C0Ca"]	; */
/* $object["C0Pa"]	; */
/* $object["C1Ro"]	; */
/* $object["C1Pr"]	; */
/* $object["C1Ca"]	; */
/* $object["C1Pa"]	; */
/* $object["C2Ro"]	; */
/* $object["C2Pr"]	; */
/* $object["C2Ca"]	; */
/* $object["C2Pa"]	; */
/* $object["C3Ro"]	; */
/* $object["C3Pr"]	; */
/* $object["C3Ca"]	; */
/* $object["C3Pa"]	; */
/* $object["C4Ro"]	; */
/* $object["C4Pr"]	; */
/* $object["C4Ca"]	; */
/* $object["C4Pa"]	; */
/* $object["C0As"]	; */
/* $object["C1As"]	; */
/* $object["C2As"]	; */
/* $object["C3As"]	; */
/* $object["C4As"]	; */

// CREAR Prosposal


$curl = curl_init();
$url = $Root."proposals/";
$data = array();

//$object->lines
$data["cliente"]=$object->fk_soc;
$data["date_creation"] =$object->date_creation;
//echo print '<br> dtodecreacion   ---->'.$object->date_creation.'<br>';
$data['datec']="12331212";
$data['datep']= $currentDateTime;
$data["date_creation"] =$currentDateTime;
$data["description"]= $object->description;
$data["entrega"]=  $object->entrega;
$data["fk_project"] = $object->fk_project;
$data["fk_soc"]=   $object->fk_soc;
$data["gastos"] =  $object->gastos;
$data["iva"] = $object->iva;
$data["label"]=   "detalle";//$object->label;
$data["megafon"] =  $object->megafon;
$data["note_private"] = $object->note_private;
$data["note_public"]= $object->note_public;
$data["ref"]= $object->ref;
$data["socid"]=  $object->fk_soc;
$data["status"] = $object->status;
$data["subtotal"] = $object->subtotal;
$data["total"] =  $object->total;
$data["trabajo"]= $object->trabajo;
$data["Usuario"]= $object->fk_user_creat;
	





curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$PresupuestoCreado = curl_exec($curl);
//$result = json_decode($facturaCreada,1);
curl_close($curl);

var_dump($PresupuestoCreado);



//AGREGAR LINEAS A INVOICE 





$curl = curl_init();
$url = $Root."proposals/".$PresupuestoCreado."/line";
var_dump($url);
//echo $url;

/* 
$data["array_languages"] = null;
$data["array_options"] = [];
$data["barcode_type_coder"] = null;
$data["barcode_type"] = null;
$data["canvas"] = null;
$data["contacts_ids"] = null;
$data["date_creation"] = null;
$data["date_debut_prevue"] = null;
$data["date_debut_reel"] = null;
$data["date_end"] = "";
$data["date_fin_prevue"] = null;
$data["date_fin_reel"] = null;
$data["date_modification"] = null;
$data["date_start"] = "";
$data["date_validation"] = null;
$data["demand_reason_id"] = null; */


$data["desc"] = "DESC" ;
$data["description"] = "DESCRIPTionTTTTT";
$data["desc"]= $object->description;

/* 
$data["duree"] = null;
$data["entity"] = null;
$data["fk_account"] = null;
$data["fk_bank"] = null;
$data["fk_fournprice"] = null;
$data["fk_parent_line"] = null;
$data["fk_product_type"] = null;
$data["fk_product"] = null; 
$data["fk_remise_except"] = null;
$data["fk_unit"] = null;
$data["height_units"] = null;
$data["height"] = null;
$data["import_key"] = null;
$data["label"] = null;
$data["last_main_doc"] = null;
$data["length_units"] = null;
$data["length"] = null;
$data["libelle"] = null;
$data["lines"] = null;
$data["linked_objects"] = null;
$data["linkedObjectsFullLoaded"] = [];
$data["linkedObjectsIds"] = null;
$data["multilangs"] = null;
$data["origin_id"] = null;
$data["origin"] = null;
$data["price"] = null;
$data["product_barcode"] = null;
$data["product_desc"] = null;
$data["product_label"] = null;
$data["product_ref"] = null;
$data["product_tobatch"] = null;
$data["product"] = null ;
$data["ref_ext"] = null;
$data["ref"] = null;
$data["region_id"] = null;
$data["remise"] = null;
$data["surface_units"] = null;
$data["surface"] = null;
$data["state_id"] = null;
$data["status"] = null;
$data["volume_units"] = null;
$data["volume"] = null;
$data["weight_units"] = null;
$data["weight"] = null;
$data["width_units"] = null;
$data["width"] = null;
//$data["localtax1_tx"] = "0.000" ;
//$data["localtax1_type"] = "0";
//$data["localtax2_tx"] = "0.000" ;
//$data["localtax2_type"] = "0" ;
//$data["marge_tx"] = "" ;
//$data["pa_ht"] = "0.00000000";
//$data["pa_t"] = "0.00000000" ;
//$data["remise_percent"] = "0" ;
//$data["rowid"] = "65";
//$data["special_code"] = "0" ;
//$data["total_localtax1"] = "0.00000000";
//$data["total_localtax2"] = "0.00000000";
//$data["subprice"] = "100.00000000" ;
//$data["transport_mode_id"] = null;
//$data["validateFieldsErrors"] = [];
//$data["vat_src_code"] = "";


*/


$data["fk_propal"] = "75" ;
//$data["id"] = "65";
//$data["info_bits"] = "0" ;
$data["marque_tx"] = 100 ;
$data["multicurrency_subprice"] = "100.00000000" ;
$data["multicurrency_total_ht"] = "1000.00000000";
$data["multicurrency_total_t"] = "1000.00000000" ;
$data["multicurrency_total_ttc"] = "1210.00000000" ;
$data["multicurrency_total_tva"] = "210.00000000" ;
$data["product_type"] = "0" ;
$data["qty"] = "1" ;
//$data["rang"] = "1" ;
$data["specimen"] = 0 ;
$data["subprice"]= $object->total;
$data["total_ht"] = $object->total; //"1000.00000000";
$data["total_t"] = "1000.00000000" ;
//$data["total_ttc"] = "1210.00000000";
//$data["total_tva"] = "210.00000000";
$data["tva_tx"] = "21.000";






curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$AgregarLineas = curl_exec($curl);
//$result = json_decode($facturaCreada,1);
curl_close($curl);
echo "<br>";

//echo "agregarlineas  ====>";
var_dump($AgregarLineas);


			






/* $LineasFActura = curl_exec($curl);
$LineasFActura = json_decode($cotizacion,1);
curl_close($curl);
 */



//$irA = http://localhost:8888/dolibarr/htdocs/comm/propal/card.php?id=54&save_lastsearch_values=1
$Rooo= "http://localhost/";
//echo '<script type="text/javascript"> window.location.rel="noopener" target="_blank" href = '.$Rooo.'comm/propal/card.php?id='.$AgregarLineas.'</script>';
//&save_lastsearch_values=1




if (isSet($AgregarLineas) & $AgregarLineas != null) {

		print dolGetButtonAction($langs->trans('ir al presupuesto'), '', 'default', $Rooo.'comm/propal/card.php?id='.$PresupuestoCreado, '', $permissiontoadd);
		
	
	# code...
}else{print 'algo fallo';}





?>