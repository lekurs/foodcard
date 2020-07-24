<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use App\Requests\User\UserCreationRequest;
use Illuminate\Http\RedirectResponse;

class UsersActionsController extends Controller
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
     * UsersActionsController constructor.
     * @param UserRepository $userRepository
     * @param UserFonctionRepository $userFonctionRepository
     */
    public function __construct(UserRepository $userRepository, UserFonctionRepository $userFonctionRepository)
    {
        $this->userRepository = $userRepository;
        $this->userFonctionRepository = $userFonctionRepository;
    }

    public function createUser(UserCreationRequest $validator): RedirectResponse
    {
        $validates = $validator->all();

        $this->userRepository->createUserInStore($validates);

        return redirect()->back()->with('success', 'Utilisateur ajouté');
    }

    public function editUser()
    {
        $userFonctions = $this->userFonctionRepository->getAll();

        if(request()->request->get('id') != "") {
            $user = $this->userRepository->getOneById(request()->request->get('id'));
        }

        if(request()->request->get('id') != "") {
            $html = view('forms.middle.users.__user_creation_middle', [
                'user' => $user,
                'userFonctions' => $userFonctions
            ]);
        } else {
            $html = view('forms.middle.users.__user_creation_middle', [

            ]);
        }

        echo $html;
    }

    public function trashUser()
    {
        $this->userRepository->trashUser(request()->request->get('id'));
    }
}
