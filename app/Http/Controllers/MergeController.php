<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\Runners\OldGitRunner;
use App\Models\Branch;

class MergeController extends Controller
{
    public function store(Request $request)
    {
        $branch = Branch::where([['repository', $request->repository], ['id', $request->branch]])->firstOrFail();
        $branch->update(['is_merged' => 1]);
        $branch_name = $branch->name;

        $origin_dir = base_path("data/repositories/{$request->repository}");
        $branch_dir = base_path("data/branches/{$request->repository}/{$request->branch}");

        $git = new Git(new OldGitRunner());
        $branch_repo = $git->open($branch_dir);
        $branch_repo->execute('config', 'user.name', Auth::user()->name);
        $branch_repo->execute('config', 'user.email', Auth::user()->email);
        $branch_repo->addAllChanges();
        $branch_repo->commit($branch_name);
        $branch_repo->push(['origin', $request->branch], ['-u']);

        $origin_repo = $git->open($origin_dir);
        $origin_repo->execute('config', 'user.name', Auth::user()->name);
        $origin_repo->execute('config', 'user.email', Auth::user()->email);
        $origin_repo->merge($request->branch);

        exec("rm -rf {$branch_dir}");

        return redirect("repository/{$request->repository}");
    }
}
