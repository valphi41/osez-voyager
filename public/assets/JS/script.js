document.getElementById('travel_rand').addEventListener('click', function () {
fetch('https://restcountries.com/v3.1/all')
.then(response => response.json())
.then(countries => {
    const name = document.getElementById('travel_rand');
    for (country of countries) {
        
    }


    updateHeadline(title, picture, content)
});
}
})

