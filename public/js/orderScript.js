var item = "";
var orderId = "";
var baseUrl = "http://127.0.0.1:8000";

function addToCart(productJson, buyerId, orderIdb) {
    var product = JSON.parse(productJson);
    var userId = buyerId;
    var itemName = product.name;
    var productId = product.id;
    var quantity = 1;
    orderId = orderIdb || 0;
    var sellerId = product.user_id;
    var sendData =
        "user_id=" +
        userId +
        "&product_id=" +
        productId +
        "&quantity=" +
        quantity +
        "&order_id=" +
        orderId +
        "&seller_id=" +
        sellerId;
    // console.log(sendData);
    itemObj = Object.assign({}, product);
    itemObj.orderId = orderId;
    item = JSON.stringify(itemObj);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                orderId = this.responseText;
            }
            console.log(this.responseText);
            updateCart(itemName, quantity, productId);
        }
    };
    xhttp.open("POST", baseUrl + "/addToCart", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader(
        "X-CSRF-Token",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );
    xhttp.send(sendData);
}

function updateCart(itemName, quantity, productId) {
    var table = document.getElementById("shoppingCart");
    var row = document.createElement("tr");
    var cell = document.createElement("td");
    var quantityButton =
        '<button class="btn btn-primary btn-sm" onclick="addQuantity(' +
        item +
        ', prompt("Enter Quantity: "))>Quantity</button>';
    var removeButton =
        '<button class="btn btn-danger btn-sm" onclick="removeCart(' +
        productId +
        ')">Remove</button>';

    var rowData =
        "<td>" +
        itemName +
        "</td>" +
        "<td>" +
        quantity +
        "</td>" +
        "<td>" +
        quantityButton +
        "</td>" +
        "<td>" +
        removeButton +
        "</td>";

    row.innerHTML = rowData;
    table.appendChild(row);

    // row.innerHTML = rowData;
}
