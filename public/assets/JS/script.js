const loadCountryAPI = () => {
    fetch('https://restcountries.com/v3.1/all')
    .then(res => res.json())
    .then(data => {
        const countries = data.map(country => country.name.common);
        const button = document.getElementById('random-country-btn');
        button.addEventListener('click', () => {
            const randomIndex = Math.floor(Math.random() * countries.length);
            const randomCountry = countries[randomIndex];
            document.getElementById('country-name').textContent = randomCountry;
        });

    })
}

loadCountryAPI()
