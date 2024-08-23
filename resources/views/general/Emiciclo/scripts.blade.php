<script>
Highcharts.chart('container', {
    chart: {
        type: 'item',
        backgroundColor: 'black', // Fondo negro
    },
    title: {
        text: 'Congreso de Trollers 2024',
        style: {
            color: 'white' // Letras blancas
        }
    },
    subtitle: {
        text: '18 diputados',
        style: {
            color: 'white' // Letras blancas
        }
    },
    legend: {
        useHTML: true,
        labelFormat: '{name} <span style="opacity: 0.4">{y}</span> <div>{members}</div>',
        itemStyle: {
            color: 'white' // Letras blancas en la leyenda
        },
    },
    series: [{
        name: 'Escaños',
        keys: ['name', 'y', 'color', 'label', 'members'],
        data: [
            {
                name: 'CNT - LIBERA POPULUM',
                y: 6,
                color: '#3A3B2E',
                label: 'CNT',
                members: 'Pepe, Robles, Roberto, Jose, Juan, Ruben'
            },
            {
                name: 'G.INDEPENDIENTE - SE ACABÓ LA FIESTA',
                y: 6,
                color: '#297FFC',
                label: 'G.INDEPENDIENTE',
                members: 'Carlos Luis, Stivo, Micluti, Ezequiel, David'
            },
            {
                name: 'VERDES EAJ-PNV ASO',
                y: 4,
                color: '#48D517',
                label: 'VERDES',
                members: 'Eduardo, Ramón, Martín, Manuel'
            },
            {
                name: 'GRUPO MIXTO - COALICIÓN TROLLER AVANZA',
                y: 3,
                color: '#FC29CF',
                label: 'GRUPO MIXTO',
                members: 'María, Alex, Alejandro'
            },
        ],
        dataLabels: {
            enabled: false,
            format: '{point.label}'
        },
        // Circular options
        center: ['50%', '88%'],
        size: '190%',
        startAngle: -90,
        endAngle: 90
    }]
});

</script>
