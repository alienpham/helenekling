<?php

jClasses::inc('jPicasa~Album');
jClasses::inc('jPicasa~Image');
jClasses::inc('jPicasa~Video');

jClasses::inc('jPicasa~Painting');


function contains($str, $content, $ignorecase=true){
    if ($ignorecase){
        $str = strtolower($str);
        $content = strtolower($content);
    }  
    return strpos($content,$str) ? true : false;
}

class jPicasa {
	
	var $user = "hk.painter@gmail.com";
	var $pass = "3,14kSSo";
		
	
	
	
	protected function connect(){
		Zend_Loader :: loadClass('Zend_Gdata_Photos');
		Zend_Loader :: loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader :: loadClass('Zend_Gdata_AuthSub');
		
		$serviceName = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
		
		$client = Zend_Gdata_ClientLogin::getHttpClient($this->user, $this->pass, $serviceName);

		// update the second argument to be CompanyName-ProductName-Version
		$gp = new Zend_Gdata_Photos($client, "Google-DevelopersGuide-1.0");
		return $gp;
    	
    }
    function albums(){
    	$gp = $this->connect();
   		try {
    		$userFeed = $gp->getUserFeed("default");
    		foreach ($userFeed as $userEntry) {
    			$album = new Album();
        		$album->name = $userEntry->title->text;
        		$album->id = $userEntry->getGphotoId() ;
        		$mediaThumbnailArray = $userEntry->getMediaGroup()->getThumbnail();
        		$album->thumbnailUrl = $mediaThumbnailArray[0]->getUrl();
        		$albums[] = $album;
    		}
		} catch (Zend_Gdata_App_HttpException $e) {
    		echo "Error: " . $e->getMessage() . "<br />\n";
    	if ($e->getResponse() != null) {
        	echo "Body: <br />\n" . $e->getResponse()->getBody() . 
            	 "<br />\n"; 
    	}
  
		} catch (Zend_Gdata_App_Exception $e) {
    			echo "Error: " . $e->getMessage() . "<br />\n"; 
		}
		return $albums;
   	}
   	function images($albumId,$thumbnailSize = 800){
   		$gp = $this->connect();
   		$query = $gp->newAlbumQuery();
		$query->setUser("default");
		$query->setAlbumId($albumId);
		$query->setThumbsize($thumbnailSize); 
		$query->setKind("photo");
		
	
		$albumFeed = $gp->getAlbumFeed($query);
	
		foreach ($albumFeed as $photoEntry) {
	
			$pos = strpos($photoEntry->title->text, ".mov");
			if($pos === false){
			$image = new Image();
			$albumId = $photoEntry->getGphotoAlbumId()->getText();
			$photoId = $photoEntry->getGphotoId();

			if ($photoEntry->getExifTags() != null && 
		    	$photoEntry->getExifTags()->getMake() != null &&
		    	$photoEntry->getExifTags()->getModel() != null) {

		    	$camera = $photoEntry->getExifTags()->getMake()->getText() . " " . 
		              $photoEntry->getExifTags()->getModel()->getText();
		              echo $photoEntry->getExifTags()->getText();
			}

			if ($photoEntry->getMediaGroup()->getContent() != null) {
		  		$mediaContentArray = $photoEntry->getMediaGroup()->getContent();
		  		$contentUrl = $mediaContentArray[0]->getUrl();
			}

			if ($photoEntry->getMediaGroup()->getThumbnail() != null) {
				$mediaThumbnailArray = $photoEntry->getMediaGroup()->getThumbnail();
		  		$firstThumbnailUrl = $mediaThumbnailArray[0]->getUrl();
			}
			
			$image->id=$photoId;
			
			$image->url = $firstThumbnailUrl;
		   	$image->height = $photoEntry->getGphotoHeight();
			$image->width = $photoEntry->getGphotoWidth();
			
    		$image->name = $photoEntry->title->text;
    		$images[] = $image;
			}
		}	
  		return $images;	
   	}
	
   	function lastImages($n = 3,$thumbnailSize = 200){
   		
   		$gp = $this->connect();
   		
    	
    	$query = $gp->newUserQuery();
    	$query->setUser("default");
		$query->setKind("photo");
		if($n!=0)
			$query->setMaxResults($n);
			
		$query->setThumbsize($thumbnailSize); 
		
		
		$userFeed = $gp->getUserFeed(null, $query);
		foreach ($userFeed as $photoEntry) {
			$image = new Image();
			$albumId = $photoEntry->getGphotoAlbumId()->getText();
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
			
			$image->url = $firstThumbnailUrl;
		   	$image->height = $photoEntry->getGphotoHeight();
			$image->width = $photoEntry->getGphotoWidth();
			
    		$image->name = $photoEntry->title->text;
    		$images[] = $image;
		}	
  		return $images;
			
   	}
   	function search($name,$thumbSize){
   		$images = array();
   		foreach($this->lastImages(3000) as $img){
   			$paintName=strtolower($img->name);
   			$name2 = strtolower($name);
   			$pos = strpos($paintName,$name2) ;
   			if($pos === false){}
   			else{
   				$images[$img->name] = $img;
   			}
   		}
   		
   		return $images;
   	}
   	function getAlbumById($id)
   	{
   		foreach ($this->albums() as $alb ) {
   			if($alb->id == $id){
   				$album = $alb;
   				break;
   			}
   		}
       return $album;
   	}
	function addComment($com,$photoid,$albumId){
		
			$service = $this->connect();
			
			//$this->viewComments($photoid,$albumId);
			
			$entry = new Zend_Gdata_Photos_CommentEntry();
			
			$entry->setTitle($service->newTitle("COMENTAIRE : "));
			$entry->setContent($service->newContent($com));
			
			$photoQuery = $service->newPhotoQuery();
			$photoQuery->setUser("default");
			$photoQuery->setAlbumName("Nude");
			$photoQuery->setPhotoId($photoid);
			$photoQuery->setType('entry');
			
			$photoEntry = $service->getPhotoEntry($photoQuery);
			
			$service->insertCommentEntry($entry, $photoEntry);
			
	}	
   	function getComments($photoid,$albumId){
   		$gp = $this->connect();
			
   		$query = $gp->newPhotoQuery();

		$username = "default";
		
		// indicate the user's data to retrieve
		$query->setUser($username);
		$query->setAlbumId($albumId);
		$query->setPhotoId($photoid);
		
		// set to only return comments 
		$query->setKind("comment");
		$query->setMaxResults("10");
		
		$photoFeed = $gp->getPhotoFeed($query);
		
		// because we specified 'comment' for the kind, only CommentEntry objects 
		// will be contained in the UserFeed
		$coms = array();
		foreach ($photoFeed as $commentEntry) {
		    $com = explode("@", $commentEntry->content->text);
		    $coms[] = $com;
		}
		return $coms;
   	}
	
}
?>