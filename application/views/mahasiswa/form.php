<style>
  .form-card {
    background:var(--card); border:1px solid var(--border);
    border-radius:var(--radius); overflow:hidden; max-width:780px;
  }
  .form-card-header {
    padding:22px 28px; border-bottom:1px solid var(--border);
    display:flex; align-items:center; gap:12px;
  }
  .form-card-header i { color:var(--accent); }
  .form-card-header h2 { font-size:17px; font-weight:700; }
  .form-card-body { padding:28px; }
  .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
  .form-group { display:flex; flex-direction:column; gap:6px; }
  .form-group.full { grid-column:1/-1; }
  .form-label { font-size:12px; font-weight:700; color:var(--muted2); text-transform:uppercase; letter-spacing:.5px; }
  .form-label .req { color:var(--red); margin-left:2px; }
  .form-control {
    background:var(--bg2); border:1px solid var(--border2);
    border-radius:9px; color:var(--text); font-family:var(--font);
    font-size:14px; padding:11px 14px; outline:none; transition:border-color .2s;
    width:100%;
  }
  .form-control:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(79,142,247,.1); }
  .form-control.is-invalid { border-color:var(--red); }
  .invalid-feedback { font-size:11px; color:var(--red); margin-top:2px; }
  .photo-preview {
    width:80px; height:80px; border-radius:50%; object-fit:cover;
    border:2px solid var(--border2); margin-bottom:8px;
  }
  .photo-wrap { display:flex; align-items:center; gap:16px; }
  .form-actions {
    padding:20px 28px; border-top:1px solid var(--border);
    display:flex; align-items:center; gap:12px;
  }
  .btn { display:inline-flex;align-items:center;gap:8px;padding:11px 22px;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;border:none;transition:all .2s;text-decoration:none;font-family:var(--font); }
  .btn-primary { background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;box-shadow:0 4px 16px rgba(79,142,247,.3); }
  .btn-primary:hover { transform:translateY(-1px); }
  .btn-outline { background:transparent;border:1px solid var(--border2);color:var(--muted2); }
  .btn-outline:hover { border-color:var(--accent);color:var(--accent); }
</style>

<?= form_open_multipart('mahasiswa/'.$action) ?>
<div class="form-card">
  <div class="form-card-header">
    <i class="fas fa-<?= isset($mahasiswa) ? 'user-edit' : 'user-plus' ?> fa-lg"></i>
    <h2><?= $title ?></h2>
  </div>
  <div class="form-card-body">
    <div class="form-grid">

      <div class="form-group">
        <label class="form-label">NIM <span class="req">*</span></label>
        <input type="text" name="nim" class="form-control <?= form_error('nim')?'is-invalid':'' ?>"
          value="<?= set_value('nim', isset($mahasiswa)?$mahasiswa->nim:'') ?>" placeholder="Contoh: 2024001">
        <?php if(form_error('nim')): ?><span class="invalid-feedback"><?= form_error('nim') ?></span><?php endif; ?>
      </div>

      <div class="form-group">
        <label class="form-label">Nama Lengkap <span class="req">*</span></label>
        <input type="text" name="nama" class="form-control <?= form_error('nama')?'is-invalid':'' ?>"
          value="<?= set_value('nama', isset($mahasiswa)?$mahasiswa->nama:'') ?>" placeholder="Nama lengkap">
        <?php if(form_error('nama')): ?><span class="invalid-feedback"><?= form_error('nama') ?></span><?php endif; ?>
      </div>

      <div class="form-group full">
        <label class="form-label">Email <span class="req">*</span></label>
        <input type="email" name="email" class="form-control <?= form_error('email')?'is-invalid':'' ?>"
          value="<?= set_value('email', isset($mahasiswa)?$mahasiswa->email:'') ?>" placeholder="email@contoh.com">
        <?php if(form_error('email')): ?><span class="invalid-feedback"><?= form_error('email') ?></span><?php endif; ?>
      </div>

      <div class="form-group">
        <label class="form-label">Jurusan <span class="req">*</span></label>
        <select name="jurusan" class="form-control <?= form_error('jurusan')?'is-invalid':'' ?>">
          <option value="">-- Pilih Jurusan --</option>
          <?php foreach(['Teknik Informatika','Sistem Informasi','Teknik Elektro','Manajemen Informatika','Ilmu Komputer'] as $j): ?>
            <option value="<?= $j ?>" <?= set_select('jurusan',$j,(isset($mahasiswa)&&$mahasiswa->jurusan==$j)) ?>><?= $j ?></option>
          <?php endforeach; ?>
        </select>
        <?php if(form_error('jurusan')): ?><span class="invalid-feedback"><?= form_error('jurusan') ?></span><?php endif; ?>
      </div>

      <div class="form-group">
        <label class="form-label">Status <span class="req">*</span></label>
        <select name="status" class="form-control <?= form_error('status')?'is-invalid':'' ?>">
          <?php foreach(['Aktif','Cuti','Lulus','DO'] as $s): ?>
            <option value="<?= $s ?>" <?= set_select('status',$s,(isset($mahasiswa)&&$mahasiswa->status==$s)) ?>><?= $s ?></option>
          <?php endforeach; ?>
        </select>
        <?php if(form_error('status')): ?><span class="invalid-feedback"><?= form_error('status') ?></span><?php endif; ?>
      </div>

      <div class="form-group">
        <label class="form-label">Semester <span class="req">*</span></label>
        <input type="number" name="semester" class="form-control <?= form_error('semester')?'is-invalid':'' ?>"
          value="<?= set_value('semester', isset($mahasiswa)?$mahasiswa->semester:'') ?>" min="1" max="14" placeholder="1 - 14">
        <?php if(form_error('semester')): ?><span class="invalid-feedback"><?= form_error('semester') ?></span><?php endif; ?>
      </div>

      <div class="form-group">
        <label class="form-label">IPK <span class="req">*</span></label>
        <input type="number" name="ipk" class="form-control <?= form_error('ipk')?'is-invalid':'' ?>"
          value="<?= set_value('ipk', isset($mahasiswa)?$mahasiswa->ipk:'') ?>" step="0.01" min="0" max="4" placeholder="0.00 - 4.00">
        <?php if(form_error('ipk')): ?><span class="invalid-feedback"><?= form_error('ipk') ?></span><?php endif; ?>
      </div>

      <div class="form-group full">
        <label class="form-label">Foto Profil</label>
        <div class="photo-wrap">
          <img id="preview" src="<?= base_url('uploads/foto/'.(isset($mahasiswa)?$mahasiswa->foto:'default.png')) ?>"
            class="photo-preview" onerror="this.src='<?= base_url('uploads/foto/default.png') ?>'">
          <div>
            <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewFoto(this)" style="padding:8px;">
            <p style="font-size:11px;color:var(--muted);margin-top:5px;">JPG/PNG/WEBP, maks. 2MB. Kosongkan jika tidak ingin mengubah.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="form-actions">
    <button type="submit" class="btn btn-primary">
      <i class="fas fa-save"></i> <?= isset($mahasiswa) ? 'Simpan Perubahan' : 'Simpan Data' ?>
    </button>
    <a href="<?= base_url('mahasiswa') ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
  </div>
</div>
<?= form_close() ?>

<script>
  function previewFoto(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => document.getElementById('preview').src = e.target.result;
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>