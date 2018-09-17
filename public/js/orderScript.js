var item = "";
var itemId = "";
var orderId = "";
var xhttp = new XMLHttpRequest();
var total = parseFloat(document.getElementById("total").innerHTML) * 1000 || 0;
var cashier = document.getElementById("total");
var baseUrl = "http://127.0.0.1:8000";

function addToCart(productJson, buyerId, orderIdb) {
    var product = JSON.parse(productJson);
    var product_price = product.price;
    var userId = buyerId;
    var itemName = product.name;
    var product_id = product.id;
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
        sellerId +
        "&product_price=" +
        product_price;
    // console.log(sendData);
    // itemObj = Object.assign({}, product);
    // itemObj.order_id = +orderId;
    // itemObj.product_id = +product_id;
    // item = JSON.stringify(itemObj);
    console.log(item);

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                orderId = this.responseText;
            }
            console.log(this.responseText);
            updateCart(
                itemName,
                quantity,
                productId,
                buyerId,
                this.responseText
            );
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

function updateCart(itemName, quantity, productId, buyerId, item) {
    console.log(item);
    var itemId = JSON.parse(item).id;
    var itemObj = JSON.parse(item);
    var table = document.getElementById("shoppingCart");
    var row = document.createElement("tr");
    total += itemObj.quantity * itemObj.price;
    formattedTotal = total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
    var cell = document.createElement("td");
    row.id = "delete" + itemId;
    var quantityButton =
        '<button class="btn btn-primary btn-sm" onclick=\'addQuantity(' +
        item +
        "," +
        buyerId +
        ', prompt("Enter Quantity: "))\'>Quantity</button>';
    console.log(quantityButton);
    var removeButton =
        '<button class="btn btn-danger btn-sm" onclick=\'removeCart(' +
        item +
        ")'>Remove</button>";

    var rowData =
        "<td>" +
        itemName +
        "</td>" +
        "<td id='quantity" +
        itemId +
        "'>" +
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
    cashier.innerHTML = formattedTotal;
    document.getElementById("cashier").style.display = "block";

    // row.innerHTML = rowData;
}

function addQuantity(item, buyerId, quantity) {
    if (!(item instanceof Object)) {
        item = JSON.parse(item);
    }
    var item_id = item.id;
    var oldItemTot = +item.quantity * +item.price;
    var newItemTot = +quantity * +item.price;
    var diff = newItemTot - oldItemTot;
    total += diff;
    var formattedTotal = total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
    var sendData = "quantity=" + quantity + "&item_id=" + item_id;

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            updateQuantityCell(quantity, item, formattedTotal);
        }
    };
    xhttp.open("POST", baseUrl + "/addQuantity", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader(
        "X-CSRF-Token",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );
    xhttp.send(sendData);

    console.log(sendData);
    // console.log(quantity);
    // console.log(buyerId);
}

function updateQuantityCell(quantity, item, formattedTotal) {
    if (!(item instanceof Object)) {
        item = JSON.parse(item);
    }
    var itemId = item.id;
    var cellId = "quantity" + itemId;

    var cell = document.getElementById(cellId);
    cell.innerHTML = quantity;
    cashier.innerHTML = formattedTotal;
}

function removeCart(item) {
    // var item = JSON.parse(itemJson);
    if (!(item instanceof Object)) {
        item = JSON.parse(item);
    }
    var itemId = item.id;
    var itemSubt = +item.price * +item.quantity;
    total -= itemSubt;
    var formattedTotal = total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xhttp.open("GET", baseUrl + "/removeFromCart/" + itemId, true);
    xhttp.send();

    document.getElementById("delete" + itemId).style.display = "none";
    cashier.innerHTML = formattedTotal;
}
