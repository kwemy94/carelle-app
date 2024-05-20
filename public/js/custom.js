// Example POST method implementation:
async function postData(url = "", data, method = "POST") {
    // Default options are marked with *
    const response = await fetch(url, {
        method: method, // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": $('input[name="_token"]').val(),
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },

        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    });

    return response.json(); // parses JSON response into native JavaScript objects
}

// Example POST method implementation:
async function getFetch(url, data, method) {
    // Default options are marked with *

    const response = await fetch(url, {
        method: "GET", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        data: data,
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": $('input[name="_token"]').val(),
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    });

    return response.json(); // parses JSON response into native JavaScript objects
}

function formatFormData(form) {
    let fields = form.serializeArray(),
        formData = {};
    $.each(fields, function (i, field) {
        formData[field.name] = field.value;
    });
    return formData;
}

function uploadImage(source, url) {
    let imageSource = $("#loadedImage").val(source);
    console.log(imageSource);
    const formData = new FormData();
    formData.append("images", imageSource);
    formData.append("array", "true");
}

const submitFetch = async (url, method = "GET") => {
    const response = await fetch(url, {
        // Your POST endpoint
        method: method,
        mode: "no-cors",
    });
    return response.json();
};

loadChart = function (divTag, donutData) {
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    let pieChartCanvas = $("#" + divTag)
        .get(0)
        .getContext("2d");
    let pieData = donutData;
    let pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
        type: "pie",
        data: pieData,
        options: pieOptions,
    });
};

async function postItem(url = "", method = "POST") {

    let reference = $("#reference").val();
    let nom_art = $("#name-item1").val();
    let item_category_id = $("#item_category_id").val();

    let standard_price = $("#standard_price").val();
    // let sale_price = $("#prix_vente_ht_id").val();
    let sale_price = $("#sale_price_ht").val();
    let min_sale_price = $("#min_sale_price").val();

    let tax_sale_id = $("#tax_sale_id").val();
    let sale_tva = $("#sale_tva").val();
    let tax_buy_id = $("#tax_buy_id").val();
    let buy_tva = $("#buy_tva").val();

    let sale_price_ttc = $("#sale_price_ttc").val();

    let alert_stock = $("#alert_stock").val();
    let initial_stock = $("#initial_stock").val();
    let _token = $("input[name=_token]").val();
    let measure_unit_id = $("input[name=measure_unit_id]").val();
    let type = $("input[name=type]").val();
    let avatar = document.querySelector("#imgInp");
    let item_type = $("#item_type").val(); 
    let batch_management = $("#batch_management").val(); 

    // url = `{{ mob_route('item.store') }}`;

    if (
        !sale_price_ttc ||
        !nom_art ||
        !item_category_id ||
        !standard_price ||
        !sale_price ||
        // !min_sale_price ||
        !buy_tva ||
        !sale_tva
    ) {
        return {"message": "Remplir les champs requis"};
    } else {
        const formData = new FormData();
        formData.append("reference", reference);
        formData.append("sale_price_ttc", sale_price_ttc);
        formData.append("label", nom_art);
        formData.append("item_category_id", item_category_id);
        formData.append("standard_price", standard_price);
        formData.append("sale_price", sale_price);
        formData.append("min_sale_price", min_sale_price);
        formData.append("tax_buy_id", tax_buy_id);
        formData.append("buy_tva", buy_tva);
        formData.append("tax_sale_id", tax_sale_id);
        formData.append("sale_tva", sale_tva);
        formData.append("initial_stock", initial_stock);
        formData.append("alert_stock", alert_stock);
        formData.append("measure_unit_id", measure_unit_id);
        formData.append("image", avatar.files[0]);
        formData.append("type", type);
        formData.append("ajax", 1);
        formData.append("for_stock", 1);
        formData.append("for_sale", 1);
        formData.append("for_buy", 1);
        formData.append("status", 1);
        formData.append("item_type", item_type);
        formData.append("batch_management", batch_management); 

        return postData2(url,formData //{
            
        //     reference,
        //     sale_price_ttc,
        //     label: nom_art,
        //     item_category_id,
        //     standard_price,
        //     sale_price,
        //     min_sale_price,
        //     tax_buy_id,
        //     buy_tva,
        //     tax_sale_id,
        //     sale_tva,
        //     initial_stock,
        //     alert_stock,
        //     measure_unit_id,
        //     type,
        //     file,
        //     ajax: 1,
        //     for_stock: 1,
        //     for_sale: 1,
        //     for_buy: 1,
        //     status: 1,
        //     item_type,
        // }
        );
    }
}

const ajaxSubmitForm = async (form, dataType = "json") => {
    let data = new FormData(form[0]);
    let url = form.attr("action"),
        method = form.attr("method");
    if (data) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                method: method,
                data: data,
                enctype: "multipart/form-data",
                contentType: false,
                processData: false,
                dataType: dataType,
            })
                .done((response) => {
                    resolve(response);
                })
                .fail((error) => {
                    reject(error);
                });
        });
    } else {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                method: method,
                data: data,
                enctype: "multipart/form-data",
                contentType: false,
                processData: false,
                dataType: dataType,
            })
                .done((response) => {
                    resolve(response);
                })
                .fail((error) => {
                    reject(error);
                });
        });
    }
};


const submitFormData = async (formData,url, method='POST', dataType = "json") => {
    let response =  await fetch(url, {
        method: method,
        headers: {
            "X-CSRF-Token": $('input[name="_token"]').val()
        },
        body: formData,
    });
    console.log(response);
    return  await response.json();

};

function ControlRequiredFields(inputs = $('.required')) {
    let success = true;

    for (let i = 0; i < inputs.length; i++) {
        if ($(inputs[i]).val() == null || $(inputs[i]).val().trim() == '') { // trim permet d'enlever les tabulation inutile sur un champ
            $(inputs[i]).addClass('error');
            success = false;
        } else {
            $(inputs[i]).removeClass('error');
        }
    }

    return success;
}

async function postData2(url = "", data, method = "POST") {
    // Default options are marked with *
    const response = await fetch(url, {
        method: method, // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        contentType: "multipart/form-data",
        headers: {
            //"Content-Type": "application/json",
            "X-CSRF-Token": $('input[name="_token"]').val(),
        },

        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: data, // body data type must match "Content-Type" header    JSON.stringify(data)
    });

    return response.json(); // parses JSON response into native JavaScript objects
}
