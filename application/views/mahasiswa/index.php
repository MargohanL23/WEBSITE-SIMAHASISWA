<style>
  .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; }
  .page-title { font-size:22px; font-weight:800; }
  .page-title span { color:var(--accent); }
  .page-sub { font-size:13px; color:var(--muted); margin-top:4px; }
  .btn {
    display:inline-flex; align-items:center; gap:8px;
    padding:10px 20px; border-radius:10px; font-size:13px;
    font-weight:600; cursor:pointer; border:none; transition:all .2s;
    text-decoration:none; font-family:var(--font);
  }
  .btn-primary { background:linear-gradient(135deg,var(--accent),var(--accent2)); color:#fff; box-shadow:0 4px 16px rgba(79,142,247,.3); }
  .btn-primary:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(79,142,247,.4); }
  .btn-sm { padding:7px 14px; font-size:12px; }
  .btn-outline { background:transparent; border:1px solid var(--border2); color:var(--muted2); }
  .btn-outline:hover { border-color:var(--accent); color:var(--accent); background:rgba(79,142,247,.06); }
  .btn-danger { background:rgba(242,92,84,.12); color:var(--red); border:1px solid rgba(242,92,84,.3); }
  .btn-danger:hover { background:rgba(242,92,84,.2); }
  .btn-info { background:rgba(79,142,247,.12); color:var(--accent); border:1px solid rgba(79,142,247,.3); }
  .btn-info:hover { background:rgba(79,142,247,.2); }
  .btn-edit { background:rgba(245,166,35,.12); color:var(--yellow); border:1px solid rgba(245,166,35,.3); }
  .btn-edit:hover { background:rgba(245,166,35,.2); }

  /* STAT CARDS */
  .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px; }
  .stat-card {
    background:var(--card); border:1px solid var(--border);
    border-radius:var(--radius); padding:20px 22px;
    display:flex; align-items:center; gap:16px;
    transition:transform .2s, border-color .2s;
  }
  .stat-card:hover { transform:translateY(-2px); border-color:var(--border2); }
  .stat-icon {
    width:48px; height:48px; border-radius:12px;
    display:flex; align-items:center; justify-content:center;
    font-size:20px; flex-shrink:0;
  }
  .stat-icon.blue   { background:rgba(79,142,247,.15); color:var(--accent); }
  .stat-icon.green  { background:rgba(34,201,132,.15); color:var(--green); }
  .stat-icon.yellow { background:rgba(245,166,35,.15); color:var(--yellow); }
  .stat-icon.red    { background:rgba(242,92,84,.15);  color:var(--red); }
  .stat-num  { font-size:28px; font-weight:800; line-height:1; }
  .stat-label{ font-size:12px; color:var(--muted); margin-top:4px; }

  /* FILTER BAR */
  .filter-bar {
    background:var(--card); border:1px solid var(--border);
    border-radius:var(--radius); padding:18px 22px;
    display:flex; align-items:center; gap:12px; flex-wrap:wrap;
    margin-bottom:20px;
  }
  .filter-bar label { font-size:12px; color:var(--muted); font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
  .form-input, .form-select {
    background:var(--bg2); border:1px solid var(--border2);
    border-radius:8px; color:var(--text); font-family:var(--font);
    font-size:13px; padding:9px 14px; outline:none;
    transition:border-color .2s;
  }
  .form-input { width:220px; }
  .form-select { cursor:pointer; }
  .form-input:focus, .form-select:focus { border-color:var(--accent); }
  .filter-bar form { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }

  /* TABLE */
  .table-wrap {
    background:var(--card); border:1px solid var(--border);
    border-radius:var(--radius); overflow:hidden;
  }
  .table-header {
    padding:18px 22px; border-bottom:1px solid var(--border);
    display:flex; align-items:center; justify-content:space-between;
  }
  .table-title { font-size:15px; font-weight:700; }
  .table-count { font-size:12px; color:var(--muted); background:var(--bg2); padding:4px 10px; border-radius:20px; }
  table { width:100%; border-collapse:collapse; }
  thead th {
    background:var(--bg); padding:12px 16px; text-align:left;
    font-size:11px; font-weight:700; text-transform:uppercase;
    letter-spacing:1px; color:var(--muted); border-bottom:1px solid var(--border);
  }
  tbody tr { border-bottom:1px solid var(--border); transition:background .15s; }
  tbody tr:last-child { border-bottom:none; }
  tbody tr:hover { background:rgba(255,255,255,.02); }
  tbody td { padding:14px 16px; font-size:13px; vertical-align:middle; }
  .nim-badge {
    font-family:var(--mono); font-size:12px;
    background:var(--bg); border:1px solid var(--border2);
    padding:3px 8px; border-radius:6px; color:var(--muted2);
  }
  .mhs-avatar {
    width:36px; height:36px; border-radius:50%; object-fit:cover;
    border:2px solid var(--border2);
  }
  .mhs-info { display:flex; align-items:center; gap:10px; }
  .mhs-name { font-weight:600; font-size:13px; }
  .mhs-email { font-size:11px; color:var(--muted); }
  .badge {
    display:inline-flex; align-items:center;
    padding:4px 10px; border-radius:20px; font-size:11px; font-weight:600;
  }
  .badge-aktif  { background:rgba(34,201,132,.1); color:var(--green); }
  .badge-cuti   { background:rgba(245,166,35,.1);  color:var(--yellow); }
  .badge-lulus  { background:rgba(79,142,247,.1);  color:var(--accent); }
  .badge-do     { background:rgba(242,92,84,.1);   color:var(--red); }
  .ipk-bar-wrap { display:flex; align-items:center; gap:8px; }
  .ipk-bar { height:4px; background:var(--bg); border-radius:4px; flex:1; overflow:hidden; }
  .ipk-fill { height:100%; border-radius:4px; background:linear-gradient(90deg,var(--accent),var(--green)); }
  .ipk-num { font-family:var(--mono); font-size:12px; color:var(--muted2); min-width:28px; }
  .action-btns { display:flex; gap:6px; }
  .empty-state { text-align:center; padding:60px 20px; color:var(--muted); }
  .empty-state i { font-size:48px; opacity:.2; margin-bottom:16px; }
  .empty-state p { font-size:14px; }
</style>

<div class="page-header">
  <div>
    <h1 class="page-title">Data <span>Mahasiswa</span></h1>
    <p class="page-sub">Kelola seluruh data mahasiswa yang terdaftar di sistem</p>
  </div>
  <a href="<?= base_url('mahasiswa/tambah') ?>" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Mahasiswa
  </a>
</div>

<!-- STATS -->
<?php
  $total = array_sum($count_status);
  $colors = ['Aktif'=>'green','Cuti'=>'yellow','Lulus'=>'blue','DO'=>'red'];
  $icons  = ['Aktif'=>'fa-user-check','Cuti'=>'fa-user-clock','Lulus'=>'fa-user-graduate','DO'=>'fa-user-slash'];
?>
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon blue"><i class="fas fa-users"></i></div>
    <div><div class="stat-num"><?= $total ?></div><div class="stat-label">Total Mahasiswa</div></div>
  </div>
  <?php foreach ($count_status as $s => $n): ?>
  <div class="stat-card">
    <div class="stat-icon <?= $colors[$s] ?>"><i class="fas <?= $icons[$s] ?>"></i></div>
    <div><div class="stat-num"><?= $n ?></div><div class="stat-label">Mahasiswa <?= $s ?></div></div>
  </div>
  <?php endforeach; ?>
</div>

<!-- FILTER -->
<div class="filter-bar">
  <label><i class="fas fa-filter"></i> Filter</label>
  <form method="get" action="<?= base_url('mahasiswa') ?>">
    <input type="text" name="search" class="form-input" placeholder="Cari nama / NIM..." value="<?= htmlspecialchars($search) ?>">
    <select name="jurusan" class="form-select">
      <option value="">Semua Jurusan</option>
      <?php foreach(['Teknik Informatika','Sistem Informasi','Teknik Elektro','Manajemen Informatika','Ilmu Komputer'] as $j): ?>
        <option value="<?= $j ?>" <?= $filter_jurusan==$j?'selected':'' ?>><?= $j ?></option>
      <?php endforeach; ?>
    </select>
    <select name="status" class="form-select">
      <option value="">Semua Status</option>
      <?php foreach(['Aktif','Cuti','Lulus','DO'] as $s): ?>
        <option value="<?= $s ?>" <?= $filter_status==$s?'selected':'' ?>><?= $s ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
    <a href="<?= base_url('mahasiswa') ?>" class="btn btn-outline btn-sm"><i class="fas fa-redo"></i> Reset</a>
  </form>
</div>

<!-- TABLE -->
<div class="table-wrap">
  <div class="table-header">
    <span class="table-title"><i class="fas fa-table" style="color:var(--accent);margin-right:8px;"></i>Daftar Mahasiswa</span>
    <span class="table-count"><?= count($mahasiswa) ?> data ditemukan</span>
  </div>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>NIM</th>
        <th>Mahasiswa</th>
        <th>Jurusan</th>
        <th>Smt</th>
        <th>IPK</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($mahasiswa)): ?>
      <tr><td colspan="8">
        <div class="empty-state">
          <div><i class="fas fa-search"></i></div>
          <p>Tidak ada data ditemukan.</p>
        </div>
      </td></tr>
      <?php else: ?>
      <?php foreach ($mahasiswa as $i => $m): ?>
      <tr>
        <td style="color:var(--muted);font-size:12px;"><?= $i+1 ?></td>
        <td><span class="nim-badge"><?= $m->nim ?></span></td>
        <td>
          <div class="mhs-info">
            <img src="<?= base_url('uploads/foto/'.$m->foto) ?>" class="mhs-avatar" onerror="this.src='<?= base_url('uploads/foto/default.png') ?>'">
            <div>
              <div class="mhs-name"><?= $m->nama ?></div>
              <div class="mhs-email"><?= $m->email ?></div>
            </div>
          </div>
        </td>
        <td style="font-size:12px;color:var(--muted2);"><?= $m->jurusan ?></td>
        <td style="text-align:center;font-family:var(--mono);"><?= $m->semester ?></td>
        <td>
          <div class="ipk-bar-wrap">
            <div class="ipk-bar"><div class="ipk-fill" style="width:<?= ($m->ipk/4)*100 ?>%"></div></div>
            <span class="ipk-num"><?= number_format($m->ipk,2) ?></span>
          </div>
        </td>
        <td>
          <span class="badge badge-<?= strtolower($m->status == 'DO' ? 'do' : strtolower($m->status)) ?>">
            <?= $m->status ?>
          </span>
        </td>
        <td>
          <div class="action-btns">
            <a href="<?= base_url('mahasiswa/detail/'.$m->id) ?>" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-eye"></i></a>
            <a href="<?= base_url('mahasiswa/edit/'.$m->id) ?>" class="btn btn-sm btn-edit" title="Edit"><i class="fas fa-pen"></i></a>
            <button onclick="confirmDelete(<?= $m->id ?>, '<?= $m->nama ?>')" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- DELETE MODAL -->
