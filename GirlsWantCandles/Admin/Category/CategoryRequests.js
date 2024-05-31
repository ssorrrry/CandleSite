window.onload = function(){
    let div = $("div.product-grid");
    let changeHistory = $("div#changeHistory");

    $.ajax({
        type: "POST",
        url: "CategoryHandler.php",
        success: function(response){
            let obj = JSON.parse(response);
            let htmlContent = '';
            for(let i = 0; i < obj['read'].length; i++)
            {
                htmlContent += NewCard(obj['read'][i]);
            }
            div.prepend(htmlContent);
        },
        error: function(http, status, e){
            console.log(http);
        }
    });

    div.on("change", "input[name=name]", function(){
        let elem_id = $(this).siblings("input[name=id_category]");

        $.ajax({
            type: "POST",
            url: "CategoryHandler.php",
            data: {
                'action': 'update',
                'id': elem_id.val(),
                'name': this.value
            },
            success: function(response){
                let obj = JSON.parse(response);
                changeHistory.append(`${obj['update']['message']}: {id = ${obj['update']['id']}; old_name = ${obj['update']['old_name']}; new_name = ${obj['update']['new_name']}}<br>`);
            },
            error: function(http, status, e){
                console.log(http);
            }
        });
    });

    div.on("click", "input[name=delete]", function(){
        let elem_id = $(this).siblings("input[name=id_category]");
   
        $.ajax({
            type: "POST",
            url: "CategoryHandler.php",
            data: {
                'action': 'delete',
                'id': elem_id.val(),
            },
            success: function(response){
                let obj = JSON.parse(response);
                changeHistory.append(`${obj['delete']['message']}: {id = ${obj['delete']['id']}; name = ${obj['delete']['name']}}<br>`);
                $(`input[name=id_category][value=${obj['delete']['id']}]`).closest(".product-card").remove();
            },
            error: function(http, status, e){
                console.log(http);
            }
        });
    });

    div.on("click", "input[name=create]", function(){
        let self = $(this);
        let elem_name = $(this).siblings("input[name=new_name]");

        if(elem_name.val() != ''){
            $.ajax({
                type: "POST",
                url: "CategoryHandler.php",
                data: {
                    'action': 'create',
                    'name': elem_name.val(),
                },
                success: function(response){
                    elem_name.val('');
                    let obj = JSON.parse(response);
                    changeHistory.append(`${obj['create']['message']}: {id = ${obj['create']['id']}; name = ${obj['create']['name']}}<br>`);
                    let htmlContent = NewCard(obj['create']);
                    self.closest(".product-card").before(htmlContent);
                },
                error: function(http, status, e){
                    console.log(http);
                }
            });
        }
        else{
            changeHistory.append("Введите название<br>");
        }
    });
};


function NewCard(obj)
{
    let htmlContent = '';
    htmlContent += "<div class='product-card background' id='db'><table>";
    htmlContent += `<tr><td>Название: <input type='text' name='name' value='${obj['name']}' class='text'>`;
    htmlContent += `<input type='hidden' name='id_category' value='${obj['id']}'>`;
    htmlContent += `<input type='button' value='Удалить' name='delete' class='button_delete'></td></tr>`;
    htmlContent += "</tr></table></div>";

    return htmlContent;
}