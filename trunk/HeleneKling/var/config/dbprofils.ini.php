;<?php die(''); ?>
;for security reasons, don't remove or modify the first line

; name of the default profile to use for any connection
;default = myapp
default = local_mac

; each section correspond to a connection
; the name of the section is the name of the connection, to use as an argument
; for jDb and jDao methods
; Parameters in each sections depends of the driver type

[myapp]

; the driver name : mysql, pgsql, pdo, sqlite...
driver="mysql"

; For the most of drivers:
database="db179817164"
host= "db200.1and1.fr"
user= "dbo179817164"
password=4S5Rba6F
persistent= on

; when you have charset issues, enable force_encoding so the connection will be
; made with the charset indicated in jelix config
;force_encoding = on

; with the following parameter, you can specify a table prefix which will be
; applied to DAOs automatically. For manual jDb requests, please use method
; jDbConnection::prefixTable().
;table_prefix =

; Example for pdo :
;driver=pdo
;dsn=mysql:host=localhost;dbname=test
;user=
;password=
force_encoding=on
[local]

; the driver name : mysql, pgsql, pdo, sqlite...
driver="mysql"

; For the most of drivers:
database="helenekling"
host= "localhost"
user= "root"
password=zeroun
persistent= on
force_encoding=on


[local_mac]

; the driver name : mysql, pgsql, pdo, sqlite...
driver="mysql"

; For the most of drivers:
database="helenekling"
host= "localhost"
user= "root"
password=root
persistent= on
force_encoding=on
