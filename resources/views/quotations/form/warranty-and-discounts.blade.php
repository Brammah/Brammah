 <div class="mb-5 row">
     <div class="col-md-6" id="warrantyOption">
         <label for="is_warranted" class="required form-label fw-bold">
             Warranty:
         </label>
         <select class="form-select" name="is_warranted" id="is_warranted" data-control="select2"
             data-placeholder="select if the quotation will be warranted">
             <option value="" selected>Select Choice</option>
             <option value="1" @selected(old('is_warranted', $quotation->is_warranted) == '1')>Yes</option>
             <option value="0" @selected(old('is_warranted', $quotation->is_warranted) == '0')>No</option>
         </select>
         @error('is_warranted')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>
     <div class="col-md-6" id="discountOption">
         <label for="is_discounted" class="required form-label fw-bold">
             Discount:
         </label>
         <select class="form-select" name="is_discounted" id="is_discounted" data-control="select2"
             data-placeholder="select if the quotation will be dicounted">
             <option value="" selected>Select Choice</option>
             <option value="1" @selected(old('is_discounted', $quotation->is_discounted) == '1')>Yes</option>
             <option value="0" @selected(old('is_discounted', $quotation->is_discounted) == '0')>No</option>
         </select>
         @error('is_discounted')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>

     <div class="col-md-3 d-none" id="discountType">
         <label for="discount_type" class="required form-label fw-bold">
             Discount Type:
         </label>
         <select class="form-select" name="discount_type" id="discount_type" data-control="select2"
             data-placeholder="select dicount type">
             <option value="" selected>Select Choice</option>
             <option value="flat-fee" @selected(old('discount_type', $quotation->discount_type) == 'flat-fee')>
                 Flat Fee
             </option>
             <option value="percentage" @selected(old('discount_type', $quotation->discount_type) == 'percentage')>
                 Percentage
             </option>
         </select>
         @error('discount_type')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>

     <div class="col-md-3 d-none" id="discountValue">
         <label class="required form-label fw-bold" for="discount_value">Discount Value:</label>
         <input type="number" step="any" name="discount_value" class="mb-2 form-control"
             placeholder="enter the value" id="discount_value" value="0.00"
             value="{{ old('discount_value', $quotation->discount_value) }}">
         @error('discount_value')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>
 </div>
 <div class="mb-5 row d-none" id="agentDetails">
     <div class="col-md-4">
         <label class="required form-label">Agent Name</label>
         <div class="fw-bold fs-3">
             <input type="text" class="mb-2 border-gray-300 form-control form-control-solid" placeholder="agent name"
                 name="agent_name" id="agent_name" value="{{ old('agent_name') }}" readonly>
             <input type="hidden" name="agent_id" id="agent_id">
             <input type="hidden" name="is_referral" id="is_referral">
         </div>
     </div>
     <div class="col-md-4">
         <label for="payment_type" class="required form-label">Payment Type</label>
         <select class="form-select" name="payment_type" id="payment_type" data-control="select2"
             data-placeholder="select payment type">
             <option value="" selected>Select Choice</option>
             <option value="flat-fee" @selected(old('payment_type') == 'flat-fee')>
                 Flat Fee
             </option>
             <option value="percentage" @selected(old('payment_type') == 'percentage')>
                 Percentage
             </option>
         </select>
         @error('payment_type')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>
     <div class="col-md-4">
         <label class="required form-label">Earned Amount/Percentage</label>
         <div class="fw-bold fs-3">
             <input type="number" step="any" class="form-control" placeholder="enter amount/percentage"
                 name="agent_earning" id="agent_earning" value="{{ old('agent_earning') }}">
         </div>
     </div>
 </div>

 <div class="mb-5 row">
     <div class="col-md-3">
         <label for="account_manager_id" class="required form-label fw-bold"> Account Managers:</label>
         <select class="form-select" name="account_manager_id" id="account_manager_id" data-control="select2"
             data-placeholder="select account manager">
             <option value="" selected>Select Account Manager</option>
             @foreach ($accountManagers as $accountManager)
                 <option value="{{ $accountManager->id }}" @selected(old('account_manager_id', $quotation->account_manager_id) == $accountManager->id)>
                     {{ $accountManager->full_name }}
                 </option>
             @endforeach
         </select>
         @error('account_manager_id')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>
     <div class="col-md-3">
         <label for="terms_and_condition_id" class="required form-label fw-bold">
             Terms & Conditions:
         </label>
         <select class="form-control form-select @error('terms_and_condition_id') is-invalid @enderror"
             data-control="select2" data-placeholder="select terms & condition" name="terms_and_condition_id"
             id="terms_and_condition_id">
             <option></option>
             @foreach ($termsAndConditions as $termsAndCondition)
                 <option value="{{ $termsAndCondition->id }}" @selected(old('terms_and_condition_id', $quotation->terms_and_condition_id) == $termsAndCondition->id)>
                     {{ $termsAndCondition->name }}
                 </option>
             @endforeach
         </select>
         @error('terms_and_condition_id')
             <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
     </div>
     <div class="mt-9 col-md-6" id="terms-and-condition">
         <div class="pb-0 mx-3 card-body pt-9 border-end border-3 rounded-top rounded-bottom border-info"
             style="background-position: center right -8rem;50px;background-size: 700px; background-repeat:no-repeat; background-image:url('{{ asset('assets/media/stock/bg-card.png') }}')">
             <div class="flex-wrap d-flex flex-sm-nowrap">
                 <div class="flex-grow-1">
                     <div class="flex-wrap mb-2 d-flex justify-content-between align-items-start">
                         <div class="d-flex flex-column">
                             <div class="mb-1 d-flex align-items-center">
                                 <div id="conditions"></div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
