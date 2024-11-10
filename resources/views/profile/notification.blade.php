@extends('profile.layout')

@section('profile')
    <div class="container my-5">
        <h2 class="mb-4">Notifications</h2>
        
        <!-- Vérification si l'utilisateur a des notifications -->
        @if ($notifications->isEmpty())
            <div class="alert alert-info">
                Vous n'avez aucune notification pour le moment.
            </div>
        @else
            <div class="list-group">
                @foreach ($notifications as $notification)
                    <div class="list-group-item d-flex justify-content-between align-items-center @if(!$notification->read_at) bg-light @endif">
                        <div>
                            <!-- Affichage du contenu de la notification -->
                            <p class=" text-black">{{ $notification->message }}</p>
                            
                            <!-- Affichage de la date de la notification -->
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        
                        <div class="btn-group">
                            <!-- Bouton pour marquer la notification comme lue -->
                            @if (!$notification->read)
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Marquer comme lu</button>
                            </form>
                            @endif
                            
                            <!-- Bouton pour supprimer la notification -->
                            <form action="{{ route('notifications.delete', $notification->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination des notifications -->
            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
@endsection
