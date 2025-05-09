<?php
namespace App\Http\Traits;

trait InsertStatus
{
    public function statusBadge(): string
    {
        $statusBadge = match ((int) $this->status) {
            0 => '<span class="badge badge-danger rounded-pill border-danger font-weight-bold">Inactive</span>',
            1 => '<span class="badge badge-success rounded-pill border-success font-weight-bold">Active</span>',
            2 => '<span class="badge badge-warning rounded-pill border-warning text-dark font-weight-bold">Not Credit Worthy</span>',
        };

        return $statusBadge;
    }

    public function supplierPaymentStatus()
    {
        $supplierPaymentStatus = match ((string) $this->status) {
            'pending' => '<span class="badge badge-info rounded-pill border-info font-weight-bold">PENDING</span>',
            'posted' => '<span class="badge badge-success rounded-pill border-success font-weight-bold">POSTED</span>',
            'approved' => '<span class="badge badge-success rounded-pill border-success font-weight-bold">APPROVED</span>',
            'completed' => '<span class="badge badge-primary rounded-pill border-primary font-weight-bold">COMPLETED</span>',
        };

        return $supplierPaymentStatus;
    }

    public function storeType()
    {
        $storeType = match ((int) $this->is_main) {
            1 => '<span class="text-white badge rounded-pill bg-success border-success fw-bold">Main Store</span>',
            0 => '<span class="badge rounded-pill bg-secondary text-dark border-dark fw-bold">Consumption Store</span>',
        };

        return $storeType;
    }

    public function inventoryApprovalStatus()
    {
        $inventoryApprovalStatus = match ((int) $this->is_approved) {
            0 => '<span class="text-white badge rounded-pill bg-info border-info fw-bold">Awaiting Approval</span>',
            1 => '<span class="text-white badge rounded-pill bg-success border-success fw-bold">Approved</span>',
            2 => '<span class="text-white badge rounded-pill bg-danger border-danger fw-bold">Declined</span>',
        };

        return $inventoryApprovalStatus;
    }
    public function lpoDeliveryStatus()
    {
        $lpoDeliveryStatus = match ((int) $this->is_delivered) {
            0 => '<span class="badge badge-danger rounded-pill border-danger font-weight-bold">No Item Delivered</span>',
            1 => '<span class="text-dark badge badge-warning rounded-pill border-warning font-weight-bold">Partially Delivered</span>',
            2 => '<span class="badge badge-success rounded-pill border-success font-weight-bold">Fully Delivered</span>',
        };

        return $lpoDeliveryStatus;
    }
    public function lpoProductDeliveryStatus()
    {
        $lpoProductDeliveryStatus = match ((string) $this->status) {
            'accepted' => '<span class="badge badge-success rounded-pill border-success font-weight-bold">ACCEPTED</span>',
            'rejected' => '<span class="badge badge-danger rounded-pill border-danger font-weight-bold">REJECTED</span>',
            'withheld' => '<span class="badge badge-warning rounded-pill border-warning font-weight-bold">WITHHELD</span>',
            'returned' => '<span class="badge badge-primary rounded-pill border-primary font-weight-bold">RETURNED</span>',
            'unfulfilled' => '<span class="badge badge-info rounded-pill border-info font-weight-bold">UNFULFILLED</span>',
        };

        return $lpoProductDeliveryStatus;
    }
    public function paymentStatus()
    {
        $paymentStatus = match ((int) $this->is_paid) {
            0 => '<span class="badge badge-danger rounded-pill border-danger font-weight-bold">Not Paid</span>',
            1 => '<span class="badge badge-success rounded-pill border-success font-weight-bold">Paid</span>',
        };

        return $paymentStatus;
    }

    public function approvalStatus()
    {
        $approvalStatus = match ((int) $this->is_approved) {
            0 => '<span class="badge badge-info rounded-pill border-info fw-bold">Pending</span>',
            1 => '<span class="badge badge-success rounded-pill border-success fw-bold">Approved</span>',
            2 => '<span class="badge badge-danger rounded-pill border-danger fw-bold">Rejected</span>',
            3 => '<span class="badge badge-info rounded-pill border-info fw-bold">Under Revision</span>',
        };

        return $approvalStatus;
    }

    public function materialIssueApprovalStatus()
    {
        $approvalStatus = match ((int) $this->is_approved) {
            0 => '<span class="badge badge-info rounded-pill border-info fw-bold">Pending</span>',
            1 => '<span class="badge badge-primary rounded-pill border-primary fw-bold">Partially Approved</span>',
            2 => '<span class="badge badge-success rounded-pill border-success fw-bold">Fully Approved</span>',
            3 => '<span class="badge text-dark badge-warning rounded-pill border-warning fw-bold">Pending Reissue Approval</span>',
            4 => '<span class="badge badge-danger rounded-pill border-danger fw-bold">Rejected</span>',
        };

        return $approvalStatus;
    }

