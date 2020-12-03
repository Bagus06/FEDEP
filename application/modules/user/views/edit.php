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
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['user'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?>
				 <?php if (is_operator()): ?>
				 	 cluster
				 <?php else: ?>
				 	 user
				 <?php endif ?>
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="username">username</label>
					<input type="text" class="form-control" name="username" placeholder="username" value="<?php echo @$data['user']['username'] ?>" required>
				</div>
				<div class="form-group">
					<label for="email">email</label>
					<input type="email" class="form-control" name="email" placeholder="email" value="<?php echo @$data['user']['email'] ?>" required>
				</div>
				<?php if (!empty($data['user'])): ?>
					<div class="form-group">
						<?php $id_iactive[] = @$data['user']['is_active']; ?>
						<?php if (!empty($is_active)) : ?>
							<?php foreach ($is_active as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $id_iactive)) : ?>
									<?php $selected = 'checked'; ?>
								<?php endif ?>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="iactive<?php echo $value['id'] ?>" name="is_active" value="<?php echo $value['id'] ?>" <?php echo $selected ?>>
									<label for="iactive<?php echo $value['id'] ?>" class="custom-control-label"><?php echo $value['title'] ?></label>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
				<?php endif ?>
				<div class="form-group">
					<label for="password">password</label>
					<input type="password" class="form-control" name="password" placeholder="password">
				</div>
				<div class="form-group">
					<label for="nama">nama</label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['user_profile']['nama'] ?>" required>
				</div>
				<div class="form-group">
					<label for="photo">photo (max file size 3Mb)</label>
					<div class="custom-file">
						<input type="file" name="img" class="form-control custom-file-label" id="photo">
					</div>
				</div>
				<div class="form-group">
					<label for="no_telephone">no tlp</label>
					<input type="number" class="form-control" name="no_tlp" placeholder="no tlp" value="<?php echo @$data['user_profile']['no_tlp'] ?>" required>
				</div>
				<div class="form-group">
					<label for="nama_usaha">nama usaha</label>
					<input type="text" class="form-control" name="nama_usaha" placeholder="nama_usaha" value="<?php echo @$data['user_profile']['nama_usaha'] ?>" required>
				</div>
				<div class="form-group">
					<label for="alamat">alamat</label>
					<textarea type="text" class="form-control" rows="3" name="alamat" placeholder="alamat" value="<?php echo @$data['user_profile']['alamat'] ?>" required><?php echo @$data['user_profile']['alamat'] ?></textarea>
				</div>
				<div class="form-group">
					<?php $id_gender[] = @$data['user_profile']['gender'] ?>
					<?php if (!empty($gender)) : ?>
						<?php foreach ($gender as $key => $value) : ?>
							<?php $selected = ''; ?>
							<?php if (in_array($value['id'], $id_gender)) : ?>
								<?php $selected = 'checked'; ?>
							<?php endif ?>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" type="radio" id="gender<?php echo $value['id'] ?>" name="gender" value="<?php echo $value['id'] ?>" <?php echo $selected ?> required>
								<label for="gender<?php echo $value['id'] ?>" class="custom-control-label"><?php echo $value['title'] ?></label>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
				<div class="form-group">
					<label for="role">role</label>
					<select class="custom-select" name="role[]" multiple required>
						<?php if (!empty($role)): ?>
						  <?php foreach ($role as $key => $value): ?>
						  	<?php $selected = ''; ?>
						  	<?php $disabled = ''; ?>
						  	<?php if (in_array($value['id'], $data['user_role'])): ?>
						  		<?php $selected = 'selected'; ?>
						  	<?php endif ?>
						  	<?php if (is_operator()): ?>
						  		<?php if ($value['id'] == 4): ?>
						  			<?php $selected = 'selected'; ?>
						  		<?php endif ?>
						  		<?php if ($value['id'] != 4): ?>
									<?php $disabled = 'disabled'; ?>
						  		<?php endif ?>
						  	<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?> <?php echo $disabled; ?>><?php echo $value['title'] ?></option>
						  <?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>