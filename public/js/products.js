let products = [];
getFilteredProducts();

function getFilteredProducts() {
    const product_name_key = $('#textProductName').val() ?? '';
    const company_id = $('#selectCompany').val();
    const price_limit_lower = $('#numPriceLimitLower').val() ?? '';
    const price_limit_upper = $('#numPriceLimitUpper').val() ?? '';
    const stock_limit_lower = $('#numStockLimitLower').val() ?? '';
    const stock_limit_upper = $('#numStockLimitUpper').val() ?? '';

    $.ajax({
        url: "products/filteredProducts",
        method: "POST",
        data: {
            product_name_key : product_name_key,
            company_id : company_id,
            price_limit_lower : price_limit_lower,
            price_limit_upper : price_limit_upper,
            stock_limit_lower : stock_limit_lower,
            stock_limit_upper : stock_limit_upper
        },
        dataType: "json",
    }).done(function(res) {
        products = res.products;
        sortAndShowProducts();
    }).fail(function(){
        alert('データの取得に失敗しました');
    });
}

function sortAndShowProducts() {
    const $tbody = $('#tableProducts > tbody').first();

    $tbody.empty();

    const sortKey = $('#selectSortProductsSauce').val();
    products.sort(function(a, b){
        if (a[sortKey] > b[sortKey]) return 1;
        if (a[sortKey] < b[sortKey]) return -1;

        if (a.id > b.id) return 1;
        if (a.id < b.id) return -1;
    });

    for(const i in products) {
        const product = products[i];

        $tbody.append(
            $(`<tr id="trProduct${product.id}" class="product-row"/>`).append(
                `<td>${product.id}</td>`,
                `<td>${product.img_path == '' ? 'NOIMAGE' : `<img class="products_img" src="${product.img_path}" alt="商品画像">`}</td>`,
                `<td>${product.product_name}</td>`,
                `<td>${product.price}</td>`,
                `<td>${product.stock}</td>`,
                `<td>${product.company_name}</td>`,
                `<td><button onclick="window.location.href='./prodctDeteal?id=${product.id}'">詳細</button></td>`,
                `<td><button onclick="deleteProduct(${product.id})">削除</button></td>`
            )
        );
    }
}

function deleteProduct(id) {
    if(!window.confirm('削除してよろしいですか？')) return;

    $.ajax({
        url: "products/deleteProduct",
        method: "Post",
        data: {
            id : id
        },
        dataType: "json",
    }).done(function() {
        $(`#trProduct${id}`).remove();
    }).fail(function(){
        alert('削除に失敗しました');
    });
}