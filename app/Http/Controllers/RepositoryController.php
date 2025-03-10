<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\Runners\OldGitRunner;
use App\Models\Repository;
use App\Models\Branch;
use App\Http\Requests\RepositoryRequest;

class RepositoryController extends Controller
{
    public function index()
    {
        $repositories = Repository::all();
        return view('repository/index', compact('repositories'));
    }

    public function store(RepositoryRequest $request)
    {
        $repository = new Repository();
        $repository->id = $request->id;
        $repository->name = $request->name;
        $repository->save();

        $dir = base_path("data/repositories/{$request->id}");
        $git = new Git(new OldGitRunner());
        $repo = $git->init($dir);
        exec("touch ${dir}/.gitkeep");
        $repo->addAllChanges();
        $repo->execute('config', 'user.name', Auth::user()->name);
        $repo->execute('config', 'user.email', Auth::user()->email);
        $repo->commit('Initial commit');

        $dir = base_path("data/branches/{$request->id}");
        exec("mkdir ${dir}");

        return redirect('/repository');
    }

    public function create()
    {
        return view('repository/create');
    }

    public function destroy($id)
    {
        $repository = Repository::findOrFail($id);
        $repository->delete();

        $branches = Branch::where('repository', $id);
        $branches->delete();

        $dir = base_path("data/repositories/{$id}");
        exec("rm -rf ${dir}");
        $dir = base_path("data/branches/{$id}");
        exec("rm -rf ${dir}");

        return redirect('/repository');
    }

    public function show($id)
    {
        $repository = Repository::findOrFail($id);
        $name = $repository->name;

        $files = [];
        $dir = base_path("data/repositories/{$id}");
        exec("find ${dir} -type f -not -path '*.git*' | sed 's|^{$dir}/||'", $files);

        return view('repository/show', compact('id', 'name', 'files'));
    }
}
