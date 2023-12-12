@extends('layouts.app')

@section('title', 'Sektor Usaha')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Sektor Usaha</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <x-card>
            <x-slot name="header">
                <a href="{{ route('sektor.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</a>
            </x-slot>

            <form action="" class="d-flex justify-content-between">
                <x-dropdown-table />
                <x-filter-table />
            </form>

            <x-table>
                <x-slot name="thead">
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th width="15%"><i class="fas fa-cog"></i></th>
                </x-slot>
                
                @foreach ($sektor as $key => $item)
                <tr>
                    <td><x-number-table :key="$key" :model="$sektor" /></td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <form action="{{ route('sektor.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('sektor.edit', $item->id) }}" class="btn btn-link text-primary"><i class="fas fa-pencil-alt"></i></a>
                            <button class="btn btn-link text-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </x-table>

            <x-pagination-table :model="$sektor" />
        </x-card>
    </div>
</div>
@endsection

<x-toast />