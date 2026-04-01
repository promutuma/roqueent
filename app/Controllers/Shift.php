<?php

namespace App\Controllers;

use App\Models\ShiftModel;
use CodeIgniter\Controller;

class Shift extends BaseController
{
    private string $errorText = 'Error: ';

    public function index()
    {
        $data['title'] = "Shift Management";
        $shiftModel = new ShiftModel();
        $session = session();
        
        $data['activeShift'] = $shiftModel->getActiveShift($session->get('user_id'));
        $data['shiftHistory'] = $shiftModel->where('user_id', $session->get('user_id'))->orderBy('id', 'DESC')->findAll();

        return view('shift/shift_status', $data);
    }

    public function openShift()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
        ];

        try {
            $shiftModel = new ShiftModel();
            $session = session();
            $sys = new Sys();

            $userId = $session->get('user_id');
            if (empty($userId)) {
                throw new \Exception("Session expired. Please log in again.");
            }

            // Check if already has an open shift
            if ($shiftModel->getActiveShift($userId)) {
                throw new \Exception("You already have an open shift. Please close it before opening a new one.");
            }

            $openingFloat = (float)$this->request->getVar('txtOpeningFloat');
            if ($openingFloat < 0) {
                throw new \Exception("Opening float cannot be negative.");
            }
            $getTime = $sys->getTime();

            $insertData = [
                'user_id' => $session->get('user_id'),
                'opening_date' => $getTime['date'],
                'opening_time' => $getTime['time'],
                'opening_float' => $openingFloat,
                'status' => 'Open',
            ];

            if ($shiftModel->insert($insertData)) {
                $data['status'] = 1;
                $data['message'] = "Shift opened successfully with a float of Ksh " . number_format($openingFloat, 2);
                
                $logDesc = "Shift opened by " . ($session->get('user_name') ?? 'Unknown') . " with float Ksh " . $openingFloat;
                $sys->addLog($session->get('session_iddata'), $userId, "Create", $logDesc);
            } else {
                $errors = $shiftModel->errors();
                $errorMsg = !empty($errors) ? implode(", ", $errors) : "Failed to insert record.";
                throw new \Exception("Failed to open shift: " . $errorMsg);
            }
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
        }

        return $this->response->setJSON($data);
    }

    public function closeShift()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
        ];

        try {
            $shiftModel = new ShiftModel();
            $session = session();
            $sys = new Sys();

            $userId = $session->get('user_id');
            if (empty($userId)) {
                throw new \Exception("Session expired. Please log in again.");
            }

            $activeShift = $shiftModel->getActiveShift($userId);
            if (!$activeShift) {
                throw new \Exception("No active shift found to close.");
            }

            $actualCash = (float)$this->request->getPost('txtActualCash');
            $expectedCash = $shiftModel->calculateExpectedCash($activeShift['id']);
            $getTime = $sys->getTime();

            $updateData = [
                'closing_date' => $getTime['date'],
                'closing_time' => $getTime['time'],
                'closing_cash_actual' => $actualCash,
                'closing_cash_expected' => $expectedCash,
                'status' => 'Closed',
                'notes' => $this->request->getVar('txtNotes'),
            ];

            if ($shiftModel->update($activeShift['id'], $updateData)) {
                $data['status'] = 1;
                $diff = $actualCash - $expectedCash;
                $data['message'] = "Shift closed successfully. Reconciliation: Expected Ksh " . number_format($expectedCash, 2) . ", Actual Ksh " . number_format($actualCash, 2) . ". Difference: Ksh " . number_format($diff, 2);
                
                $logDesc = "Shift closed by " . $session->get('user_name') . ". Difference: Ksh " . $diff;
                $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Update", $logDesc);
            } else {
                throw new \Exception("Failed to close shift.");
            }
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
        }

        return $this->response->setJSON($data);
    }

    public function getActiveShiftStatus()
    {
        $shiftModel = new ShiftModel();
        $session = session();
        $activeShift = $shiftModel->getActiveShift($session->get('user_id'));
        
        return $this->response->setJSON([
            'isOpen' => $activeShift ? true : false,
            'shift' => $activeShift
        ]);
    }
}
