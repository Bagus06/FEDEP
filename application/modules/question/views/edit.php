<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="col-md-12">
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
				<?php echo alert($data['status'], $value) ?>
			<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					<!-- general form elements -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">
								<?php if (empty($data['data'])): ?>
									tambah
									<?php else: ?>
										ubah
										<?php endif ?> question
									</h3>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<form method="post">
									<div class="card-body">
										<div class="form-group">
											<label for="number">nomor soal</label>
											<input type="number" name="number" class="form-control" id="number" placeholder="number" value="<?php echo @$data['data']['number'] ?>" required>
										</div>
										<div class="form-group">
											<label for="score">score</label>
											<input type="number" name="score" class="form-control" id="score" placeholder="score" value="<?php echo @$data['data']['score'] ?>" required>
										</div>
										<div class="form-group">
											<label>type jawaban</label>
											<select name="type_jawaban" class="custom-select" required>
												<?php foreach ($type_jawaban as $key => $value): ?>
													<?php $selected=''; ?>
													<?php if ($key == @$data['data']['type_jawaban']): ?>
														<?php $selected='selected'; ?>
													<?php endif ?>
													<option value="<?php echo $key ?>" <?php echo $selected; ?>><?php echo $value ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group">
											<label for="title">sub_soal</label>
											<div class="row">
												<div class="col-lg-12">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<?php
																	$checked = '';
																	if (@$data['data']['sub_question'] == 1) {
																		$checked = 'checked';
																	}
																 ?>
																<input name="sub_ceklist" type="checkbox" <?php echo $checked; ?>>
															</span>
														</div>
														<input name="sub_title" type="text" class="form-control" value="<?php echo @$data['data']['question_title_sub'] ?>">
													</div>
													<!-- /input-group -->
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="title">jawaban ceklis <small style="color: red">(*per judul ceklis beri tanda koma di blakangnya. Tanpa space!)</small></label>
											<div class="row">
												<div class="col-lg-12">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<?php
																	$checked = '';
																	if (@$data['data']['type_jawaban'] == 2) {
																		$checked = 'checked';
																	}
																?>
																<input name="jawaban_ceklist" type="checkbox" <?php echo $checked; ?>>
															</span>
														</div>
														<input name="isi_ceklist" <?php echo @$data['data']['ceklist'] ?> type="text" class="form-control">
													</div>
													<!-- /input-group -->
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Soal <small style="color: red">(*Jik soal yang di inputkan mempunyai sub soal, maka ketik semua soal sama. yang berbeda hanya sub soalnya)</small></label>
											<textarea name="soal" class="form-control" rows="3" placeholder="Tulis title berita disini" value="<?php echo @$data['data']['title'] ?>" required><?php echo @$data['data']['title'] ?></textarea>
										</div>
									</div>
									<!-- /.card-body -->

									<div class="card-footer" align="right">
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>