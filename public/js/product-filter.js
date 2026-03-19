function loadProducts(page = 1){
    var keyword  = document.getElementById("search").value;
    var brand_id = document.getElementById("brandFilter").value;
    var mainPagination = document.getElementById("mainPagination");

    if(keyword === "" && brand_id === ""){
        mainPagination.classList.remove("hidden");
        window.location.href = "/laptofy_MVC/public/Home";
        return;
    }

    mainPagination.classList.add("hidden");

    fetch("/laptofy_MVC/public/filter?keyword=" + keyword +"&brand_id=" + brand_id + "&page=" + page)

    .then(function(response){ return response.text(); })
    .then(function(data){
        var parser = new DOMParser();
        var doc = parser.parseFromString(data, "text/html");

        var cards = doc.getElementById("filterCards");
        document.getElementById("productContainer").innerHTML = cards ? cards.innerHTML : data;

        var filterPagination = doc.getElementById("filterPagination");
        var mainPagination = document.getElementById("mainPagination");
        if(filterPagination){
            mainPagination.innerHTML = filterPagination.innerHTML;
        } else {
            mainPagination.innerHTML = "";
        }
    });
}

function loadByPrice(page = 1){
    var price = document.getElementById("priceFilter").value;
    var mainPagination = document.getElementById("mainPagination");

    if(price === ""){
        mainPagination.classList.remove("hidden");
        window.location.href = "/laptofy_MVC/public/Home";
        return;
    }

    mainPagination.classList.add("hidden");

    fetch("/laptofy_MVC/public/price-filter?price_range=" + price + "&page=" + page)

    .then(function(response){ return response.text(); })
    .then(function(data){
        var parser = new DOMParser();
        var doc = parser.parseFromString(data, "text/html");

        var cards = doc.getElementById("filterCards");
        document.getElementById("productContainer").innerHTML = cards ? cards.innerHTML : data;

        var filterPagination = doc.getElementById("filterPagination");
        var mainPagination = document.getElementById("mainPagination");
        if(filterPagination){
            mainPagination.innerHTML = filterPagination.innerHTML;
        } else {
            mainPagination.innerHTML = "";
        }
    });
}


// Search button
document.getElementById("searchBtn").addEventListener("click", function(){
    loadProducts(1);
});

// Brand dropdown
document.getElementById("brandFilter").addEventListener("change", function(){
    loadProducts(1);
});

//Price dropdown 
document.getElementById("priceFilter").addEventListener("change", function(){
    loadByPrice(1);
});