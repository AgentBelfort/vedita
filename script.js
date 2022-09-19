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