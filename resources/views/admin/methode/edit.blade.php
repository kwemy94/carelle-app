<form method="POST" action="{{ route('use-method.update', $category->id) }}" id="form-edit-category">
    @csrf
    @method('PUT')
    <div class="card-body" id="ma-modal-edit">
        <div class="form-group">
            <label for="name">{{ __('Nom du composant') }} <em style="color:red">*</em></label>
            <input type="text" class="form-control form-control-border border-width-1 required" name="name"
                id="name" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="questionnaire_id">Questionnaire associé <em style="color: red">*</em></label>
            <select name="questionnaire_id" class="custom-select form-control-border border-width-1 required"
                id="questionnaire_id" required>
                <option value="" disabled>Choisir</option>
                @foreach ($questionnaires as $questionnaire)
                    <option value="{{ $questionnaire->id }}"
                        {{ $category->questionnaire_id == $questionnaire->id ? 'selected' : '' }}>
                        {{ $questionnaire->name }}</option>
                @endforeach
            </select>
        </div>
        <hr>
        <h5>Ajouter les questions de la méthode</h5>
        @php
            $i = 1;
        @endphp
        @foreach ($category->questions as $question)
            <div class="form-group">
                <label for="name">{{ __("Question $i") }} <em style="color:red">*</em></label>
                <input type="text" class="form-control required-question form-control-border border-width-1 required"
                    name="lines[question_{{ $question->id }}][]" id="q{{ $question->id }}"
                    value="{{ $question->intitule }}" required>
            </div>
            <div class="form-group">
                <label for="name">{{ __("Cotation $i") }} <em style="color:red">*</em></label>
                <input type="number"
                    class="form-control required-question cotation form-control-border border-width-1 required"
                    name="lines[cotation][]" id="q1{{ $question->id }}" min="1" step="0.5"
                    value="{{ $question->cotation }}" required>
            </div>
            <div class="form-group">
                <label for="response">Réponse {{ $i }} <em style="color: red">*</em></label>
                <select name="lines[response][]" id="r1"
                    class="custom-select required-question form-control-border border-width-1 required" id="response"
                    required>
                    <option value="" disabled>Choisir</option>
                    <option value="0" {{ $question->response == 0 ? 'selected' : '' }}>Faux / Non</option>
                    <option value="1" {{ $question->response == 1 ? 'selected' : '' }}>Vrai / Oui</option>

                </select>
            </div>
            @php
                $i++;
            @endphp
        @endforeach


    </div>
    <div class="card-body">
        <div class="form-group error-cotation" hidden>
            <label for="" style="color: red">La somme des cotations doit être égale à 100</label>

        </div>
    </div>
    <button type="button" id="neu-line-edit" class="btn btn-outline-success btn-sm" title="Autre question"><span
            class="fa fa-plus"></span> </button>

    <div class="modal-footer justify-content-between">
        <button type="submit" id="save-edit-category" class="btn btn-primary btn-sm">{{ __('Enregistrer') }}
        </button>
    </div>
</form>

<script>
    $('#save-edit-category').click((e) => {
        e.preventDefault();
        console.log('edit');
        let inputs = $('#form-edit-category .cotation');
        let sommeCotation = 0;
        if (!ControlRequiredFields($('#form-edit-category .required'))) {
            return 0;
        }
        for (let i = 0; i < inputs.length; i++) {
            sommeCotation += parseFloat($(inputs[i]).val());
        }
        console.log('cotation : ' + sommeCotation);
        if (sommeCotation != 100) {
            $('.error-cotation').removeAttr('hidden');
            return 0;
        }
        $('#save-edit-category').prop("disabled", true);
        $('#form-edit-category').submit();
    });

    $('#neu-line-edit').click(() => {
            var a = 2;
            let newQuestion = '<div id="block-question"><div class="form-group">' +
                '<button type="button" id="delete-line" class="btn btn-outline-danger btn-sm" title="Supprimer"><span class="fa fa-trash"></span> </button>' +
                '<label for="name">{{ __('Question') }} <em style="color:red">*</em></label>' +
                '<input type="text" class="form-control required-question form-control-border border-width-1 required"' +
                'name="lines[question][]" id="" placeholder="Satisfaction client" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="name">{{ __('Cotation') }} <em style="color:red">*</em></label>' +
                '<input type="number" class="form-control required-question cotation form-control-border border-width-1 required"' +
                'name="lines[cotation][]" id="q1" min="1" step="0.5" placeholder="Satisfaction client" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="response">Réponse 1 <em style="color: red">*</em></label>' +
                '<select name="lines[response][]" class="custom-select required-question form-control-border border-width-1 required"' +
                'id="response" required>' +
                '<option value="" disabled selected >Choisir</option>' +
                '<option value="0">Faux / Non</option>' +
                '<option value="1">Vrai / Oui</option>' +
                '</select>' +
                '</div></div>';
            if (!ControlRequiredFields($('#form-edit-category .required-question'))) {
                alert("Remplir les questions précedente  avant de créer une autre");
                return 0;
            }
            $('#ma-modal-edit').append(newQuestion);

        });
</script>
