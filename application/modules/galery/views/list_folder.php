<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-12">
		<?php if (!empty($data['msg'])): ?>
			<?php echo alert($data['status'],$data['msg']) ?>
			<?php if (!empty($data['msgs'])): ?>
				<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
			<?php endif ?>
		<?php endif ?>
		<a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-tambahfolder"><span class="fas fa-folder-plus"></span> Tambah folder</a>
		<a href="<?php echo base_url("galery/edit/") ?>" class="btn btn-info"><span class="fas fa-file-image"></span> Tambah gambar</a>

		<div style="padding-bottom: 20px"></div>

		<small>-isi deskripsi dengan "for-corousel" untuk menampilakn image di corousel home page</small>
		<br>
		<small>-isi deskripsi dengan "for-galery" untuk menampilakn image di galery</small>
		<br>
		<small>-protect  galery agar tidak dapat di hapus</small>
		<div style="padding-bottom: 20px"></div>
		
		<table border="0" class="col-md-12">
			<?php foreach ($data['folder'] as $key => $value): ?>
				<tr>
					<td>
						<a style="color: black; font-weight: bold;" href="<?php echo base_url("galery/folder/" . $value['id']) ?>">
							<span class="fas fa-2x fa-folder" style="color: #3498DB; padding-right: 6px"></span><?php echo $value['title'] ?>
						</a>
					</td>
					<td>
						<a data-toggle="modal" data-target="#modal-renamefolder<?php echo $value['id'] ?>" href="" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> rename</a>
						| 
						<a href="<?php echo base_url('folder/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus folder <?php echo $value['title'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
					</td>
						<?php if ($value['deskripsi'] != 'for-corousel' || $value['deskripsi'] != 'for-galery'): ?>
							<td>
								<div class="form-group">
									<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
										<?php $selected = ''; ?>
										<?php $status = 'Not Protect'; ?>
										<?php if ($value['protect'] == 1) : ?>
											<?php $selected = 'checked'; ?>
											<?php $status = 'Protect'; ?>
										<?php endif ?>
										<input onclick="window.location.href='<?php echo base_url('galery/list_folder/') . $value['id'] ?>?switch=<?php echo $value['protect'] ?>'"  type="checkbox" class="custom-control-input" id="customSwitch<?php echo $value['id'] ?>" <?php echo $selected ?> >
										<label class="custom-control-label" for="customSwitch<?php echo $value['id'] ?>"><?php echo $status; ?></label>
									</div>
								</div>
							</td>
						<?php endif ?>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>
			<?php endforeach ?>
		</table>

	</div>
</div>

<!-- modal -->
<div class="modal fade" id="modal-tambahfolder">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Folder</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="title">title</label>
						<input type="text" class="form-control" name="title" placeholder="title" value="<?php echo @$data['data']['title'] ?>" required>
					</div>
					<div class="form-group">
						<label for="dskripsi">dskripsi</label>
						<input type="text" class="form-control" name="deskripsi" placeholder="dskripsi" value="<?php echo @$data['data']['dskripsi'] ?>">
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">batal</button>
					<button type="submit" class="btn btn-primary">simpan</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<?php foreach ($data['folder'] as $key => $value): ?>
	<div class="modal fade" id="modal-renamefolder<?php echo $value['id'] ?>">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Rename Folder</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo base_url("galery/list_folder/") ?><?php echo $value['id'] ?>" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="title">title</label>
							<input type="text" class="form-control" name="title" placeholder="title" value="<?php echo @$value['title'] ?>" required>
						</div>
						<div class="form-group">
							<label for="dskripsi">dskripsi</label>
							<input type="text" class="form-control" name="deskripsi" placeholder="dskripsi" value="<?php echo @$value['deskripsi'] ?>">
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">batal</button>
						<button type="submit" class="btn btn-primary">simpan</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<?php endforeach ?>