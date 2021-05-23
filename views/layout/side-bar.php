<body>
    <header>
        <button class="sidebar-toggle">&#9776;</button>
    </header>
<div class="sidebar">
    <div class="sidebar__profile-image">
        <img src="assets/images/user-pic.jpg" alt="" class="profile-image__image">
    </div>
    <nav class="navigation">
        <ul class="navigation__nav-list">
            <li class="nav-list__item">
                <a href="index.php">Dashboard</a>
            </li>
            <li class="nav-list__item nav-list__item--dropdown">
                Serviços
                <ul class="item__dropdown">
                    <li class="dropdown__item"><a href="index.php?acao=servicos/cadastrar">Novo serviço</a></li><hr>
                    <li class="dropdown__item"><a href="index.php?acao=servicos/listar">Listar serviços</a></li>
                </ul>
            </li>
            <li class="nav-list__item nav-list__item--dropdown">
                Profissionais
                <ul class="item__dropdown">
                    <li class="dropdown__item"><a href="index.php?acao=profissionais/cadastrar">Novo profissional</a></li><hr>
                    <li class="dropdown__item"><a href="index.php?acao=profissionais/listar">Listar profissionais</a></li>
                </ul>
            </li>
            <li class="nav-list__item nav-list__item--dropdown">
                Agenda
                <ul class="item__dropdown">
                    <li class="dropdown__item"><a href="index.php?acao=agenda/novo">Novo agendamento</a></li><hr>
                    <li class="dropdown__item"><a href="index.php?acao=agenda/listar">Ver agenda</a></li>
                </ul>
            </li>
            <li class="nav-list__item nav-list__item--dropdown">
                Cliente
                <ul class="item__dropdown">
                    <li class="dropdown__item"><a href="index.php?acao=cliente/novo">Novo cliente</a></li><hr>
                    <li class="dropdown__item"><a href="index.php?acao=cliente/listar">Listar clientes</a></li>
                </ul>
            </li>
            <li class="nav-list__item">
                <a href="authController.php?acao=logout">Sair</a>
            </li>
        </ul>
    </nav>
</div>
