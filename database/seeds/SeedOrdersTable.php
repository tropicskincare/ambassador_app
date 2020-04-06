<?php

use Illuminate\Database\Seeder;

class SeedOrdersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfOrdersToCreate = 100000;



        $customers = \App\Customer::all();
        $customerCount = count($customers);

        $channels = [
            'web',
            'ambassador',
            'party'
        ];

        $productsFile = [
            'products-1.json'
        ];

        $products = json_decode(file_get_contents(__DIR__ . '/data/products-1.json'));

        for ( $i=0; $i<$numberOfOrdersToCreate; $i++ )
        {
            $shipping = rand(250, 450) / 100;
            $numItems = rand(1, 10);
            $channel = $channels[rand(0, count($channels)-1)];
            $customer = $customers[rand(0, $customerCount -1)];


            while ( true )
            {
                $createdTs = rand(1364953078, time());

                if ( checkdate(date('m', $createdTs), date('d', $createdTs), date('Y', $createdTs)) == true )
                {
                    break;
                }
            }
            

            $items = [];
            $subTotal = 0;

            for ( $j=0; $j<$numItems; $j++ )
            {
                $product = $products[rand(0, count($products)-1)];
                $qty = rand(1, 3);

                $items[] = [
                    'quantity' => $qty,
                    'name' => $product->name,
                    'unit_price' => $product->price,
                    'total_price' => $product->price * $qty
                ];

                $subTotal += $product->price * $qty;
            }

            try
            {

                $order = \App\Order::create([
                    'user_id' => '5dc395df-376c-41be-a739-6fc13584e143',
                    'customer_id' => $customer->id,
                    'customer_name' => $customer->getName(),
                    'status' => 'complete',
                    'channel' => $channel,
                    'subtotal' => $subTotal,
                    'shipping' => $shipping,
                    'total' => $subTotal + $shipping,
                    'created_at' => date('Y-m-d H:i:s', $createdTs),
                    'updated_at' => date('Y-m-d H:i:s', $createdTs)
                ]); 

                \App\DynamoDb::put(config('dynamodb.portal_table'), 'order:' . $order->id, [
                    'id' => $order->id,
                    'user' => [
                        'id' => '5dc395df-376c-41be-a739-6fc13584e143'
                    ],
                    'customer' => array_filter($customer->toArray(), function($v)
                        {
                            return '' != $v;

                        }),
                    'items' => $items
                ]);
            }
            catch ( \Exception $e )
            {
                echo $e->getMessage()."\n";
                
            }

        } 
    }
}
