<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="col-md-12">
	<?php if (!empty($data['data']['msg'])): ?>
		<?php echo alert($data['data']['status'],$data['data']['msg']) ?>
		<?php if (!empty($data['data']['msgs'])): ?>
			<?php foreach ($data['data']['msgs'] as $key => $value): ?>
					<?php echo alert($data['data']['status'], $value) ?>
				<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['data'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> Galery
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="title">title</label>
					<input type="text" class="form-control" name="title" placeholder="title" value="<?php echo @$data['data']['title'] ?>" minlength="6" maxlength="16" required>
				</div>
				<div class="form-group ">
					<label for="folder">folder</label>
					<select name="folder_id" class="form-control select2" style="width: 100%;" required>
						<option value="0">None</option>
						<?php if (!empty($data['folder'])): ?>
							<?php foreach ($data['folder'] as $key => $value): ?>
								<?php $selected = ''; ?>
								<?php if ($value['id'] == @$data['data']['folder_id']): ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['title'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="photo">photo (max file size 3Mb)</label>
					<div class="custom-file">
						<input type="file" name="img" class="form-control custom-file-label" id="photo">
					</div>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>