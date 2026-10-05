<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('cms:about', function (): void {
    $this->info('MyFirtGPT Tech CMS');
})->purpose('Display CMS information');