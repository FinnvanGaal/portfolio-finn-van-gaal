<<<<<<< HEAD
<aside class="sidebar">
  <div class="sidebar-header">
    <i class="fa-solid fa-circle-user"></i>
    <div class="sidebar-user">
      <p class="username"><?= htmlspecialchars($_SESSION['user']['username']) ?></p>
      <p class="role">Mijn profiel</p>
    </div>
  </div>

  <ul class="nav-links">
  <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/posts" 
        class="<?= ($currentTab === 'posts') ? 'active' : '' ?>">
        <i class="fa-solid fa-clipboard-list"></i> Mijn Recepten</a></li>

  <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/create" 
        class="<?= ($currentTab === 'create') ? 'active' : '' ?>">
        <i class="fa-solid fa-plus"></i> Nieuw Gerecht</a></li>

  <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/comments" 
        class="<?= ($currentTab === 'comments') ? 'active' : '' ?>">
        <i class="fa-solid fa-comment-dots"></i> Reacties</a></li>

  <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/account" 
        class="<?= ($currentTab === 'account') ? 'active' : '' ?>">
        <i class="fa-solid fa-gear"></i> Account</a></li>
  </ul>

  <ul class="nav-logout">
  <li>
    <form method="post" class="logout-form" style="display:inline;">
      <input type="hidden" name="logout" value="true">
      <button type="submit" class="logout-btn" style="background:none;border:none;padding:0;cursor:pointer;">
        <i class="fa-solid fa-right-from-bracket"></i> Uitloggen
      </button>
    </form>
  </li>
</ul>

</aside>
=======
<aside class="sidebar">
  <div class="sidebar-header">
    <i class="fa-solid fa-circle-user"></i>
    <div class="sidebar-user">
      <p class="username"><?= htmlspecialchars($_SESSION['user']['username']) ?></p>
      <p class="role">Mijn profiel</p>
    </div>
  </div>

  <ul class="nav-links">
  <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/posts" 
        class="<?= ($currentTab === 'posts') ? 'active' : '' ?>">
        <i class="fa-solid fa-clipboard-list"></i> Mijn Recepten</a></li>

  <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/create" 
        class="<?= ($currentTab === 'create') ? 'active' : '' ?>">
        <i class="fa-solid fa-plus"></i> Nieuw Gerecht</a></li>

  <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/comments" 
        class="<?= ($currentTab === 'comments') ? 'active' : '' ?>">
        <i class="fa-solid fa-comment-dots"></i> Reacties</a></li>

  <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/account" 
        class="<?= ($currentTab === 'account') ? 'active' : '' ?>">
        <i class="fa-solid fa-gear"></i> Account</a></li>
  </ul>

  <ul class="nav-logout">
  <li>
    <form method="post" class="logout-form" style="display:inline;">
      <input type="hidden" name="logout" value="true">
      <button type="submit" class="logout-btn" style="background:none;border:none;padding:0;cursor:pointer;">
        <i class="fa-solid fa-right-from-bracket"></i> Uitloggen
      </button>
    </form>
  </li>
</ul>

</aside>
>>>>>>> 38ab6e3b03704417fcdbae3e967854145f00a340
