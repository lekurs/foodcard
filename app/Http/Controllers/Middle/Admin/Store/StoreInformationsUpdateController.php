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

        if (isset($validates['storelogo'])) {
            $this->uploadService->moveFile($validates['storelogo'], '/public/store/' . Str::slug($validates['name']));
            //Insert bdd
            $this->storeMediaRepository->store($validates);
        }

        if (isset($validates['storeillustration'])) {
            $this->uploadService->moveFile($validates['storeillustration'], '/storage/store/' . Str::slug($validates['name']));
            //Insert bdd
            $this->storeMediaRepository->store($validates);
        }


        dd($validates);
    }
}
