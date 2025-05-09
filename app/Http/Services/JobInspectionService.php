<?php

namespace App\Http\Services;

use App\Models\JobInspectionProduct;

class JobInspectionService
{
    public function handle($jobInspection, $validatedInspectionProducts)
    {
        $this->updateJobcardAndJobInspectionStatuses($jobInspection);

        if ($validatedInspectionProducts->isNotEmpty()) {
            $this->createJobInspectionProducts($validatedInspectionProducts, $jobInspection);
        }
    }

    private function updateJobcardAndJobInspectionStatuses($jobInspection)
    {
        $jobInspection->update(['status' => 1]);
        $jobInspection->jobCard->update(['status' => 1]);
    }

    private function createJobInspectionProducts($validatedInspectionProducts, $jobInspection)
    {
        $validatedInspectionProducts->each(function ($inspectionProduct) use ($jobInspection) {
            JobInspectionProduct::create([
                'job_inspection_id' => $jobInspection->id,
                'product_id' => $inspectionProduct['product_id'],
                'quantity' => $inspectionProduct['quantity_to_repair'],
            ]);
        });
    }
}
