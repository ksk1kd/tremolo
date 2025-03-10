<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\Runners\OldGitRunner;
use App\Models\Branch;
use App\Http\Requests\BranchRequest;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $repository = $request->repository;

        $branches = Branch::where([['repository', $repository], ['is_merged', 0]])->get();

        return view('branch/index', compact('repository', 'branches'));
    }

    public function store(BranchRequest $request)
    {
        $branch = new Branch();
        $branch->repository = $request->repository;
        $branch->id = $request->id;
        $branch->name = $request->name;
        $branch->is_merged = 0;
        $branch->save();

        $origin_dir = base_path("data/repositories/{$request->repository}");
        $branch_dir = base_path("data/branches/{$request->repository}/{$request->id}");

        $git = new Git(new OldGitRunner());
        $repo = $git->cloneRepository($origin_dir, $branch_dir);
        $repo->createBranch($request->id, true);

        return redirect("repository/{$request->repository}/branch/{$request->id}");
    }

    public function create(Request $request)
    {
        $repository = $request->repository;
        return view('branch/create', compact('repository'));
    }

    public function destroy(Request $request)
    {
        $branch = Branch::where([['repository', $request->repository], ['id', $request->branch]]);
        $branch->delete();

        $dir = base_path("data/branches/{$request->repository}/{$request->branch}");
        exec("rm -rf ${dir}");

        return redirect("repository/{$request->repository}/branch");
    }

    public function show(Request $request)
    {
        $branch = Branch::where([['repository', $request->repository], ['id', $request->branch]])->first();
        $repository = $branch->repository;
        $id = $branch->id;
        $name = $branch->name;

        $files = [];
        $dir = base_path("data/branches/{$request->repository}/{$request->branch}");
        exec("find ${dir} -type f -not -path '*.git*' | sed 's|^{$dir}/||'", $files);

        return view('branch/show', compact('repository', 'id', 'name', 'files'));
    }
}
