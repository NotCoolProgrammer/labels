<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowLabelRequest;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Services\LabelService;

class LabelController extends Controller
{
    private LabelService $service;

    public function __construct(LabelService $labelService)
    {
        $this->service = $labelService;
    }

    public function addLabels(StoreLabelRequest $request)
    {
        $validated = $request->validated();
        $this->service->addLabels($validated);
    }

    public function showLabels(ShowLabelRequest $request)
    {
        $validated = $request->validated();
        return $this->service->getLabels($validated);
    }

    public function updateLabels(UpdateLabelRequest $request)
    {
        $validated = $request->validated();
        $this->service->updateLabels($validated);
    }

    public function deleteLabels(StoreLabelRequest $request)
    {
        $validated = $request->validated();
        $this->service->deleteLabels($validated);
    }
}
