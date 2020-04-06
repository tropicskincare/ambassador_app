<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Order extends Model
{
	use Uuid;

	/**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [	
    	'customer_id', 
    	'party_id', 
    	'customer_name', 
    	'status', 
    	'user_id', 
    	'channel'
    ];
    

    /**
     * 
     */



	public function customer()
	{
		return $this->belongsTo('\App\Customer');
	}


	public function getDocument()
	{
		$result = DynamoDb::getObject(config('dynamodb.portal_table'), 'order:' . $this->id);

		return $result;
	}


}
