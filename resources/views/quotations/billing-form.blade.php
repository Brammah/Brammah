 @if ($quotation->customer->parent == null && $quotation->customer->children->isEmpty())
     <div class="alert alert-info">
         <strong>Note:</strong> This customer has no related customers. Please select their account and submit.
     </div>
 @endif

 <div class="mb-5 row">
     <div class="col-md-6">
         <label for="customer_name" class="required form-label fw-bold">Customer:</label>
         <input type="text" name="customer_name" id="customer_name"
             class="mb-2 border-gray-300 form-control form-control-solid" placeholder="jobcard number"
             value="{{ old('customer_name', $quotation->customer->company_name ?? $quotation->customer->name) }}"
             readonly>
         @error('customer_name')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>
 </div>

 <div class="mb-5 row">
     <div class="col-md-6">
         <label for="bill_to_customer_id" class="required form-label fw-bold">Related Customers:</label>
         <select class="form-control form-select @error('bill_to_customer_id') is-invalid @enderror"
             data-control="select2" data-placeholder="select customer to bill" name="bill_to_customer_id"
             id="bill_to_customer_id">
             <option></option>
             @foreach ($relatedCustomers as $relatedCustomer)
                 <option value="{{ $relatedCustomer->id }}" @selected(old('bill_to_customer_id', $quotation->bill_to_customer_id) == $relatedCustomer->id)>
                     {{ $relatedCustomer->name ?? $relatedCustomer->company_name }}</option>
             @endforeach
         </select>
         @error('bill_to_customer_id')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>

     <div class="col-md-6 d-none" id="kra-pin-input">
         <label for="kra_pin" class="required form-label fw-bold">KRA Pin:</label>
         <input type="text" name="kra_pin" id="kra_pin" class="form-control" placeholder="enter KRA pin"
             value="{{ old('kra_pin') }}">
         @error('kra_pin')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>
 </div>
