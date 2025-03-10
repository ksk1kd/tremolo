<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request)
    {
        $path = $request->input('path');
        $repository = $request->repository;
        $branch = $request->branch;
        $file = $this->getPageData($path, $repository, $branch);
        $title = $file['title'];
        $content = $file['content'];
        $parent = $this->getParentPageData($path, $repository, $branch);
        $navs = $this->getNavigationPageData($path, $repository, $branch);

        return view('page/show', compact('repository', 'branch', 'path', 'content', 'title', 'parent', 'navs'));
    }

    public function master(Request $request)
    {
        $path = $request->input('path');
        $repository = $request->repository;
        $file = $this->getPageData($path, $repository);
        $title = $file['title'];
        $content = $file['content'];
        $parent = $this->getParentPageData($path, $repository);
        $navs = $this->getNavigationPageData($path, $repository);

        return view('page/master', compact('repository', 'path', 'content', 'title', 'parent', 'navs'));
    }

    private function getPageData($path, $repository, $branch = null)
    {
        $content = $this->getContent($path, $repository, $branch);
        $title = $this->getTitle($content);
        return [
            'title' => $title,
            'content' => $content,
        ];
    }

    private function getParentPageData($path, $repository, $branch = null)
    {
        $splited = $this->splitIntoDirAndFilename($path);
        $currentDir = $splited['currentDir'];
        $fileName = $splited['fileName'];
        $parentPath = $currentDir ? "{$currentDir}/index.md" : null;
        if ($fileName === 'index.md') {
            preg_match('/(.+)\/(.+)/', $currentDir, $matches);
            $parentPath = isset($matches[1]) ? "{$matches[1]}/index.md" : null;
        }
        if (!$parentPath) {
            return null;
        }
        $content = $this->getContent($parentPath, $repository, $branch);
        $title = $this->getTitle($content);
        return [
            'title' => $title,
            'path' => $parentPath,
        ];
    }

    private function getNavigationPageData($path, $repository, $branch = null)
    {
        return $this->getSiblingsPageData(1, $path, $repository, $branch);
    }

    private function getSiblingsPageData($level, $path, $repository, $branch = null)
    {
        if ($level > 2) {
            return;
        }
        if (preg_match('/.+\.md/', $path)) {
            $splited = $this->splitIntoDirAndFilename($path);
            $currentDir = $splited['currentDir'];
            $fileName = $splited['fileName'];
        } else {
            $currentDir = $path;
            $fileName = null;
        }
        if ($fileName === 'index.md') {
            preg_match('/(.+)\/(.+)/', $currentDir, $matches);
            $currentDir = $matches[1] ?? null;
        }
        $fullPath = $this->getFullPath($currentDir, $repository, $branch);
        exec("ls {$fullPath}", $lsResults);
        $siblings = [];
        $siblingsPaths = [];
        foreach ($lsResults as $lsResult) {
            if ($lsResult === 'index.md') {
                continue;
            }
            if (preg_match('/(.*)\.md$/', $lsResult)) {
                $siblingsPaths[] = $currentDir ? "{$currentDir}/{$lsResult}" : $lsResult;
                continue;
            }
            if (file_exists("{$fullPath}/{$lsResult}/index.md")) {
                $siblingsPaths[] = $currentDir ? "{$currentDir}/{$lsResult}/index.md" : "{$lsResult}/index.md";
                continue;
            }
        }
        foreach ($siblingsPaths as $siblingsPath) {
            $content = $this->getContent($siblingsPath, $repository, $branch);
            $title = $this->getTitle($content);
            $children = null;
            preg_match('/(.+)\/index\.md$/', $siblingsPath, $matches);
            $children = isset($matches[1])
                ? $this->getSiblingsPageData($level + 1, $matches[1], $repository, $branch)
                : null;

            $siblings[] = [
                'title' => $title,
                'path' => $siblingsPath,
                'children' => $children,
            ];
        }
        return $siblings ?? null;
    }

    private function getContent($path, $repository, $branch = null)
    {
        $fullPath = $this->getFullPath($path, $repository, $branch);
        return file_get_contents($fullPath);
    }

    private function getTitle($content)
    {
        $firstLine = explode("\n", $content)[0];
        preg_match('/#\s+(.+)/', $firstLine, $matches);
        return $matches[1] ?? __('No Title');
    }

    private function getFullPath($path, $repository, $branch = null)
    {
        $relativePath = $branch
            ? "data/branches/{$repository}/{$branch}/{$path}"
            : "data/repositories/{$repository}/{$path}";
        return base_path($relativePath);
    }

    private function splitIntoDirAndFilename($path)
    {
        preg_match('/(.+)\/(.+)/', $path, $matches);
        return [
            'currentDir' => $matches[1] ?? null,
            'fileName' => $matches[2] ?? $path,
        ];
    }
}
