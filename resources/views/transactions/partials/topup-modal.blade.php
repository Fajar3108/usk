<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="topupModalLabel">Top Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger d-none" id="errorAlert">Error Message</div>
        @csrf
        <div class="mb-3">
            <input type="number" class="form-control" placeholder="Amount" id="amount" required>
            <div id="amountHelp" class="form-text">topup min Rp5.000 and amount must be a multiple of 5000</div>
        </div>
        <button class="btn btn-block btn-primary w-100" id="submitTopup">Submit</button>
      </div>
    </div>
  </div>
</div>
