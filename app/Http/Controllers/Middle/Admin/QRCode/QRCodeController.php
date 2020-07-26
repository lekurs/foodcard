<?php


namespace App\Http\Controllers\Middle\Admin\QRCode;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use App\Services\QRCode\QRcode;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @var UserFonctionRepository $userFonctionRepository
     */
    private UserFonctionRepository $userFonctionRepository;

    /**
     * @var StoreRepository $storeRepository
     */
    private StoreRepository $storeRepository;

    /**
     * QRCodeController constructor.
     * @param UserRepository $userRepository
     * @param UserFonctionRepository $userFonctionRepository
     * @param StoreRepository $storeRepository
     */
    public function __construct(UserRepository $userRepository, UserFonctionRepository $userFonctionRepository, StoreRepository $storeRepository)
    {
        $this->userRepository = $userRepository;
        $this->userFonctionRepository = $userFonctionRepository;
        $this->storeRepository = $storeRepository;
    }


    public function show()
    {
        $userFonctions = $this->userFonctionRepository->getAll();
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;

        $qr = new QRcode();
        $qr->frame = $qr::LVL_FRAME_HUGE;
        $qr->target = "http://www.google.com";
        $qr->logo = "https://ressources.blogdumoderateur.com/2013/10/google-logo.png";
        $qr->color = "006c50";
        $qrcode = $qr->output();

        $image = '<img class="qrcode-img img-fluid" src="data:image/png;base64,'.base64_encode($qrcode).'">';

        return view('admin.middle.account.qrcode.admin_middle_qrcode_show', [
            'qrcode' => $image,
            'userFonctions' => $userFonctions,
            'stores' => $stores
        ]);
    }
}
