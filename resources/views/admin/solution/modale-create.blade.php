<form method="POST" action="{{ route('solution.store') }}" id="solution-form">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="intitule">{{ __('Intitulé de la solution') }} <em style="color:red">*</em></label>
            <input type="text" class="form-control form-control-border border-width-2 required" name="intitule"
                id="intitule" placeholder="Satisfaction client" required>
        </div>
        <div class="form-group">
            <label for="category_id">category associé <em style="color: red">*</em></label>
            <select name="category_id" class="custom-select form-control-border border-width-1 required"
                id="category_id" required>
                <option value="" disabled selected>Choisir</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}
                        ({{ isset($category->questionnaire->name) ? $category->questionnaire->name : '' }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="marge_inf">{{ __('Valeur min') }} <em style="color:red">*</em></label>
                    <input type="number" class="form-control form-control-border border-width-2 required"
                        name="marge_inf" id="marge_inf" min="0" max="100" placeholder="Satisfaction client"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="marge_sup">{{ __('Valeur max') }} <em style="color:red">*</em></label>
                    <input type="number" class="form-control form-control-border border-width-2 required"
                        name="marge_sup" id="marge_sup" min="0" max="100" placeholder="Satisfaction client"
                        required>
                </div>
                <label id="error-marge" style="color: red"
                    hidden>{{ __('la valeur min ne peut être supérieur à la valeur max') }} </label>
            </div>
        </div>
        <div class="form-group">
            <label for="summernote">Description</label>
            <textarea name="description" class="form-control" id="summernote" rows="4">
            
            </textarea>
        </div>

    </div>

    <div class="modal-footer justify-content-between">
        <button type="submit" id="save-solution" class="btn btn-primary btn-sm">{{ __('Enregistrer') }}
        </button>
    </div>
</form>
