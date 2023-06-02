function getFilteredProducts() {
    const product_name_key = $('#textProductName').val() ?? '';
    const company_id = $('#selectCompany').val();

    $.ajax({
        url: "products/filteredProducts",
        method: "GET",
        data: {
            product_name_key : product_name_key,
            company_id : company_id
        },
        dataType: "json",
    }).done(function(res) {
        products = res.products;
        sortAndShowProducts();
    }).fail(function(){
        alert('通信の失敗をしました');
    });
}