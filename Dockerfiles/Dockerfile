FROM tuxgasy/dolibarr

# Copiar el archivo de respaldo a la imagen del contenedor
COPY c1481397_doliba.struct.sql /backup/c1481397_doliba.struct.sql
COPY c1481397_doliba.struct.sql /backup/c1481397_doliba.data.sql

# Verificar si la base de datos ya existe
RUN mysql -h mariadb -u root -p root -e "USE dolibarr" 2>/dev/null || \
    (echo "La base de datos dolibarr no existe. Creando base de datos..." && \
    mysql -h mariadb -u root -p root -e "CREATE DATABASE dolibarr")

# Ejecutar el comando para cargar el archivo de respaldo en la base de datos
RUN mysql -h mariadb -u root -p root dolibarr < /backup/c1481397_doliba.struct.sql
RUN mysql -h mariadb -u root -p root dolibarr < /backup/c1481397_doliba.data.sql
