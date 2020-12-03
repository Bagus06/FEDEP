<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Detail Produk <?php echo $data['data']['nama'] ?></h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<strong>Status</strong>
			<p class="text-muted">
				<?php if ($data['data']['status'] == 0): ?>
					<button class="btn btn-block btn-outline-warning btn-sm">Belum di diskusikan</button>
				<?php elseif ($data['data']['status'] == 1): ?>
					<button class="btn btn-block btn-outline-info btn-sm">Sedang Didiskusikan</button>
				<?php elseif ($data['data']['status'] == 2): ?>
					<button class="btn btn-block btn-outline-success btn-sm">Pengajuan diterima</button>
				<?php elseif ($data['data']['status'] == 3): ?>
					<button class="btn btn-block btn-outline-danger btn-sm">Pengajuan ditolak</button>
				<?php endif ?>
			</p>
			<hr>
			<?php if (is_pimpinan()): ?>
				<strong>Anggota yang mengajukan</strong>
				<p class="text-muted">
					<?php echo $data['data']['nama_user'] ?>
				</p>
				<hr>
			<?php endif ?>
			<strong>Fungsi</strong>
			<p class="text-muted">
				<?php echo $data['data']['fungsi'] ?>
			</p>
			<hr>
			<strong>Volume Produk</strong>
			<p class="text-muted">
				<?php echo $data['data']['volume'] ?>
			</p>
			<hr>
			<strong>Harga</strong>
			<p class="text-muted">
				<?php echo money($data['data']['harga']); ?>
			</p>
			<hr>
			<strong>Sumber Dana</strong>
			<p class="text-muted">
				<?php echo $data['data']['sumber_dana']; ?>
			</p>
			<hr>
			<strong>Penanggungjawab</strong>
			<p class="text-muted">
				<?php echo $data['data']['tanggung_jawab'] ?>
			</p>
			<hr>
			<strong>Hasil Diskusi</strong>
			<p class="text-muted">
				<?php echo $data['data']['volume'] ?>
			</p>
			<hr>
		</div>
		<!-- /.card-body -->
	</div>
</div>