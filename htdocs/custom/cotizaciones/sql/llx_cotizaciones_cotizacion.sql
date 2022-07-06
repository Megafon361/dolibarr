-- Copyright (C) ---Put here your own copyright and developer email---
--
-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see https://www.gnu.org/licenses/.


CREATE TABLE llx_cotizaciones_cotizacion(
	-- BEGIN MODULEBUILDER FIELDS
	rowid integer AUTO_INCREMENT PRIMARY KEY NOT NULL, 
	ref varchar(128) DEFAULT '(PROV)' NOT NULL, 
	Usuario integer, 
	fk_soc integer, 
	trabajo varchar(128), 
	fk_project integer, 
	description text, 
	note_public text, 
	entrega date NOT NULL, 
	label varchar(255), 
	note_private text, 
	gastos varchar(128), 
	megafon varchar(128), 
	subtotal varchar(128), 
	iva varchar(128), 
	total varchar(128), 
	date_creation datetime NOT NULL, 
	tms timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
	fk_user_creat integer NOT NULL, 
	fk_user_modif integer, 
	last_main_doc varchar(255), 
	import_key varchar(14), 
	model_pdf varchar(255), 
	status integer NOT NULL, 
	C0Ro integer, 
	C0Pr varchar(128), 
	C0Ca varchar(128), 
	C0Pa varchar(128), 
	C1Ro varchar(128), 
	C1Pr varchar(128), 
	C1Ca varchar(128), 
	C1Pa varchar(128), 
	C2Ro varchar(128), 
	C2Pr varchar(128), 
	C2Ca varchar(128), 
	C2Pa varchar(128), 
	C3Ro varchar(128), 
	C3Pr varchar(128), 
	C3Ca varchar(128), 
	C3Pa varchar(128), 
	C4Ro varchar(128), 
	C4Pr varchar(128), 
	C4Ca varchar(128), 
	C4Pa varchar(128), 
	C0As integer, 
	C1As integer, 
	C2As integer, 
	C3As integer, 
	C4As integer
	-- END MODULEBUILDER FIELDS
) ENGINE=innodb;
