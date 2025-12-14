<div style="
  width: 100%; 
  overflow-x: auto; 
  background: #111; 
  padding: 20px; 
  border-radius: 12px;
  box-shadow: 0 0 5px #00ffc3aa, 0 0 10px #00ffc3aa inset;
">
  <canvas id="multiResourceChart" style="height: 480px;"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const RESOURCES = [
  'steak', 'livestock', 'coca', 'cookedFish',
  'heavyAmmo', 'concrete', 'fish', 'bread', 'ammo',
  'limestone', 'grain', 'iron', 'steel', 'lead'
];

const COLORS = [
  '#00ffc3', '#44c2f8', '#d400ff', '#ffcc29', '#ff6b6b',
  '#ffd93d', '#4dd0e1', '#1de9b6', '#ff8a65', '#ba68c8',
  '#9575cd', '#7986cb', '#81c784', '#90a4ae'
];

const ctx = document.getElementById('multiResourceChart').getContext('2d');
const chart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [],
    datasets: RESOURCES.map((res, i) => ({
      label: res,
      data: [],
      borderColor: COLORS[i % COLORS.length],
      borderWidth: 1.2,
      pointRadius: 0,
      fill: false,
      tension: 0.4
    }))
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    interaction: {
      mode: 'index',
      intersect: false
    },
    scales: {
      x: {
        ticks: {
          color: '#aaa',
          font: { size: 10 },
          autoSkip: true,
          maxRotation: 60,
          minRotation: 30
        },
        grid: { color: '#222' }
      },
      y: {
        beginAtZero: false,
        ticks: { color: '#ccc' },
        grid: { color: '#222' }
      }
    },
    plugins: {
      legend: {
        labels: {
          color: '#eee',
          font: { size: 12, weight: 'bold' }
        }
      },
      tooltip: {
        mode: 'nearest',
        intersect: false,
        backgroundColor: '#222',
        titleColor: '#00ffc3',
        bodyColor: '#fff',
        borderColor: '#00ffc3',
        borderWidth: 1
      }
    }
  }
});

async function fetchFullHistory() {
  const res = await fetch('/api/warera-prices');
  const data = await res.json();

  chart.data.labels = data.map(e => e.timestamp.replace('2025-', '').replace(':00', ''));
  RESOURCES.forEach((res, i) => {
    chart.data.datasets[i].data = data.map(e => e[res]);
  });
  chart.update();
}

fetchFullHistory();
setInterval(fetchFullHistory, 5000);
</script>
