@if(!empty($toBuy) || !empty($toSell))
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
<style>
  .market-grid {
    max-width: 950px;
    margin: 0 auto;
  }

  @media (min-width: 768px) {
    .market-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px;
    }
  }

  @media (max-width: 767px) {
    .market-grid {
      display: block;
      padding: 0 10px;
    }

    h4 {
      margin-top: 30px !important;
    }
  }

  .market-column {
    text-align: left;
  }

  .resource-item {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
  }

  .resource-item img {
    width: 30px;
    height: 30px;
    object-fit: contain;
    border-radius: 5px;
    background: #111;
    padding: 2px;
    border: 1px solid #00ffc3;
  }
</style>


<div class="alert" style="position: relative; overflow: hidden; color: #fff; padding: 30px 25px; border-radius: 15px; margin-top: 30px; border: 2px solid #00ffc3; box-shadow: 0 0 25px #00ffc3cc; font-family: 'Segoe UI', sans-serif; backdrop-filter: blur(6px); width: 100%;">
  <div style="background: url('https://warera.io/images/bg1.png') center center / cover no-repeat; position: absolute; inset: 0; z-index: 1;"></div>
  <div style="background-color: rgba(0, 0, 0, 0.65); position: absolute; inset: 0; z-index: 2;"></div>

  <div style="position: relative; z-index: 3;">
<h2 style="margin: 0 0 20px; font-size: 26px; font-weight: 800; text-align: center; text-transform: uppercase; display: flex; justify-content: center; align-items: center; gap: 12px;">
  <span style="background: linear-gradient(90deg, #00ffc3, #44c2f8, #d400ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
    ⚔️ WarEra AI
  </span>
  <span style="color: #00ffc3; font-weight: 700; font-size: 13px; background-color: rgba(0, 255, 195, 0.12); border: 1px solid #00ffc3; padding: 3px 10px; border-radius: 8px; animation: pulseGlow 1.8s ease-in-out infinite;">
    AHORA MISMO
  </span>
</h2>

<style>
@keyframes pulseGlow {
  0% {
    box-shadow: 0 0 0px #00ffc3aa;
    opacity: 1;
  }
  50% {
    box-shadow: 0 0 12px #00ffc3dd, 0 0 24px #00ffc3aa;
    opacity: 0.85;
  }
  100% {
    box-shadow: 0 0 0px #00ffc3aa;
    opacity: 1;
  }
}
</style>


    <div class="market-grid">
      @if(!empty($toBuy))
      <div>
        <h4 style="color: #00ffc3; font-weight: 700; margin-bottom: 20px; margin-top:10px;">🟢 Recursos Estratégicos para COMPRAR </h4>
        <ul style="list-style: none; padding: 0; margin: 0;">
          @foreach($toBuy as $item => $price)
            <li class="resource-item">
              <img src="https://app.warera.io/images/items/{{ $item }}.png?v=9" alt="{{ $item }}"
                   onerror="this.style.display='none'">
              <span style="color: #affff1;">
                <b>{{ ucfirst($item) }}</b> — {{ number_format($price, 3) }} 🪙
              </span>
            </li>
          @endforeach
        </ul>
      </div>
      @endif

      @if(!empty($toSell))
      <div>
        <h4 style="color: #ffd93d; font-weight: 700; margin-bottom: 20px; padding:10px;">🔴 Recursos Premium para VENDER</h4>
        <ul style="list-style: none; padding: 0; margin: 0;">
          @foreach($toSell as $item => $price)
            <li class="resource-item">
              <img src="https://app.warera.io/images/items/{{ $item }}.png?v=9" alt="{{ $item }}"
                   onerror="this.style.display='none'">
              <span style="color: #ffe9a3;">
                <b>{{ ucfirst($item) }}</b> — {{ number_format($price, 3) }} 🪙
              </span>
            </li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>
  </div>
</div>
@endif
