<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\Runners\OldGitRunner;

class HistoryController extends Controller
{
    public function index($id)
    {
        $git = new Git(new OldGitRunner());
        $dir = base_path("data/repositories/{$id}");
        $repo = $git->open($dir);
        $history = [];
        $history = $repo->execute('log', '--date=format-local:%Y/%m/%d %H:%M:%S', '--pretty=format:"%cd|%s|%cn|%H"');

        foreach ($history as $index => $commit) {
            $commit = trim($commit, '"');
            $row = explode('|', $commit);
            $history[$index] = [
                'date' => $row[0],
                'message' => $row[1],
                'user' => $row[2],
                'hash' => $row[3],
            ];
        }

        return view('history/index', compact('id', 'history'));
    }
}
