# InventorySystem
setup data base connection:

inventorySystem/model/model.php

Add project domain name in apache/conf/extra/httpd-vhosts.conf:

<VirtualHost 127.0.0.1>
    DocumentRoot "<--project path-->\public"
    ServerName www.inventory-system.local
	ServerAlias inventory-system.local
</VirtualHost>

Add this in C:\Windows\System32\drivers\etc\hosts file:
127.0.0.1 	localhost
127.0.0.1 	inventory-system.local 
