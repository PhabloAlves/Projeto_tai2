<div class="sidebar close">
    <div class="logo-details">
        <i><img style="width: 70px; margin-top: 30px;" src="{{ url('Assets/Images/logoalone.png') }}" alt=""></i>
        <span class="logo_name"><img style="width: 170px; margin-top: 100px;" src="{{ url('Assets/Images/letras.png') }}" alt=""></span>
    </div>
    <ul class="nav-links">
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="{{ url('Assets/Images/user.png') }}" alt="profileImg">
                </div>
                <div class="name-job">
                    @if(Auth::check())
                        <div class="profile_name">{{ Auth::user()->name }}</div>
                    @else
                        <div class="profile_name">Usuário</div>
                    @endif
                <div class="job">Serviço</div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="border: none; background: transparent; cursor: pointer;">
                        <i class='bx bx-log-out' title="Logout"></i>
                    </button>
                </form>
            </div>
        </li>
        <hr>
        
        <li class="{{ request()->is('cadastros*') ? 'active' : '' }}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-add-to-queue'></i>
                    <span class="link_name">Cadastros</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="">Cadastros</a></li>
                <li><a href="{{ url('empresas') }}">Empresa</a></li>
                <li><a href="{{ url('funcionarios') }}">Funcionários</a></li>
                <li><a href="{{ url('categoriasservicos') }}">Categoria de Serviços</a></li>
                <li><a href="{{ url('servicos') }}">Serviços</a></li>
                <li><a href="{{ url('jornadas') }}">Jornadas</a></li>
                <li><a href="{{ url('usuarios') }}">Usuários</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('agendamentos') ? 'active' : '' }}">
            <a href="{{ url('agendamentos') }}">
                <i class='bx bx-time-five'></i>
                <span class="link_name">Agendamento</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Agendamento</a></li>
            </ul>
        </li>
        
      <!--  <li class="{{ request()->is('configuracoes') ? 'active' : '' }}">
            <a href="{{ url('configuracoes') }}">
                <i class='bx bx-cog'></i>
                <span class="link_name">Configurações</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Configurações</a></li>
            </ul>
        </li>
     -->
        
        <li class="{{ request()->is('ajuda') ? 'active' : '' }}">
            <a href="{{ url('ajuda') }}">
                <i class='bx bx-help-circle'></i>
                <span class="link_name">Ajuda</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Ajuda</a></li>
            </ul>
        </li>
    </ul>
</div>

