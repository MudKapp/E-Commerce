let products = document.querySelectorAll('.product')
let basketList = sessionStorage.getItem('product-id') ? JSON.parse(sessionStorage.getItem('product-id')) : []
let basket = new Set(basketList);

products.forEach((ele) => {
    ele.addEventListener('click',()=>{
        basket.add(ele.dataset.id.toString())
        let basketList = [...basket]
        sessionStorage.setItem("product-id", JSON.stringify(basketList) )
        let test = JSON.parse(sessionStorage.getItem('product-id')) 
        console.log(test)
    })
})