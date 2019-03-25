#!/bin/bash
echo ">>> restore bdd fw"
# restore
cat fw.sql | /usr/bin/mysql -u root --password=rootpassword fw