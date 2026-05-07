<style>
  .detail-wrap { display:grid; grid-template-columns:280px 1fr; gap:24px; max-width:900px; }
  .detail-card { background:var(--card); border:1px solid var(--border); border-radius:var(--radius); overflow:hidden; }
  .profile-card { text-align:center; padding:32px 24px; }
  .profile-img { width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid var(--border2); margin-bottom:16px; }
  .profile-name { font-size:18px; font-weight:800; margin-bottom:4px; }
  .profile-nim { font-family:var(--mono); font-size:13px; color:var(--muted2); margin-bottom:12px; }
  .badge { display:inline-flex;align-items:center;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600; }
  .badge-aktif  { background:rgba(34,201,132,.1);color:var(--green); }
  .badge-cuti   { background:rgba(245,166,35,.1);color:var(--yellow); }
  .badge-lulus  { background:rgba(79,142,247,.1);color:var(--accent); }
  .badge-do     { background:rgba(242,92,84,.1);color:var(--red); }
  .info-card-header { padding:18px 22px; border-bottom:1px solid var(--border); font-size:14px; font-weight:700; }
  .info-card-header i { color:var(--accent); margin-right:8px; }
  .info-row { display:flex; align-items:center; padding:14px 22px; border-bottom:1px solid var(--border); }
  .info-row:last-child { border-bottom:none; }
  .info-key { width:130px; font-size:12px; color:var(--muted); font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
  .info-val { font-size:14px; font-weight:500; }
  .ipk-big { font-family:var(--mono); font-size:22px; font-weight:700; color:var(--accent); }
  .actions { display:flex; gap:10px; padding:20px 22px; border-top:1px solid var(--border); }
  .btn { display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;border:none;transition:all .2s;text-decoration:none;font-family:var(--font); }
  .btn-primary { background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff; }
  .btn-primary:hover { transform:translateY(-1px); }
  .btn-outline { background:transparent;border:1px solid var(--border2);color:var(--muted2); }
  .btn-outline:hover { border-color:var(--accent);color:var(--accent); }
</style>

<div class="detail-wrap">

  <!-- Kartu Profil (kiri) -->
  <div class="detail-card profile-card">
    <img src="<?= base_url('uploads/foto/'.$mahasiswa->foto) ?>" class="profile-img"
      onerror="this.src='<?= base_url('uploads/foto/default.png') ?>'">
    <div class="profile-name"><?= htmlspecialchars($mahasiswa->nama) ?></div>
    <div class="profile-nim"><?= htmlspecialchars($mahasiswa->nim) ?></div>
    <span class="badge badge-<?= strtolower($mahasiswa->status == 'DO' ? 'do' : strtolower($mahasiswa->status)) ?>">
      <?= $mahasiswa->status ?>
    </span>
    <div style="margin-top:24px;border-top:1px solid var(--border);padding-top:20px;">
      <div style="font-size:11px;color:var(--muted);margin-bottom:4px;">Terdaftar sejak</div>
      <div style="font-size:13px;"><?= date('d F Y', strtotime($mahasiswa->created_at)) ?></div>
    </div>
  </div>

  <!-- Kartu Info Akademik (kanan) -->
  <div class="detail-card">
    <div class="info-card-header">
      <i class="fas fa-info-circle"></i>Informasi Akademik
    </div>
    <div class="info-row">
      <span class="info-key">Email</span>
      <span class="info-val"><?= htmlspecialchars($mahasiswa->email) ?></span>
    </div>
    <div class="info-row">
      <span class="info-key">Jurusan</span>
      <span class="info-val"><?= htmlspecialchars($mahasiswa->jurusan) ?></span>
    </div>
    <div class="info-row">
      <span class="info-key">Semester</span>
      <span class="info-val"><?= $mahasiswa->semester ?></span>
    </div>
    <div class="info-row">
      <span class="info-key">IPK</span>
      <span class="info-val">
        <span class="ipk-big"><?= number_format($mahasiswa->ipk, 2) ?></span>
        <span style="color:var(--muted);font-size:12px;margin-left:4px;">/ 4.00</span>
        <div style="margin-top:8px;height:5px;background:var(--bg);border-radius:4px;width:200px;">
          <div style="height:100%;border-radius:4px;background:linear-gradient(90deg,var(--accent),var(--green));width:<?= ($mahasiswa->ipk/4)*100 ?>%;"></div>
        </div>
      </span>
    </div>
    <div class="actions">
      <a href="<?= base_url('mahasiswa/edit/'.$mahasiswa->id) ?>" class="btn btn-primary">
        <i class="fas fa-pen"></i> Edit Data
      </a>
      <a href="<?= base_url('mahasiswa') ?>" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

</div>