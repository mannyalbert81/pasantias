 <?php 
 phpinfo();
 require_once ( "http: //localhost:8080/JavaBridge/java/Java.inc");
 echo java ( "java.lang.System")->getProperties (); 
 ?>