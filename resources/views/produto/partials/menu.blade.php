<ul class="navbar-nav">
    <li class="nav-item">
        <a href="{{ route('produto.index')}}">
            Todos os Produtos
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('produto.edit', ['id'=>$produto->id_produto])}}">
            Editar
        </a>
    </li>
</ul>
