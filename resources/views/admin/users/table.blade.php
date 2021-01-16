<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

    <table id="data-table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
        <thead>
        <tr>
            <th data-priority="0">ID</th>
            <th data-priority="1">Name</th>
            <th data-priority="2">Email</th>
            <th data-priority="3">Role</th>
            <th data-priority="4">Email Verified At</th>
            <th data-priority="5">Created At</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

        @foreach($users as $user)

            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles[0]->name }}</td>
                <td>{{ $user->email_verified_at ?? 'N/A' }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>
