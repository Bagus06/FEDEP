<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<div class="col-md-12">
		<div class="card card-warning">
			<div class="card-header">
				<div class="card-title"><div class="btn btn-sm btn-warning">Data Cluster</div> <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-sm btn-warning"><span class="fas fa-home"></span> Kembali</a>
				<a href="<?php echo base_url('kelembagaan/edit/' . $profiles['user_id']); ?>" class="btn btn-sm btn-warning"><span class="fas fa-user"></span> Profile Kelembagaan</a></div>
			</div>
			<div class="card-body col-md-12 row">
				<div class="col-md-7">
					<table border="0">
						<tr>
							<td style="width: 25%">nama</td>
							<td style="width: 1%">:</td>
							<td><?php echo $profiles['nama'] ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Telepon/Wa</td>
							<td style="width: 1%">:</td>
							<td><?php echo $profiles['no_tlp'] ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Alamat</td>
							<td style="width: 1%">:</td>
							<td><?php echo $profiles['alamat'] ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Nama Usaha</td>
							<td style="width: 1%">:</td>
							<td><?php echo $profiles['nama_usaha'] ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Alamat</td>
							<td style="width: 1%">:</td>
							<td>
								<?php if ($profiles['gender'] == 0): ?>
									<?php echo 'Perempuan'; ?>
								<?php elseif($profiles['gender'] == 1): ?>
									<?php echo 'Laki-laki'; ?>
								<?php else: ?>
									<?php echo 'lainnya'; ?>
								<?php endif ?>
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-5" align="right">
					<img style="width: 200px; max-width: 200px" src="<?php echo base_url('assets/images/user/' . $profiles['img']) ?>" alt="No Match">
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Response dari <?php echo $profiles['nama']; ?></h3>
			</div>
			<div class="card-body">
				<?php foreach ($data as $key => $value): ?>
					<div class="col-md-12 row">
						<p><?php echo $value['number'] ?>. </p>
						<p><?php echo $value['title'] ?></p>
					</div>
					<?php if ($value['sub_question'] == 1): ?>
						<p style="margin-top: -20px; padding-left: 12px"><?php echo $value['question_title_sub'] ?></p>
					<?php endif ?>
					
					<?php if ($value['type_jawaban'] == 1): ?>
						<div style="margin-top: -35px; padding-left: 22px" class="col-md-12 row">
							<p>Response :  </p>
							<?php if (empty($value['isian'])): ?>
								<p>Belum di isi</p>
							<?php else: ?>
								<p><?php echo $value['isian']; ?></p>
							<?php endif ?>
						</div>
					<?php elseif($value['type_jawaban'] == 2): ?>
						<div style="margin-top: -35px; padding-left: 22px" class="col-md-12 row">
							<p>Response :  </p>
							<?php if (empty($value['ceklist'])): ?>
								<p>Belum di isi</p>
							<?php else: ?>
								<p><?php echo $value['ceklist']; ?></p>
							<?php endif ?>
						</div>
					<?php elseif($value['type_jawaban'] == 3): ?>
						<div style="margin-top: -35px; padding-left: 22px" class="col-md-12 row">
							<p>Files :  </p>
							<?php if (empty($value['img'])): ?>
								<p>Belum di isi</p>
							<?php else: ?>
								<p>
									
									<a href="<?php echo base_url("assets/images/archiv/" . $value['img']) ?>" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> View file</a>
								</p>
							<?php endif ?>
						</div>
					<?php endif ?>
					<div style="margin-top: -35px; padding-left: 22px" class="col-md-12 row">
						<p>keterangan :  </p>
						<?php if (empty($value['ket'])): ?>
							<p>Tanpa keterangan</p>
						<?php else: ?>
							<p><?php echo $value['ket']; ?></p>
						<?php endif ?>
					</div>

				<?php endforeach ?>
			</div>
		<!-- /.card-body -->
		</div>
	<!-- /.card -->
	</div>
</div>