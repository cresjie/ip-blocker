<?php namespace Cresjie\IpBlocker;

use Illuminate\Support\ServiceProvider;


use App;
use Request;
use Config;
use Exception;

class IpBlockerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
		
	}

	
	public function boot()
	{
		$this->publishes([
			__DIR__. '/../config/block-ip.php' => config_path('cresjie/block-ip.php')
		]);

		App::booted(function(){

			$config = Config::get('cresjie.block-ip');
			$ip = Request::getClientIp();



			if( count($config['allow_only']) ){
				if( !in_array($ip, $config['allow_only']) );
					throw new IpBlockerException($config['message']);
					
			}

			if( count($config['block']) ){
				if( in_array($ip, $config['block']) )
					throw new IpBlockerException($config['message']);
			}
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
