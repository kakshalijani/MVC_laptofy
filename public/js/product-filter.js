function loadProducts(){

var keyword = document.getElementById("search").value;
var brand_id = document.getElementById("brandFilter").value;

var xhr = new XMLHttpRequest();

xhr.open(
    "GET",
    "/laptofy_MVC/public/filter?keyword="+keyword+"&brand_id="+brand_id,
    true
);

xhr.onload = function(){

if(xhr.status == 200){

document.getElementById("productContainer").innerHTML = xhr.responseText;

}

};

xhr.send();

}

/* Search */
document.getElementById("search").addEventListener("keyup", loadProducts);

/* Brand Filter */
document.getElementById("brandFilter").addEventListener("change", loadProducts);