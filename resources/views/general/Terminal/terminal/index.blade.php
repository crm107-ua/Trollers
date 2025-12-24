<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
  <body>
  <div class="site-wrap">
  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  @include('general.Terminal.terminal.estilos')
  @include('general.Header.header')

  <!-- Main Content Area -->
  <main class="main-content">
    <div class="chat-container">
        <!-- Header inside chat removed for cleaner look if global header exists -->
        <!-- Or keep it simple -->
        <div class="chat-header-internal">
            <div class="header-info">
                <div class="chat-title">TROLLERS CORE</div>
                <div class="chat-status">
                    [ SYSTEM ONLINE ]
                </div>
            </div>
            <div class="header-actions">
                <!-- Optional actions -->
            </div>
        </div>

        <!-- Chat Messages -->
        <div id="chat-messages">
            <!-- Welcome Message -->
            <div class="message bot">
                <div class="avatar bot-avatar">
                   <img src="https://ui-avatars.com/api/?name=AI&background=000&color=fff" alt="AI">
                </div>
                <div class="message-content">
                    Hola. Soy la inteligencia artificial de Trollers. He analizado todos los archivos y bases de datos. Pregúntame lo que quieras y te responderé con máximo detalle.
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="input-area">
            <div class="input-wrapper">
                <textarea id="chat-input" rows="1" placeholder="Escribe algo cabron"></textarea>
                <button id="send-btn" class="send-btn" disabled>
                    <svg viewBox="0 0 24 24" fill="none" class="send-icon" stroke="currentColor" stroke-width="2">
                       <path d="M22 2L11 13" stroke-linecap="round" stroke-linejoin="round"/>
                       <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
  </main>

  @include('general.Links.scripts')
  <!-- Helper libraries for icons if not already in general scripts -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
  @include('general.Terminal.terminal.scripts')

  </div> <!-- .site-wrap -->
  </body>
</html>
