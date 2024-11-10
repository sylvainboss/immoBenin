@extends('profile.layout')

@section('profile')
    <div class="container" style="width: 950px">
        <div class="card shadow-sm">
            <div class="card-header text-white">
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
                            <th>Ville</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $index => $item)
                            <tr>
                                <td class=" text-white">{{ $index + 1 }}</td>
                                <td class=" text-white">{{ $item->nom }}</td>
                                <td class=" text-white">{{ $item->superficie }} m²</td>
                                <td class=" text-white">{{ number_format($item->prix, 0, ',', ' ') }} CFA</td>
                                <td class=" text-white">{{ $item->ville->nom }}</td>
                                <td class="text-end">
                                    <!-- Boutons d'action -->
                                    <a href="{{ route('property.xyz.show', $item->id) }}" class="btn btn-sm btn-outline-success me-2">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>
                                    <a href="{{ route('property.xyz.edit', $item->id) }}" class="btn btn-sm btn-outline-warning me-2">
                                        <i class="bi bi-pencil-square"></i> Éditer
                                    </a>
                                    <form action="{{ route('property.xyz.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
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
