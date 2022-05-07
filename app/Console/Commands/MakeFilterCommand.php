<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeFilterCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:filter {filter}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Creating a new filter';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle(Filesystem $fileSystem)
	{
		$filter = $this->argument('filter');

		if ($filter == '' || is_null($filter) || empty($filter)) {
			return $this->error('Filter name error!');
		}

		$structure = '<?php

namespace App\Http\Filters;

class ' . $filter . ' implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return \'name\';
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @param  mixed $value
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder, $value)
	{
		return $builder;
	}
}';

		$dir = app_path() . '/Http/Filters';
		$file = $dir . '/' . $filter . '.php';

		if ($fileSystem->isDirectory($dir)) {
			if ($fileSystem->isFile($file)) {
				return $this->error('File already exitsts!');
			}
			if (!$fileSystem->put($file, $structure)) {
				return $this->error('Something went wrong!');
			}
			$this->info("$filter generated!");
		} else {
			$fileSystem->makeDirectory($dir, 0777, true, true);

			if (!$fileSystem->put($file, $structure)) {
				return $this->error('Something went wrong!');
			}
			$this->info("$filter generated!");
		}
	}
}
