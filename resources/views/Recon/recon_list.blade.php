<div class="card mb-3">
    <div class="card-header" style="color: #858796 !important;">RECORDS OF RECONSIDERATIONS</div>
    <div class="card-body">
        @if ($recons)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="w-10">#</th>
                        <th scope="col" class="w-10">NIT</th>
                        <th scope="col" class="w-10">EXPEDIENT</th>
                        <th scope="col" class="w-15">EMPLOYER</th>
                        <th scope="col" class="w-10">RUC</th>
                        <th scope="col" class="w-10">DATE OF ADMMISSION</th>
                        <th scope="col" class="w-10">FECHA LIMITE</th>
                        <th scope="col" class="w-10">STAGE</th>
                        <th scope="col" class="w-12">OPTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recons as $index => $recon)
                        <tr>
                            <td>{{ ($recons->currentPage() - 1) * $recons->perPage() + $index + 1 }}</td>
                            <td>{{ $recon->nit }}</td>
                            <td>{{ $recon->expediente }}</td>
                            <td>{{ $recon->empleador }}</td>
                            <td>{{ $recon->ruc }}</td>
                            <td>{{ \Carbon\Carbon::parse($recon->fecha_ingreso)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($recon->fecha_limite)->format('d/m/Y') }}</td>
                            <td>{{ $recon->est_notificar ? 'NOTIFIED' : ($recon->est_resolver ? 'RESOLVED' : ($recon->est_resolutor ? 'ASSIGNED' : '')) }}
                            </td>
                            <td>
                                <div class="button-column">
                                    @if ($recon->est_resolutor == '1')
                                        <button type="button" class="btn btn-primary rounded-circle"
                                            data-bs-toggle="modal tooltip" data-bs-placement="top"
                                            data-bs-target="#exampleModal"
                                            wire:click="abriModal('resolutor',{{ $recon->id_apelacion }})">
                                            <i class="bi bi-person-fill-check" style="font-size: 1.5rem;"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success rounded-circle"
                                            data-bs-toggle="modal tooltip" data-bs-placement="top"
                                            data-bs-target="#exampleModal"
                                            wire:click="abriModal('resolutor',{{ $recon->id_apelacion }})">
                                            <i class="bi bi-person-fill-add" style="font-size: 1.5rem;"></i>
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-secondary rounded-circle"
                                        data-bs-toggle="modal tooltip" data-bs-placement="top"
                                        data-bs-target="#exampleModal"
                                        wire:click="abriModal('ver_reconsideracion',{{ $recon->id_apelacion }})">
                                        <i class="bi bi-eye" style="font-size: 1.5rem;"></i>
                                    </button>

                                    <button type="button" class="btn btn-warning rounded-circle"
                                        data-bs-toggle="modal tooltip" data-bs-placement="top"
                                        data-bs-target="#exampleModal" title="Editar Reconsideracion"
                                        wire:click="abriModal('editar_reconsideracion',{{ $recon->id_apelacion }})">
                                        <i class="bi bi-pencil-square" style="font-size: 1.5rem; color: white;"></i>
                                    </button>

                                    <button
                                        onclick="window.location.href='{{ route('chatbot', $recon->id_apelacion) }}'"
                                        class="btn gradient-button" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Abrir ChatBot" style="color: white;">
                                        Chatbot
                                        <span class="icon-group">
                                            <i class="bi bi-robot" style="font-size: 1.5rem; color: white;"></i>
                                            <i class="bi bi-chat-text second-icon"></i>
                                        </span>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $recons->links() }}
            </button>
        @else
            <p>No hay datos disponibles.</p>
        @endif
    </div>

</div>
