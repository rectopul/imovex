<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendSuccessResponse($message)
    {
        return response()->json($message ,200);
    }

    protected function setAlertSuccess($body)
    {
        $this->setAlert('success', $body);
    }

    protected function sendAlertSuccessResponse($alertBody, $successContent)
    {
        $this->setAlertSuccess($alertBody);

        return $this->sendSuccessResponse($successContent);
    }

    private function setAlert($type, $body)
    {
        session()->flash('alert', [
            'type' => $type,
            'body' => $body
        ]);
    }
}
