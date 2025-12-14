<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
Highcharts.chart('tribuna', {
    chart: {
        type: 'bar',
        backgroundColor: '#000',
        spacingLeft: 40
    },
    title: {
        text: 'Congreso de WarEra España 2025',
        style: { color: 'white', fontSize: '22px' }
    },
    subtitle: {
        text: 'Tribuna de 10 miembros',
        style: { color: 'white' }
    },
    xAxis: {
        categories: [
            'Perro Sanxe',
            'Santiago Abascal',
            'Capybara Andaluz',
            'Jaume Primer',
            'LaLegion',
            'Comisario Scutux',
            'Tumuertopepe',
            'CarlitosJr',
            'PollitoFrito',
            'palabralarga editorial'
        ],
        labels: {
            style: { color: 'white', fontSize: '14px' }
        },
        title: { text: null }
    },
    yAxis: {
       visible: false,
    },
    tooltip: {
        backgroundColor: 'white',
        borderColor: '#333',
        style: { color: '#000' },
        formatter: function () {
            let title = '';
            if (this.point.options.role) {
                title = `<b>${this.x}</b><br>${this.point.options.role}`;
            } else {
                title = `<b>${this.x}</b>`;
            }
            return title;
        }
    },
    plotOptions: {
        series: {
            borderRadius: 4,
            pointPadding: 0.2,
            groupPadding: 0.1,
            dataLabels: {
                enabled: true,
                color: 'white',
                format: '{point.role}',
                style: { textOutline: 'none', fontSize: '12px' },
                inside: true,
                align: 'left'
            }
        }
    },
    legend: { enabled: false },
    series: [{
        name: 'Diputados',
        data: [
            { y: 1, color: '#D43F00', role: 'Presidente' }, // Perro Sanxe
            { y: 1, color: '#002C5A', role: 'Vicepresidente' }, // Santiago Abascal
            { y: 1, color: '#48D517', role: 'Guardia Civil' }, // Capybara
            { y: 1, color: '#8C52FF', role: 'Congresista' },
            { y: 1, color: '#8C52FF', role: 'Congresista' },
            { y: 1, color: '#8C52FF', role: 'Congresista' },
            { y: 1, color: '#8C52FF', role: 'Congresista' },
            { y: 1, color: '#8C52FF', role: 'Congresista' },
            { y: 1, color: '#8C52FF', role: 'Congresista' },
            { y: 1, color: '#8C52FF', role: 'Congresista' }
        ]
    }]
});
</script>
