<?php

namespace App;

class DataDocument
{
	public static function get($name)
	{
		$result = DynamoDb::getObject(config('dynamodb.portal_table'), $name);

		return $result;
	}
}