<?php
require_once 'Zend/Loader.php';

Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');

$serviceName = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
$user = "hk.painter@gmail.com";
$pass = "3,14kSSo";

$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $serviceName);

// update the second argument to be CompanyName-ProductName-Version
$gp = new Zend_Gdata_Photos($client, "Google-DevelopersGuide-1.0");

// In version 1.5+, you can enable a debug logging mode to see the
// underlying HTTP requests being made, as long as you're not using
// a proxy server
// $gp->enableRequestDebugLogging('/tmp/gp_requests.log');



//Header("Content-type: text/xml");

class Image {
	var $id;
	var $name;
	var $url;
	var $photoId;
	var $height;
	var $width;
}


try {
		$query = $gp->newUserQuery();
		$query->setThumbsize("800"); 
		

    	$userFeed = $gp->getUserFeed(null, $query);
		
		
    foreach ($userFeed as $photoEntry) {
		if($photoEntry instanceof Zend_Gdata_Photos_AlbumEntry)
			echo "ALBUMM !!!!";
		els
		$image = new Image();
		
		$albumId = $photoEntry->getGphotoAlbumId()->getText();
		$albumName = $photoEntry->getGphotoAlbum()->getText();
		$photoId = $photoEntry->getGphotoId()->getText();

		if ($photoEntry->getExifTags() != null && 
		    $photoEntry->getExifTags()->getMake() != null &&
		    $photoEntry->getExifTags()->getModel() != null) {

		    $camera = $photoEntry->getExifTags()->getMake()->getText() . " " . 
		              $photoEntry->getExifTags()->getModel()->getText();
		}

		if ($photoEntry->getMediaGroup()->getContent() != null) {
		  $mediaContentArray = $photoEntry->getMediaGroup()->getContent();
		  $contentUrl = $mediaContentArray[0]->getUrl();
		}

		if ($photoEntry->getMediaGroup()->getThumbnail() != null) {
		  $mediaThumbnailArray = $photoEntry->getMediaGroup()->getThumbnail();
		  $firstThumbnailUrl = $mediaThumbnailArray[0]->getUrl();
		}
			
			$image->id=  $photoId;
			$image->name =$photoEntry->title->text ;
			
			$image->url = $firstThumbnailUrl;
		   	$image->height = $photoEntry->getGphotoHeight();
			$image->width = $photoEntry->getGphotoWidth();
		$albums[$albumName][] = $image;
		
	
    	}
} catch (Zend_Gdata_App_HttpException $e) {
    echo "Error: " . $e->getMessage() . "<br >\n";
    if ($e->getResponse() != null) {
        echo "Body: <br />\n" . $e->getResponse()->getBody() . 
             "<br />\n"; 
    }
} catch (Zend_Gdata_App_Exception $e) {
    echo "Error: " . $e->getMessage() . "<br />\n"; 
}

	foreach($albums as $album){
		
		foreach($album as $img){
			echo $img->name.'<br>';
		}
	}



?>
