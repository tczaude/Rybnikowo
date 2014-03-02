
<?php

require_once('../config/config.php');

require_once($__CFG['base_path'].'/config/db.php');
require_once($__CFG['base_path'].'/config/mail.php');
require_once($__CFG['base_path'].'/config/smarty_admin.php');

require_once('database.class.php');
global $DBM;
$DBM = new DBManager($__DB_CFG['uri']);
$kind_id = $_POST['kind_id'];
$serie_id = $_POST['serie_id'];
$type_id = $_POST['type_id'];

if(!empty($kind_id)) {

	// Cechy produktów
	require_once('../models/Feature.class.php');
	$feature = new Feature();
	//wyciagamy rodzica
	require_once('../models/Kind.class.php');
	$kind = new Kind();
	$parent_details = $kind->getGroup($kind_id);	
	$feature_list = $feature->createMenuCategoriesToViewForCategory($parent_details['parent'], 0);

	
	echo '<option selected="selected">- wybierz cechę -</option>';
	if($feature_list){

		foreach($feature_list as $feature){
			
			if($feature['id'] == $type_id){
				echo '<option selected="" value="'.$feature['id'].'">'.$feature['name'].'</option>';
			}
			else{

				echo '<option value="'.$feature['id'].'">'.$feature['name'].'</option>';
				
			}

		}
	}
	else{
		
		//echo '<option selected="selected">- wybierz serię -</option>';
		
	}
}
else{
	
	echo '<option selected="selected">- wybierz cechę -</option>';
	
}
	    
?>