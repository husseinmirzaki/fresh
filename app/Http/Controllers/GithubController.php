<?php

namespace App\Http\Controllers;


use App\Traits\GithubTrait;

class GithubController extends Controller
{
    use GithubTrait;

    public function index()
    {
        return view('github.index', compact('git_username'));
    }

    public function repoCommits($repo,$branch)
    {
        $repository = $this->getUserRepoBranch($repo , $branch);
        if ($repository == null)
            abort(404);
//        $user_commits = $this->getRepoCommits($repo);
        $user_commits = $this->getRepoCommitsBranch($repo,$branch);
        return view('github.commits', compact('repo','branch', 'user_commits'));
    }

    public function repoCommit($repo, $branch ,$sha)
    {
        $commit = $this->getRepoCommit($repo, $sha);
        return view('github.commit', compact('commit', 'repo','branch', 'sha'));
    }

    public function branches($repo){
        $branches = $this->getUserRepoBranches($repo);
        return view('github.branches', compact('branches', 'repo'));
    }

    public function pullFile($repo, $sha, $fileSha)
    {
        $this->pull($repo, $sha, $fileSha, true);
        return back()->withErrors([
            'success' => [
                'pulling file ' . $fileSha . ' is done'
            ]
        ]);

    }

    public function pull($repo,$sha, $fileSha = null, $isFile = false)
    {
        set_time_limit(0);

        $dir = base_path('test');
        if (!file_exists($dir)) {
            mkdir($dir);
        }

        $commit = $this->getRepoCommit($repo, $sha);
        $files = $commit['files'];
        foreach ($files as $file) {
            if ($isFile)
                if ($file['sha'] != $fileSha)
                    continue;
            $path = $dir;
            $address = $file['filename'];
            $raw_url = $file['raw_url'];
            $separated_parts = preg_split('/\//', $address);
            foreach ($separated_parts as $index => $separated_part) {
                $path .= '/' . $separated_part;
                if ($index == count($separated_parts) - 1) {
                    $rs = fopen($path, 'w+');
                    $text = file_get_contents($raw_url);
                    fwrite($rs, $text);
                    fclose($rs);
                    continue;
                }
                if (!file_exists($path)) {
                    mkdir($path);
                }

            }
        }

        return back()->withErrors([
            'success' => [
                'pulling commit ' . $commit['commit']['message'] . ' is done'
            ]
        ]);
    }

    public function updateToLatestCommit()
    {
        //        dd($this->github->user()->repositories('husseinmirzaki'));
    }
}
