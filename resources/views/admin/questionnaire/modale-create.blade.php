<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title h4" style="text-align: center">{{ __("Creation d'un questionnaire") }}</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('questionnaire.store') }}" id="product-form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Intitulé du questionnaire') }} <em style="color:red">*</em></label>
                            <input type="text" class="form-control form-control-border border-width-2 required"
                                name="name" id="name" placeholder="Satisfaction client" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control form-control-border border-width-2"
                                name="description" id="description">
                        </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="submit" id="save-product" class="btn btn-primary btn-sm">{{ __('Enregistrer') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
