<nav class="navbar navbar-expand navbar-dark blue-gradient">

  <a class="navbar-brand" href="{{ route('guides.index') }}"><i class="fas fa-plane mr-2"></i>tabisuke</a>

  <ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest
      
    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{ route('guides.create') }}"><i class="fas fa-pen mr-1"></i>作成する</a>
    </li>
    <li class="nav-item">
    <form  method="POST" action="{{ route('logout') }}" name="logout_link">
      @csrf
      <a class="nav-link" href="javascript:logout_link.submit()"><i class="fas fa-sign-out-alt"></i>ログアウト</a>
    </form>
    </li>
    @endauth
  </ul>

</nav>