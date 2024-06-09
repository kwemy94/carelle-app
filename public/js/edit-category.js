$('#save-edit-category').click((e) => {
    e.preventDefault();
    console.log('edit');
    // let inputs = $('#form-edit-category .cotation');
    // let sommeCotation = 0;
    if (!ControlRequiredFields($('#form-edit-category .required'))) {
        return 0;
    }
    // for (let i = 0; i < inputs.length; i++) {
    //     sommeCotation += parseFloat($(inputs[i]).val());
    // }
    // console.log('cotation : ' + sommeCotation);
    // if (sommeCotation != 100) {
    //     $('.error-cotation').removeAttr('hidden');
    //     return 0;
    // }
    $('#save-edit-category').prop("disabled", true);
    $('#form-edit-category').submit();
});

$('#neu-line-edit').click(() => {
    var a = 2;
    let newQuestion = '<div id="block-question"><div class="form-group">' +
        '<button type="button" id="delete-line" class="btn btn-outline-danger btn-sm" title="Supprimer"><span class="fa fa-trash"></span> </button>' +
        '<label for="name">Question <em style="color:red">*</em></label>' +
        '<input type="text" class="form-control required-question form-control-border border-width-1 required"' +
        'name="lines[question][]" id="" placeholder="Satisfaction client" required>' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="type">Type<em style="color:red">*</em></label>' +
        '<select name="lines[type][]" class="custom-select required-question form-control-border border-width-1 required"' +
        'id="type" required>' +
        '<option value="" disabled selected >Choisir</option>' +
        '<option value="2"  selected >Attente</option>' +
        '<option value="0"  selected >Importance</option>' +
        '<option value="1"  selected >Perception</option>' +
        '</select>' +
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

function editer(id) {
    let url = $('#edit_' + id).data('url');

    let data = {};
    console.log(url, data);
    $('#loader').css('display', 'block');
    $('#loader').html('<div class="text-center"><i style="z-index: 5000; color:green;font-size:30px;">Chargement....</i></div>');
    $.ajax({
        url,
        data,
        success: (data) => {
            console.log(data);
            // $('#edit_method').css('display', 'blog');
            $('#body-edit').html(data.view)
            $('#modal-edit').modal('show');
            $('#loader').css('display', 'none');
        },
        error: (xhr, exception) => {
            $('#loader').css('display', 'none');
        }
    })
}