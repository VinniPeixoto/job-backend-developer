<?php

namespace App\Console\Commands;

use App\Services\Products\ImportProductsByExternalApiService;
use Illuminate\Console\Command;

class ImportProductsCommand extends Command
{
    private ImportProductsByExternalApiService $importProductsByExternalApiService;

    /**
     * @param ImportProductsByExternalApiService $importProductsByExternalApiService
     */
    public function __construct(ImportProductsByExternalApiService $importProductsByExternalApiService)
    {
        parent::__construct();
        $this->importProductsByExternalApiService = $importProductsByExternalApiService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Products through another api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $id = $this->option('id');
            if (!$id) {
                $this->error('Please enter any id for import. Ex: "php artisan products:import --id=1"');
                die();
            }
            $this->info('Starting import product from fakestoreapi');
            $product = $this->importProductsByExternalApiService->run($id);
            $this->info("Import product '{$product->name}' completed successful");
        } catch (\Exception $exception) {
            $this->error("{$exception->getMessage()} \n");
        }
    }
}
