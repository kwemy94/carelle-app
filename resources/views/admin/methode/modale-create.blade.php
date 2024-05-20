<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title h4" style="text-align: center">{{ __("Creation des composants de la méthode") }}</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('use-method.store') }}" id="form-cetagory">
                    @csrf
                    <div class="card-body" id="ma-modale">
                        <div class="form-group">
                            <label for="name">{{ __('Nom du composant') }} <em style="color:red">*</em></label>
                            <input type="text" class="form-control form-control-border border-width-1 required"
                                name="name" id="name" placeholder="Satisfaction client" required>
                        </div>
                        <div class="form-group">
                            <label for="questionnaire_id">Questionnaire associé <em style="color: red">*</em></label>
                            <select name="questionnaire_id" class="custom-select form-control-border border-width-1 required"
                                id="questionnaire_id" required>
                                <option value="" disabled selected >Choisir</option>
                                @foreach ($questionnaires as $qestionnaire)
                                    <option value="{{ $qestionnaire->id }}">{{ $qestionnaire->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <h5>Ajouter les questions de la méthode</h5>
                        <div class="form-group">
                            <label for="name">{{ __('Question 1') }} <em style="color:red">*</em></label>
                            <input type="text" class="form-control required-question form-control-border border-width-1 required"
                                name="lines[question][]" id="q1" placeholder="Satisfaction client" required>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Cotation') }} <em style="color:red">*</em></label>
                            <input type="number" class="form-control required-question cotation form-control-border border-width-1 required"
                                name="lines[cotation][]" id="q1" min="1" step="0.5" placeholder="Satisfaction client" required>
                        </div>
                        <div class="form-group">
                            <label for="response">Réponse 1 <em style="color: red">*</em></label>
                            <select name="lines[response][]" id="r1" class="custom-select required-question form-control-border border-width-1 required"
                                id="response" required>
                                <option value="" disabled selected >Choisir</option>
                                <option value="0">Faux / Non</option>
                                <option value="1">Vrai / Oui</option>
                                
                            </select>
                        </div>


                    </div>
                    <button type="button" id="new-line" class="btn btn-outline-success btn-sm" title="Autre question"><span class="fa fa-plus"></span> </button>

                    <div class="modal-footer justify-content-between">
                        <button type="submit" id="save-category" class="btn btn-primary btn-sm">{{ __('Enregistrer') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
