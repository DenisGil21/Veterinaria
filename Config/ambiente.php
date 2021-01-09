<?php 

//AMBIENTE DE PRODUCCION
/*
define("WSDL_PATH", "https://app33.advans.mx/ws/awscfdi.php?wsdl");
define("GENERADOR_PATH", "/var/www/html/scolarsoft/empresas/");
define("BASE_PATH", "https://scolarsoft.com/");
define("WSDL_CANCEL_PATH", "https://app33.advans.mx/cfdi-cancelacion/soap?wsdl");
*/

//AMBIENTE TESTING
define("WSDL_PATH", "https://dev.advans.mx/ws/awscfdi.php?wsdl");
define("GENERADOR_PATH", "/var/www/html/scolarsoft/testing/empresas/");
define("BASE_PATH", "https://scolarsoft.com/testing");
define("WSDL_CANCEL_PATH", "https://dev.advans.mx/cfdi-cancelacion/soap?wsdl");

//AMBIENTE DE DEMO
/*
define("WSDL_PATH", "https://dev.advans.mx/ws/awscfdi.php?wsdl");
define("GENERADOR_PATH", "/var/www/html/scolarsoft/demo/empresas/");
define("BASE_PATH", "https://scolarsoft.com/demo");
define("WSDL_CANCEL_PATH", "https://dev.advans.mx/cfdi-cancelacion/soap?wsdl");
*/
?>