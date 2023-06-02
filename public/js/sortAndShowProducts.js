let products = [];
getFilteredProducts();

function sortAndShowProducts() {
    const $tbody = $('#tableProducts > tbody').first();

    $tbody.empty();

    for(const i in products) {
        const product = products[i];

        $tbody.append(
            $('<tr class="product-row"/>').append(
                `<td>${product.id}</td>`,
                `<td></td>`,
                `<td>${product.product_name}</td>`,
                `<td>${product.price}</td>`,
                `<td>${product.stock}</td>`,
                `<td>${product.company_name}</td>`,
                `<td><button>詳細</button></td>`,
                `<td><button>削除</button></td>`
            )
        );
    }
}