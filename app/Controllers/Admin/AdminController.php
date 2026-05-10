<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RegimeModel;
use App\Models\ActiviteSportiveModel;
use App\Models\CodePortefeuilleModel;
use App\Models\AbonnementGoldModel;
use App\Models\UserRegimeModel;

class AdminController extends BaseController
{
    public function viewLoginAdmin()
    {
        return view('admin/loginAdmin');
    }

    public function doLoginAdmin()
    {
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('mot_de_passe');
        $user = $model->where('email', $email)->first();

        $role = isset($user['role']) ? strtoupper($user['role']) : '';
        $isAdmin = ($user && ((isset($user['is_admin']) && $user['is_admin'] == 1) || $role === 'ADMIN'));

        if ($user && $password === $user['mot_de_passe'] && $isAdmin) {
            session()->set('admin_id', $user['id']);
            session()->set('is_admin', true);
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('Error', 'Accès refusé. Identifiants invalides ou droits insuffisants.');
    }

    public function AdminAccueil()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/viewLoginAdmin')->with('Error', 'Veuillez vous connecter en tant qu\'administrateur.');
        }

        $userModel = new UserModel();
        $regimeModel = new RegimeModel();
        $abonnementGoldModel = new AbonnementGoldModel();
        $userRegimeModel = new UserRegimeModel();

        $data['totalUsers'] = $userModel->countAll();
        $data['goldMembers'] = $userModel->where('is_gold', 1)->countAllResults();
        $data['activeRegimes'] = $regimeModel->countAll();

        $totalGoldRow = $abonnementGoldModel->selectSum('montant')->get()->getRow();
        $totalGoldRevenue = $totalGoldRow ? ($totalGoldRow->montant ?? 0) : 0;

        $totalRegimeRow = $userRegimeModel->selectSum('prix_total')->get()->getRow();
        $totalRegimeRevenue = $totalRegimeRow ? ($totalRegimeRow->prix_total ?? 0) : 0;

        $data['totalRevenue'] = (float)$totalGoldRevenue + (float)$totalRegimeRevenue;

        $debutMois = date('Y-m-01');
        $finMois = date('Y-m-t');

        $monthlyGoldRow = $abonnementGoldModel->selectSum('montant')
            ->where('date_paiement >=', $debutMois)
            ->where('date_paiement <=', $finMois)
            ->get()
            ->getRow();
        $monthlyGoldRevenue = $monthlyGoldRow ? ($monthlyGoldRow->montant ?? 0) : 0;

        $monthlyRegimeRow = $userRegimeModel->selectSum('prix_total')
            ->where('date_debut >=', $debutMois)
            ->where('date_debut <=', $finMois)
            ->get()
            ->getRow();
        $monthlyRegimeRevenue = $monthlyRegimeRow ? ($monthlyRegimeRow->prix_total ?? 0) : 0;

        $data['monthlyRevenue'] = (float)$monthlyGoldRevenue + (float)$monthlyRegimeRevenue;

        $data['recentRegimes'] = $regimeModel->orderBy('id', 'DESC')->findAll(5);

        return view('admin/dashboard', $data);
    }

    public function adminRegimes()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/viewLoginAdmin');
        }

        $regimeModel = new RegimeModel();
        $data['regimes'] = $regimeModel->findAll();
        return view('admin/regimes', $data);
    }

    public function addRegime()
    {
        if (!session()->get('is_admin')) return redirect()->to('/viewLoginAdmin');
        return view('admin/form_regime');
    }

    public function editRegime($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('/viewLoginAdmin');
        $model = new RegimeModel();
        $data['regime'] = $model->find($id);
        return view('admin/form_regime', $data);
    }

    public function saveRegime()
    {
        $model = new RegimeModel();
        $id = $this->request->getPost('id');
        $data = $this->request->getPost();

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        return redirect()->to('/admin/regimes');
    }

    public function deleteRegime($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('/viewLoginAdmin');
        $model = new RegimeModel();
        $model->delete($id);
        return redirect()->to('/admin/regimes');
    }

    public function adminActivites()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/viewLoginAdmin');
        }

        $sportModel = new ActiviteSportiveModel();
        $data['activites'] = $sportModel->findAll();
        return view('admin/activites', $data);
    }

    public function addActivite()
    {
        if (!session()->get('is_admin')) return redirect()->to('/viewLoginAdmin');
        return view('admin/form_activite');
    }

    public function editActivite($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('/viewLoginAdmin');
        $model = new ActiviteSportiveModel();
        $data['activite'] = $model->find($id);
        return view('admin/form_activite', $data);
    }

    public function saveActivite()
    {
        $model = new ActiviteSportiveModel();
        $id = $this->request->getPost('id');
        $data = $this->request->getPost();

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        return redirect()->to('/admin/activites');
    }

    public function deleteActivite($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('/viewLoginAdmin');
        $model = new ActiviteSportiveModel();
        $model->delete($id);
        return redirect()->to('/admin/activites');
    }

    public function adminCodes()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/viewLoginAdmin');
        }

        $codeModel = new CodePortefeuilleModel();
        $data['codes'] = $codeModel->findAll();
        return view('admin/codes', $data);
    }

    public function adminParametres()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/viewLoginAdmin');
        }
        return view('admin/parametres');
    }

    public function adminLogout()
    {
        session()->remove('admin_id');
        session()->remove('is_admin');
        return redirect()->to('/viewLoginAdmin');
    }
}
