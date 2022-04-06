<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Quiz</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo ROOT_DIR . '/admin/question'; ?>">Question</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo ROOT_DIR . '/admin/reponse'; ?>">Reponse</a>
        </li>
      </ul>
    </div>
  </div>
</nav>