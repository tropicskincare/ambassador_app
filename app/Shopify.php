<?php

/**
 * This class handles all communication with Shopify
 */

namespace App;

use Illuminate\Support\Facades\Cache;


class Shopify
{
	/**
	 * Which properties should be read and stored from Shopify?
	 */

	const PRODUCT_FIELDS = [];


	/**
	 * How long should we cache the products for
	 */

	const PRODUCT_CACHE_TIMEOUT = 60; // minutes


	/**
	 * How many items to return from the Shopify API
	 */

	const PRODUCT_LIMIT = 250; // 250 is the maximum


	/**
	 * Holds the instance of the SDK client
	 */

	private static $client = null;


	/**
	 * Return the full list of products available
	 * in the store
	 */

	public static function getProducts()
	{
		/**
		 * We are defining the parameters of the Shopify API call first
		 * As this gives us the ability to use them in the cache key name 
		 * 
		 * This is useful, because if we change the parameters then the cache will
		 * automatically be invalidated
		 */

		$apiCallProperties = [

			// Which fields to request 
			'fields' => join(',', self::PRODUCT_FIELDS),

			// How many records to request
			'limit' => self::PRODUCT_LIMIT,

			// Only return fully published products
			'published_status' => 'published',

			// Only return products which are published to the web channel
			'published_scope' => 'web'
		];


		/**
		 * Build the cache key name based on the values in the above properties
		 */

		$cacheName = md5(join('', array_values($apiCallProperties)));


		/**
		 * Check to see if a cache exists for this data
		 */

		if ( Cache::has($cacheName) )
		{
			/**
			 * Cache is good, return
			 */

			return Cache::get($cacheName);
		}
		else
		{
			/**
			 * Query the Shopify API for the product catalogue
			 */

			$shopifyProducts = self::getClient()->Product->get($apiCallProperties);


			/**
			 * Iterate through and use the Shopify product ID as the key to the array
			 * This is for easy referencing in future.
			 * We also find the correct price for the product and build a URL to the shopfront
			 */

			$products = [];

			foreach ( $shopifyProducts as $p )
			{
				$lowestPrice = null;
				$fixedPrice = null;


				/**
				 * Find the correct price to show for this product
				 */

				if ( count($p['variants']) > 1 )
				{
					/**
					 * Multiple variants available. Let's find the lowest price
					 */

					foreach ( $p['variants'] as $variant )
					{
						if ( null === $lowestPrice || $variant['price'] < $lowestPrice )
						{
							$lowestPrice = $variant['price'];
						}
					}
				}
				else
				{
					/**
					 * There is only a single variant of this product
					 */

					$fixedPrice = $p['variants'][0]['price'] ?? 0;
				}

				
				/**
				 * Build array of return products
				 */

				$products[$p['id']] = $p + [

					'lowest_price' => $lowestPrice,
					'fixed_price' => $fixedPrice,

					// Add the URL for easy referencing
					'url' => config('services.shopify.shop_url') . '/products/' . $p['handle'],
				
				];
			}


			/**
			 * Send to cache
			 */

			Cache::put($cacheName, $products, now()->addMinutes(self::PRODUCT_CACHE_TIMEOUT));

			return $products;
		}

	}


	/**
	 * Get the instance of the Shopify client API
	 */

	private static function getClient()
	{
		if ( null !== self::$client )
		{
			/**
			 * Client is already initialised
			 */

			return self::$client;
		}


		/**
		 * Initialise and return the client
		 */

		return self::$client = \PHPShopify\ShopifySDK::config([
			'ShopUrl' => config('services.shopify.url'),
		    'ApiKey' => config('services.shopify.key'),
		    'Password' => config('services.shopify.password'),
		]);
	}



	public static function createDraftOrder(array $data)
	{
		$return = self::getClient()->DraftOrder->post([
			'name' => "Ed's Test Draft Order",
			'customer_id' => '3190177759285',
			'email' => 'ed@behindthedot.com',
			'line_items' => [
				[
					'quantity' => 1,
					'product_id' => '29352',
			//		'name' => 'Test Product',
					'title' => 'Test Product',
					'price' => 2.00

				]
			]
		]);

		echo '<pre>';
		print_r($return);exit;


	}
}