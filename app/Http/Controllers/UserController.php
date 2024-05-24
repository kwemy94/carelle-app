<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function index(){
        $users = $this->userRepository->getAll();

        return view('admin.users.index', compact('users'));
    }

    public function destroy($id){
        try {
            $user = $this->userRepository->getById($id);
            $user->delete();
        } catch (\Throwable $th) {
            $notification = array(
                'message' => "une erreur s'est produite " . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Utilisateur supprimé !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
