var item = "";
var itemId = "";
var orderId = 0;
var placedOrders = [0];
var total = parseFloat(document.getElementById("total").innerHTML) * 1000 || 0;
var cashier = document.getElementById("total");
var baseUrl = "https://ecommerce-eugene.azurewebsites.net";

function addToCart(productJson, buyerId, orderIdb) {
    var product = JSON.parse(productJson);
    var product_price = product.price;
    var userId = buyerId;
    var itemName = product.name;
    var product_id = product.id;
    var productId = product.id;
    var quantity = 1;
    var order_id = +orderIdb || orderId;
    orderId = placedOrders.includes(order_id) ? 0 : order_id;
    alert(orderId);
    var sellerId = product.user_id;
    var sendData =
        "user_id=" +
        userId +
        "&product_id=" +
        productId +
        "&quantity=" +
        quantity +
        "&order_id=" +
        +orderId +
        "&seller_id=" +
        sellerId +
        "&product_price=" +
        product_price;
    // console.log(sendData);
    // itemObj = Object.assign({}, product);
    // itemObj.order_id = +orderId;
    // itemObj.product_id = +product_id;
    // item = JSON.stringify(itemObj);
    // console.log(item);
    // console.log(sendData);
    // debugger;
    console.log(sendData);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                orderId = JSON.parse(this.responseText).order_id;
            }
            // console.log(orderId);
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
    if (!(item instanceof Object)) {
        item = JSON.parse(item);
    }
    var itemId = item.id;
    var itemObj = item;
    var myjson = JSON.stringify(item);
    var table = document.getElementById("shoppingCart");
    var row = document.createElement("tr");
    total += itemObj.quantity * itemObj.price;
    formattedTotal = total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
    var cell = document.createElement("td");
    row.id = "delete" + itemId;
    var quantityButton =
        '<button class="btn btn-primary btn-sm" onclick=\'addQuantity(' +
        myjson +
        "," +
        buyerId +
        ', prompt("Enter Quantity: "))\'>Quantity</button>';
    console.log(quantityButton);
    var removeButton =
        '<button class="btn btn-danger btn-sm" onclick=\'removeCart(' +
        myjson +
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

    var xhttp = new XMLHttpRequest();
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
    var xhttp = new XMLHttpRequest();
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

function clearCart(orderIdb) {
    orderId = orderId || orderIdb;
    $("#shoppingCart td").hide();
    $("#cashier").hide();

    var xhttps = new XMLHttpRequest();
    xhttps.open("GET", baseUrl + "/clearCart/" + orderId, true);
    xhttps.send();
}

function placeOrder(orderIdb) {
    orderId = orderId || orderIdb;
    alert(orderId);
    $("#shoppingCart td").hide();
    $("#cashier").hide();

    placedOrders.push(+orderId);
    var xhttps = new XMLHttpRequest();
    xhttps.open("GET", baseUrl + "/placeOrder/" + orderId, true);
    xhttps.send();
}
