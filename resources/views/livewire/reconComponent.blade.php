<div>
    <h1 class="h3 mb-2 text-gray-800"
        style="text-align:center;margin-top:10px;font-weight: bold; color: #5a5c69 !important;font-size: 1.75rem;">CLAIMS
        SYSTEM</h1>
    <div id="reconsideracion">
        <div class="container-fluid">

            <div class="card mb-3">
                <div class="card-header" style="color: #858796 !important;">CLAIMS</div>
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row my-1">
                            <div class="p-3 col-md-6 order-sm-2 order-md-1">
                                <div class="form-group">
                                    <label for="claimSelect" class="form-label">Select search filter:</label>
                                    <select id="claimSelect" name="claimSelect"class="form-select" style=""
                                        wire:model.change="filtrorecon">
                                        <option value="1">ALL</option>
                                        <option value="2">CLAIMS RECEIVED</option>
                                        <option value="3">CLAIMS ASSIGNED</option>
                                        <option value="4">CLAIMS RESOLVED</option>
                                        <option value="5">CLAIMS NOTIFIED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="p-4 col-sm-12 col-md-6 order-sm-1 order-md-2 ">
                                <div class=" d-grid gap-2 d-md-flex justify-content-md-end ">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        wire:click="abriModal('nueva_reconsideracion','0')">
                                        New Claims
                                    </button>
                                </div>
                                @include('Recon.Recon_modal')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('Recon.recon_list')
        </div>
    </div>

    @if ($open)
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
