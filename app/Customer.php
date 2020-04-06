<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Support\Facades\Auth;


class Customer extends Model
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
     * Search through the customers by name and email
     */

    public static function search($query)
    {
        /**
         * Split the query string by words
         */

        $words = preg_split("/\s+/", $query);


        /**
         * Start the model
         */

        $model = \App\Customer::where([]);


        /**
         * Itterate through the words and build the where query
         */

        foreach ( $words as $w )
        {
            $wheres = [];

            foreach ( ['firstname', 'lastname', 'email'] as $field )
            {
                $wheres[] = [
                    $field,
                    'like',
                    '%'.$w.'%',
                    'or'
                ];
            }

            $model->where($wheres);
        }


        /**
         * Run and return the query
         */

        return $model->get();
    }


    /**
     * 
     */

    public function createOrder()
    {
        $order = \App\Order::create([
            'customer_id' => $this->id,
            'customer_name' => $this->getName(),
            'channel' => 'ambassador',
            'user_id' => Auth::user()->id
        ]);


        /**
         * Create the document
         */

        \App\DynamoDb::put(config('dynamodb.portal_table'), 'order:' . $order->id, [
            'id' => $order->id,
            'user' => array_filter(Auth::user()->toArray(), function($v)
                {
                    return '' != $v;

                }),
            'customer' => array_filter($this->toArray(), function($v)
                {
                    return '' != $v;

                }),
            'items' => []
        ]);


        return $order;

    }
    

    /**
     * 
     */

    public function getName()
    {
    	return $this->firstname . ' ' . $this->lastname;
    }


    /**
     * 
     */

    public function orders()
    {
    	return $this->hasMany('\App\Order');
    }
}
