function loadProducts(){

var keyword = document.getElementById("search").value;
var brand_id = document.getElementById("brandFilter").value;

/* if search and filter are empty → reload page */
if(keyword === "" && brand_id === ""){
window.location.href = "/laptofy_MVC/public/Home";
return;
}

fetch("/laptofy_MVC/public/filter?keyword="+keyword+"&brand_id="+brand_id)

.then(function(response){
return response.text();
})

.then(function(data){

document.getElementById("productContainer").innerHTML = data;

/* hide pagination */
var pagination = document.getElementById("pagination");
if(pagination){
pagination.style.display = "none";
}

});

}

/* Search */
document.getElementById("search").addEventListener("keyup", loadProducts);

/* Brand Filter */
document.getElementById("brandFilter").addEventListener("change", loadProducts);