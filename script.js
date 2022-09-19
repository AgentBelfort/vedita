function hide_td(id) {
    // удаляем строку
    row = document.getElementById('tr_'+id);
    row.remove();

    // ajax request
    const request = new XMLHttpRequest();
    const url = "ajax_quest.php?action=hide_product&product_id=" + id;
    request.open('GET', url);
    request.send();
}

function change_qty(id, mutable_value) {
    // ajax request
    const request = new XMLHttpRequest();
    const url = "ajax_quest.php?action=change_qty&product_id=" + id + "&mutable_value=" + mutable_value;
    request.open('GET', url);
    request.addEventListener("readystatechange", () => { // изменим текст после получения результата
        if (request.readyState === 4 && request.status === 200) {
            console.log(request.responseText);
            // изменяем текст
            qty_nobr = document.getElementById('qty_'+id);
            qty_nobr.innerHTML = request.responseText;
        }
    });
    request.send();
}