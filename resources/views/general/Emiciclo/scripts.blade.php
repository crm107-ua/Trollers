<script>
Highcharts.chart('container', {
    chart: {
        type: 'item',
        backgroundColor: 'black', // Fondo negro
    },
    title: {
        text: 'Congreso de Trollers 2023',
        style: {
            color: 'white' // Letras blancas
        }
    },
    subtitle: {
        text: '350 diputados',
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
                name: 'CNT',
                y: 125,
                color: '#3A3B2E',
                label: 'CNT',
                members: 'Pepe, Robles, Roberto, Juan, Ruben'
            },
            {
                name: 'VERDES',
                y: 125,
                color: '#48D517',
                label: 'VERDES',
                members: 'Eduardo, Jose, Ramón, Martín, Manuel' // Lista de miembros de VERDES
            },
            {
                name: 'G.INDEPENDIENTE',
                y: 90,
                color: '#297FFC',
                label: 'G.INDEPENDIENTE',
                members: 'Carlos Luis, Toni, Stivo' // Lista de miembros de G.INDEPENDIENTE
            },
            {
                name: 'GRUPO MIXTO',
                y: 10,
                color: '#FC29CF',
                label: 'GRUPO MIXTO',
                members: 'Grupo Mixto, Coalición Troller Avanza' // Lista de miembros de GRUPO MIXTO
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
