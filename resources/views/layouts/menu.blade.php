<header class="header body-pd" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>
    <div class="l-navbar show-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
              <a href="/Dashboard" class="nav_link {{ request()->is('Dashboard') ? 'active' : '' }}"> 
                <i class='bx bx-layer nav_logo-icon'></i> 
                <span class="nav_name">Home</span> 
              </a>
                <div class="nav_list"> 
                  <a href="/Reconsideracion" class="nav_link {{ request()->is('Reconsideracion') ? 'active' : '' }}"> 
                    <i class='bx bx-folder nav_icon'></i> 
                    <span class="nav_name">Claims</span> 
                  </a> 
                  <a href="/Indicador_Reembolso" class="nav_link {{ request()->is('Indicador_Reembolso') ? 'active' : '' }}"> 
                    <i class='bx bx-grid-alt nav_icon'></i> 
                    <span class="nav_name">Refund Indicator</span> 
                  </a> 
                  
                  <a href="/ChatBot" class="nav_link {{ request()->is('ChatBot')|| request()->is('ChatBot/*') ? 'active' : '' }}"> 
                    <i class='bx bx-message-square-detail nav_icon'></i> 
                    <span class="nav_name">ChatBot</span> 
                  </a> 
                  
                  <a href="#" class="nav_link"> 
                    <i class='bx bx-bar-chart-alt-2 nav_icon'></i> 
                    <span class="nav_name">Stats</span>
                  </a> 
                </div>            
            </div> 
            <a href="#" class="nav_link"> 
                <i class='bx bx-log-out nav_icon'></i> 
                <span class="nav_name">SignOut</span> 
            </a>
        </nav>
    </div>