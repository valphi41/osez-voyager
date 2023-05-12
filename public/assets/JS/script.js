var roulette = document.querySelector('#roulette');
var arrow = document.querySelector('#arrow');
var item = document.querySelector('#item');

var offset = 0;

var countries = [];

const loadCountryAPI = () => {
    fetch('https://restcountries.com/v3.1/all')
    .then(res => res.json())
    .then(data => {
        countries = data.map(country => ({name: country.name.common, flag: country.flags.png}));

        countries.forEach(function(country) {
            var newItem = item.content.cloneNode(true);
            newItem.querySelector('i').classList.add('fa-flag');
            newItem.querySelector('span').textContent = country.name;
            newItem.querySelector('.country-flag').src = country.flag;
            roulette.appendChild(newItem);
        });

        maxOffset = countries.length * 250;
    });
}

loadCountryAPI();

var wheel = {
  speed: 100,

  getSpeed: function() {
    this.speed = this.speed - Math.round(Math.random() * 1);
    if (this.speed < 0)
      return 0;
    return this.speed;
  },

  resetSpeed: function() { this.speed = 100 }
}

function spin() {
    arrow.classList.remove('shine');

    var timer = setInterval(function() {
      offset = offset + wheel.getSpeed();
      if ((offset > maxOffset) || (offset < 0))
        offset = 0;
      roulette.style.transform = 'translateX(-'+offset+'px)';
    }, 10);

    setTimeout(function() {
      clearInterval(timer);
      wheel.resetSpeed();

      var centerOffset = (roulette.offsetWidth / 2) - (250 / 2);
      var selectedIndex = Math.ceil(offset / 250);
      offset = selectedIndex * 250 - centerOffset;
      roulette.style.transform = 'translateX(-'+offset+'px)';

      var selectedCountry = countries[selectedIndex];
      var rouletteSection = document.getElementById('roulette-section');

      arrow.classList.add('shine');
    }, 2500);
  }
