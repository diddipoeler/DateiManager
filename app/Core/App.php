<?php

declare(strict_types=1);

namespace App\Core;

final class App
{
    public function __construct(private readonly Request $request = new Request())
    {
    }

    public function run(): void
    {
        View::render('layout', [
            'title' => Config::APP_NAME,
            'version' => Config::VERSION,
            'currentPath' => '/',
            'view' => $this->request->query('view', 'grid'),
            'search' => $this->request->query('search'),
        ]);
    }
}
