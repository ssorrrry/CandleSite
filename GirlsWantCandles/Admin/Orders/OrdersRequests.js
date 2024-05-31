window.onload = function(){
    let changeHistory = $("div#changeHistory");
    let products = [];
    let sost = [
        {
            'value': 0,
            'text': 'В процессе'
        },
        {
            'value': 1,
            'text': 'Выполнен'
        }
    ];

    $.ajax({
        type: "POST",
        url: "../Products/ProductsHandler.php",
        success: function(response){
            let obj = JSON.parse(response);
            for(let i = 0; i < obj['read'].length; i++)
            {
                let product = {
                    'id': obj['read'][i]['id'],
                    'name': obj['read'][i]['name']
                };
                products.push(product);
            }

            $.ajax({
                type: "POST",
                url: "OrdersHandler.php",
                success: function(response){
                    let obj = JSON.parse(response);
                    let htmlContent = '';
                    for(let i = 0; i < obj['read'].length; i++)
                    {
                        htmlContent += NewCard(obj['read'][i], products, sost);
                    }
                    $("table").append(htmlContent);
                },
                error: function(http, status, e){
                    console.log(http);
                }
            });
        },
        error: function(http, status, e){
            console.log(http);
        }
    });

    

    $("table").on("change", "input, select", function(){
        $.ajax({
            type: "POST",
            url: "OrdersHandler.php",
            data: {
                'action': 'update',
                'id': $(this).closest('tr').find("input[name=id_order]").val(),
                'key': $(this).attr('name'),
                'value': $(this).is("select") ? $(this).find(":selected").val() : $(this).val()
            },
            success: function(response){
                let obj = JSON.parse(response);
                changeHistory.append(`${obj['update']['message']}: {id = ${obj['update']['id']}; key = ${obj['update']['key']}; old_value = ${obj['update']['old_value']}; new_value = ${obj['update']['new_value']}}<br>`);
            },
            error: function(http, status, e){
                console.log(http);
            },
        });
    });

    $("table").on("click", "input[name=delete]", function(){

        $.ajax({
            type: "POST",
            url: "OrdersHandler.php",
            data: {
                'action': 'delete',
                'id': $(this).closest('tr').find("input[name=id_order]").val(),
            },
            success: function(response){
                let obj = JSON.parse(response);
                console.log(obj['delete']);
                $(`input[name=id_order][value=${obj['delete']['id']}]`).closest('tr').remove();
                changeHistory.append(`${obj['delete']['message']}: {id = ${obj['delete']['id']}; name = ${obj['delete']['name']}; telephone = ${obj['delete']['telephone']}; address = ${obj['delete']['address']}; id_product = ${obj['delete']['id_product']}; quantity = ${obj['delete']['quantity']}; date = ${obj['delete']['date']}; sost = ${obj['delete']['sost']}}<br>`);
            },
            error: function(http, status, e){
                console.log(http);
            },
        });
    });

};

function NewCard(obj, products, sost)
{
    let htmlContent = '';
    htmlContent += `<tr><td><input type='hidden' name='id_order' value='${obj['id']}'>`;
    htmlContent += `${obj['name']}</td>`;
    htmlContent += `<td>${obj['telephone']}</td>`;
    htmlContent += `<td><input type='text' name='address' value='${obj['address']}' class='input text'></td>`;

    htmlContent += `<td><select name='id_product'>`;
    for(let j = 0; j < products.length; j++)
    {
        if(products[j]['id'] == obj['id_product'])
        {
            htmlContent += `<option value = '${obj['id_product']}' selected> ${products[j]['name']} </option>`;
        }
        else
        {
            htmlContent += `<option value = '${products[j]['id']}'> ${products[j]['name']} </option>`;
        }
    }
    htmlContent += `</select></td>`;

    htmlContent += `<td><input type='number' name='quantity' value='${obj['quantity']}' class='input number'></td>`;
    htmlContent += `<td>${obj['date']}</td>`;

    htmlContent += `<td><select name='sost'>`;
    for(let j = 0; j < sost.length; j++)
    {
        if(sost[j]['value'] == obj['sost'])
        {
            htmlContent += `<option value = '${obj['sost']}' selected> ${sost[j]['text']} </option>`;
        }
        else
        {
            htmlContent += `<option value = '${sost[j]['value']}'> ${sost[j]['text']} </option>`;
        }
    }
    htmlContent += `</select></td>`;

    htmlContent += `<td><input type='button' name='delete' value='Удалить' class='submit_1'></td>`;

    return htmlContent;
}