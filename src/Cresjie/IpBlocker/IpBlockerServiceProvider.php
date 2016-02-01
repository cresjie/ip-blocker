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
		$this->package('cresjie/ip-blocker');
		
		//$this->app['ip_blocker'] = $this->app->share(function($app){return new IpBlocker;});
		App::before(function(){
			$config = Config::get('ip-blocker::config');
			$ip = Request::getClientIp();


			if( count($config['allow_only']) ){
				if( !in_array($ip, $config['allow_only']) );
					throw new IpBlockerException($config['message']);
					
			}

			if( count($config['block']) ){
				if( !in_array($ip, $config['block']) )
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
