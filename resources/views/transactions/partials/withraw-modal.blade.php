<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="withdrawModalLabel">Withraw</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger d-none" id="withdrawErrorAlert">Error Message</div>
        <div class="mb-3">
            <input type="number" class="form-control" placeholder="Amount" id="amountWithdraw" required>
            <div id="amountHelp" class="form-text">withraw min Rp500 and amount must be a multiple of 500</div>
        </div>
        <button class="btn btn-block btn-primary w-100" id="submitWithdraw">Submit</button>
      </div>
    </div>
  </div>
</div>
