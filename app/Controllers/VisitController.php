<?php

namespace App\Controllers;

use App\Models\Person;
use App\Models\Visit;
use App\Models\VisitType;

class VisitController extends BaseController
{
    public function index($visitTypeName)
    {
        $visitTypeModel = new VisitType();
        $visitType = $visitTypeModel->where('name', $visitTypeName)->first();
        if (!$visitType) {
            throw new \Exception('Visit type not found');
        }

        $data['title'] = 'Visit - ' . $visitType['name'];
        $data['visit_id'] = $visitType['id'];

        return view('pages/Visit', $data);
    }

    public function singleSubmit()
    {
        try {
            $session = session();

            $personCode = $this->request->getVar('person_code');
            $visitTypeId = $this->request->getVar('visit_type_id');

            $personModel = new Person();
            $person = $personModel->where('code', $personCode)->first();
            if (!$person) {
                throw new \Exception('Person not found');
            }

            $visitTypeModel = new VisitType();
            $visitType = $visitTypeModel->find($visitTypeId);
            if (!$visitType) {
                throw new \Exception('Visit type not found');
            }

            $visitModel = new Visit();
            $visitModel->insert([
                'person_id' => $person['id'],
                'instance_id' => $person['instance_id'],
                'visit_type_id' => $visitTypeId,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $session->setFlashdata('success', 'Visit Type ' . $visitType['name'] . ' submitted successfully');

            return redirect()->to('/visit');

        } catch (\Exception $e) {
            $session->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