    public function appStatusBadge()
    {
        $defaultStatus = match ((int) $this->is_app_user) {
            0 => '<span class="badge badge-danger rounded-pill border-danger font-weight-bold">Inactive</span>',
            1 => '<span class="badge badge-success rounded-pill border-success font-weight-bold">Active</span>',
        };

        return $defaultStatus;
    }

    public function webStatusBadge()
    {
        $defaultStatus = match ((int) $this->is_web_user) {
            0 => '<span class="badge badge-danger rounded-pill border-danger font-weight-bold">Inactive</span>',
            1 => '<span class="badge badge-success rounded-pill border-success font-weight-bold">Active</span>',
        };

        return $defaultStatus;
    }

    public function restockStatus()
    {
        $restockStatus = match ((int) $this->is_approved) {
            0 => '<span class="text-dark badge badge-warning rounded-pill border-warning font-weight-bold">Pending Restock</span>',
            1 => '<span class="badge badge-success rounded-pill border-success font-weight-bold">Restocked</span>',
        };

        return $restockStatus;
    }

    public function storeTransferStatus()
    {
        $storeTransferStatus = match ((int) $this->is_approved) {
            0 => '<span class="badge badge-info rounded-pill border-info font-weight-bold">Pending Approval</span>',
            1 => '<span class="badge badge-success rounded-pill border-success font-weight-bold">Approved</span>',
        };

        return $storeTransferStatus;
    }

    public function transactingStatus()
    {
        $transactingStatus = match ((int) $this->transacting_status) {
            0 => '<span class="badge badge-danger rounded-pill border-danger fw-bold">No</span>',
            1 => '<span class="badge badge-success rounded-pill border-success fw-bold">Yes</span>',
        };

        return $transactingStatus;
    }

    public function orderStatus()
    {
        $orderStatus = match ((int) $this->status) {
            0 => '<span class="badge badge-info rounded-pill border-info fw-bold">Pending Payment</span>',
            1 => '<span class="badge badge-success rounded-pill border-success fw-bold">Fully Paid</span>',
            2 => '<span class="badge badge-warning rounded-pill border-warning text-dark fw-bold">Credit</span>',
            3 => '<span class="badge badge-danger rounded-pill border-danger fw-bold">Cancelled</span>',
        };

        return $orderStatus;
    }

    public function jobCardStatus()
    {
        $jobCardStatus = match ((int) $this->status) {
            0 => '<span class="badge badge-info rounded-pill border-info fw-bold">Open</span>',
            1 => '<span class="badge badge-primary rounded-pill border-primary fw-bold">Under Inspection</span>',
            2 => '<span class="badge badge-warning rounded-pill border-warning text-dark fw-bold">Quoted</span>',
            3 => '<span class="badge badge-info rounded-pill border-info fw-bold">Material Requested/Issued</span>',
            4 => '<span class="badge badge-primary rounded-pill border-primary fw-bold">On Delivery</span>',
            5 => '<span class="badge badge-success rounded-pill border-success fw-bold">Completed</span>',
            6 => '<span class="badge badge-danger rounded-pill border-danger fw-bold">Quote Rejected</span>',
            7 => '<span class="badge badge-success rounded-pill border-success fw-bold">Invoiced</span>',
            8 => '<span class="badge badge-secondary rounded-pill border-secondary fw-bold">Returned</span>',
        };

        return $jobCardStatus;
    }

    public function jobInspectionStatus()
    {
        $jobInspectionStatus = match ($this->status) {
            0 => '<span class="badge rounded-pill bg-secondary text-dark border-dark fw-bold">Pending</span>',
            1 => '<span class="text-white badge rounded-pill bg-success border-success fw-bold">Complete</span>',
            2 => '<span class="text-dark badge rounded-pill bg-warning border-warning fw-bold">Quoted</span>',
            3 => '<span class="badge badge-info rounded-pill border-info fw-bold">Material Requested/Issued</span>',
            4 => '<span class="badge badge-primary rounded-pill border-primary fw-bold">On Delivery</span>',
            5 => '<span class="badge badge-success rounded-pill border-success fw-bold">Completed</span>',
            6 => '<span class="badge badge-success rounded-pill border-success fw-bold">Invoiced</span>',
            7 => '<span class="badge badge-success rounded-pill border-success fw-bold">Invoiced</span>',
        };

        return $jobInspectionStatus;
    }

    public function receiptStatus()
    {
        $receiptStatus = match ($this->status) {
            'PENDING' => '<span class="text-white badge rounded-pill bg-info border-info fw-bold">PENDING</span>',
            'REVOKED' => '<span class="text-white badge rounded-pill bg-danger border-danger fw-bold">REVOKED</span>',
            'CLEARED' => '<span class="text-white badge rounded-pill bg-success border-success fw-bold">CLEARED</span>',
        };

        return $receiptStatus;
    }
}