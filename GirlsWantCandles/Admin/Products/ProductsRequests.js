window.onload = function(){
    let div = $("div.product-grid");
    let categories = [];
    let changeHistory = $("div#changeHistory");

    $.ajax({
        type: "POST",
        url: "../Category/CategoryHandler.php",
        success: function(response){
            let obj = JSON.parse(response);
            let htmlContent = '';
            for(let i = 0; i < obj['read'].length; i++)
            {
                htmlContent += `<option value = '${obj['read'][i]['id']}'> ${obj['read'][i]['name']} </option>`;
                let category = {
                    'id': obj['read'][i]['id'],
                    'name': obj['read'][i]['name']
                };
                categories.push(category);
            }
            $("select[name=id_category]").append(htmlContent);
        },
        error: function(http, status, e){
            console.log(http);
        },
    });

    $.ajax({
        type: "POST",
        url: "ProductsHandler.php",
        success: function(response){
            let obj = JSON.parse(response);
            let htmlContent = '';
            for(let i = 0; i < obj['read'].length; i++)
            {
                htmlContent += NewCard(obj['read'][i], categories);
            }
            div.prepend(htmlContent);
        },
        error: function(http, status, e){
            console.log(http);
        },
    });

    $("input[name=create]").click(function(){
        let self = $(this);
        
        $.ajax({
            type: "POST",
            url: "ProductsHandler.php",
            data: {
                'action': 'create',
                'path_img': $(this).siblings("input[name=path_img]").val(),
                'name': $(this).siblings("input[name=name]").val(),
                'description': $(this).siblings("textarea[name=description]").val(),
                'id_category': $(this).siblings("select[name=id_category]").val(),
                'price': $(this).siblings("input[name=price]").val(),
            },
            success: function(response){
                let obj = JSON.parse(response);
                let htmlContent = '';
                htmlContent = NewCard(obj['create'], categories);
                self.parent().before(htmlContent);
                changeHistory.append(`${obj['create']['message']}: {id = ${obj['create']['id']}; name = ${obj['create']['name']}}<br>`);
                self.closest("div").find("input:not([name=create]), textarea").val('');
            },
            error: function(http, status, e){
                console.log(http);
            },
        });
    });

    $("div.product-grid").on("click", "input[name=delete]", function(){
        $.ajax({
            type: "POST",
            url: "ProductsHandler.php",
            data: {
                'action': 'delete',
                'id': $(this).siblings("input[name=id_product]").val(),
            },
            success: function(response){
                let obj = JSON.parse(response);
                $(`input[name=id_product][value=${obj['delete']['id']}]`).parent().remove();
                changeHistory.append(`${obj['delete']['message']}: {id = ${obj['delete']['id']}; name = ${obj['delete']['name']}; description = ${obj['delete']['description']}; id_category = ${obj['delete']['id_category']}; price = ${obj['delete']['price']}; path_img = ${obj['delete']['path_img']}}<br>`);
            },
            error: function(http, status, e){
                console.log(http);
            },
        });
    });

    $("div.product-grid").on("change", "div.product-card:not(.form) input, div.product-card:not(.form) select, div.product-card:not(.form) textarea", function(){
        let self = $(this);
        console.log($(this).is("select") ? $(this).find(":selected").val() : $(this).val());
        $.ajax({
            type: "POST",
            url: "ProductsHandler.php",
            data: {
                'action': 'update',
                'id': $(this).siblings("input[name=id_product]").val(),
                'key': $(this).attr('name'),
                'value': $(this).is("select") ? $(this).find(":selected").val() : $(this).val()
            },
            success: function(response){
                let obj = JSON.parse(response);
                console.log(obj['update']);

                if(obj['update']['key'] == 'path_img')
                {
                    self.siblings("img").attr('src', `../${obj['update']['new_value']}`);
                }
                
                changeHistory.append(`${obj['update']['message']}: {id = ${obj['update']['id']}; key = ${obj['update']['key']}; old_value = ${obj['update']['old_value']}; new_value = ${obj['update']['new_value']}}<br>`);
            },
            error: function(http, status, e){
                console.log(http);
            },
        });
    });
}

function NewCard(obj, categories)
{   
    let htmlContent = '';
    htmlContent += `<div class='product-card'>`;
    htmlContent += `<img src='../${obj['path_img']}'><br><br>`;
    htmlContent += `Путь: <input type='text' name='path_img' value='${obj['path_img']}' class='text input'><br>`;
    htmlContent += `<input type='text' name='name' value='${obj['name'].toUpperCase()}' class='text input'><br>`;
    htmlContent += `<textarea name='description' class='input description'>${obj['description']}</textarea><br>`;
    htmlContent += `Категория: <select name='id_category'>`;
    for(let j = 0; j < categories.length; j++)
    {
        if(categories[j]['id'] == obj['id_category'])
        {
            htmlContent += `<option value = '${obj['id_category']}' selected> ${categories[j]['name']} </option>`;
        }
        else
        {
            htmlContent += `<option value = '${categories[j]['id']}'> ${categories[j]['name']} </option>`;
        }
    }
    htmlContent += `</select><br><br>`;
    

    htmlContent += `Наличие: <select name='availability'>`;
    if(obj['availability'] == 0){
        htmlContent += `<option value=0 selected>Отсутсвует</option>`;
        htmlContent += `<option value=1>В наличие</option>`;
    }
    else{
        htmlContent += `<option value=0>Отсутсвует</option>`;
        htmlContent += `<option value=1 selected>В наличие</option>`;
    }
    htmlContent += `</select><br><br>`;


    htmlContent += `Цена: <input type='number' name='price' value='${obj['price']}' class='input number'> руб <br><br>`;
    htmlContent += `<input type='hidden' name='id_product' value='${obj['id']}'>`;
    htmlContent += `<input type='button' name='delete' value='Удалить' class='submit_1'></div>`;

    return htmlContent;
}