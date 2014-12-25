<?php namespace Aracademia\Dbbackup;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class DbbackupServiceProvider extends ServiceProvider {

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
		$this->app['Dbbackup'] = $this->app->share(function($app)
		{
			$filesystem = $this->app->make('Illuminate\Filesystem\Filesystem');
			return new Dbbackup($filesystem);
		});

		$this->app->booting(function()
		{
			AliasLoader::getInstance()->alias('Dbbackup', 'Aracademia\Dbbackup\Facades\DbbackupFacade');
		});
	}

	public function boot()
	{
		$this->package('Aracademia/Dbbackup');
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
