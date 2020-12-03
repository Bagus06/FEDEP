<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<div class="col-md-12">
		<div class="card card-warning">
			<div class="card-header">
				<div class="card-title"><div class="btn btn-sm btn-warning">Data Cluster</div> <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-sm btn-warning"><span class="fas fa-home"></span> Kembali</a></div>
			</div>
			<div class="card-body col-md-12 row">
				<div class="col-md-7">
					<table border="0">
					<?php $idf = get_user()['id']; $profiles = get_profile_all($idf) ?>
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
					<img style="width: 200px; max-width: 200px" src="<?php echo base_url('assets/images/user/' . get_profile($idf)) ?>" alt="No Match">
				</div>
			</div>
		</div>
		<?php if (!empty($data['msg'])): ?>
			<?php echo alert($data['status'],$data['msg']) ?>
			<?php if (!empty($data['msgs'])): ?>
				<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
			<?php endif ?>
		<?php endif ?>
		<form role="form" method="post" enctype="multipart/form-data">
			<div class="card card-warning">
				<div class="card-header">
					<h3 class="card-title">Quesioner</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<!-- textarea -->
							<?php foreach ($data['data'] as $key => $value): ?>
								<div class="form-group">
									<?php $disable1 = ''; ?>
									<?php $disable2 = ''; ?>
									<?php $disable3 = ''; ?>
									<?php if ($value['type_jawaban'] != 1): ?>
										<?php $disable1 = 'none'; ?>
									<?php endif ?>
									<?php if ($value['type_jawaban'] != 2): ?>
										<?php $disable2 = 'none'; ?>
									<?php endif ?>
									<?php if ($value['type_jawaban'] != 3): ?>
										<?php $disable3 = 'none'; ?>
									<?php endif ?>
									<input type="hidden" name="question_id[]" value="<?php echo $value['id']; ?>">
									<div class="col-md-12 row">
										<p><?php echo $value['number'] ?>. </p>
										<p><?php echo $value['title'] ?></p>
									</div>
									<?php if ($value['sub_question'] == 1): ?>
										<p style="margin-top: -20px; padding-left: 12px"><?php echo $value['question_title_sub'] ?></p>
									<?php endif ?>
									<label for="Isian" >Isian</label>
									<div style="display: <?php echo $disable1; ?>">
										<textarea id="isian" name="isian[]" class="form-control" rows="3" placeholder="isian"></textarea>
									</div>
									<div class="form-group" style="display: <?php echo $disable2; ?>">
										<?php $ceklist = explode(',',$value['ceklist']); ?>
										<div class="form-group" >
											<label>Custom Select</label>
											<select class="custom-select" name="ceklist[]">
												<option value="">none</option>
												<?php foreach ($ceklist as $keys => $valceklist): ?>
													<option value="<?php echo $valceklist; ?>"><?php echo $valceklist; ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div style="display: <?php echo $disable3; ?>">
										<small style="color: red; "><i>*max file size 4Mb dan pastikan file berformat jpg,jpeg,png ataupun pdf</i></small>
										<div id="img" class="custom-file" style="">
											<input type="file" name="img[]" class="form-control custom-file-label" id="photo">
										</div>
									</div>
									<label for="ket" >Keterangan</label>
									<textarea id="ket" name="ket[]" class="form-control" rows="3" placeholder="keterangan"></textarea>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
			</div>
			<div align="center">
				<?php $display = ''; ?>
				<?php if (is_operator() || is_admin() || is_pimpinan()): ?>
					<?php $display = 'none'; ?>
				<?php endif ?>
				<button type="submit" class="btn btn-block btn-info" style="display: <?php echo $display; ?>">Simpan</button>
				<a href="<?php echo base_url('dashboard') ?>" class="btn btn-block btn-danger">Batal</a>
			</div>
		</form>
		<!-- /.card -->
	</div>
</div>