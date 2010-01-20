<?php
class OnDiskVideosService {

	private function listVideos($rep = './videos') {
	
		if ($handle = opendir($rep)) {
			while (false !== ($file = readdir($handle))) {
				$files[] = $file;
			}
			closedir($handle);
		}
		return $files;
	}
	function getVideo($albumName){
		$videoFile = null;
		foreach($this->listVideos() as $vid){
			$vidName = strtolower($vid);
			$albName = strtolower($albumName);
			
			$pos = strpos($vidName,$albName) ;
			if($pos === false){}
			else{
				$videoFile = $vid;
				break;
			}
		}
		if($videoFile != null)
			return new Video($videoFile);
		else
			return null;
	}
	function randomVideo(){
		$videoFiles = array();
		$nb_files = 0;
		foreach($this->listVideos() as $vid){
			$vidName = strtolower($vid);
			$pos = strpos($vidName,".flv") ;
			if($pos === false){}
			else{
				$videoFiles[] = $vid;
				$nb_files++;
			}
		}
		if($nb_files>0)
			return new Video($videoFiles[rand(0, $nb_files-1)]);
		else return null;
	}

}