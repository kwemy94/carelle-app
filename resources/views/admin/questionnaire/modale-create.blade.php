<form method="POST" action="{{ route('questionnaire.store') }}" id="quiz-form">
    @csrf
    <div id="edit_method" style="display: none">
        @method('PUT')
    </div>
    <div class="card-body" >
        <div class="form-group">
            <label for="name">{{ __('Intitulé du questionnaire') }} <em style="color:red">*</em></label>
            <input type="text" class="form-control form-control-border border-width-2 required"
                name="name" id="name" placeholder="Satisfaction client" value="{{ asset($questionnaire)? $questionnaire->name : '' }}" required>
        </div>
         
        <div class="form-group">
            <label for="summernote">Description</label>
            <textarea name="description" class="form-control" id="summernote" rows="4"></textarea>
        </div>

    </div>

    <div class="modal-footer justify-content-between">
        <button type="submit" id="save-product" class="btn btn-primary btn-sm">{{ __('Enregistrer') }}
        </button>
    </div>
</form>
