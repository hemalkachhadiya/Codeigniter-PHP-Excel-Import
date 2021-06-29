<link href="<?= base_url() ?>/public/dist/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url() ?>/public/dist/css/datatablecustome.css" rel="stylesheet">
<div>
	<form action="<?= base_url() ?>/users/import" method="post" enctype="multipart/form-data">
		<div class="rounded bg-white mb-4 md:text-center">
			<div class="border-b-2 p-2">
				<h2 class="font-bold text-md">Import Excel</h2>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 p-2">
				<div class="col-span-1">
					<input type="file" name="excel" class="bg-gray-400 p-2 rounded-md mb-4 md:mb-0 w-full md:w-80 text-white" required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
				</div>
				<div class="col-span-1">
					<button type="submit" class="p-2 bg-green-400 rounded-md hover:bg-green-600 text-white">Import</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div>
	<div class="flex flex-col">
		<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
				<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
					<table class="min-w-full divide-y divide-gray-200" id="table">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Email
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Phone
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Address
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Action
								</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>/public/dist/js/jquery-3.5.1.js"></script>
<script src="<?= base_url() ?>/public/dist/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/public/dist/js/users.js"></script>