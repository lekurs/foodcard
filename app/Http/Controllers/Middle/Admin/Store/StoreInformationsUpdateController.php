<?php


namespace App\Http\Controllers\Middle\Admin\Store;


use App\Http\Controllers\Controller;
use App\Repository\StoreMediaRepository;
use App\Repository\StoreRepository;
use App\Requests\Store\StoreCreationRequest;
use App\Services\Uploads\UploadedFilesService;
use Illuminate\Support\Str;


class StoreInformationsUpdateController extends Controller
{
    private StoreRepository $storeRepository;

    private StoreMediaRepository $storeMediaRepository;

    private UploadedFilesService $uploadService;

    /**
     * StoreInformationsUpdateController constructor.
     *
     * @param StoreRepository $storeRepository
     * @param StoreMediaRepository $storeMediaRepository
     * @param UploadedFilesService $uploadService
     */
    public function __construct(
        StoreRepository $storeRepository,
        StoreMediaRepository $storeMediaRepository,
        UploadedFilesService $uploadService
    ) {
        $this->storeRepository = $storeRepository;
        $this->storeMediaRepository = $storeMediaRepository;
        $this->uploadService = $uploadService;
    }

    public function __invoke(string $storeSlug, StoreCreationRequest $validator)
    {
        $validates = $validator->all();

        $this->storeRepository->updateStore($validates);

        if (isset($validates['storeMedias']['logo'])) {
            $this->uploadService->moveFile($validates['storeMedias']['logo'][0], '/public/store/' . Str::slug($validates['name']));
            $this->storeMediaRepository->store($validates);
        }

        if (isset($validates['storeMedias']['illustration'])) {
            $this->uploadService->moveFile($validates['storeMedias']['illustration'][0], '/public/store/' . Str::slug($validates['name']) . '/' . 'background');
            $this->storeMediaRepository->store($validates);
        }

        return back()->with('success', 'Votre établissement à été mis à jour');
    }
}
