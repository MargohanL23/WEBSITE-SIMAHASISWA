<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $title ?> — SIMAHASISWA</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  :root {
    --bg: #0d0f14;
    --bg2: #13161e;
    --card: #181c26;
    --border: #252a38;
    --border2: #2e3447;
    --accent: #4f8ef7;
    --accent2: #7b61ff;
    --green: #22c984;
    --yellow: #f5a623;
    --red: #f25c54;
    --purple: #b06ef3;
    --text: #e8eaf0;
    --muted: #6b7492;
    --muted2: #8892b0;
    --radius: 14px;
    --font: 'Plus Jakarta Sans', sans-serif;
    --mono: 'DM Mono', monospace;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: var(--font);
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
  }

  /* SIDEBAR */
  .sidebar {
    width: 260px;
    min-height: 100vh;
    background: var(--bg2);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0;
    z-index: 100;
  }
  .sidebar-logo {
    padding: 28px 24px 20px;
    border-bottom: 1px solid var(--border);
  }
  .logo-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
  }
  .logo-icon {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: #fff;
    box-shadow: 0 4px 16px rgba(79,142,247,.3);
  }
  .logo-text { line-height: 1; }
  .logo-text strong { display: block; font-size: 14px; font-weight: 800; letter-spacing: .5px; color: var(--text); }
  .logo-text span { font-size: 10px; color: var(--muted); letter-spacing: 1.5px; text-transform: uppercase; }
  .sidebar-nav { padding: 16px 12px; flex: 1; }
  .nav-label { font-size: 10px; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); padding: 8px 12px 6px; }
  .nav-link {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 14px; border-radius: 10px;
    color: var(--muted2); text-decoration: none;
    font-size: 14px; font-weight: 500;
    transition: all .2s; margin-bottom: 2px;
  }
  .nav-link:hover, .nav-link.active {
    background: rgba(79,142,247,.1);
    color: var(--accent);
  }
  .nav-link i { width: 18px; text-align: center; font-size: 15px; }
  .sidebar-footer {
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    font-size: 12px;
    color: var(--muted);
    display: flex; align-items: center; gap: 8px;
  }

  /* MAIN */
  .main {
    margin-left: 260px;
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  .topbar {
    background: var(--bg2);
    border-bottom: 1px solid var(--border);
    padding: 0 32px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky; top: 0; z-index: 50;
  }
  .topbar-left { display: flex; align-items: center; gap: 8px; }
  .topbar-left span { font-size: 13px; color: var(--muted); }
  .topbar-left strong { font-size: 13px; font-weight: 600; }
  .breadcrumb-sep { color: var(--border2); }
  .topbar-right { display: flex; align-items: center; gap: 12px; }
  .topbar-time {
    font-family: var(--mono);
    font-size: 12px;
    color: var(--muted);
    background: var(--card);
    border: 1px solid var(--border);
    padding: 6px 12px;
    border-radius: 8px;
  }
  .page-content { padding: 32px; flex: 1; }

  /* ALERTS */
  .alert {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 18px; border-radius: var(--radius);
    margin-bottom: 24px; font-size: 14px; font-weight: 500;
    border: 1px solid;
    animation: slideDown .3s ease;
  }
  @keyframes slideDown { from { opacity:0; transform:translateY(-10px); } to { opacity:1; transform:translateY(0); } }
  .alert-success { background: rgba(34,201,132,.08); border-color: rgba(34,201,132,.3); color: var(--green); }
  .alert-error   { background: rgba(242,92,84,.08);  border-color: rgba(242,92,84,.3);  color: var(--red); }
  .alert-close { margin-left: auto; cursor: pointer; opacity: .7; }
  .alert-close:hover { opacity: 1; }
</style>
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-logo">
    <a href="<?= base_url('mahasiswa') ?>" class="logo-badge">
      <div class="logo-icon"><i class="fas fa-graduation-cap"></i></div>
      <div class="logo-text">
        <strong>SIMAHASISWA</strong>
        <span>Sistem Informasi</span>
      </div>
    </a>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-label">Menu Utama</div>
    <a href="<?= base_url('mahasiswa') ?>" class="nav-link <?= ($title == 'Dashboard') ? 'active' : '' ?>">
      <i class="fas fa-chart-pie"></i> Dashboard
    </a>
    <a href="<?= base_url('mahasiswa/tambah') ?>" class="nav-link <?= (strpos($title,'Tambah') !== false) ? 'active' : '' ?>">
      <i class="fas fa-user-plus"></i> Tambah Mahasiswa
    </a>
  </nav>
  <div class="sidebar-footer">
    <i class="fas fa-circle" style="color:var(--green);font-size:8px;"></i>
    XAMPP &bull; ci3-crud &bull; v1.0
  </div>
</aside>

<div class="main">
  <header class="topbar">
    <div class="topbar-left">
      <span>SIMAHASISWA</span>
      <span class="breadcrumb-sep">/</span>
      <strong><?= $title ?></strong>
    </div>
    <div class="topbar-right">
      <div class="topbar-time" id="clock">--:--:--</div>
    </div>
  </header>

  <div class="page-content">
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <?= $this->session->flashdata('success') ?>
        <span class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></span>
      </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <?= $this->session->flashdata('error') ?>
        <span class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></span>
      </div>
    <?php endif; ?>