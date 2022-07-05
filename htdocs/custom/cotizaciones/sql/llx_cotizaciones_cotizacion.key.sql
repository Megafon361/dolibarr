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


-- BEGIN MODULEBUILDER INDEXES
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_rowid (rowid);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_ref (ref);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_fk_soc (fk_soc);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_fk_project (fk_project);
ALTER TABLE llx_cotizaciones_cotizacion ADD CONSTRAINT llx_cotizaciones_cotizacion_fk_user_creat FOREIGN KEY (fk_user_creat) REFERENCES llx_user(rowid);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_status (status);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_C0Ro (C0Ro);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_C1Ro (C1Ro);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_C2Ro (C2Ro);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_C3Ro (C3Ro);
ALTER TABLE llx_cotizaciones_cotizacion ADD INDEX idx_cotizaciones_cotizacion_C4Ro (C4Ro);
-- END MODULEBUILDER INDEXES

--ALTER TABLE llx_cotizaciones_cotizacion ADD UNIQUE INDEX uk_cotizaciones_cotizacion_fieldxy(fieldx, fieldy);

--ALTER TABLE llx_cotizaciones_cotizacion ADD CONSTRAINT llx_cotizaciones_cotizacion_fk_field FOREIGN KEY (fk_field) REFERENCES llx_cotizaciones_myotherobject(rowid);

