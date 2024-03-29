const vip = datas.vip
const gold = datas.gold
const classic = datas.classic
const day = datas.day
const rien = datas.no_pass
const rooms = datas.rooms
const months = datas.mois

const ctx1 = document.getElementById('myChart1');
const ctx2 = document.getElementById('myChart2');
const ctx3 = document.getElementById('myChart3');

new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['VIP', 'GOLD', 'Classic', 'Day', 'No Pass'],
        datasets: [{
            label: '# Subscribers',
            data: [vip, gold, classic, day, rien],
            borderWidth: 1,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'teal',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64,1)'
            ],
            hoverOffset: 4
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


let roomName = []
let roomNumber = []
datas.rooms.forEach((room, index) => {
    roomName.push(room.nom_salle)
    roomNumber.push(room.nombre_films_programmes)
})

new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: roomName,
        datasets: [{
            label: '# room',
            data: roomNumber,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

let monthName = ['0']
let monthNumber = [0]
datas.mois.forEach((m, index) => {
    monthName.push(m.mois_programmation)
    monthNumber.push(m.nombre_films_programmes )
})

console.log(monthName);
console.log(monthNumber);

new Chart(ctx3, {
    type: 'line',
    data: {
        labels: monthName,
        datasets: [{
            label: '# Month projection',
            data: monthNumber,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
        }]
    },
    options: {
        animations: {
            tension: {
                duration: 1000,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: true
            }
        },
        scales: {
            x: { 
                min: 0,
                max: 100
            }
        }
    }
});