const result = document.querySelector('.result');
        
// Llamamos a la función callAPI al cargar la página con los valores deseados
callAPI('Ambato', 'Ecuador');

function callAPI(city, country) {
    const apiId = '41d1d7f5c2475b3a16167b30bc4f265c';
    const url = `http://api.openweathermap.org/data/2.5/weather?q=${city},${country}&appid=${apiId}`;

    fetch(url)
        .then(data => {
            return data.json();
        })
        .then(dataJSON => {
            if (dataJSON.cod === '404') {
                showError('Ciudad no encontrada...');
            } else {
                clearHTML();
                showWeather(dataJSON);
            }
        })
        .catch(error => {
            console.log(error);
        });
}

function showWeather(data) {
    const {name, main: {temp}, weather: [arr]} = data;

    const degrees = kelvinToCentigrade(temp);

    const content = document.createElement('div');
    content.innerHTML = `
        <h2 class="mb-0 font-weight-bold text"><i class="icon-sun mr-2"></i>${degrees}<sup>&deg;C</sup></h2>
    `;

    result.appendChild(content);
}

function showError(message) {
    const alert = document.createElement('p');
    alert.classList.add('alert-message');
    alert.innerHTML = message;

    result.appendChild(alert);
    setTimeout(() => {
        alert.remove();
    }, 3000);
}

function kelvinToCentigrade(temp) {
    return parseInt(temp - 273.15);
}

function clearHTML() {
    result.innerHTML = '';
}