@extends('admin-layout')

@section('admin')
    <div class="container" style="width: 900px">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card shadow-sm">
            <div class="card-header text-black">
                <h5 class="mb-0">La liste de vos annonces</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-striped w-100">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Surface</th>
                            <th>Prix</th>
                            <th>Etat</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $index => $item)
                            <tr>
                                <td class=" text-black">{{ $index + 1 }}</td>
                                <td class=" text-black">{{ $item->nom }}</td>
                                <td class=" text-black">{{ $item->superficie }} m²</td>
                                <td class=" text-black">{{ number_format($item->prix, 0, ',', ' ') }} CFA</td>
                                <td class=" text-black">
                                    @if ($item->accept)
                                        <span class="text-success">Publié</span>
                                    @else
                                        <span class="text-danger">En attente</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <!-- Boutons d'action -->
                                    <a href="{{ route('dashboard.viewProperty', $item->id) }}"
                                        class="btn btn-sm btn-outline-success me-2">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>
                                    <form action="{{ route('property.xyz.destroy', $item->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Aucune annonce disponible.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $properties->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
