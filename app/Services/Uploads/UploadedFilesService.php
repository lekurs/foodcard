<?php


namespace App\Services\Uploads;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class UploadedFilesService
{
    private function controlUploadedFile(UploadedFile $file)
    {
        $mimeTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/svg+xml'];

        if ($file->getError() !== 0) {

            return back()->with('error', request()->file()->getErrorMessage());
        }

        if (!in_array($file->getMimeType(), $mimeTypes)) {

            return back()->with('error', 'Pas le bon format de fichier');
        }
    }

    public function moveFile(UploadedFile $file, string $path): void
    {
        $this->controlUploadedFile($file);

        $file->storeAs($path, $file->getClientOriginalName());
    }

}