<div id="modal-overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:999;backdrop-filter:blur(4px);" onclick="closeModal()"></div>
<div id="modal-box" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:var(--card);border:1px solid var(--border2);border-radius:var(--radius);padding:32px;width:360px;z-index:1000;text-align:center;">
  <div style="width:56px;height:56px;background:rgba(242,92,84,.12);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:var(--red);">
    <i class="fas fa-trash-alt"></i>
  </div>
  <h3 style="font-size:17px;margin-bottom:8px;">Hapus Data?</h3>
  <p id="modal-msg" style="font-size:13px;color:var(--muted);margin-bottom:24px;"></p>
  <div style="display:flex;gap:10px;justify-content:center;">
    <button onclick="closeModal()" class="btn btn-outline">Batal</button>
    <a id="modal-confirm" href="#" class="btn btn-danger">Ya, Hapus</a>
  </div>
</div>

<script>
  function confirmDelete(id, nama) {
    document.getElementById('modal-msg').textContent = 'Data "' + nama + '" akan dihapus permanen.';
    document.getElementById('modal-confirm').href = '<?= base_url('mahasiswa/hapus/') ?>' + id;
    document.getElementById('modal-overlay').style.display = 'block';
    document.getElementById('modal-box').style.display = 'block';
  }
  function closeModal() {
    document.getElementById('modal-overlay').style.display = 'none';
    document.getElementById('modal-box').style.display = 'none';
  }
</script>