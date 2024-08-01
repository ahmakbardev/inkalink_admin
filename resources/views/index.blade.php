@extends('layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">Dashboard</h1>
    </div>
    <div class="-mt-12 mx-6 mb-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 xl:grid-cols-2">
        <!-- Eligibility Results Card -->
        <div class="card shadow">
            <div class="card-body">
                <div class="flex justify-between items-center">
                    <h4>Eligibility Results</h4>
                    <div
                        class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                        <i data-feather="check-circle"></i>
                    </div>
                </div>
                <div class="mt-4 flex flex-col gap-0 text-base">
                    <h2 class="text-xl font-bold">{{ $eligibilityData->count() }}</h2>
                    <div>
                        <span>{{ $eligibilityData->count() }}</span>
                        <span class="text-gray-500">Entries</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Personality Test Results Card -->
        <div class="card shadow">
            <div class="card-body">
                <div class="flex justify-between items-center">
                    <h4>Personality Test Results</h4>
                    <div
                        class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
                <div class="mt-4 flex flex-col gap-0 text-base">
                    <h2 class="text-xl font-bold">{{ $personalityTestData->count() }}</h2>
                    <div>
                        <span>{{ $personalityTestData->count() }}</span>
                        <span class="text-gray-500">Entries</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-6 grid grid-cols-1 xl:grid-cols-1 grid-rows-1 grid-flow-row-dense gap-6">
        <div class="">
            <div class="card h-full shadow">
                <!-- heading -->
                <div class="border-b border-gray-300 px-5 py-4">
                    <h4>Eligibility Results</h4>
                </div>

                <div class="relative overflow-x-auto">
                    <!-- table -->
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="text-gray-700">
                            <tr>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">User</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Grades</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Overall Average</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eligibilityData as $result)
                                <tr>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $result->user_name }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        @foreach ($result->grades as $semester => $grades)
                                            <strong>Semester {{ $semester }}:</strong>
                                            <ul>
                                                @foreach ($grades as $subject => $grade)
                                                    <li>{{ $subject }}: {{ $grade }}</li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $result->overall_average }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $result->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card h-full shadow">
            <div class="border-b border-gray-300 px-5 py-4">
                <h4>Personality Test Results</h4>
            </div>
            <div class="relative overflow-x-auto" data-simplebar="" style="max-height: 380px">
                <!-- table -->
                <table class="text-left w-full whitespace-nowrap">
                    <thead class="text-gray-700">
                        <tr>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">User</th>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Category Counts</th>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Top Categories</th>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personalityTestData as $result)
                            <tr>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    {{ $result->user_name }}</td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <ul>
                                        @foreach ($result->category_counts as $category => $count)
                                            <li>{{ $category }}: {{ $count }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <ul>
                                        @foreach ($result->top_categories as $category)
                                            <li>{{ $category }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    {{ $result->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
