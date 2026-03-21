var currentPrice   = "";
var currentKeyword = "";
var currentBrand   = "";

function loadProducts(page = 1){
    currentKeyword = document.getElementById("search").value;
    currentBrand   = document.getElementById("brandFilter").value;
    var mainPagination = document.getElementById("mainPagination");

    if(currentKeyword === "" && currentBrand === ""){
        mainPagination.style.display = "flex"; 
        window.location.href = "/laptofy_MVC/public/Home";
        return;
    }

    mainPagination.style.display = "none";

    fetch("/laptofy_MVC/public/filter?keyword=" + currentKeyword +
          "&brand_id=" + currentBrand +
          "&page=" + page)

    .then(function(response){ return response.text(); })
    .then(function(data){
        var parser = new DOMParser();
        var doc = parser.parseFromString(data, "text/html");

        var cards = doc.getElementById("filterCards");
        document.getElementById("productContainer").innerHTML = cards ? cards.innerHTML : data;

        var filterPagination = doc.getElementById("filterPagination");
        if(filterPagination && filterPagination.innerHTML.trim() !== ""){
            mainPagination.innerHTML = filterPagination.innerHTML;
            mainPagination.style.display = "flex"; 
        } else {
            mainPagination.innerHTML = "";
            mainPagination.style.display = "none";
        }
    });
}

function loadByPrice(page = 1){
    if(page === 1){
        currentPrice = document.getElementById("priceFilter").value;
    }

    var mainPagination = document.getElementById("mainPagination");

    if(currentPrice === ""){
        mainPagination.style.display = "flex";
        window.location.href = "/laptofy_MVC/public/Home";
        return;
    }

    mainPagination.style.display = "none";

    fetch("/laptofy_MVC/public/price-filter?price_range=" + currentPrice +
          "&page=" + page)

    .then(function(response){ return response.text(); })
    .then(function(data){
        var parser = new DOMParser();
        var doc = parser.parseFromString(data, "text/html");

        var cards = doc.getElementById("filterCards");
        document.getElementById("productContainer").innerHTML = cards ? cards.innerHTML : data;

        var filterPagination = doc.getElementById("filterPagination");
        if(filterPagination && filterPagination.innerHTML.trim() !== ""){
            mainPagination.innerHTML = filterPagination.innerHTML;
            mainPagination.style.display = "flex"; 
        } else {
            mainPagination.innerHTML = "";
            mainPagination.style.display = "none";
        }
    });
}

function resetFilters(){
    currentPrice   = "";
    currentKeyword = "";
    currentBrand   = "";
    document.getElementById("search").value      = "";
    document.getElementById("brandFilter").value = "";
    document.getElementById("priceFilter").value = "";
    window.location.href = "/laptofy_MVC/public/Home";
}

// Search button
document.getElementById("searchBtn").addEventListener("click", function(){
    loadProducts(1);
});

// Brand dropdown
document.getElementById("brandFilter").addEventListener("change", function(){
    loadProducts(1);
});

// Price dropdown
document.getElementById("priceFilter").addEventListener("change", function(){
    loadByPrice(1);
});