<?php


	/**
	 * @author Steve King <steve@stevenking.com.au>
	 *
	 * Initial release.
	 */

	class kmlHandler {
		
		function __construct() {
			
		}
		
		public function kmlLoadString($String = NULL) {
			try {
				$KML = simplexml_load_string($String);
				if ( is_object($KML) ) {
					$this->Document = $KML->Document;
					// See https://help.sming.co/display/DerKarte/KML+Structure
				}
			} catch ( Exception $e ) {
				throw new Exception ( 'Could not load string. Are you sure it is valid KML?', 0,$e);
			}
			return false;
		}
		
		public function folders() {
			// Folder - can contain folders and placemarks
			if ( isset($this->Document->Folder) && is_array($this->Document->Folder) ) {
				// Ok, do folders!
				foreach ( $this->Document->Folder as &$theFolder ) {
					$this->_folders[] = &$theFolder;
				}
				return @count($this->_folders)-1;
			}
			elseif ( isset($this->Document->Folder) ) {
				$this->_folders[] = &$theFolder;
				return 1;
			}
			return 0;
		}
		
		public function outputTSV($IgnoreFolders = NULL) {
			$theOutput = "";
			if ( isset($this->Document) ) {
				// Go into each folder
				if ( isset($this->Document->Folder) && !is_array($this->Document->Folder) ) {
					$this->tsvFolder($this->Document->Folder,$theOutput);
				}
			}
			return false;
		}
		
		public function tsvFolder(&$Folder = NULL, &$Output = NULL) {
			if ( isset($Folder) ) {
				$thisFolder = (string)$Folder->name;
				if ( isset($Folder->Placemark) ) {
					foreach ( $Folder->Placemark as &$thePlacemark) {
					}
				}
			}
			
			return false;
		}
		
	}