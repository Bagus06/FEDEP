<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">
				<i class="fas fa-table"></i>
				Question
				<a href="<?php echo base_url("question/edit") ?>" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah question</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>number</th>
								<th>title</th>
								<th>score</th>
								<th>type jawaban</th>
								<th style="text-align: center">action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
								<th>number</th>
								<th>title</th>
								<th>score</th>
								<th>type jawaban</th>
								<th style="text-align: center">action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php $i = 1; ?>
							<?php if (!empty($data)) : ?>
								<?php foreach ($data as $key => $value) : ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $value['number'] ?></td>
										<td><?php echo $value['title'] ?></td>
										<td><?php echo $value['score'] ?></td>
										<td>
											<?php 
												if ($value['type_jawaban'] == 1) {
													echo "isian";
												}elseif ($value['type_jawaban'] == 2) {
													echo "ceklist";
												}elseif ($value['type_jawaban'] == 3) {
													echo "files";
												}
											 ?>
										</td>
										<td align="center">
											<a href="<?php echo base_url('question/edit/' . $value['id']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
											| 
											<a href="<?php echo base_url('question/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus question nomor <?php echo $value['number'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
										</td>
									</tr>
									<?php $i++; ?>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
			<div class="card-footer small text-muted">by : FEDEP</div>
		</div>
	</div>
</div>