<div class="space-y-4">
    <div class="flex space-x-2">
        <input type="text" wire:model="search" class="border p-2 w-full" placeholder="Suche nach Titel..">

        <select wire:model="statusFilter" class="border p-2">
            <option value="">Status auswählen</option>
            <option value="pending">Pending</option>
            <option value="active">Active</option>
            <!-- Dodajte ostale statuse po potrebi -->
        </select>

        <select wire:model="isActiveFilter" class="border p-2">
            <option value="">Alle Jobs</option>
            <option value="0">Inactive</option>
            <option value="1">Active</option>
        </select>

        <input type="date" wire:model="dateFilter" class="border p-2">
    </div>

    <table class="w-full table-auto border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">ID</th>
                <th class="border p-2">Title</th>
                <th class="border p-2">Description</th>
                <th class="border p-2">Status</th>
                <!-- Dodajte ostale kolone prema potrebi -->
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr>
                    <td class="border p-2">{{ $job->id }}</td>
                    <td class="border p-2">{{ $job->title }}</td>
                    <td class="border p-2">{{ $job->description }}</td>
                    <td class="border p-2">{{ $job->status }}</td>
                    <!-- Dodajte ostale podatke prema potrebi -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
