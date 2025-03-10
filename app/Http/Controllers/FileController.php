<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $repository = $request->repository;
        $branch = $request->branch;
        $path = $request->path;
        $body = $request->body;
        $fullpath = base_path("data/branches/{$repository}/{$branch}/{$path}");
        $paths = explode('/', $fullpath);
        array_pop($paths);
        if (count($paths) > 0) {
            $dir = implode('/', $paths);
            is_dir($dir) or mkdir($dir, 0755, true);
        }
        file_put_contents($fullpath, $body);
        return redirect("repository/{$repository}/branch/{$branch}");
    }

    public function create(Request $request)
    {
        $repository = $request->repository;
        $branch = $request->branch;
        return view('file/create', compact('repository', 'branch'));
    }

    public function update(Request $request)
    {
        $repository = $request->repository;
        $branch = $request->branch;
        $old = $request->old;
        $path = $request->path;
        $body = $request->body;
        $fullold = base_path("data/branches/{$repository}/{$branch}/{$old}");
        $fullpath = base_path("data/branches/{$repository}/{$branch}/{$path}");
        exec("rm {$fullold}");
        $paths = explode('/', $fullpath);
        array_pop($paths);
        if (count($paths) > 0) {
            $dir = implode('/', $paths);
            is_dir($dir) or mkdir($dir, 0755, true);
        }
        file_put_contents($fullpath, $body);
        return redirect("repository/{$repository}/branch/{$branch}");
    }

    public function destroy(Request $request)
    {
        $repository = $request->repository;
        $branch = $request->branch;
        $path = $request->path;
        $fullpath = base_path("data/branches/{$repository}/{$branch}/{$path}");
        exec("rm {$fullpath}");
        return redirect("repository/{$repository}/branch/{$branch}");
    }

    public function show(Request $request)
    {
        $repository = $request->repository;
        $branch = $request->branch;
        $path = $request->input('path');
        $fullpath = base_path("data/branches/{$repository}/{$branch}/{$path}");
        $content = file_get_contents($fullpath);
        return view('file/show', compact('repository', 'branch', 'path', 'content'));
    }

    public function master(Request $request)
    {
        $repository = $request->repository;
        $path = $request->input('path');
        $fullpath = base_path("data/repositories/{$repository}/{$path}");
        $content = file_get_contents($fullpath);
        return view('file/master', compact('repository', 'path', 'content'));
    }

    public function edit(Request $request)
    {
        $repository = $request->repository;
        $branch = $request->branch;
        $path = $request->input('path');
        $fullpath = base_path("data/branches/{$repository}/{$branch}/{$path}");
        $content = file_get_contents($fullpath);
        return view('file/edit', compact('repository', 'branch', 'path', 'content'));
    }
}
