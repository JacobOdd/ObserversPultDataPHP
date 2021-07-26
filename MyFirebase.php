<?php 

namespace ZOV;

require('vendor/autoload.php');

use Google\Cloud\Firestore\FirestoreClient;

class MyFirebase {

	private $collection;

	public function __construct($path) {
		$firestore = new FirestoreClient([
			"projectId" => "publicobserver-8767b",
			"keyFile" => json_decode(file_get_contents($path), true)
		]);

	    $this->collection = $firestore->collection('ppk');
	}

	public function setDocument($ppk_id,$address,$isOn,$number_object,$latitude,$longitude,$type_pult,$timestamp) {
		try {
			$ppk = $this->collection->document($type_pult."_".$ppk_id);

			$ppk->set([
				'address' => $address,
				'isOn' => $isOn,
				'latitude' => $latitude,
				'longitude' => $longitude,
				'number_object' => $number_object,
				'ppk_id' => $ppk_id,
				'type_pult' => $type_pult,
				'timestamp' => $timestamp
			]
			);
		} catch (Throwable $t) {
		   // Executed only in PHP 7, will not match in PHP 5
			return false;
		} catch (Exception $e) {
		   // Executed only in PHP 5, will not be reached in PHP 7
			return false;
		}

		return true;
	}

	public function deleteDocument($timestamp) {
		try {
			$query = $this->collection->where('timestamp', '<=',$timestamp);
			$documents = $query->documents();

			foreach ($documents as $document) {
				if ($document->exists()) {
					$ppk = $this->collection->document($document->data()["type_pult"]."_".$document->data()["ppk_id"]);
					$ppk->delete();
				}
			}

		} catch (Throwable $t) {
		   // Executed only in PHP 7, will not match in PHP 5
			return false;
		} catch (Exception $e) {
		   // Executed only in PHP 5, will not be reached in PHP 7
			return false;
		}

		return true;
	}

}

