<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">WebManiaBR</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">Inicio</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    NF-e
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('nfe.emitir')}}">Emitir</a>
                        <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('nfe.consulta')}}">Consultar</a>
                        <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('nfe.cancelamento')}}">Cancelar</a>
                        <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('nfe.devolver')}}">Devolução</a>
                        <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('nfe.validacao.cert')}}">Validar Certificado</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    CEP
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('cep')}}">Consultar</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
