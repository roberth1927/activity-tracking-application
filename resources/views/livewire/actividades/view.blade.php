@section('title', __('Actividades'))
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Listado de Actividades  </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.3s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Actividades">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Actividades
						</div>
					</div>
				</div>

				<div class="card-body">
						@include('livewire.actividades.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
								<th>Descripcion</th>
								<th>Estado</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($actividades as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->descripcion }}</td>
								<td>{{ $row->estado ? 'Completada' : 'Pendiente' }}</td>
							{{-- 	<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Actions
										</a>
										<ul class="dropdown-menu">
											<li>
                                                <a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>
                                            </li>

                                            <li><a data-bs-toggle="modal"
                                                   data-bs-target="#getTimes"
                                                   class="dropdown-item"
                                                   wire:click="getTimes({{$row->id}})"><i class="fa fa-edit"></i> Tiempos </a>
                                            </li>

											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Actividade id {{$row->id}}? \nDeleted Actividades cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a></li>
										</ul>
									</div>
								</td> --}}


                                <td width="90" class="text-center">
                                    <div class="btn-group">

                                            <a data-bs-toggle="modal"
                                                x-data="{ scale: 1 }"
                                                x-bind:style="{ transform: 'scale(' + scale + ')',transition: 'transform 0.3s ease' }"
                                                @mouseenter="scale = 1.2" @mouseleave="scale = 1"
                                                data-bs-target="#updateDataModal"
                                                class="btn btn-sm btn-success rounded"
                                                wire:click="edit({{ $row->id }})">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a data-bs-toggle="modal"
                                                x-data="{ scale: 1 }"
                                                x-bind:style="{ transform: 'scale(' + scale + ')',transition: 'transform 0.3s ease' }"
                                                @mouseenter="scale = 1.2" @mouseleave="scale = 1"
                                                data-bs-target="#getTimes"
                                                class="btn btn-sm btn-info ms-2 me-2 rounded"
                                                wire:click="getTimes({{ $row->id }})">
                                                <i class="fa fa-clock"></i>
                                            </a>

                                            <a class="btn btn-sm btn-danger"
                                                onclick="confirm('Confirm Delete Task id {{ $row->id }}? \nDeleted Tasks cannot be recovered!')||event.stopImmediatePropagation()"
                                                wire:click="destroy({{ $row->id }})" x-data="{ scale: 1 }"
                                                x-bind:style="{ transform: 'scale(' + scale + ')',
                                                    transition: 'transform 0.3s ease' }"
                                                @mouseenter="scale = 1.2" @mouseleave="scale = 1">
                                                <i class="fa fa-trash rounded"></i>
                                            </a>
                                    </div>
                                </td>






























							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>
					<div class="float-end">{{ $actividades->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
