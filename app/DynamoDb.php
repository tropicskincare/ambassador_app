<?php

namespace App;

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

class DynamoDb
{
	private static $client;


	public static function getClient()
	{
		$sdk = new \Aws\Sdk([
		    'endpoint'   => config('dynamodb.endpoint'),
		    'region'   => 'eu-west-2',
		    'version'  => 'latest',
		    'credentials' => [
		    	'key' => config('dynamodb.access_key'),
		    	'secret' => config('dynamodb.secret_key')
		    ]
		]);

		return self::$client = $sdk->createDynamoDb();
	}


	public static function getObject($table, $id)
	{
		$marshaler = new Marshaler();

		$params = [
		    'TableName' => $table,
		    'Key' => [
		    	'id' => [
		    		'S' => (string) $id
		    	]
		    ]
		];

		try {
		    $result = self::getClient()->getItem($params);

		    return $marshaler->unmarshalItem($result['Item']);

		} catch (DynamoDbException $e) {
		    echo "Unable to get item:\n";
		    echo $e->getMessage() . "\n";
		}
	}


	public static function put($table, $key, array $data)
	{
		$marshaler = new Marshaler();

		$data['id'] = $key;

		$item = $marshaler->marshalJson(json_encode($data, true));

		$params = [
		    'TableName' => $table,
		    'Item' => $item
		];

		try {
		    $result = self::getClient()->putItem($params);

		} catch (DynamoDbException $e) {
		    echo "Unable to add item:\n";
		    echo $e->getMessage() . "\n";
		}
	}


	
}