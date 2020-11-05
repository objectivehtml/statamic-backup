<?php

use Gitonomy\Git\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Statamic\Facades\Entry;
use Statamic\Facades\Collection;

Route::name('utilities.git-backup.init')->post('utilities/git-backup/init', function() {
    if(app('statamic.backup.git')->isBare()) {
        Admin::init(config('backup.git.path', base_path()), false);
    }


    return redirect()->to('cp/utilities/git-backup');
});